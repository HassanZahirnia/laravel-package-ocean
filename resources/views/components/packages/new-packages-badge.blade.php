<div
    x-data="{
        lastVisitDate: $persist(@entangle('lastVisitDate')).as('lastVisitDate'),
        newVisitDate: $persist(null).as('newVisitDate'),
        GRACE_PERIOD: 5, // minutes,
        newPackagesCount: 0,

        async init() {
            // If the lastVisitDate is empty, set the current time
            if (! this.lastVisitDate) {
                this.lastVisitDate = new Date().toISOString()
                this.newVisitDate = null
            }
            // If newVisitDate is empty, set it to the current time
            // so that on the next visit, we have something to compare the GRACE_PERIOD minutes difference with
            else if (! this.newVisitDate) {
                this.newVisitDate = new Date().toISOString()
            }
            // If the difference between the lastVisitDate and newVisitDate is more than GRACE_PERIOD minutes,
            // set the lastVisitDate to the current time and newVisitDate to null
            else if (
                dayjs().diff(this.newVisitDate, 'minute') > this.GRACE_PERIOD
            ) {
                this.lastVisitDate = new Date().toISOString()
                this.newVisitDate = null
            }

            await $wire.newPackagesCountSinceLastVisit().then((response) => {
                $data.newPackagesCount = response
            })
        },
    }"
    x-show="newPackagesCount > 0"
    theme="emerald"
    wire:click.prevent="toggleShowNewPackagesSinceLastVisit()"
    x-tooltip.raw.theme.emerald="{{ $this->newPackagesCountSinceLastVisit() . ' New packages were added since your last visit !' }}"
>
    <div
        @class([
            'flex cursor-pointer select-none items-center gap-2 rounded-full px-4 py-1.5 font-medium transition-all duration-300 hover:brightness-105',
            'bg-slate-300/50 text-slate-600 dark:bg-slate-700/50 dark:text-slate-400' => ! $this->showNewPackagesSinceLastVisit,
            'bg-teal-200/70 text-teal-600 dark:bg-teal-500/20 dark:text-teal-500' => $this->showNewPackagesSinceLastVisit,
        ])
    >
        <span class="relative flex h-2.5 w-2.5">
            <span
                @class([
                    'absolute inline-flex h-full w-full animate-ping rounded-full bg-teal-400',
                    'opacity-75' => ! $this->showNewPackagesSinceLastVisit,
                    'opacity-0' => $this->showNewPackagesSinceLastVisit,
                ])
            ></span>
            <span
                class="relative inline-flex h-2.5 w-2.5 rounded-full bg-teal-500"
            ></span>
        </span>
        <div>
            {{ $this->newPackagesCountSinceLastVisit() }}
            {{ str('New Item')->plural($this->newPackagesCountSinceLastVisit()) }}
        </div>
    </div>
</div>
