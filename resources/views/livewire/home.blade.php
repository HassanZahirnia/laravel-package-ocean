<section
    class="min-h-screen overflow-clip bg-[#FAFCFF] font-poppins antialiased transition duration-300 selection:bg-stone-800/10 dark:bg-[#04041F] dark:text-[#EAEFFB] dark:selection:bg-indigo-100/10"
>
    <x-nav.bar />
    <div
        class="relative z-10 mx-auto w-full max-w-screen-xl"
        x-data="{
            init() {
                gsap.set('.gsap-background-blur, .gsap-background-blur-opacity-70', {
                    autoAlpha: 0,
                })
                gsap.fromTo(
                    '.gsap-background-blur',
                    {
                        autoAlpha: 0,
                    },
                    {
                        autoAlpha: 1,
                        duration: 0.3,
                    },
                )
                gsap.fromTo(
                    '.gsap-background-blur-opacity-70',
                    {
                        autoAlpha: 0,
                    },
                    {
                        autoAlpha: 0.8,
                        duration: 0.3,
                    },
                )
            },
        }"
    >
        <livewire:hero-background />
        <livewire:hero />
        <x-home.package-section />
        <x-home.footer />
    </div>
</section>
