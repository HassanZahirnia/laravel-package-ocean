<section
    class="min-h-screen overflow-clip bg-[#FAFCFF] font-poppins antialiased transition duration-300 selection:bg-stone-800/10 dark:bg-[#04041F] dark:text-[#EAEFFB] dark:selection:bg-indigo-100/10"
>
    <x-nav.bar />
    <div
        class="relative z-10 mx-auto w-full max-w-screen-xl"
        x-data="{
            init() {
                gsap.set('.gsap-background-blur, .gsap-background-blur-opacity-70', {
                    autoAlpha: 0,
                })
                gsap.fromTo(
                    '.gsap-background-blur',
                    {
                        autoAlpha: 0,
                    },
                    {
                        autoAlpha: 1,
                        duration: 0.3,
                    },
                )
                gsap.fromTo(
                    '.gsap-background-blur-opacity-70',
                    {
                        autoAlpha: 0,
                    },
                    {
                        autoAlpha: 0.8,
                        duration: 0.3,
                    },
                )
            },
        }"
    >
        <livewire:hero-background />
        <div class="mx-auto w-full max-w-3xl px-5 text-center">
            {{-- Star Cup --}}
            <div class="flex justify-center">
                <img
                    src="@viteAsset('resources/images/star-cup.webp')"
                    width="150"
                    height="150"
                    alt=""
                    class="pointer-events-none select-none"
                />
            </div>

            {{-- Title --}}
            <div
                class="pt-5 text-2xl font-bold text-[#040404] transition duration-300 dark:text-white sm:text-3xl"
            >
                Top Laravel Packages
            </div>

            {{-- Description --}}
            <div
                class="pt-3 font-medium text-[#6A7789] transition duration-300 dark:text-[#96A5BB] sm:text-lg"
            >
                The most popular Laravel packages with the highest stars on
                Github.
            </div>
        </div>
        <div class="flex flex-wrap justify-center gap-20 pt-20">
            {{-- First Place --}}
            <div class="">
                {{-- Badge --}}
                <div class="flex justify-center">
                    <svg
                        width="71"
                        height="90"
                        viewBox="0 0 71 90"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M56.0698 90.0009L59.7494 79.1017L70.6674 81.5847L60.4064 63.5487L45.8088 71.9628L56.0698 90.0009Z"
                            fill="url(#paint0_linear_908_1637)"
                        />
                        <path
                            d="M15.2651 89.7474L11.5834 78.8481L0.66748 81.3311L10.9285 63.293L25.5261 71.7092L15.2651 89.7474Z"
                            fill="url(#paint1_linear_908_1637)"
                        />
                        <path
                            d="M1.13721 22.307V56.8784C1.13721 58.6718 2.08726 60.3285 3.62974 61.2263L33.3722 78.512C34.9146 79.4098 36.8169 79.4098 38.3594 78.512L68.1018 61.2263C69.6443 60.3285 70.5943 58.6718 70.5943 56.8784V22.307C70.5943 20.5136 69.6443 18.8568 68.1018 17.959L38.3615 0.673341C36.819 -0.224447 34.9168 -0.224447 33.3743 0.673341L3.6319 17.959C2.08941 18.8568 1.13936 20.5136 1.13936 22.307H1.13721Z"
                            fill="url(#paint2_linear_908_1637)"
                        />
                        <path
                            d="M7.18848 25.8223V53.361C7.18848 55.1544 8.13853 56.8112 9.68101 57.7089L33.3741 71.4772C34.9166 72.375 36.8189 72.375 38.3613 71.4772L62.0544 57.7089C63.5969 56.8112 64.547 55.1544 64.547 53.361V25.8223C64.547 24.0289 63.5969 22.3721 62.0544 21.4743L38.3613 7.70606C36.8189 6.80827 34.9166 6.80827 33.3741 7.70606L9.68101 21.4743C8.13853 22.3721 7.18848 24.0289 7.18848 25.8223Z"
                            fill="url(#paint3_linear_908_1637)"
                        />
                        <path
                            d="M8.69897 26.7005V52.4848C8.69897 54.2782 9.64903 55.935 11.1915 56.8327L33.3744 69.7249C34.9169 70.6227 36.8192 70.6227 38.3617 69.7249L60.5446 56.8327C62.0871 55.935 63.0371 54.2782 63.0371 52.4848V26.7005C63.0371 24.9071 62.0871 23.2503 60.5446 22.3525L38.3617 9.46033C36.8192 8.56254 34.9169 8.56254 33.3744 9.46033L11.1915 22.3525C9.64903 23.2503 8.69897 24.9071 8.69897 26.7005Z"
                            fill="url(#paint4_linear_908_1637)"
                        />
                        <path
                            d="M52.2488 56.4912C61.4225 47.2568 61.4225 32.2849 52.2488 23.0506C43.0752 13.8162 28.2017 13.8162 19.0281 23.0506C9.85444 32.2849 9.85444 47.2568 19.0281 56.4912C28.2017 65.7256 43.0752 65.7256 52.2488 56.4912Z"
                            fill="url(#paint5_radial_908_1637)"
                        />
                        <path
                            d="M31.6508 34.0413H18.6582L35.6665 39.6058L31.6508 34.0413Z"
                            fill="#FAD974"
                        />
                        <path
                            d="M35.6665 39.6057L46.1795 54.1698L42.1639 41.7287L35.6665 39.6057Z"
                            fill="#F5C33F"
                        />
                        <path
                            d="M25.1533 54.1698L35.6664 46.4801V39.6057L25.1533 54.1698Z"
                            fill="#F5C33F"
                        />
                        <path
                            d="M52.6769 34.0413H39.6821L35.6665 39.6058L52.6769 34.0413Z"
                            fill="#F5C33F"
                        />
                        <path
                            d="M35.6665 46.4801L46.1795 54.1698L35.6665 39.6057V46.4801Z"
                            fill="#FAD974"
                        />
                        <path
                            d="M35.6664 39.6057L29.1711 41.7287L25.1533 54.1698L35.6664 39.6057Z"
                            fill="#FAD974"
                        />
                        <path
                            d="M31.6509 34.0412L35.6665 39.6058V21.6023L31.6509 34.0412Z"
                            fill="#F5C33F"
                        />
                        <path
                            d="M35.6665 21.6023V39.6058L39.6821 34.0412L35.6665 21.6023Z"
                            fill="#FAD974"
                        />
                        <path
                            d="M35.6665 39.6058L18.6582 34.0413L29.1712 41.7288L35.6665 39.6058Z"
                            fill="#F5C33F"
                        />
                        <path
                            d="M35.6665 39.6058L42.1639 41.7288L52.6769 34.0413L35.6665 39.6058Z"
                            fill="#FAD974"
                        />
                        <path
                            d="M20.4025 21.1517C20.4051 19.6199 19.1737 18.376 17.6519 18.3733C16.1302 18.3706 14.8944 19.6102 14.8918 21.1421C14.8891 22.6739 16.1206 23.9178 17.6423 23.9205C19.1641 23.9232 20.3998 22.6835 20.4025 21.1517Z"
                            fill="url(#paint6_radial_908_1637)"
                        />
                        <path
                            d="M17.6478 25.1219C17.6478 22.9273 15.8791 21.1469 13.699 21.1469C15.8813 21.1469 17.6478 19.3665 17.6478 17.1719C17.6478 19.3665 19.4165 21.1469 21.5967 21.1469C19.4144 21.1469 17.6478 22.9273 17.6478 25.1219Z"
                            fill="white"
                        />
                        <path
                            d="M44.5016 68.1924C44.504 67.1445 43.6619 66.293 42.6209 66.2906C41.5798 66.2882 40.7339 67.1358 40.7316 68.1838C40.7292 69.2318 41.5712 70.0832 42.6123 70.0856C43.6534 70.088 44.4992 69.2404 44.5016 68.1924Z"
                            fill="url(#paint7_radial_908_1637)"
                        />
                        <path
                            d="M42.6143 70.9047C42.6143 69.4018 41.4036 68.1831 39.9106 68.1831C41.4036 68.1831 42.6143 66.9644 42.6143 65.4615C42.6143 66.9644 43.825 68.1831 45.318 68.1831C43.825 68.1831 42.6143 69.4018 42.6143 70.9047Z"
                            fill="white"
                        />
                        <path
                            d="M55.4789 22.1663C57.6086 22.1637 59.3329 20.4238 59.3303 18.2799C59.3276 16.1361 57.599 14.4003 55.4693 14.4028C53.3395 14.4054 51.6152 16.1454 51.6179 18.2892C51.6205 20.433 53.3492 22.1689 55.4789 22.1663Z"
                            fill="url(#paint8_radial_908_1637)"
                        />
                        <path
                            d="M55.4754 23.8466C55.4754 20.7737 53.0001 18.2821 49.9453 18.2821C53.0001 18.2821 55.4754 15.7882 55.4754 12.7153C55.4754 15.7882 57.9507 18.2821 61.0055 18.2821C57.9507 18.2821 55.4754 20.7759 55.4754 23.8488V23.8466Z"
                            fill="white"
                        />
                        <defs>
                            <linearGradient
                                id="paint0_linear_908_1637"
                                x1="65.73"
                                y1="85.743"
                                x2="50.6352"
                                y2="67.8741"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#F8D56C" />
                                <stop
                                    offset="1"
                                    stop-color="#E6990B"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint1_linear_908_1637"
                                x1="5.60387"
                                y1="85.5031"
                                x2="20.6998"
                                y2="67.6324"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#F8D56C" />
                                <stop
                                    offset="1"
                                    stop-color="#E6990B"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint2_linear_908_1637"
                                x1="35.8668"
                                y1="79.1843"
                                x2="35.8668"
                                y2="0.00108553"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#F0B431" />
                                <stop
                                    offset="0.5"
                                    stop-color="#F9D66D"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#FAD974"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint3_linear_908_1637"
                                x1="25.3687"
                                y1="68.6277"
                                x2="46.6105"
                                y2="10.6478"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#EDB036" />
                                <stop
                                    offset="0.5"
                                    stop-color="#FBD589"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#EAA724"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint4_linear_908_1637"
                                x1="35.867"
                                y1="70.395"
                                x2="35.867"
                                y2="8.78807"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#E89E12" />
                                <stop
                                    offset="1"
                                    stop-color="#F4BC48"
                                />
                            </linearGradient>
                            <radialGradient
                                id="paint5_radial_908_1637"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(35.6399 39.7697) scale(23.4906 23.6461)"
                            >
                                <stop stop-color="#CB5114" />
                                <stop
                                    offset="1"
                                    stop-color="#F4BC48"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint6_radial_908_1637"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(17.6092 21.2653) scale(2.7629 2.78119)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#F4BC48"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint7_radial_908_1637"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(42.6651 68.4703) scale(1.8931 1.90563)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#F4BC48"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint8_radial_908_1637"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(55.566 18.3924) scale(3.86968 3.89529)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#F4BC48"
                                />
                            </radialGradient>
                        </defs>
                    </svg>
                </div>

                {{-- Name --}}
                <div class="relative z-50 pt-3 text-center text-2xl font-bold">
                    {{ $this->firstPlace->name }}
                </div>

                {{-- Stars Count --}}
                <div
                    class="relative z-50 flex items-center justify-center gap-2 pt-1"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 32 32"
                        class="relative -top-px text-amber-400 dark:text-[#FCD53F]"
                    >
                        <path
                            fill="currentColor"
                            d="m18.7 4.627l2.247 4.31a2.27 2.27 0 0 0 1.686 1.189l4.746.65c2.538.35 3.522 3.479 1.645 5.219l-3.25 2.999a2.225 2.225 0 0 0-.683 2.04l.793 4.398c.441 2.45-2.108 4.36-4.345 3.24l-4.536-2.25a2.282 2.282 0 0 0-2.006 0l-4.536 2.25c-2.238 1.11-4.786-.79-4.345-3.24l.793-4.399c.14-.75-.12-1.52-.682-2.04l-3.251-2.998c-1.877-1.73-.893-4.87 1.645-5.22l4.746-.65a2.23 2.23 0 0 0 1.686-1.189l2.248-4.309c1.144-2.17 4.264-2.17 5.398 0Z"
                        />
                    </svg>
                    <div class="text-lg font-semibold opacity-70">
                        {{ number_format($this->firstPlace->stars) }}
                    </div>
                </div>
                <div class="relative pt-5">
                    {{-- Top Shadow --}}
                    <div class="absolute -left-0 -top-6 z-0">
                        <svg
                            width="255"
                            height="52"
                            viewBox="0 0 255 52"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-white dark:text-[#2D3678]"
                        >
                            <path
                                d="M30.2426 -0.000244141H224.757L254.11 49.7398C254.503 50.4064 254.023 51.248 253.249 51.248H1.75125C0.977211 51.248 0.496647 50.4064 0.890033 49.7398L30.2426 -0.000244141Z"
                                fill="url(#paint0_linear_908_1580)"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_908_1580"
                                    x1="127.5"
                                    y1="-0.000244141"
                                    x2="127.5"
                                    y2="51.248"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop
                                        stop-color="currentColor"
                                        stop-opacity="0"
                                    />
                                    <stop
                                        offset="1"
                                        stop-color="currentColor"
                                    />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div
                        class="relative z-10 grid h-[10rem] w-[16rem] rounded-lg bg-gradient-to-b from-white via-transparent to-transparent p-1 dark:from-[#2D3679]"
                    >
                        {{-- Inner --}}
                        <div
                            class="grid h-[16rem] w-full place-items-center rounded bg-gradient-to-b from-blue-100 to-transparent pb-10 dark:from-[#121439]"
                        >
                            {{-- Number --}}
                            <div
                                class="bg-gradient-to-b from-blue-500 to-transparent bg-clip-text text-8xl font-bold text-transparent dark:from-white"
                            >
                                1
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <livewire:footer />
    </div>
</section>
