<div class="flex w-40 flex-1 justify-start min-[920px]:justify-end">
    <div
        @class([
            'group relative flex h-11 w-50 cursor-pointer select-none items-center gap-2 overflow-hidden rounded-xl transition-all delay-100 duration-300 ease-out sm:w-40 lg:w-11 lg:hover:w-40',
            'bg-white/50 dark:bg-[#362B59]/30 dark:hover:bg-[#362B59]/40' => $this->showOfficialPackages === false,
            'bg-white hover:bg-white/80 dark:bg-indigo-500/20 dark:hover:bg-indigo-500/10 lg:w-40' => $this->showOfficialPackages === true,
        ])
        wire:click="toggleShowOfficialPackages"
    >
        <div class="mb-1 ml-2.5 shrink-0"><x-icons.crown /></div>
        <div
            @class([
                'truncate leading-5 transition delay-100 duration-300 sm:text-xs lg:opacity-0 lg:group-hover:opacity-100',
                'lg:opacity-100' => $this->showOfficialPackages,
            ])
        >
            Official Packages
        </div>
    </div>
</div>
