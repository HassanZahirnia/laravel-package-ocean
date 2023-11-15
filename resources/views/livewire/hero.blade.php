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
        },
    }"
>
    {{-- Earth --}}
    <div class="absolute right-1/2 top-0 z-[-1] translate-x-1/2 sm:-top-5">
        <img
            src="{{ Vite::asset('resources/images/earth.webp') }}"
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
                class="mt-11 flex flex-wrap justify-around gap-5 border-t border-t-[#6A7789]/20 pt-9 transition duration-300 dark:border-t-[#627288]/20 min-[450px]:gap-14 sm:mx-10 md:mx-20 md:justify-center md:gap-24"
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
</div>
