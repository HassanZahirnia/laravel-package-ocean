<?php

namespace App\Filament\Pages;

use App\Models\Package;
use App\Services\PackageHealthChecker;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class HealthChecks extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-heart';

    protected string $view = 'filament.pages.health-checks';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 100;

    public bool $isScanning = false;

    public bool $isPaused = false;

    public array $unhealthyPackages = [];

    public int $totalPackages = 0;

    public int $scannedPackages = 0;

    public int $healthyPackages = 0;

    public ?int $currentPackageId = null;

    public ?string $currentPackageName = null;

    private const CACHE_KEY_STATE = 'health_check_state';

    private const CACHE_KEY_RESULTS = 'health_check_results';

    public function mount(): void
    {
        // Only restore results from cache, not the scanning state
        // This prevents the UI from showing "scanning" when page is refreshed
        $cachedResults = Cache::get(self::CACHE_KEY_RESULTS, []);
        if ($cachedResults) {
            $this->unhealthyPackages = $cachedResults;

            // If we have cached results, also restore the stats
            $cachedState = Cache::get(self::CACHE_KEY_STATE);
            if ($cachedState) {
                $this->scannedPackages = $cachedState['scannedPackages'] ?? 0;
                $this->totalPackages = $cachedState['totalPackages'] ?? 0;
                $this->healthyPackages = $cachedState['healthyPackages'] ?? 0;
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('startScan')
                ->label($this->isScanning && ! $this->isPaused ? 'Scanning...' : ($this->isPaused ? 'Resume Scan' : 'Start Health Check'))
                ->icon($this->isScanning && ! $this->isPaused ? 'heroicon-o-arrow-path' : 'heroicon-o-play')
                ->color($this->isScanning && ! $this->isPaused ? 'gray' : 'primary')
                ->disabled($this->isScanning && ! $this->isPaused)
                ->action('startOrResumeScan')
                ->visible(! $this->isScanning || $this->isPaused),

            Action::make('pauseScan')
                ->label('Pause')
                ->icon('heroicon-o-pause')
                ->color('warning')
                ->action('pauseScan')
                ->visible($this->isScanning && ! $this->isPaused),

            Action::make('cancelScan')
                ->label('Cancel')
                ->icon('heroicon-o-x-mark')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Cancel Health Check?')
                ->modalDescription('Are you sure you want to cancel the health check? All progress will be lost.')
                ->action('cancelScan')
                ->visible($this->isScanning),

            Action::make('deleteAll')
                ->label('Delete All Unhealthy')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Delete All Unhealthy Packages?')
                ->modalDescription('Are you sure you want to delete all unhealthy packages? This action cannot be undone.')
                ->action('deleteAllUnhealthy')
                ->visible(count($this->unhealthyPackages) > 0 && ! $this->isScanning),

            Action::make('clearResults')
                ->label('Clear Results')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action('clearResults')
                ->visible(count($this->unhealthyPackages) > 0 && ! $this->isScanning),
        ];
    }

    public function startOrResumeScan(): void
    {
        if ($this->isPaused) {
            $this->isPaused = false;
            $this->persistState();
            $this->dispatch('resume-scan');
        } else {
            $this->isScanning = true;
            $this->isPaused = false;
            $this->unhealthyPackages = [];
            $this->scannedPackages = 0;
            $this->healthyPackages = 0;
            $this->currentPackageId = null;

            $this->totalPackages = Package::count();

            $this->persistState();
            $this->dispatch('start-scan');
        }
    }

    public function pauseScan(): void
    {
        $this->isPaused = true;
        $this->persistState();

        Notification::make()
            ->title('Scan Paused')
            ->body('You can resume the scan at any time.')
            ->info()
            ->send();
    }

    public function cancelScan(): void
    {
        $this->isScanning = false;
        $this->isPaused = false;
        $this->scannedPackages = 0;
        $this->healthyPackages = 0;
        $this->currentPackageId = null;

        $this->clearCache();

        // Dispatch event to stop the client-side interval
        $this->dispatch('cancel-scan');

        Notification::make()
            ->title('Scan Cancelled')
            ->body('The health check has been cancelled.')
            ->warning()
            ->send();
    }

    public function scanNextPackage(): ?array
    {
        if ($this->isPaused) {
            return null;
        }

        // Get the next package to scan
        $package = Package::query()
            ->when($this->currentPackageId, fn ($q) => $q->where('id', '>', $this->currentPackageId))
            ->orderBy('id')
            ->first();

        if (! $package) {
            // Scanning complete
            $this->isScanning = false;
            $this->isPaused = false;
            $this->currentPackageId = null;

            $this->clearCache();

            Notification::make()
                ->title('Health Check Complete')
                ->body("Scanned {$this->scannedPackages} packages. Found ".count($this->unhealthyPackages).' unhealthy packages.')
                ->success()
                ->send();

            return null;
        }

        $this->currentPackageId = $package->id;
        $this->currentPackageName = $package->name;
        $this->scannedPackages++;

        // Check package health
        $checker = new PackageHealthChecker;
        $issues = $checker->checkPackageHealth($package);

        // Filter out healthy status from issues
        $actualIssues = collect($issues)->filter(fn ($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY)->toArray();

        if (! empty($actualIssues)) {
            $this->unhealthyPackages[] = [
                'id' => $package->id,
                'name' => $package->name,
                'github' => $package->github,
                'author' => $package->author,
                'issues' => $actualIssues,
            ];

            $this->persistResults();
        } else {
            $this->healthyPackages++;
        }

        $this->persistState();

        return [
            'continue' => true,
            'current' => $this->scannedPackages,
            'total' => $this->totalPackages,
            'packageName' => $package->name,
        ];
    }

    public function deleteAllUnhealthy(): void
    {
        $count = 0;

        foreach ($this->unhealthyPackages as $unhealthyPackage) {
            $package = Package::find($unhealthyPackage['id']);
            if ($package) {
                $package->delete();
                $count++;
            }
        }

        $this->unhealthyPackages = [];
        $this->persistResults();

        Notification::make()
            ->title('All Unhealthy Packages Deleted')
            ->body("Deleted {$count} unhealthy packages.")
            ->success()
            ->send();
    }

    public function clearResults(): void
    {
        $this->unhealthyPackages = [];
        $this->scannedPackages = 0;
        $this->healthyPackages = 0;
        $this->clearCache();

        Notification::make()
            ->title('Results Cleared')
            ->success()
            ->send();
    }

    private function persistState(): void
    {
        Cache::put(self::CACHE_KEY_STATE, [
            'isScanning' => $this->isScanning,
            'isPaused' => $this->isPaused,
            'scannedPackages' => $this->scannedPackages,
            'totalPackages' => $this->totalPackages,
            'healthyPackages' => $this->healthyPackages,
            'currentPackageId' => $this->currentPackageId,
        ], now()->addHours(24));
    }

    private function persistResults(): void
    {
        Cache::put(self::CACHE_KEY_RESULTS, $this->unhealthyPackages, now()->addHours(24));
    }

    private function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY_STATE);
        Cache::forget(self::CACHE_KEY_RESULTS);
    }

    public function getProgressPercentage(): int
    {
        if ($this->totalPackages === 0) {
            return 0;
        }

        return (int) round(($this->scannedPackages / $this->totalPackages) * 100);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->getUnhealthyPackagesQuery())
            ->striped()
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('name')
                    ->label('Package')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->description(fn (Package $record): string => $record->author),

                TextColumn::make('github')
                    ->label('Repository')
                    ->searchable()
                    ->url(fn (Package $record): string => $record->github)
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->limit(40),

                TextColumn::make('health_issues')
                    ->label('Issues')
                    ->badge()
                    ->separator(',')
                    ->state(function (Package $record) {
                        $issues = $this->getPackageIssues($record->id);
                        $checker = new PackageHealthChecker;

                        return collect($issues)
                            ->filter(fn ($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY)
                            ->map(function ($issue) use ($checker) {
                                $badge = $checker->getHealthStatusBadge($issue['status']);

                                return $badge['label'];
                            })
                            ->toArray();
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Archived' => 'danger',
                        'Disabled' => 'danger',
                        'Private' => 'danger',
                        'Not Found' => 'danger',
                        'Inactive' => 'warning',
                        'Laravel Incompatible' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('issue_details')
                    ->label('Details')
                    ->wrap()
                    ->lineClamp(3)
                    ->state(function (Package $record) {
                        $issues = $this->getPackageIssues($record->id);

                        return collect($issues)
                            ->filter(fn ($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY)
                            ->map(fn ($issue) => '• '.$issue['message'])
                            ->join("\n");
                    })
                    ->html()
                    ->formatStateUsing(fn (string $state) => nl2br(e($state))),

                TextColumn::make('last_commit')
                    ->label('Last Commit')
                    ->state(function (Package $record) {
                        $issues = $this->getPackageIssues($record->id);
                        $lastCommit = $issues[0]['last_commit'] ?? null;

                        if (! $lastCommit) {
                            return 'Unknown';
                        }

                        return \Carbon\Carbon::parse($lastCommit)->diffForHumans();
                    })
                    ->sortable(false),
            ])
            ->recordActions([
                Action::make('delete')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Package?')
                    ->modalDescription(fn (Package $record) => "Are you sure you want to delete '{$record->name}'?")
                    ->action(function (Package $record) {
                        // Remove from unhealthy packages list
                        $this->unhealthyPackages = array_values(
                            array_filter(
                                $this->unhealthyPackages,
                                fn ($p) => $p['id'] !== $record->id
                            )
                        );
                        $this->persistResults();

                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title('Package deleted')
                            ->body("'{$record->name}' has been removed from the database.")
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            $recordIds = $records->pluck('id')->toArray();
                            $this->unhealthyPackages = array_values(
                                array_filter(
                                    $this->unhealthyPackages,
                                    fn ($p) => ! in_array($p['id'], $recordIds)
                                )
                            );
                            $this->persistResults();
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Packages deleted')
                                ->body('The selected packages have been removed from the database.')
                        ),
                ]),
            ])
            ->emptyStateHeading('No unhealthy packages found')
            ->emptyStateDescription('All scanned packages are healthy!')
            ->emptyStateIcon('heroicon-o-check-circle');
    }

    protected function getUnhealthyPackagesQuery(): Builder
    {
        $unhealthyIds = collect($this->unhealthyPackages)->pluck('id')->toArray();

        return Package::query()
            ->whereIn('id', $unhealthyIds)
            ->orderBy('name');
    }

    protected function getPackageIssues(int $packageId): array
    {
        $package = collect($this->unhealthyPackages)->firstWhere('id', $packageId);

        return $package['issues'] ?? [];
    }
}
