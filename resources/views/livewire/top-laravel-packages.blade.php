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
                    width="130"
                    height="130"
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
        <div
            class="flex flex-col items-center justify-center gap-x-20 gap-y-28 px-5 pt-20 min-[920px]:flex-row min-[920px]:items-end"
        >
            {{-- Second Place --}}
            <a
                href="{{ $this->secondPlace->github }}"
                target="_blank"
                class="order-2 transition duration-500 ease-out hover:-translate-y-2 min-[920px]:order-1"
            >
                {{-- Badge --}}
                <div class="flex justify-center">
                    <svg
                        width="61"
                        height="77"
                        viewBox="0 0 61 77"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M47.5578 76.6363L50.7117 67.3555L60.0701 69.4698L51.2749 54.1121L38.7627 61.2767L47.5578 76.6363Z"
                            fill="url(#paint0_linear_908_1730)"
                        />
                        <path
                            d="M12.5823 76.4204L9.42655 67.1396L0.0700684 69.2539L8.86519 53.8943L21.3774 61.0608L12.5823 76.4204Z"
                            fill="url(#paint1_linear_908_1730)"
                        />
                        <path
                            d="M0.472656 18.9943V48.432C0.472656 49.9591 1.28699 51.3699 2.60912 52.1344L28.1026 66.8532C29.4247 67.6177 31.0552 67.6177 32.3774 66.8532L57.8709 52.1344C59.193 51.3699 60.0073 49.9591 60.0073 48.432V18.9943C60.0073 17.4672 59.193 16.0564 57.8709 15.292L32.3792 0.57311C31.0571 -0.191362 29.4266 -0.191362 28.1045 0.57311L2.61096 15.292C1.28883 16.0564 0.474503 17.4672 0.474503 18.9943H0.472656Z"
                            fill="url(#paint2_linear_908_1730)"
                        />
                        <path
                            d="M5.65967 21.9876V45.437C5.65967 46.9641 6.474 48.3748 7.79613 49.1393L28.1045 60.8631C29.4266 61.6275 31.0571 61.6275 32.3793 60.8631L52.6876 49.1393C54.0098 48.3748 54.8241 46.9641 54.8241 45.437V21.9876C54.8241 20.4605 54.0098 19.0497 52.6876 18.2853L32.3793 6.56151C31.0571 5.79704 29.4266 5.79704 28.1045 6.56151L7.79613 18.2853C6.474 19.0497 5.65967 20.4605 5.65967 21.9876Z"
                            fill="url(#paint3_linear_908_1730)"
                        />
                        <path
                            d="M6.9541 22.7356V44.6911C6.9541 46.2182 7.76843 47.629 9.09056 48.3935L28.1045 59.3712C29.4266 60.1357 31.0571 60.1357 32.3793 59.3712L51.3932 48.3935C52.7153 47.629 53.5297 46.2182 53.5297 44.6911V22.7356C53.5297 21.2085 52.7153 19.7978 51.3932 19.0333L32.3793 8.05553C31.0571 7.29106 29.4266 7.29106 28.1045 8.05553L9.09056 19.0333C7.76843 19.7978 6.9541 21.2085 6.9541 22.7356Z"
                            fill="url(#paint4_linear_908_1730)"
                        />
                        <path
                            d="M30.045 53.9995C41.1651 53.9995 50.1798 44.9848 50.1798 33.8647C50.1798 22.7445 41.1651 13.7299 30.045 13.7299C18.9248 13.7299 9.91016 22.7445 9.91016 33.8647C9.91016 44.9848 18.9248 53.9995 30.045 53.9995Z"
                            fill="url(#paint5_radial_908_1730)"
                        />
                        <path
                            d="M26.627 28.986H15.4905L30.069 33.7242L26.627 28.986Z"
                            fill="#93F0C1"
                        />
                        <path
                            d="M30.0691 33.7242L39.0803 46.1257L35.6383 35.532L30.0691 33.7242Z"
                            fill="#5BE08E"
                        />
                        <path
                            d="M21.0579 46.1257L30.069 39.5778V33.7242L21.0579 46.1257Z"
                            fill="#5BE08E"
                        />
                        <path
                            d="M44.6495 28.986H33.5111L30.0691 33.7242L44.6495 28.986Z"
                            fill="#5BE08E"
                        />
                        <path
                            d="M30.0691 39.5778L39.0803 46.1257L30.0691 33.7242V39.5778Z"
                            fill="#93F0C1"
                        />
                        <path
                            d="M30.069 33.7242L24.5017 35.532L21.0579 46.1257L30.069 33.7242Z"
                            fill="#93F0C1"
                        />
                        <path
                            d="M26.6272 28.9861L30.0692 33.7244V18.3943L26.6272 28.9861Z"
                            fill="#5BE08E"
                        />
                        <path
                            d="M30.0691 18.3943V33.7244L33.5111 28.9861L30.0691 18.3943Z"
                            fill="#93F0C1"
                        />
                        <path
                            d="M30.069 33.7242L15.4905 28.986L24.5016 35.532L30.069 33.7242Z"
                            fill="#5BE08E"
                        />
                        <path
                            d="M30.0691 33.7242L35.6383 35.532L44.6495 28.986L30.0691 33.7242Z"
                            fill="#93F0C1"
                        />
                        <path
                            d="M16.9855 18.0247C16.9958 16.7204 15.9467 15.6547 14.6424 15.6445C13.3381 15.6342 12.2724 16.6833 12.2622 17.9876C12.252 19.2919 13.301 20.3575 14.6053 20.3678C15.9096 20.378 16.9753 19.329 16.9855 18.0247Z"
                            fill="url(#paint6_radial_908_1730)"
                        />
                        <path
                            d="M14.6245 21.3912C14.6245 19.5225 13.1085 18.0064 11.2397 18.0064C13.1103 18.0064 14.6245 16.4904 14.6245 14.6217C14.6245 16.4904 16.1405 18.0064 18.0092 18.0064C16.1386 18.0064 14.6245 19.5225 14.6245 21.3912Z"
                            fill="white"
                        />
                        <path
                            d="M36.0381 59.6762C36.9303 59.6665 37.6459 58.9354 37.6362 58.0431C37.6266 57.1508 36.8954 56.4353 36.0031 56.4449C35.1108 56.4546 34.3953 57.1857 34.4049 58.078C34.4146 58.9703 35.1458 59.6859 36.0381 59.6762Z"
                            fill="url(#paint7_radial_908_1730)"
                        />
                        <path
                            d="M36.0242 60.3754C36.0242 59.0958 34.9864 58.058 33.7068 58.058C34.9864 58.058 36.0242 57.0203 36.0242 55.7406C36.0242 57.0203 37.062 58.058 38.3416 58.058C37.062 58.058 36.0242 59.0958 36.0242 60.3754Z"
                            fill="white"
                        />
                        <path
                            d="M47.0482 18.8707C48.8737 18.8707 50.3536 17.3908 50.3536 15.5653C50.3536 13.7399 48.8737 12.26 47.0482 12.26C45.2228 12.26 43.7429 13.7399 43.7429 15.5653C43.7429 17.3908 45.2228 18.8707 47.0482 18.8707Z"
                            fill="url(#paint8_radial_908_1730)"
                        />
                        <path
                            d="M47.0484 20.3054C47.0484 17.6888 44.9268 15.5671 42.3083 15.5671C44.9268 15.5671 47.0484 13.4436 47.0484 10.827C47.0484 13.4436 49.1701 15.5653 51.7885 15.5653C49.1701 15.5653 47.0484 17.6888 47.0484 20.3054Z"
                            fill="white"
                        />
                        <defs>
                            <linearGradient
                                id="paint0_linear_908_1730"
                                x1="55.8396"
                                y1="73.0146"
                                x2="43.0006"
                                y2="57.7156"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#89EAB8" />
                                <stop
                                    offset="1"
                                    stop-color="#24B337"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint1_linear_908_1730"
                                x1="4.30064"
                                y1="72.8087"
                                x2="17.1396"
                                y2="57.5097"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#89EAB8" />
                                <stop
                                    offset="1"
                                    stop-color="#24B337"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint2_linear_908_1730"
                                x1="30.2409"
                                y1="67.4257"
                                x2="30.2409"
                                y2="0.000680193"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#4AD26B" />
                                <stop
                                    offset="0.5"
                                    stop-color="#8BECBA"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#93F0C1"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint3_linear_908_1730"
                                x1="21.2427"
                                y1="58.4367"
                                x2="39.2392"
                                y2="8.98973"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#4CC962" />
                                <stop
                                    offset="0.5"
                                    stop-color="#A9F3B7"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#3BC051"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint4_linear_908_1730"
                                x1="30.241"
                                y1="59.9418"
                                x2="30.241"
                                y2="7.4831"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#2BBA3F" />
                                <stop
                                    offset="1"
                                    stop-color="#62DD7C"
                                />
                            </linearGradient>
                            <radialGradient
                                id="paint5_radial_908_1730"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(30.045 33.8647) scale(20.1348)"
                            >
                                <stop stop-color="#699725" />
                                <stop
                                    offset="1"
                                    stop-color="#62DD7C"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint6_radial_908_1730"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(14.5931 18.026) scale(2.3682)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#62DD7C"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint7_radial_908_1730"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(36.0625 58.2175) scale(1.62266)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#62DD7C"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint8_radial_908_1730"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(47.1253 15.5755) scale(3.31687)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#62DD7C"
                                />
                            </radialGradient>
                        </defs>
                    </svg>
                </div>

                {{-- Name --}}
                <div class="relative z-50 pt-3 text-center text-xl font-bold">
                    {{ $this->secondPlace->name }}
                </div>

                {{-- Stars Count --}}
                <div
                    class="relative z-50 flex items-center justify-center gap-2 pr-1 pt-1"
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
                        {{ number_format($this->secondPlace->stars) }}
                    </div>
                </div>
                <div class="relative pt-5">
                    {{-- Top Shadow --}}
                    <div class="absolute -top-5 left-0.5 z-0">
                        <svg
                            width="219"
                            height="45"
                            viewBox="0 0 219 45"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="text-white dark:text-[#2D3678]"
                        >
                            <path
                                d="M14.0037 -0.000366211H181.82L218.572 42.5602C219.132 43.2082 218.671 44.2138 217.815 44.2138H1.36568C0.689431 44.2138 0.208169 43.5566 0.412358 42.9119L14.0037 -0.000366211Z"
                                fill="url(#paint0_linear_908_1673)"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_908_1673"
                                    x1="110"
                                    y1="-0.000366211"
                                    x2="110"
                                    y2="44.2138"
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
                        class="relative z-10 grid h-[8rem] w-[14rem] rounded-lg bg-gradient-to-b from-white via-transparent to-transparent p-1 dark:from-[#2D3679]"
                    >
                        {{-- Inner --}}
                        <div
                            class="grid h-[14rem] w-full place-items-center rounded bg-gradient-to-b from-blue-100/70 to-transparent pb-10 dark:from-[#121439]"
                        >
                            {{-- Number --}}
                            <div
                                class="bg-gradient-to-b from-slate-500 to-transparent bg-clip-text text-8xl font-bold text-transparent dark:from-white"
                            >
                                2
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- First Place --}}
            <a
                href="{{ $this->firstPlace->github }}"
                target="_blank"
                class="order-1 transition duration-500 ease-out hover:-translate-y-2 min-[920px]:order-2"
            >
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
                    class="relative z-50 flex items-center justify-center gap-2 pr-1 pt-1"
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
                            class="grid h-[16rem] w-full place-items-center rounded bg-gradient-to-b from-blue-100/70 to-transparent pb-10 dark:from-[#121439]"
                        >
                            {{-- Number --}}
                            <div
                                class="bg-gradient-to-b from-slate-500 to-transparent bg-clip-text text-9xl font-bold text-transparent dark:from-white"
                            >
                                1
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Third Place --}}
            <a
                href="{{ $this->thirdPlace->github }}"
                target="_blank"
                class="order-3 transition duration-500 ease-out hover:-translate-y-2"
            >
                {{-- Badge --}}
                <div class="flex justify-center">
                    <svg
                        width="60"
                        height="77"
                        viewBox="0 0 60 77"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M47.4878 76.3719L50.6417 67.2426L60 69.3224L51.2049 54.2153L38.6926 61.263L47.4878 76.3719Z"
                            fill="url(#paint0_linear_908_1824)"
                        />
                        <path
                            d="M12.5122 76.1591L9.35648 67.0298L0 69.1096L8.79512 54.0007L21.3074 61.0502L12.5122 76.1591Z"
                            fill="url(#paint1_linear_908_1824)"
                        />
                        <path
                            d="M0.402344 19.6708V48.628C0.402344 50.1302 1.21667 51.5179 2.5388 52.2699L28.0323 66.7485C29.3544 67.5005 30.9849 67.5005 32.3071 66.7485L57.8006 52.2699C59.1227 51.5179 59.937 50.1302 59.937 48.628V19.6708C59.937 18.1687 59.1227 16.7809 57.8006 16.0289L32.3089 1.55032C30.9868 0.79833 29.3563 0.79833 28.0341 1.55032L2.54065 16.0289C1.21852 16.7809 0.40419 18.1687 0.40419 19.6708H0.402344Z"
                            fill="url(#paint2_linear_908_1824)"
                        />
                        <path
                            d="M5.5896 22.6151V45.6817C5.5896 47.1839 6.40393 48.5716 7.72606 49.3236L28.0344 60.856C29.3566 61.608 30.9871 61.608 32.3092 60.856L52.6176 49.3236C53.9397 48.5716 54.754 47.1839 54.754 45.6817V22.6151C54.754 21.1129 53.9397 19.7252 52.6176 18.9732L32.3092 7.44083C30.9871 6.68883 29.3566 6.68883 28.0344 7.44083L7.72606 18.9732C6.40393 19.7252 5.5896 21.1129 5.5896 22.6151Z"
                            fill="url(#paint3_linear_908_1824)"
                        />
                        <path
                            d="M6.88379 23.3508V44.9479C6.88379 46.45 7.69812 47.8378 9.02025 48.5898L28.0342 59.3883C29.3563 60.1403 30.9868 60.1403 32.309 59.3883L51.3229 48.5898C52.645 47.8378 53.4594 46.45 53.4594 44.9479V23.3508C53.4594 21.8486 52.645 20.4609 51.3229 19.7089L32.309 8.91031C30.9868 8.15832 29.3563 8.15832 28.0342 8.91031L9.02025 19.7089C7.69812 20.4609 6.88379 21.8486 6.88379 23.3508Z"
                            fill="url(#paint4_linear_908_1824)"
                        />
                        <path
                            d="M29.9751 54.1044C41.0953 54.1044 50.1099 45.2369 50.1099 34.2983C50.1099 23.3597 41.0953 14.4922 29.9751 14.4922C18.855 14.4922 9.84033 23.3597 9.84033 34.2983C9.84033 45.2369 18.855 54.1044 29.9751 54.1044Z"
                            fill="url(#paint5_radial_908_1824)"
                        />
                        <path
                            d="M26.557 29.4995H15.4204L29.9989 34.1604L26.557 29.4995Z"
                            fill="#F49CEE"
                        />
                        <path
                            d="M29.999 34.1604L39.0102 46.3594L35.5682 35.9387L29.999 34.1604Z"
                            fill="#E368E8"
                        />
                        <path
                            d="M20.9878 46.3594L29.999 39.9184V34.1604L20.9878 46.3594Z"
                            fill="#E368E8"
                        />
                        <path
                            d="M44.5794 29.4995H33.441L29.999 34.1604L44.5794 29.4995Z"
                            fill="#E368E8"
                        />
                        <path
                            d="M29.999 39.9184L39.0102 46.3594L29.999 34.1604V39.9184Z"
                            fill="#F49CEE"
                        />
                        <path
                            d="M29.999 34.1604L24.4316 35.9387L20.9878 46.3594L29.999 34.1604Z"
                            fill="#F49CEE"
                        />
                        <path
                            d="M26.5569 29.4995L29.9989 34.1604V19.0806L26.5569 29.4995Z"
                            fill="#E368E8"
                        />
                        <path
                            d="M29.999 19.0806V34.1604L33.441 29.4995L29.999 19.0806Z"
                            fill="#F49CEE"
                        />
                        <path
                            d="M29.9989 34.1604L15.4204 29.4995L24.4316 35.9387L29.9989 34.1604Z"
                            fill="#E368E8"
                        />
                        <path
                            d="M29.999 34.1604L35.5682 35.9387L44.5794 29.4995L29.999 34.1604Z"
                            fill="#F49CEE"
                        />
                        <path
                            d="M16.9148 18.7188C16.9255 17.4358 15.8768 16.3871 14.5725 16.3766C13.2682 16.3661 12.2022 17.3977 12.1915 18.6807C12.1808 19.9637 13.2295 21.0123 14.5338 21.0228C15.8381 21.0334 16.9041 20.0018 16.9148 18.7188Z"
                            fill="url(#paint6_radial_908_1824)"
                        />
                        <path
                            d="M14.5544 22.0285C14.5544 20.1903 13.0384 18.699 11.1697 18.699C13.0402 18.699 14.5544 17.2077 14.5544 15.3695C14.5544 17.2077 16.0704 18.699 17.9391 18.699C16.0686 18.699 14.5544 20.1903 14.5544 22.0285Z"
                            fill="white"
                        />
                        <path
                            d="M35.9752 59.6851C36.8675 59.6759 37.5832 58.9569 37.5739 58.0792C37.5645 57.2014 36.8336 56.4974 35.9413 56.5065C35.049 56.5157 34.3333 57.2347 34.3426 58.1125C34.3519 58.9902 35.0829 59.6943 35.9752 59.6851Z"
                            fill="url(#paint7_radial_908_1824)"
                        />
                        <path
                            d="M35.9544 60.3764C35.9544 59.1177 34.9166 58.0969 33.637 58.0969C34.9166 58.0969 35.9544 57.076 35.9544 55.8173C35.9544 57.076 36.9921 58.0969 38.2718 58.0969C36.9921 58.0969 35.9544 59.1177 35.9544 60.3764Z"
                            fill="white"
                        />
                        <path
                            d="M46.9777 19.549C48.8032 19.549 50.283 18.0933 50.283 16.2976C50.283 14.502 48.8032 13.0463 46.9777 13.0463C45.1522 13.0463 43.6724 14.502 43.6724 16.2976C43.6724 18.0933 45.1522 19.549 46.9777 19.549Z"
                            fill="url(#paint8_radial_908_1824)"
                        />
                        <path
                            d="M46.9781 20.9603C46.9781 18.3865 44.8564 16.2994 42.238 16.2994C44.8564 16.2994 46.9781 14.2106 46.9781 11.6367C46.9781 14.2106 49.0998 16.2976 51.7182 16.2976C49.0998 16.2976 46.9781 18.3865 46.9781 20.9603Z"
                            fill="white"
                        />
                        <defs>
                            <linearGradient
                                id="paint0_linear_908_1824"
                                x1="55.7685"
                                y1="72.792"
                                x2="43.1768"
                                y2="57.5386"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#F093EA" />
                                <stop
                                    offset="1"
                                    stop-color="#9B33C7"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint1_linear_908_1824"
                                x1="4.23468"
                                y1="72.6075"
                                x2="16.8264"
                                y2="57.3541"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#F093EA" />
                                <stop
                                    offset="1"
                                    stop-color="#9B33C7"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint2_linear_908_1824"
                                x1="30.1706"
                                y1="67.3116"
                                x2="30.1706"
                                y2="0.987237"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#C759DE" />
                                <stop
                                    offset="0.5"
                                    stop-color="#F195EC"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#F49CEE"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint3_linear_908_1824"
                                x1="21.1727"
                                y1="58.4692"
                                x2="38.6526"
                                y2="9.64448"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#B85BD7" />
                                <stop
                                    offset="0.5"
                                    stop-color="#E6B1F6"
                                />
                                <stop
                                    offset="1"
                                    stop-color="#AE4BD1"
                                />
                            </linearGradient>
                            <linearGradient
                                id="paint4_linear_908_1824"
                                x1="30.1707"
                                y1="59.9496"
                                x2="30.1707"
                                y2="8.34722"
                                gradientUnits="userSpaceOnUse"
                            >
                                <stop stop-color="#A23ACC" />
                                <stop
                                    offset="1"
                                    stop-color="#CD6FE6"
                                />
                            </linearGradient>
                            <radialGradient
                                id="paint5_radial_908_1824"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(29.9751 34.2983) scale(20.1348 19.8061)"
                            >
                                <stop stop-color="#4A36B3" />
                                <stop
                                    offset="1"
                                    stop-color="#CD6FE6"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint6_radial_908_1824"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(14.4265 18.7176) scale(2.3682 2.32955)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#CD6FE6"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint7_radial_908_1824"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(35.9005 58.2495) scale(1.62266 1.59617)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#CD6FE6"
                                />
                            </radialGradient>
                            <radialGradient
                                id="paint8_radial_908_1824"
                                cx="0"
                                cy="0"
                                r="1"
                                gradientUnits="userSpaceOnUse"
                                gradientTransform="translate(46.9601 16.3076) scale(3.31687 3.26273)"
                            >
                                <stop stop-color="white" />
                                <stop
                                    offset="1"
                                    stop-color="#CD6FE6"
                                />
                            </radialGradient>
                        </defs>
                    </svg>
                </div>

                {{-- Name --}}
                <div class="relative z-50 pt-3 text-center text-xl font-bold">
                    {{ $this->thirdPlace->name }}
                </div>

                {{-- Stars Count --}}
                <div
                    class="relative z-50 flex items-center justify-center gap-2 pr-1 pt-1"
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
                        {{ number_format($this->thirdPlace->stars) }}
                    </div>
                </div>
                <div class="relative pt-5">
                    {{-- Top Shadow --}}
                    <div class="absolute -top-5 left-0.5 z-0">
                        <svg
                            width="219"
                            height="45"
                            viewBox="0 0 219 45"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="-scale-x-100 text-white dark:text-[#2D3678]"
                        >
                            <path
                                d="M14.0037 -0.000366211H181.82L218.572 42.5602C219.132 43.2082 218.671 44.2138 217.815 44.2138H1.36568C0.689431 44.2138 0.208169 43.5566 0.412358 42.9119L14.0037 -0.000366211Z"
                                fill="url(#paint0_linear_908_1673)"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_908_1673"
                                    x1="110"
                                    y1="-0.000366211"
                                    x2="110"
                                    y2="44.2138"
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
                        class="relative z-10 grid h-[8rem] w-[14rem] rounded-lg bg-gradient-to-b from-white via-transparent to-transparent p-1 dark:from-[#2D3679]"
                    >
                        {{-- Inner --}}
                        <div
                            class="grid h-[14rem] w-full place-items-center rounded bg-gradient-to-b from-blue-100/70 to-transparent pb-10 dark:from-[#121439]"
                        >
                            {{-- Number --}}
                            <div
                                class="bg-gradient-to-b from-slate-500 to-transparent bg-clip-text text-8xl font-bold text-transparent dark:from-white"
                            >
                                3
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <livewire:footer />
    </div>
</section>
