<div
    wire:key="{{ $package->id }}"
    wire:ignore.self
    x-on:mouseenter="isHovering = true"
    x-on:mouseleave="isHovering = false"
    x-data="{
        cardTimeline: null,
        isHovering: false,

        init() {
            $data.cardTimeline = gsap
                .timeline({
                    paused: true,
                    onComplete: () => {
                        // If not hovering, reverse the animation
                        if (! $data.isHovering) $data.cardTimeline?.reverse()
                    },
                })
                .to($el, {
                    y: -1,
                    ease: 'sine.out',
                    duration: 0.25,
                })

            $watch('isHovering', (value) => {
                // If hovering, play the animation
                if (value) $data.cardTimeline?.play()
                // If not hovering and animation is done, reverse it
                else if ($data.cardTimeline?.progress() === 1)
                    $data.cardTimeline?.reverse()
            })
        },
    }"
>
    <a
        href="{{ $package->github }}"
        target="_blank"
        class="group/package-card relative z-[1] flex h-60 flex-col rounded-3xl bg-white/40 p-6 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] ring-1 ring-slate-100 transition-all duration-300 hover:bg-white/60 hover:shadow-2xl hover:shadow-indigo-300/30 hover:ring-white dark:bg-[#362B59]/20 dark:ring-1 dark:ring-[#132447] dark:hover:bg-[#362B59]/30 dark:hover:shadow-xl dark:hover:shadow-[#1c164a] dark:hover:ring-[#373060]"
    >
        {{-- Crown icon --}}
        @if ($package->is_official_laravel_package === true)
            <div class="absolute -left-3 -top-3">
                <div
                    class="-rotate-45"
                    wire:click.prevent="setShowOfficialPackages(1)"
                    x-tooltip.raw.theme.amber="Official Laravel Package"
                >
                    <x-icons.crown />
                </div>
            </div>
        @endif

        <div class="flex items-center justify-between gap-5">
            {{-- Category --}}
            <x-packages.category-pill :category="$package->category" />
            {{-- Stars --}}
            <div
                @class([
                    'flex items-center gap-2',
                    'transition-transform duration-300 group-hover/package-card:-translate-x-2' => $package->stars >= 1000,
                ])
            >
                <svg
                    @class([
                        'relative -top-px transition duration-500 ease-out',
                        'group-hover/package-card:rotate-[-75deg]' => $package->stars >= 1000,
                    ])
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 32 32"
                >
                    <path
                        fill="#FCD53F"
                        d="m18.7 4.627l2.247 4.31a2.27 2.27 0 0 0 1.686 1.189l4.746.65c2.538.35 3.522 3.479 1.645 5.219l-3.25 2.999a2.225 2.225 0 0 0-.683 2.04l.793 4.398c.441 2.45-2.108 4.36-4.345 3.24l-4.536-2.25a2.282 2.282 0 0 0-2.006 0l-4.536 2.25c-2.238 1.11-4.786-.79-4.345-3.24l.793-4.399c.14-.75-.12-1.52-.682-2.04l-3.251-2.998c-1.877-1.73-.893-4.87 1.645-5.22l4.746-.65a2.23 2.23 0 0 0 1.686-1.189l2.248-4.309c1.144-2.17 4.264-2.17 5.398 0Z"
                    />
                </svg>
                <div class="relative text-sm">
                    <div
                        @class([
                            'transition-opacity duration-300 group-hover/package-card:opacity-0' => $package->stars >= 1000,
                        ])
                    >
                        {{ $package->getStarsFormatted() }}
                    </div>
                    <div
                        @class([
                            'absolute left-0 top-0',
                            'opacity-0 transition-opacity duration-300 group-hover/package-card:opacity-100' => $package->stars >= 1000,
                        ])
                    >
                        {{ number_format($package->stars) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 pt-6">
            <div class="flex items-center gap-2">
                @if ($package->paid_integration)
                    <div
                        class="text-yellow-500"
                        x-tooltip.raw.theme.indigo="This package integrates with a paid service."
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill="currentColor"
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10s10-4.486 10-10S17.514 2 12 2zm1 14.915V18h-2v-1.08c-2.339-.367-3-2.002-3-2.92h2c.011.143.159 1 2 1c1.38 0 2-.585 2-1c0-.324 0-1-2-1c-3.48 0-4-1.88-4-3c0-1.288 1.029-2.584 3-2.915V6.012h2v1.109c1.734.41 2.4 1.853 2.4 2.879h-1l-1 .018C13.386 9.638 13.185 9 12 9c-1.299 0-2 .516-2 1c0 .374 0 1 2 1c3.48 0 4 1.88 4 3c0 1.288-1.029 2.584-3 2.915z"
                            />
                        </svg>
                    </div>
                @endif

                {{-- Name --}}
                <div
                    class="{{ strlen($package->name) > 30 ? 'text-sm' : 'text-base' }} font-semibold text-[#545D82] dark:text-[#DEE4F1]"
                >
                    {{ $package->name }}
                </div>
            </div>
            {{-- Description --}}
            <div class="pt-1.5 text-sm text-[#959BAF] dark:text-[#828CAC]">
                {{ $package->description }}
            </div>
        </div>
        <div class="relative mt-2 text-[#505878] dark:text-[#BECDF2]">
            {{-- Repo name --}}
            <div
                class="flex items-center gap-2 transition duration-300 ease-out group-hover/package-card:translate-x-5 group-hover/package-card:translate-y-5 group-hover/package-card:opacity-0"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 32 32"
                >
                    <path
                        fill="currentColor"
                        fill-rule="evenodd"
                        d="M16 2a14 14 0 0 0-4.43 27.28c.7.13 1-.3 1-.67v-2.38c-3.89.84-4.71-1.88-4.71-1.88a3.71 3.71 0 0 0-1.62-2.05c-1.27-.86.1-.85.1-.85a2.94 2.94 0 0 1 2.14 1.45a3 3 0 0 0 4.08 1.16a2.93 2.93 0 0 1 .88-1.87c-3.1-.36-6.37-1.56-6.37-6.92a5.4 5.4 0 0 1 1.44-3.76a5 5 0 0 1 .14-3.7s1.17-.38 3.85 1.43a13.3 13.3 0 0 1 7 0c2.67-1.81 3.84-1.43 3.84-1.43a5 5 0 0 1 .14 3.7a5.4 5.4 0 0 1 1.44 3.76c0 5.38-3.27 6.56-6.39 6.91a3.33 3.33 0 0 1 .95 2.59v3.84c0 .46.25.81 1 .67A14 14 0 0 0 16 2Z"
                    />
                </svg>
                <div class="truncate text-xs font-medium">Repo Name</div>
            </div>
            {{-- Package type --}}
            <div
                class="{{ count($package->laravel_dependency_versions) === 0 ? 'top-0' : '-top-2' }} absolute left-0 flex w-full -translate-x-5 -translate-y-5 items-center gap-2 truncate opacity-0 transition duration-300 ease-out group-hover/package-card:translate-x-0 group-hover/package-card:translate-y-0 group-hover/package-card:opacity-100"
            >
                <div class="leading-loose">
                    {{-- Laravel icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'laravel-package'"
                        class="i-logos:laravel text-[1.3rem]"
                    ></div>
                    {{-- PHP icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'php-package'"
                        class="i-svg-elephant text-[1.3rem]"
                    ></div>
                    {{-- NPM icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'npm-package'"
                        class="i-logos:npm-icon text-xl"
                    ></div>
                    {{-- Mac icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'mac-app'"
                        class="i-logos:apple?mask text-[1.35rem] dark:text-white"
                    ></div>
                    {{-- Windows icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'windows-app'"
                        class="i-logos:microsoft-windows text-lg"
                    ></div>
                    {{-- All operating systems icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'all-operating-systems-app'"
                        class="i-carbon:software-resource-cluster text-2xl"
                    ></div>
                    {{-- IDE Extension icon --}}
                    <div
                        v-if="laravelPackage.package_type === 'ide-extension'"
                        class="i-ph:code text-2xl"
                    ></div>
                </div>
                <div class="">
                    <div class="text-sm font-bold">
                        @if ($package->package_type === 'laravel-package')
                            Laravel package
                        @elseif ($package->package_type === 'php-package')
                            PHP package
                        @elseif ($package->package_type === 'mac-app')
                            Mac app
                        @elseif ($package->package_type === 'windows-app')
                            Windows app
                        @elseif ($package->package_type === 'all-operating-systems-app')
                            All operating systems app
                        @elseif ($package->package_type === 'ide-extension')
                            IDE Extension/Plugin
                        @endif
                    </div>
                    <div class="text-xs opacity-80">
                        @if (count($package->laravel_dependency_versions) > 0 && $package->isCompatibleWithLaravelActiveVersions() === true)
                            @if ($package->minimumCompatibleLaravelVersion() !== $package->maximumCompatibleLaravelVersion())
                                <span class="inline-flex items-center gap-1">
                                    <span>
                                        {{ 'v' . $package->minimumCompatibleLaravelVersion() }}
                                    </span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 24 24"
                                        class="inline-block"
                                    >
                                        <path
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
                                        />
                                    </svg>
                                    <span>
                                        {{ 'v' . $package->maximumCompatibleLaravelVersion() }}
                                    </span>
                                    <span>supported</span>
                                </span>
                            @else
                                <span>
                                    {{ 'v' . $package->minimumCompatibleLaravelVersion() }}
                                </span>
                                <span>supported</span>
                            @endif
                        @endif

                        @if (count($package->laravel_dependency_versions) > 0 && $package->isCompatibleWithLaravelActiveVersions() === false)
                            <div class="text-amber-600">
                                Incompatible with maintained versions!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
