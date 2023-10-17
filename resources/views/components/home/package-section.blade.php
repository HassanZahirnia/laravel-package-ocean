<div
    x-data="{
        init() {
            gsap.set('.gsap-emerald-background-blur', {
                autoAlpha: 0,
            })
            gsap.fromTo(
                '.gsap-emerald-background-blur',
                {
                    autoAlpha: 0,
                },
                {
                    autoAlpha: 1,
                    duration: 0.3,
                },
            )
        },
    }"
    class="relative px-5 pt-10 text-[#273240] dark:text-[#EAEFFB]"
>
    {{-- Emerald background --}}
    <div
        class="gsap-emerald-background-blur absolute right-1/2 top-1/2 -z-40 h-[calc(10rem+35vw)] w-[calc(10rem+35vw)] -translate-y-1/2 translate-x-1/2 scale-[2.5]"
    >
        <img
            src="{{ Vite::asset('resources/images/emerald-blur.webp') }}"
            width="auto"
            height="auto"
            alt=""
            class="pointer-events-none h-full w-full select-none transition duration-300"
            :class="{
                'opacity-60': darkMode,
            }"
        />
    </div>
    {{-- Categories & Packages list --}}
    <div class="fade-in relative flex items-start gap-5">
        <x-plugins.category-list />
        <package-list />
    </div>
</div>
