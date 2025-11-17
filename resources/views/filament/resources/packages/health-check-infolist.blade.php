@php
    use App\Services\PackageHealthChecker;
@endphp

<div class="space-y-4">
    {{-- Run Health Check Button --}}
    <x-filament::button
        wire:click="runHealthCheck"
        wire:loading.attr="disabled"
        icon="heroicon-o-arrow-path"
        size="sm"
        color="primary"
        class="w-full"
    >
        <span wire:loading.remove wire:target="runHealthCheck">Run Health Check</span>
        <span wire:loading wire:target="runHealthCheck">Checking...</span>
    </x-filament::button>

    {{-- Health Status Display --}}
    @if($this->healthCheckResults !== null)
        @php
            $checker = new PackageHealthChecker();
            $issues = $this->healthCheckResults;
            $isHealthy = empty(collect($issues)->filter(fn($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY)->toArray());
        @endphp

        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50">
            @if ($isHealthy)
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="rounded-full bg-success-100 p-2 dark:bg-success-900/30">
                            <x-filament::icon 
                                icon="heroicon-o-check-circle" 
                                class="h-5 w-5 text-success-600 dark:text-success-400"
                            />
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                Healthy Package
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                No issues detected
                            </p>
                        </div>
                    </div>

                    {{-- Last Commit Info (always shown if available) --}}
                    @if(!empty($issues[0]['last_commit'] ?? null))
                        <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                <span class="font-medium">Last commit:</span>
                                <br>
                                {{ \Carbon\Carbon::parse($issues[0]['last_commit'])->diffForHumans() }}
                            </p>
                        </div>
                    @endif
                </div>
            @else
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="rounded-full bg-danger-100 p-2 dark:bg-danger-900/30">
                            <x-filament::icon 
                                icon="heroicon-o-exclamation-triangle" 
                                class="h-5 w-5 text-danger-600 dark:text-danger-400"
                            />
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                Issues Detected
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ count(collect($issues)->filter(fn($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY)) }} 
                                {{ Str::plural('issue', count(collect($issues)->filter(fn($issue) => $issue['status'] !== PackageHealthChecker::STATUS_HEALTHY))) }} found
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @foreach($issues as $issue)
                            @php
                                if ($issue['status'] === PackageHealthChecker::STATUS_HEALTHY) continue;
                                $badge = $checker->getHealthStatusBadge($issue['status']);
                            @endphp
                            <div class="rounded-lg border border-gray-200 bg-white p-3 dark:border-gray-700 dark:bg-gray-900/50">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-gray-900 dark:text-white wrap-break-word">
                                            {{ $issue['message'] }}
                                        </p>
                                        @if(!empty($issue['last_commit']))
                                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                Last commit:
                                                <br>
                                                {{ \Carbon\Carbon::parse($issue['last_commit'])->diffForHumans() }}
                                            </p>
                                        @endif
                                    </div>
                                    <x-filament::badge :color="$badge['color']" size="sm" class="shrink-0">
                                        {{ $badge['label'] }}
                                    </x-filament::badge>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-6 text-center dark:border-gray-600 dark:bg-gray-800/50">
            <x-filament::icon 
                icon="heroicon-o-beaker" 
                class="mx-auto h-10 w-10 text-gray-400"
            />
            <p class="mt-3 text-sm font-medium text-gray-900 dark:text-white">
                Ready to Check
            </p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                Click "Run Health Check" to analyze this package
            </p>
        </div>
    @endif
</div>
