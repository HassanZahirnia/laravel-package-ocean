<div
    id="hero-section"
    class="relative"
    x-data="{
        init() {
            gsap.to('#hero-section .gsap-earth-planet', {
                yPercent: 7,
                scrollTrigger: {
                    trigger: 'body',
                    scrub: 1.5,
                    start: '100px 50px',
                    end: 'bottom bottom',
                },
            })
            gsap.to('#hero-section .gsap-hero-card', {
                yPercent: -3,
                scrollTrigger: {
                    trigger: 'body',
                    scrub: 1,
                    start: '100px 50px',
                    end: 'bottom bottom',
                },
            })
            gsap.to('#hero-section .gsap-sponsor-card', {
                yPercent: -3,
                scrollTrigger: {
                    trigger: 'body',
                    scrub: 1,
                    start: '100px 50px',
                    end: 'bottom bottom',
                },
            })
        },
    }"
>
    {{-- Earth --}}
    <div class="absolute right-1/2 top-0 z-[-1] translate-x-1/2 sm:-top-5">
        <img
            src="@viteAsset('resources/images/earth.webp')"
            width="250"
            height="237"
            alt=""
            class="gsap-earth-planet pointer-events-none select-none"
        />
    </div>
    {{-- Hero text --}}
    <div class="gsap-hero-card px-5 pt-32 sm:px-10">
        <div
            class="mx-auto w-full max-w-3xl rounded-3xl bg-white/30 px-5 py-10 text-center shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition-colors duration-300 dark:bg-[#110E26]/50 dark:backdrop-blur-lg sm:p-10 lg:p-11"
        >
            {{-- Title --}}
            <div
                class="text-2xl font-bold text-[#040404] transition duration-300 dark:text-white sm:text-3xl"
            >
                Discover new Laravel packages.
            </div>
            {{-- Description --}}
            <div
                class="mx-auto max-w-sm pt-5 font-medium text-[#6A7789] transition duration-300 dark:text-[#96A5BB] sm:max-w-md sm:text-lg"
            >
                Our goal is to help the Laravel community to find new & useful
                Laravel packages in one place.
            </div>
            <div
                class="flex flex-wrap justify-around gap-5 pt-10 transition duration-300 min-[450px]:gap-14 sm:mx-10 md:mx-20 md:justify-center md:gap-24"
            >
                {{-- Packages count --}}
                <div class="space-y-0.5">
                    <div
                        class="text-3xl font-bold text-[#4B6CFF] transition duration-300"
                    >
                        {{ $stats['packages'] }}
                    </div>
                    <div
                        class="text-sm font-medium text-[#827F98] transition duration-300 dark:text-[#96A5BB]"
                    >
                        Packages
                    </div>
                </div>
                {{-- Authors count --}}
                <div class="space-y-0.5">
                    <div
                        class="text-3xl font-bold text-[#4B6CFF] transition duration-300"
                    >
                        {{ $stats['authors'] }}
                    </div>
                    <div
                        class="text-sm font-medium text-[#827F98] transition duration-300 dark:text-[#96A5BB]"
                    >
                        Authors
                    </div>
                </div>
                {{-- Categories count --}}
                <div class="space-y-0.5">
                    <div
                        class="text-3xl font-bold text-[#4B6CFF] transition duration-300"
                    >
                        {{ $stats['categories'] }}
                    </div>
                    <div
                        class="text-sm font-medium text-[#827F98] transition duration-300 dark:text-[#96A5BB]"
                    >
                        Categories
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Sponsor Card --}}
    <div class="gsap-sponsor-card px-5 pt-5 sm:px-10">
        <div
            class="group/sponsor-card mx-auto grid w-full max-w-3xl place-items-center transition duration-300 will-change-transform hover:translate-x-0.5"
        >
            <div
                class="h-full w-full rounded-[1.6rem] bg-gradient-to-br transition-colors duration-300 [grid-area:1/-1] dark:from-fuchsia-500/5 dark:via-fuchsia-500/5 dark:to-fuchsia-500/40"
            ></div>
            <a
                href="https://github.com/sponsors/HassanZahirnia"
                target="_blank"
                class="flex h-[calc(100%-0.2rem)] w-[calc(100%-0.2rem)] items-center justify-between gap-10 overflow-hidden rounded-3xl bg-[#edf0fd] px-10 py-5 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition-colors duration-300 [grid-area:1/-1] hover:bg-[#f1f3fe] dark:bg-[#101332] dark:backdrop-blur-lg hover:dark:bg-[#110E26]/40"
            >
                <div class="space-y-1.5">
                    {{-- Title --}}
                    <div class="flex items-center gap-2">
                        <div
                            class="text-xl font-bold text-[#040404] transition duration-300 dark:text-white"
                        >
                            Sponsor me on GitHub
                        </div>
                        <div
                            class="-translate-x-1 scale-x-90 opacity-0 transition duration-300 group-hover/sponsor-card:translate-x-0 group-hover/sponsor-card:scale-x-100 group-hover/sponsor-card:opacity-100 motion-reduce:transition-none"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 12h16m0 0l-6-6m6 6l-6 6"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    {{-- Description --}}
                    <div
                        class="font-medium text-[#6A7789] transition duration-300 dark:text-[#96A5BB] sm:max-w-md"
                    >
                        To support this project!
                    </div>
                </div>
                <div class="relative grid w-20 place-items-center">
                    <img
                        src="@viteAsset('resources/images/heart-bottle.webp')"
                        width="50"
                        height="80"
                        alt=""
                        class="pointer-events-none select-none mix-blend-hard-light dark:mix-blend-normal"
                    />
                    <div
                        class="absolute right-1/2 top-1/2 -z-10 size-20 -translate-y-1/2 translate-x-1/2 bg-fuchsia-500 opacity-30 blur-xl dark:bg-rose-500 dark:opacity-50"
                    ></div>
                </div>
            </a>
        </div>
    </div>
</div>
