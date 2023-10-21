@props([
    'content',
    'placement',
    'theme',
    'size',
    'condition',
])

<div
    x-data="{
        tooltipInstance: null,

        init() {
            if ($el && {{ $condition ?? 'true' }}) {
                $nextTick(() => {
                    $data.tooltipInstance = tippy($el, {
                        content: '{{ $content }}',
                        theme: '{{ $theme ?? "slate" }}',
                        placement: '{{ $placement ?? "bottom" }}',
                        animation: 'shift-away',
                        touch: 'hold',
                        allowHTML: true,
                        delay: 100,
                    })
                })
            }
        },
    }"
>
    {{ $slot }}
</div>
