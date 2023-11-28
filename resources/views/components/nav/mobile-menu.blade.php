<div x-data="{
    openMobileMenu: false,
}">
    <!-- Burger/Menu button -->
    <button
        type="button"
        x-ref="mobile_menu_button"
        class="grid h-10 w-10 cursor-pointer place-items-center rounded-lg transition duration-300 hover:bg-white hover:shadow-lg hover:shadow-black/5 dark:hover:bg-slate-700/50 sm:hidden"
        aria-label="Open Menu"
        x-on:click="openMobileMenu = ! openMobileMenu"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="30"
            height="30"
            viewBox="0 0 256 256"
        >
            <path
                fill="currentColor"
                d="M224 128a8 8 0 0 1-8 8H40a8 8 0 0 1 0-16h176a8 8 0 0 1 8 8ZM40 72h176a8 8 0 0 0 0-16H40a8 8 0 0 0 0 16Zm176 112H40a8 8 0 0 0 0 16h176a8 8 0 0 0 0-16Z"
            />
        </svg>
    </button>

    <div
        x-show="openMobileMenu"
        x-on:click.outside="openMobileMenu = false"
        x-transition
        x-anchor.offset.20="$refs.mobile_menu_button"
        class="w-full max-w-xs transform overflow-hidden rounded-2xl bg-[#f2f3fb] px-6 py-5 text-left align-middle shadow-xl transition duration-300 dark:bg-[#04041F] dark:text-[#EAEFFB]"
    >
        <div
            class="flex items-center justify-between gap-2 text-left text-lg font-medium leading-6 text-gray-900 dark:text-inherit"
        >
            <!-- Menu title -->
            <div>Menu</div>
        </div>
        <div class="relative mt-5 space-y-4">
            <!-- Suggest a new package -->
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                target="_blank"
                class="mr-1 block w-full select-none rounded-full bg-white/60 px-5 py-3 text-center text-sm font-medium text-indigo-900 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white hover:text-slate-900 dark:bg-transparent dark:text-[#ABB0DD] dark:ring-[#627288]/40 dark:hover:bg-slate-900/50"
            >
                Suggest a new package
            </a>
            <!-- Icons -->
            <div wire:ignore class="relative flex items-center justify-center gap-5">
                <!-- Github link -->
                <a
                    class="block select-none p-2 hover:text-slate-600 hover:transition hover:duration-300 dark:text-[#ABB0DD] dark:hover:text-[#bcc1ef]"
                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                    target="_blank"
                    aria-label="Github"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="30"
                        height="30"
                        viewBox="0 0 32 32"
                    >
                        <path
                            fill="currentColor"
                            fill-rule="evenodd"
                            d="M16 2a14 14 0 0 0-4.43 27.28c.7.13 1-.3 1-.67v-2.38c-3.89.84-4.71-1.88-4.71-1.88a3.71 3.71 0 0 0-1.62-2.05c-1.27-.86.1-.85.1-.85a2.94 2.94 0 0 1 2.14 1.45a3 3 0 0 0 4.08 1.16a2.93 2.93 0 0 1 .88-1.87c-3.1-.36-6.37-1.56-6.37-6.92a5.4 5.4 0 0 1 1.44-3.76a5 5 0 0 1 .14-3.7s1.17-.38 3.85 1.43a13.3 13.3 0 0 1 7 0c2.67-1.81 3.84-1.43 3.84-1.43a5 5 0 0 1 .14 3.7a5.4 5.4 0 0 1 1.44 3.76c0 5.38-3.27 6.56-6.39 6.91a3.33 3.33 0 0 1 .95 2.59v3.84c0 .46.25.81 1 .67A14 14 0 0 0 16 2Z"
                        />
                    </svg>
                </a>

                <!-- Theme toggle  -->
                <x-nav.theme-toggle name="gsap-mobile-theme-toggle" />
            </div>
        </div>
    </div>
</div>
