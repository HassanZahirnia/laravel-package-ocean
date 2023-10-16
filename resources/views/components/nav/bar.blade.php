<nav class="relative z-50 mx-auto w-full max-w-screen-xl">
    <header
        class="relative flex items-center justify-between gap-5 px-5 pb-14 pt-9 sm:py-10"
    >
        <!-- Logo and brand name -->
        <x-nav.logo />
        <!-- Menu -->
        <nav-menu-modal />

        <!-- Navigation menus -->
        <div class="hidden items-center gap-1 sm:flex">
            <!-- Suggest a new package -->
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                target="_blank"
                class="mr-1 select-none rounded-xl bg-white/30 px-5 py-3 text-sm font-medium text-[#404a6b] shadow-lg shadow-fuchsia-100/70 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white/40 hover:text-slate-900 hover:shadow-xl hover:shadow-fuchsia-100 dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40"
            >
                Suggest a new package
            </a>
            <!-- Github link -->
            <a
                class="select-none p-2 transition duration-300 hover:text-slate-600 dark:text-[#ABB0DD] dark:hover:text-[#bcc1ef]"
                href="https://github.com/HassanZahirnia/laravel-package-ocean"
                target="_blank"
                aria-label="Github"
            >
                <div class="i-carbon-logo-github text-3xl" />
            </a>
            <!-- Theme toggle  -->
            <ui-theme-toggle />
        </div>
    </header>
</nav>
