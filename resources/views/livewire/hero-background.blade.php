<div>
    {{-- Ellipse arc --}}
    <div
        class="pointer-events-none absolute left-1/2 top-[-80vw] -z-10 h-[calc(100vw+10rem)] w-[calc(100vw+10rem)] -translate-x-1/2 scale-x-150 scale-y-75 select-none rounded-full bg-white/20 transition duration-300 dark:bg-[#173563]/10"
    ></div>
    {{-- Purple blur --}}
    <img
        x-show="!darkMode"
        src="@viteAsset('resources/images/pink-blur.webp')"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute right-[calc(10rem-15vw)] top-[-10vw] -z-20 h-[calc(10rem+35vw)] w-[calc(10rem+35vw)] scale-[2.5] select-none"
    />
    {{-- Purple blur for dark theme --}}
    <img
        x-show="darkMode"
        src="@viteAsset('resources/images/pink-blur-dark.webp')"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute right-[calc(10rem-15vw)] top-[-10vw] -z-20 h-[calc(10rem+35vw)] w-[calc(10rem+35vw)] scale-[2.5] select-none min-[2000px]:scale-[1.7]"
    />
    {{-- Blue blur --}}
    <img
        x-show="!darkMode"
        src="@viteAsset('resources/images/blue-blur.webp')"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur pointer-events-none absolute left-[6vw] top-96 -z-30 h-[calc(10rem+40vw)] w-[calc(10rem+40vw)] scale-[2.5] select-none min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)] min-[600px]:left-[calc(10rem-20vw)] xl:top-[clamp(-25rem,(-5vw),calc(-200px-10vw))]"
    />
    {{-- Blue blur for dark theme --}}
    <img
        x-show="darkMode"
        src="@viteAsset('resources/images/blue-blur-dark.webp')"
        width="auto"
        height="auto"
        alt=""
        class="gsap-background-blur-opacity-70 pointer-events-none absolute left-[6vw] top-96 -z-30 h-[calc(10rem+40vw)] w-[calc(10rem+40vw)] scale-[2.5] select-none min-[500px]:top-[clamp(10rem,calc(25rem-30vw),500px)] min-[600px]:left-[calc(10rem-20vw)] xl:top-[clamp(-25rem,(-5vw),calc(-200px-10vw))] min-[2000px]:scale-[1.7]"
    />
</div>
