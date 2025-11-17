<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Progress Section --}}
        @if ($isScanning)
            <x-filament::section>
                <x-slot name="heading">
                    @if ($isPaused)
                        Scan Paused
                    @else
                        Scanning Packages...
                    @endif
                </x-slot>

                @if (!$isPaused && $currentPackageName)
                    <x-slot name="description">
                        Currently checking: <span class="font-medium">{{ $currentPackageName }}</span>
                    </x-slot>
                @endif

                <div class="space-y-4">
                    {{-- Progress Bar --}}
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="font-medium text-gray-700 dark:text-gray-300">Progress</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $scannedPackages }} / {{ $totalPackages }} ({{ $this->getProgressPercentage() }}%)</span>
                        </div>
                        <div class="relative h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                            <div 
                                class="h-full bg-primary-600 transition-all duration-300 ease-out dark:bg-primary-500"
                                style="width: {{ $this->getProgressPercentage() }}%"
                            ></div>
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-2 gap-6">
                        <x-filament::section compact>
                            <div class="flex items-center gap-3">
                                <div class="rounded-full bg-success-100 p-2 dark:bg-success-900/30">
                                    <x-filament::icon 
                                        icon="heroicon-o-check-circle" 
                                        class="h-5 w-5 text-success-600 dark:text-success-400"
                                    />
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Healthy</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $healthyPackages }}</p>
                                </div>
                            </div>
                        </x-filament::section>

                        <x-filament::section compact>
                            <div class="flex items-center gap-3">
                                <div class="rounded-full bg-danger-100 p-2 dark:bg-danger-900/30">
                                    <x-filament::icon 
                                        icon="heroicon-o-exclamation-triangle" 
                                        class="h-5 w-5 text-danger-600 dark:text-danger-400"
                                    />
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Issues Found</p>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($unhealthyPackages) }}</p>
                                </div>
                            </div>
                        </x-filament::section>
                    </div>
                </div>
            </x-filament::section>
        @endif

        {{-- Summary Stats --}}
        @if (!$isScanning && $scannedPackages > 0)
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <x-filament::section compact>
                    <div class="flex items-center gap-4">
                        <div class="shrink-0 rounded-full bg-primary-100 p-3 dark:bg-primary-900/30">
                            <x-filament::icon 
                                icon="heroicon-o-document-check" 
                                class="h-6 w-6 text-primary-600 dark:text-primary-400"
                            />
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Scanned</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $scannedPackages }}</p>
                        </div>
                    </div>
                </x-filament::section>

                <x-filament::section compact>
                    <div class="flex items-center gap-4">
                        <div class="shrink-0 rounded-full bg-success-100 p-3 dark:bg-success-900/30">
                            <x-filament::icon 
                                icon="heroicon-o-heart" 
                                class="h-6 w-6 text-success-600 dark:text-success-400"
                            />
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Healthy</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $healthyPackages }}</p>
                        </div>
                    </div>
                </x-filament::section>

                <x-filament::section compact>
                    <div class="flex items-center gap-4">
                        <div class="shrink-0 rounded-full bg-danger-100 p-3 dark:bg-danger-900/30">
                            <x-filament::icon 
                                icon="heroicon-o-exclamation-triangle" 
                                class="h-6 w-6 text-danger-600 dark:text-danger-400"
                            />
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Issues Found</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ count($unhealthyPackages) }}</p>
                        </div>
                    </div>
                </x-filament::section>
            </div>
        @endif

        {{-- Unhealthy Packages Table --}}
        @if (count($unhealthyPackages) > 0)
            <x-filament::section>
                <x-slot name="heading">
                    Unhealthy Packages ({{ count($unhealthyPackages) }})
                </x-slot>

                <x-slot name="description">
                    Review and manage packages that have health issues
                </x-slot>

                {{ $this->table }}
            </x-filament::section>
        @endif

        {{-- All packages healthy state --}}
        @if (!$isScanning && $scannedPackages > 0 && count($unhealthyPackages) === 0)
            <x-filament::section>
                <div class="py-12 text-center">
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
            </x-filament::section>
        @endif

        {{-- Empty state --}}
        @if (!$isScanning && $scannedPackages === 0)
            <x-filament::section>
                <div class="py-12 text-center">
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
            </x-filament::section>
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

        // Cancel scanning
        $wire.on('cancel-scan', () => {
            if (scanInterval) {
                clearInterval(scanInterval);
                scanInterval = null;
            }
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
