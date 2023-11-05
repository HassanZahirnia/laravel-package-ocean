<nav class="relative z-50 mx-auto w-full max-w-screen-xl">
    <header
        class="relative flex items-center justify-between gap-5 px-5 pb-14 pt-9 sm:py-10"
    >
        {{-- Logo and brand name --}}
        <x-nav.logo />

        {{-- Navigation menu modal --}}
        <x-nav.mobile-menu />

        {{-- Navigation menu --}}
        <div class="hidden items-center gap-1 sm:flex">
            {{-- Suggest a new package --}}
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                target="_blank"
                class="mr-1 select-none truncate rounded-xl bg-white/30 px-5 py-3 text-sm font-medium text-[#404a6b] shadow-lg shadow-fuchsia-100/70 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white/40 hover:text-slate-900 hover:shadow-xl hover:shadow-fuchsia-100 dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40"
            >
                Suggest a new package
            </a>

            {{-- Github Link --}}
            <a
                class="select-none p-2 transition duration-300 hover:text-slate-600 dark:text-[#ABB0DD] dark:hover:text-[#bcc1ef]"
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

            {{-- Theme toggle --}}
            <x-nav.theme-toggle />
        </div>
    </header>
</nav>
