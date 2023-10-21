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
        @if (!$package->is_official_laravel_package)
            <x-tooltip
                content="Official Laravel Package"
                class="absolute -left-3 -top-3"
                theme="amber"
            >
                <div
                    class="-rotate-45"
                    wire:click.prevent="setShowOfficialPackages(1)"
                >
                    <x-icons.crown />
                </div>
            </x-tooltip>
        @endif

        <div class="flex items-center justify-between gap-5">
            {{-- Category --}}
            <category-pill
                :category="{{ $package->category }}"
                wire:click.prevent="selectCategory('{{ $package->category }}')"
            />
            {{-- Stars --}}
            <div
                class="flex items-center gap-2"
                :class="{
                        'transition-transform duration-300 group-hover/package-card:-translate-x-2': true,
                    }"
            >
                <div
                    class="i-fluent-emoji-flat:star relative -top-px h-[1.15rem] w-[1.15rem] transition duration-500 ease-out"
                    :class="{
                            'group-hover/package-card:rotate-[-75deg]': true,
                        }"
                ></div>
                <div class="relative text-sm">
                    <div
                        :class="{
                                'transition-opacity duration-300 group-hover/package-card:opacity-0': true,
                            }"
                    >
                        0
                    </div>
                    <div
                        class="absolute left-0 top-0"
                        :class="{
                                'transition-opacity duration-300 opacity-0 group-hover/package-card:opacity-100': true,
                            }"
                    >
                        0
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 pt-6">
            <div class="flex items-center gap-2">
                @if ($package->paid_integration)
                    <x-tooltip
                        content="This package integrates with a paid service."
                        theme="indigo"
                    >
                        <div
                            class="i-bx:bxs-dollar-circle text-[1.3rem] text-yellow-500"
                        ></div>
                    </x-tooltip>
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
                <div class="i-carbon:logo-github text-xl"></div>
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
                        <div
                            v-if="laravelPackage.package_type === 'laravel-package'"
                        >
                            Laravel package
                        </div>
                        <div
                            v-if="laravelPackage.package_type === 'php-package'"
                        >
                            PHP package
                        </div>
                        <div
                            v-if="laravelPackage.package_type === 'npm-package'"
                        >
                            NPM package
                        </div>
                        <div v-if="laravelPackage.package_type === 'mac-app'">
                            Mac app
                        </div>
                        <div
                            v-if="laravelPackage.package_type === 'windows-app'"
                        >
                            Windows app
                        </div>
                        <div
                            v-if="laravelPackage.package_type === 'all-operating-systems-app'"
                        >
                            All operating systems app
                        </div>
                        <div
                            v-if="laravelPackage.package_type === 'ide-extension'"
                        >
                            IDE Extension/Plugin
                        </div>
                    </div>
                    <div class="text-xs opacity-80">
                        <div
                            v-if="laravelPackage.laravel_dependency_versions.length && isCompatible"
                        >
                            <span
                                v-if="minimum_compatible_version
                                        && maximum_compatible_version
                                        && minimum_compatible_version !== maximum_compatible_version
                                    "
                                class="inline-flex items-center gap-1"
                            >
                                <span>
                                    {{ 'v' }}
                                </span>
                                <span
                                    class="i-heroicons:arrow-long-right inline-block text-xl"
                                ></span>
                                <span>
                                    {{ 'v' }}
                                </span>
                                <span>supported</span>
                            </span>
                            <span v-else>
                                <span>
                                    {{ 'v' }}
                                </span>
                                <span>supported</span>
                            </span>
                        </div>
                        <div
                            v-if="laravelPackage.laravel_dependency_versions.length && !isCompatible"
                            class="text-amber-600"
                        >
                            Incompatible with maintained versions!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
