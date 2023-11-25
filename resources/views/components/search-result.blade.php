<div
    x-data="{
        isHovering: false,
    }"
    class="grid place-items-center pt-8 text-center"
>
    {{-- Emote faces --}}
    <div class="grid h-28 w-28">
        <img
            src="{{ Vite::asset('resources/images/emotes/sad.webp') }}"
            width="auto"
            height="auto"
            alt=""
            class="pointer-events-none w-24 select-none self-center justify-self-center transition duration-300 [grid-area:1/-1]"
            :class="{
                'opacity-0': isHovering,
            }"
        />
        <img
            src="{{ Vite::asset('resources/images/emotes/excited.webp') }}"
            width="auto"
            height="auto"
            alt=""
            class="pointer-events-none w-24 select-none self-center justify-self-center transition duration-300 [grid-area:1/-1]"
            :class="{
                'opacity-0': !isHovering,
            }"
        />
    </div>
    <div class="pt-2 text-2xl font-semibold">Oops!</div>
    <div class="inline-flex items-center gap-2 pt-1 font-medium">
        <span>
            No packages found
            @if ($this->search)
                <span>for</span>
            @endif
        </span>
        @if ($this->search)
            <span
                class="inline-flex cursor-pointer items-center gap-1 rounded-full bg-cyan-200 pb-0.5 pl-3.5 pr-3 pt-px text-cyan-600 transition duration-300 hover:bg-cyan-200/50 dark:bg-cyan-900/50 dark:text-cyan-500 dark:hover:bg-cyan-800"
                wire:click="resetSearch()"
            >
                <span>
                    {{ $this->search }}
                </span>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 256 256"
                >
                    <path
                        fill="currentColor"
                        d="M208.49 191.51a12 12 0 0 1-17 17L128 145l-63.51 63.49a12 12 0 0 1-17-17L111 128L47.51 64.49a12 12 0 0 1 17-17L128 111l63.51-63.52a12 12 0 0 1 17 17L145 128Z"
                    />
                </svg>
            </span>
        @endif
    </div>
    <div class="pt-2 text-sm text-[#6A7789] dark:text-[#96A5BB]">
        If you know a package that is not listed here, feel free to suggest it.
    </div>

    {{-- Suggest a new package --}}
    <div class="mt-6">
        <a
            href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
            target="_blank"
            class="mr-1 select-none rounded-xl bg-white/50 px-5 py-3 text-sm font-medium text-[#404a6b] shadow-lg shadow-slate-200/70 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white hover:text-slate-900 hover:shadow-xl hover:shadow-slate-200 dark:bg-transparent dark:text-[#ABB0DD] dark:shadow-none dark:ring-[#627288]/40 dark:hover:bg-[#110E26]/40"
            x-on:mouseenter="isHovering = true"
            x-on:mouseleave="isHovering = false"
        >
            Suggest a new package
        </a>
    </div>
</div>
