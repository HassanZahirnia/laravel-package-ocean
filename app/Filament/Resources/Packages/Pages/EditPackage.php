<?php

namespace App\Filament\Resources\Packages\Pages;

use App\Filament\Resources\Packages\PackageResource;
use App\Services\PackageHealthChecker;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class EditPackage extends EditRecord
{
    protected static string $resource = PackageResource::class;

    public ?array $healthCheckResults = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function runHealthCheck(): void
    {
        $checker = new PackageHealthChecker;
        $this->healthCheckResults = $checker->checkPackageHealth($this->record);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'lg' => 12])
                    ->schema([
                        $this->getFormContentComponent()
                            ->columnSpan(['default' => 1, 'lg' => 8]),
                        Section::make('Health Check')
                            ->description('Check the health status of this package')
                            ->schema([
                                View::make('filament.resources.packages.health-check-infolist'),
                            ])
                            ->columnSpan(['default' => 1, 'lg' => 4])
                            ->collapsible(),
                    ]),
                $this->getRelationManagersContentComponent(),
            ]);
    }
}
