<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Progress Section --}}
        @if ($isScanning)
            <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            @if ($isPaused)
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-warning-100 dark:bg-warning-900">
                                    <x-filament::icon 
                                        icon="heroicon-o-pause" 
                                        class="h-5 w-5 text-warning-600 dark:text-warning-400"
                                    />
                                </div>
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900">
                                    <x-filament::loading-indicator class="h-5 w-5 text-primary-600 dark:text-primary-400" />
                                </div>
                            @endif
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    @if ($isPaused)
                                        Scan Paused
                                    @else
                                        Scanning Packages...
                                    @endif
                                </h3>
                                @if (!$isPaused && $currentPackageName)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Currently checking: <span class="font-medium">{{ $currentPackageName }}</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $this->getProgressPercentage() }}%
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $scannedPackages }} / {{ $totalPackages }}
                            </p>
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="relative mb-4">
                        <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                            <div 
                                class="h-full bg-linear-to-r from-primary-500 to-primary-600 transition-all duration-300 ease-out dark:from-primary-600 dark:to-primary-700"
                                style="width: {{ $this->getProgressPercentage() }}%"
                            ></div>
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-lg bg-success-50 p-4 dark:bg-success-900/20">
                            <div class="flex items-center gap-2">
                                <x-filament::icon 
                                    icon="heroicon-o-check-circle" 
                                    class="h-5 w-5 text-success-600 dark:text-success-400"
                                />
                                <div>
                                    <p class="text-xs font-medium text-success-600 dark:text-success-400">Healthy</p>
                                    <p class="text-lg font-bold text-success-700 dark:text-success-300">{{ $healthyPackages }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-lg bg-danger-50 p-4 dark:bg-danger-900/20">
                            <div class="flex items-center gap-2">
                                <x-filament::icon 
                                    icon="heroicon-o-exclamation-triangle" 
                                    class="h-5 w-5 text-danger-600 dark:text-danger-400"
                                />
                                <div>
                                    <p class="text-xs font-medium text-danger-600 dark:text-danger-400">Issues Found</p>
                                    <p class="text-lg font-bold text-danger-700 dark:text-danger-300">{{ count($unhealthyPackages) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Summary Stats --}}
        @if (!$isScanning && $scannedPackages > 0)
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="rounded-full bg-primary-100 p-3 dark:bg-primary-900">
                            <x-filament::icon 
                                icon="heroicon-o-check-circle" 
                                class="h-6 w-6 text-primary-600 dark:text-primary-400"
                            />
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Scanned</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $scannedPackages }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="rounded-full bg-success-100 p-3 dark:bg-success-900">
                            <x-filament::icon 
                                icon="heroicon-o-heart" 
                                class="h-6 w-6 text-success-600 dark:text-success-400"
                            />
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Healthy</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $healthyPackages }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <div class="flex items-center">
                        <div class="rounded-full bg-danger-100 p-3 dark:bg-danger-900">
                            <x-filament::icon 
                                icon="heroicon-o-exclamation-triangle" 
                                class="h-6 w-6 text-danger-600 dark:text-danger-400"
                            />
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Issues Found</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ count($unhealthyPackages) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Unhealthy Packages Table --}}
        @if (count($unhealthyPackages) > 0)
            <div class="rounded-lg bg-white shadow dark:bg-gray-800">
                <div class="border-b border-gray-200 p-6 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Unhealthy Packages ({{ count($unhealthyPackages) }})
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Review and manage packages that have health issues
                    </p>
                </div>
                <div class="p-6">
                    {{ $this->table }}
                </div>
            </div>
        @endif

        {{-- All packages healthy state --}}
        @if (!$isScanning && $scannedPackages > 0 && count($unhealthyPackages) === 0)
            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-white p-12 text-center dark:border-gray-600 dark:bg-gray-800">
                <x-filament::icon 
                    icon="heroicon-o-check-circle" 
                    class="mx-auto h-12 w-12 text-success-600 dark:text-success-400"
                />
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                    All Packages Are Healthy!
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    No issues found in {{ $scannedPackages }} packages scanned.
                </p>
            </div>
        @endif

        {{-- Empty state --}}
        @if (!$isScanning && $scannedPackages === 0)
            <div class="rounded-lg border-2 border-dashed border-gray-300 bg-white p-12 text-center dark:border-gray-600 dark:bg-gray-800">
                <x-filament::icon 
                    icon="heroicon-o-heart" 
                    class="mx-auto h-12 w-12 text-gray-400"
                />
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                    No Health Check Results
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Click "Start Health Check" to scan all packages for issues.
                </p>
            </div>
        @endif
    </div>

    @script
    <script>
        let scanInterval = null;

        // Start scanning
        $wire.on('start-scan', () => {
            if (scanInterval) {
                clearInterval(scanInterval);
            }

            scanInterval = setInterval(() => {
                $wire.scanNextPackage().then((result) => {
                    if (!result || !result.continue) {
                        clearInterval(scanInterval);
                        scanInterval = null;
                    }
                });
            }, 1000); // Scan every 1 second to avoid rate limiting
        });

        // Resume scanning
        $wire.on('resume-scan', () => {
            if (scanInterval) {
                clearInterval(scanInterval);
            }

            scanInterval = setInterval(() => {
                $wire.scanNextPackage().then((result) => {
                    if (!result || !result.continue) {
                        clearInterval(scanInterval);
                        scanInterval = null;
                    }
                });
            }, 1000);
        });

        // Cleanup when component is destroyed
        document.addEventListener('livewire:navigating', () => {
            if (scanInterval) {
                clearInterval(scanInterval);
                scanInterval = null;
            }
        });
    </script>
    @endscript
</x-filament-panels::page>
