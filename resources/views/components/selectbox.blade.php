@props([
    'items',
])

<div class="relative z-20">
    <button
        type="button"
        class="relative w-full cursor-pointer rounded-xl bg-white/50 py-3 pl-3.5 pr-10 text-left leading-5 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] transition duration-300 placeholder:text-[#9095AE] hover:bg-white/80 focus:outline-hidden focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-blue-300 dark:bg-[#362B59]/20 dark:hover:bg-[#362B59]/40 sm:text-sm"
    >
        <span class="block truncate">Newest</span>
        <span
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 256 256"
                class="rotate-180 text-gray-400 transition duration-300"
            >
                <path
                    fill="currentColor"
                    d="m213.66 101.66l-80 80a8 8 0 0 1-11.32 0l-80-80a8 8 0 0 1 11.32-11.32L128 164.69l74.34-74.35a8 8 0 0 1 11.32 11.32Z"
                />
            </svg>
        </span>
    </button>
    <div>
        <ul
            role="listbox"
            tabindex="0"
            class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white text-base shadow-xl shadow-black/5 focus:outline-hidden dark:bg-[#362B59] sm:text-sm"
        >
            <li
                class="group relative cursor-pointer select-none bg-indigo-100 py-2.5 pl-9 pr-4 text-indigo-900 transition duration-200 first:pt-3 last:pb-3 dark:bg-indigo-900 dark:text-indigo-100"
                role="option"
                tabindex="-1"
            >
                <div
                    class="pl-1 transition duration-300 group-hover:translate-x-1"
                >
                    <div class="block truncate font-medium">Newest</div>
                    <div class="truncate text-xs opacity-60">
                        Freshly Released
                    </div>
                </div>
                <span
                    class="absolute inset-y-0 left-0 flex items-center pl-2.5 text-indigo-600 transition duration-200"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 256 256"
                    >
                        <path
                            fill="currentColor"
                            d="m232.49 80.49l-128 128a12 12 0 0 1-17 0l-56-56a12 12 0 1 1 17-17L96 183L215.51 63.51a12 12 0 0 1 17 17Z"
                        />
                    </svg>
                </span>
            </li>
        </ul>
    </div>
</div>
