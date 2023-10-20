<div
    class="group relative w-full overflow-hidden rounded-xl transition-all delay-100 duration-500 ease-out md:max-w-[13rem] lg:focus-within:w-60 lg:hover:w-60"
    :class="{
        'lg:w-11': !$wire.search,
        'lg:w-60': $wire.search,
    }"
>
    {{-- X icon --}}
    <div
        x-show="$wire.search !== ''"
        x-transition:enter="transition duration-150 ease-out"
        x-transition:enter-start="translate-x-2 rotate-90 opacity-0"
        x-transition:enter-end="translate-x-0 rotate-0 opacity-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-x-0 rotate-0 opacity-100"
        x-transition:leave-end="translate-x-2 rotate-90 opacity-0"
        class="absolute right-1.5 top-0.5 cursor-pointer p-2.5"
    >
        <div
            class="text-[#9095AE] transition duration-300 hover:scale-110 hover:text-black dark:text-[#ABB0DD] dark:hover:text-white"
            wire:click="search = ''"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 256 256"
            >
                <path
                    fill="currentColor"
                    d="M205.66 194.34a8 8 0 0 1-11.32 11.32L128 139.31l-66.34 66.35a8 8 0 0 1-11.32-11.32L116.69 128L50.34 61.66a8 8 0 0 1 11.32-11.32L128 116.69l66.34-66.35a8 8 0 0 1 11.32 11.32L139.31 128Z"
                />
            </svg>
        </div>
    </div>
    {{-- Magnify icon --}}
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 256 256"
        class="absolute left-3 top-[0.75rem] text-[#9095AE] transition duration-300 dark:text-[#ABB0DD]"
    >
        <path
            fill="currentColor"
            d="M232.49 215.51L185 168a92.12 92.12 0 1 0-17 17l47.53 47.54a12 12 0 0 0 17-17ZM44 112a68 68 0 1 1 68 68a68.07 68.07 0 0 1-68-68Z"
        />
    </svg>
    {{-- Search input --}}
    <input
        wire:model.live="search"
        type="text"
        class="w-full border-none bg-white/50 px-10 py-3 leading-5 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] transition duration-300 placeholder:text-[#9095AE] dark:bg-[#362B59]/20 dark:ring-1 dark:ring-transparent dark:placeholder:text-[#ABB0DD] dark:hover:bg-[#362B59]/30 dark:focus:ring-indigo-500 sm:text-sm lg:placeholder:opacity-0 lg:placeholder:transition lg:placeholder:duration-300 lg:group-focus-within:placeholder:opacity-100 lg:group-hover:placeholder:opacity-100"
        placeholder="Search ..."
    />
</div>
