<div class="flex select-none items-center gap-3">
    <div
        @class([
            "grid h-10 w-10 place-items-center rounded-full bg-white/80 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition duration-300 dark:bg-[#110E26]/50",
            "cursor-not-allowed opacity-20" => $this->packages->onFirstPage(),
            "cursor-pointer hover:bg-white dark:hover:bg-[#15112e]" => ! $this->packages->onFirstPage(),
        ])
        wire:click="setPage(1)"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <g fill="currentColor">
                <path
                    d="M17.75 19a.75.75 0 0 1-1.32.488l-6-7a.75.75 0 0 1 0-.976l6-7A.75.75 0 0 1 17.75 5v14Z"
                    opacity=".5"
                />
                <path
                    fill-rule="evenodd"
                    d="M13.488 19.57a.75.75 0 0 0 .081-1.058L7.988 12l5.581-6.512a.75.75 0 1 0-1.138-.976l-6 7a.75.75 0 0 0 0 .976l6 7a.75.75 0 0 0 1.057.082Z"
                    clip-rule="evenodd"
                />
            </g>
        </svg>
    </div>
    <div
        @class([
            "grid h-10 w-10 place-items-center rounded-full bg-white/80 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition duration-300 dark:bg-[#110E26]/50",
            "cursor-not-allowed opacity-20" => $this->packages->onFirstPage(),
            "cursor-pointer hover:bg-white dark:hover:bg-[#15112e]" => ! $this->packages->onFirstPage(),
        ])
        wire:click="previousPage"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <path
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="m15 5l-6 7l6 7"
            />
        </svg>
    </div>
    <div class="grid w-16 place-items-center">
        <div
            class="relative h-12 w-14"
            x-data="{
                totalPages: @entangle("alpinePackagesTotal"),
                currentPage: @entangle("alpineCurrentPage"),
            }"
        >
            <template
                x-for="i in totalPages"
                :key="i"
            >
                <div
                    :class="{
                'absolute text-xl font-semibold transition-all duration-300': true,
                'right-[60%] top-0': i === currentPage,
                '-top-5 right-[20%] opacity-0': i > currentPage,
                'right-[90%] top-5 opacity-0': i < currentPage
            }"
                >
                    <span x-text="i"></span>
                </div>
            </template>

            <div
                class="absolute right-1/2 top-1/2 h-[0.5px] w-10 -translate-y-1/2 translate-x-1/2 -rotate-45 rounded-full bg-current"
            ></div>
            <div class="absolute bottom-1 left-[60%] text-sm">
                {{-- Number of pages --}}
                {{ $this->packages->lastPage() }}
            </div>
        </div>
    </div>
    <div
        @class([
            "grid h-10 w-10 place-items-center rounded-full bg-white/80 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition duration-300 dark:bg-[#110E26]/50",
            "cursor-not-allowed opacity-20" => $this->packages->onLastPage(),
            "cursor-pointer hover:bg-white dark:hover:bg-[#15112e]" => ! $this->packages->onLastPage(),
        ])
        @if (! $this->packages->onLastPage())
            wire:click="nextPage"
        @endif
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <path
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="m9 5l6 7l-6 7"
            />
        </svg>
    </div>
    <div
        @class([
            "grid h-10 w-10 place-items-center rounded-full bg-white/80 shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] backdrop-blur-xl transition duration-300 dark:bg-[#110E26]/50",
            "cursor-not-allowed opacity-20" => $this->packages->onLastPage(),
            "cursor-pointer hover:bg-white dark:hover:bg-[#15112e]" => ! $this->packages->onLastPage(),
        ])
        wire:click="setPage({{ $this->packages->lastPage() }})"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <g fill="currentColor">
                <path
                    d="M6.25 19a.75.75 0 0 0 1.32.488l6-7a.75.75 0 0 0 0-.976l-6-7A.75.75 0 0 0 6.25 5v14Z"
                    opacity=".5"
                />
                <path
                    fill-rule="evenodd"
                    d="M10.512 19.57a.75.75 0 0 1-.081-1.058L16.012 12l-5.581-6.512a.75.75 0 1 1 1.139-.976l6 7a.75.75 0 0 1 0 .976l-6 7a.75.75 0 0 1-1.058.082Z"
                    clip-rule="evenodd"
                />
            </g>
        </svg>
    </div>
</div>
