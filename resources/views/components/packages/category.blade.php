<div
    x-on:mouseenter="isHovering = true"
    x-on:mouseleave="isHovering = false"
    wire:click="selectCategory('{{ $category->name }}')"
    wire:ignore.self
    x-data="{
        categoryTimeline: null,
        isHovering: false,

        init() {
            $data.categoryTimeline = gsap
                .timeline({
                    paused: true,
                    onComplete: () => {
                        // If not hovering, reverse the animation
                        if (! $data.isHovering) $data.categoryTimeline?.reverse()
                    },
                })
                .to($el, {
                    x: 10,
                    ease: 'sine.inOut',
                    duration: 0.3,
                })

            $watch('isHovering', (value) => {
                // If hovering, play the animation
                if (value) $data.categoryTimeline?.play()
                // If not hovering and animation is done, reverse it
                else if ($data.categoryTimeline?.progress() === 1)
                    $data.categoryTimeline?.reverse()
            })
        },
    }"
    class="relative flex cursor-pointer items-center gap-3 py-2.5"
>
    {{-- Icon --}}
    <div
        class="grid h-8 w-8 place-items-center rounded-lg transition duration-300 {{ $this->selectedCategory === $category->name ? $category->activeClass : 'bg-slate-300/50 text-slate-500 dark:bg-slate-800/50' }}"
    >
        {!! $category->content !!}
    </div>
    {{-- Category name and package count --}}
    <div>
        <div
            class="text-sm font-medium dark:text-slate-300"
        >
            {{ $category->name }}
        </div>
        <div class="text-xs text-slate-400 dark:text-slate-400">{{ $category->packages_count }} Packages</div>
    </div>
</div>
