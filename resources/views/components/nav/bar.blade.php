<nav class="relative z-50 mx-auto w-full max-w-screen-xl">
    <header
        class="relative flex items-center justify-between gap-5 px-5 pb-14 pt-9 min-[850px]:py-10"
    >
        {{-- Logo and brand name --}}
        <x-nav.logo />

        {{-- Navigation menu modal --}}
        <x-nav.mobile-menu />

        {{-- Navigation menu --}}
        <div class="hidden items-center gap-1 min-[850px]:flex">
            {{-- Top Packages --}}
            <a
                href="{{ route('leaderboard') }}"
                class="mr-2 flex h-11 select-none items-center justify-center gap-2 truncate rounded-xl bg-white/30 pl-4 pr-5 text-sm font-medium text-[#404a6b] shadow-lg shadow-fuchsia-100/70 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white/40 hover:text-slate-900 hover:shadow-xl hover:shadow-fuchsia-100 dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40 dark:hover:text-[#ABB0DD] dark:hover:shadow-none"
            >
                <svg
                    width="26"
                    height="25"
                    viewBox="0 0 26 25"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class=""
                >
                    <path
                        opacity="0.5"
                        d="M13.0001 16.6666C7.00005 16.6666 5.93755 10.6874 5.75005 5.94367C5.69693 4.62492 5.67089 3.9645 6.16672 3.35513C6.66151 2.74471 7.25422 2.64471 8.44068 2.44471C9.94778 2.19771 11.4729 2.0768 13.0001 2.08325C14.8584 2.08325 16.3886 2.24679 17.5594 2.44471C18.7459 2.64471 19.3386 2.74471 19.8344 3.35513C20.3303 3.96554 20.3032 4.62492 20.2511 5.94367C20.0636 10.6864 19.0011 16.6666 13.0011 16.6666"
                        fill="currentColor"
                    />
                    <path
                        d="M18.875 12.9395L21.8094 11.3093C22.5928 10.8739 22.9844 10.6562 23.2011 10.2895C23.4167 9.92284 23.4167 9.47492 23.4167 8.57804V8.502C23.4167 7.41554 23.4167 6.87179 23.1219 6.46242C22.8271 6.05304 22.3115 5.88117 21.2802 5.53742L20.2917 5.20825L20.274 5.29679C20.2688 5.49367 20.2605 5.70825 20.2511 5.94367C20.1594 8.26138 19.8584 10.8739 18.8761 12.9395M5.75004 5.94367C5.84067 8.26138 6.14171 10.8739 7.12504 12.9395L4.19067 11.3093C3.40733 10.8739 3.01462 10.6562 2.799 10.2895C2.58337 9.92284 2.58337 9.47492 2.58337 8.57804V8.502C2.58337 7.41554 2.58337 6.87179 2.87817 6.46242C3.17296 6.05304 3.68858 5.88117 4.71983 5.53742L5.70837 5.20825L5.72608 5.29888C5.73129 5.49471 5.73962 5.70929 5.749 5.94471"
                        fill="currentColor"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M5.96875 22.9167C5.96875 22.7095 6.05106 22.5108 6.19757 22.3643C6.34409 22.2178 6.5428 22.1355 6.75 22.1355H19.25C19.4572 22.1355 19.6559 22.2178 19.8024 22.3643C19.9489 22.5108 20.0312 22.7095 20.0312 22.9167C20.0312 23.1239 19.9489 23.3227 19.8024 23.4692C19.6559 23.6157 19.4572 23.698 19.25 23.698H6.75C6.5428 23.698 6.34409 23.6157 6.19757 23.4692C6.05106 23.3227 5.96875 23.1239 5.96875 22.9167Z"
                        fill="currentColor"
                    />
                    <path
                        opacity="0.5"
                        d="M16.6021 22.1355H9.39795L9.70732 20.3126C9.75451 20.0765 9.88199 19.8641 10.0681 19.7114C10.2542 19.5588 10.4874 19.4752 10.7282 19.4751H15.2709C15.5116 19.4752 15.7448 19.5588 15.9309 19.7114C16.117 19.8641 16.2445 20.0765 16.2917 20.3126L16.6021 22.1355Z"
                        fill="currentColor"
                    />
                    <path
                        d="M13 16.6668C12.7292 16.6668 12.4687 16.6553 12.2188 16.6313V19.4751H13.7812V16.6313C13.5215 16.6554 13.2608 16.6672 13 16.6668Z"
                        fill="currentColor"
                    />
                </svg>
                <div>Top packages</div>
            </a>

            {{-- Suggest a new package --}}
            <a
                href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                target="_blank"
                class="mr-1 select-none truncate rounded-xl bg-white/30 px-5 py-3 text-sm font-medium text-[#404a6b] shadow-lg shadow-fuchsia-100/70 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white/40 hover:text-slate-900 hover:shadow-xl hover:shadow-fuchsia-100 dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40 dark:hover:text-[#ABB0DD] dark:hover:shadow-none"
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
            <x-nav.theme-toggle name="gsap-nav-theme-toggle" />
        </div>
    </header>
</nav>
