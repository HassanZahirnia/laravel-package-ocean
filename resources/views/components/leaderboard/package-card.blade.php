<div
    wire:key="{{ $package->id }}"
    wire:ignore.self
    x-on:mouseenter="isHovering = true"
    x-on:mouseleave="isHovering = false"
    x-data="{
        cardTimeline: null,
        isHovering: false,

        init() {
            $data.cardTimeline = gsap
                .timeline({
                    paused: true,
                    onComplete: () => {
                        // If not hovering, reverse the animation
                        if (! $data.isHovering) $data.cardTimeline?.reverse()
                    },
                })
                .to($el, {
                    y: -1,
                    ease: 'sine.out',
                    duration: 0.25,
                })

            $watch('isHovering', (value) => {
                // If hovering, play the animation
                if (value) $data.cardTimeline?.play()
                // If not hovering and animation is done, reverse it
                else if ($data.cardTimeline?.progress() === 1)
                    $data.cardTimeline?.reverse()
            })
        },
    }"
>
    <a
        href="{{ $package->github }}"
        target="_blank"
        class="group/package-card relative z-[1] flex items-center gap-x-10 gap-y-5 rounded-xl bg-white/40 p-5 text-sm shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] ring-1 ring-slate-100 transition-all duration-300 hover:bg-white/60 hover:shadow-2xl hover:shadow-indigo-300/30 hover:ring-white dark:bg-[#362B59]/20 dark:ring-1 dark:ring-[#132447] dark:hover:bg-[#362B59]/30 dark:hover:shadow-xl dark:hover:shadow-[#1c164a] dark:hover:ring-[#373060]"
    >
        {{-- Rank --}}
        <div class="flex items-center gap-2">
            <svg
                width="26"
                height="25"
                viewBox="0 0 26 25"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="text-blue-300"
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

            <div class="font-semibold text-[#545D82] dark:text-[#DEE4F1]">
                {{ $package->getRankAttribute() }}
            </div>
        </div>

        {{-- Name --}}
        <div class="flex-1 font-semibold text-[#545D82] dark:text-[#DEE4F1]">
            {{ $package->name }}
        </div>

        {{-- Stars --}}
        <div
            @class([
                'flex items-center gap-2',
                'transition-transform duration-300 group-hover/package-card:-translate-x-2' =>
                    $package->stars >= 1000,
            ])
        >
            <svg
                @class([
                    'relative -top-px transition duration-500 ease-out',
                    'group-hover/package-card:rotate-[-75deg]' => $package->stars >= 1000,
                ])
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="18"
                viewBox="0 0 32 32"
            >
                <path
                    fill="#FCD53F"
                    d="m18.7 4.627l2.247 4.31a2.27 2.27 0 0 0 1.686 1.189l4.746.65c2.538.35 3.522 3.479 1.645 5.219l-3.25 2.999a2.225 2.225 0 0 0-.683 2.04l.793 4.398c.441 2.45-2.108 4.36-4.345 3.24l-4.536-2.25a2.282 2.282 0 0 0-2.006 0l-4.536 2.25c-2.238 1.11-4.786-.79-4.345-3.24l.793-4.399c.14-.75-.12-1.52-.682-2.04l-3.251-2.998c-1.877-1.73-.893-4.87 1.645-5.22l4.746-.65a2.23 2.23 0 0 0 1.686-1.189l2.248-4.309c1.144-2.17 4.264-2.17 5.398 0Z"
                />
            </svg>
            <div class="relative">
                {{ number_format($package->stars) }}
            </div>
        </div>
    </a>
</div>
