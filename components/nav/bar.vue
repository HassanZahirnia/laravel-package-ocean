<template>
    <nav
        class="relative z-50
        mx-auto w-full max-w-screen-xl
        "
        >
        <header
            class="px-5 pt-9 pb-14 sm:py-10 relative
            flex gap-5
            items-center
            justify-between
            "
            >
            <!-- Logo and brand name -->
            <nav-logo />
            <!-- Menu -->
            <nav-menu-modal />

            <!-- Navigation menus -->
            <div
                class="hidden sm:flex
                gap-1
                items-center
                "
                >
                <!-- Suggest a new package -->
                <a
                    href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                    target="_blank"
                    class="mr-1
                    select-none rounded-xl
                    backdrop-blur-xl
                    transition duration-300
                    px-5 py-3
                    text-sm
                    font-medium
                    bg-white/30 dark:bg-transparent
                    hover:bg-white/40
                    dark:hover:bg-[#110E26]/40
                    text-[#404a6b]
                    hover:text-slate-900
                    dark:text-[#ABB0DD]
                    shadow-lg shadow-fuchsia-100/70
                    hover:shadow-xl hover:shadow-fuchsia-100
                    dark:shadow-none
                    ring-1 ring-slate-200/20
                    dark:ring-[#627288]/40
                    "
                    >
                    Suggest a new package
                </a>
                <!-- Github link -->
                <a
                    class="select-none
                    p-2
                    transition duration-300
                    hover:text-slate-600
                    dark:text-[#ABB0DD]
                    dark:hover:text-[#bcc1ef]
                    "
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
</template>