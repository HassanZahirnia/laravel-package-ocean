<div
    wire:ignore
    class="gsap-theme-toggle relative h-11 w-11 cursor-pointer select-none hover:text-slate-600 dark:text-[#ABB0DD] dark:hover:text-[#bcc1ef]"
    x-on:click="darkMode = !darkMode"
    x-data="{
        timeline: null,

        init() {
            gsap.to('.gsap-theme-toggle', {
                scale: 1,
                duration: 0.1,
            })

            timeline = gsap
                .timeline({
                    paused: true,
                })
                .to('.gsap-theme-toggle-moon', {
                    rotate: 70,
                    ease: 'sine.out',
                    duration: 0.3,
                })
                .to(
                    '.gsap-theme-toggle-mini-star',
                    {
                        autoAlpha: 0,
                        scale: 0,
                        ease: 'sine.out',
                        duration: 0.3,
                    },
                    '>-0.3',
                )
                .to(
                    '.gsap-theme-toggle-micro-star',
                    {
                        autoAlpha: 0,
                        scale: 0,
                        ease: 'sine.out',
                        duration: 0.3,
                    },
                    '<',
                )
                .to(
                    '.gsap-theme-toggle-moon',
                    {
                        scale: 0.6,
                        ease: 'sine.out',
                        duration: 0.3,
                    },
                    '<',
                )
                .fromTo(
                    '.gsap-theme-toggle-sunball',
                    {
                        scale: 0,
                        x: -5,
                        y: 5,
                    },
                    {
                        x: 0,
                        y: 0,
                        scale: 1,
                        ease: 'expo.out',
                        duration: 0.3,
                    },
                    '>-0.15',
                )
                .fromTo(
                    '.gsap-theme-toggle-sunshine',
                    {
                        // autoAlpha: 0,
                        scale: 0,
                        rotate: -180,
                    },
                    {
                        // autoAlpha: 1,
                        scale: 1,
                        rotate: 0,
                        ease: 'expo.out',
                        duration: 0.3,
                    },
                    '<',
                )

            if (darkMode) timeline.progress(1)

            $watch('darkMode', (value) => {
                if (value) {
                    timeline.play()
                } else {
                    timeline.reverse()
                }
            })
        },
    }"
>
    {{-- Moon --}}
    <div
        class="gsap-theme-toggle-moon absolute right-1/2 top-1/2 -translate-y-1/2 translate-x-1/2"
    >
        <div class="scale-x-[-1] transition duration-300">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 16 16"
            >
                <path
                    fill="currentColor"
                    d="M6 .278a.768.768 0 0 1 .08.858a7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277c.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316a.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71C0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"
                />
            </svg>
        </div>
    </div>
    {{-- Mini star --}}
    <div class="gsap-theme-toggle-mini-star absolute left-[.6rem] top-[.6rem]">
        <div class="transition duration-300">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="7"
                height="7"
                viewBox="0 0 256 256"
            >
                <path
                    fill="currentColor"
                    d="M240 128a15.79 15.79 0 0 1-10.5 15l-63.44 23.07L143 229.5a16 16 0 0 1-30 0L89.93 166L26.5 143a16 16 0 0 1 0-30L90 89.93l23-63.43a16 16 0 0 1 30 0L166.07 90l63.43 23a15.79 15.79 0 0 1 10.5 15Z"
                />
            </svg>
        </div>
    </div>
    {{-- Micro star --}}
    <div class="gsap-theme-toggle-micro-star absolute left-[1rem] top-[1rem]">
        <div class="transition duration-300">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="5"
                height="5"
                viewBox="0 0 256 256"
            >
                <path
                    fill="currentColor"
                    d="M240 128a15.79 15.79 0 0 1-10.5 15l-63.44 23.07L143 229.5a16 16 0 0 1-30 0L89.93 166L26.5 143a16 16 0 0 1 0-30L90 89.93l23-63.43a16 16 0 0 1 30 0L166.07 90l63.43 23a15.79 15.79 0 0 1 10.5 15Z"
                />
            </svg>
        </div>
    </div>
    {{-- Sun ball --}}
    <div class="absolute right-1/2 top-1/2 -translate-y-1/2 translate-x-1/2">
        <div class="gsap-theme-toggle-sunball">
            <div
                class="h-4 w-4 rounded-full bg-current transition duration-300"
            ></div>
        </div>
    </div>
    {{-- sunShine --}}
    <div class="gsap-theme-toggle-sunshine absolute inset-0 grid h-full w-full">
        <div class="relative h-full w-full">
            {{-- Top --}}
            <div
                class="absolute right-1/2 top-[0.5rem] h-[0.22rem] w-0.5 translate-x-1/2 rounded-full bg-current transition duration-300"
            ></div>
            {{-- Right --}}
            <div
                class="absolute right-[0.5rem] top-1/2 h-[0.22rem] w-0.5 -translate-y-1/2 rotate-[90deg] rounded-full bg-current transition duration-300"
            ></div>
            {{-- Bottom --}}
            <div
                class="absolute bottom-[0.5rem] right-1/2 h-[0.22rem] w-0.5 translate-x-1/2 rounded-full bg-current transition duration-300"
            ></div>
            {{-- Left --}}
            <div
                class="absolute left-[0.5rem] top-1/2 h-[0.22rem] w-0.5 -translate-y-1/2 rotate-[90deg] rounded-full bg-current transition duration-300"
            ></div>
            {{-- Top Right --}}
            <div
                class="absolute right-[0.75rem] top-[0.75rem] h-[0.22rem] w-0.5 rotate-[45deg] rounded-full bg-current transition duration-300"
            ></div>
            {{-- Top Left --}}
            <div
                class="absolute left-[0.75rem] top-[0.75rem] h-[0.22rem] w-0.5 rotate-[-45deg] rounded-full bg-current transition duration-300"
            ></div>

            {{-- Bottom Right --}}
            <div
                class="absolute bottom-[0.75rem] right-[0.75rem] h-[0.22rem] w-0.5 rotate-[-45deg] rounded-full bg-current transition duration-300"
            ></div>
            {{-- Bottom Left --}}
            <div
                class="absolute bottom-[0.75rem] left-[0.75rem] h-[0.22rem] w-0.5 rotate-[45deg] rounded-full bg-current transition duration-300"
            ></div>
        </div>
    </div>
</div>
