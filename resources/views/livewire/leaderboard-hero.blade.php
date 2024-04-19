<div>
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
            The most popular Laravel packages with the highest stars on Github.
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
                    width="55"
                    height="71"
                    viewBox="0 0 55 71"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M43.5305 70.349L46.4215 61.8295L55 63.7704L46.9378 49.6725L35.4683 56.2494L43.5305 70.349Z"
                        fill="url(#paint0_linear_908_1223)"
                    />
                    <path
                        d="M11.4695 70.1507L8.57677 61.6313L0 63.5721L8.0622 49.4725L19.5317 56.0511L11.4695 70.1507Z"
                        fill="url(#paint1_linear_908_1223)"
                    />
                    <path
                        d="M0.369019 17.4356V44.4584C0.369019 45.8603 1.11549 47.1553 2.32744 47.8571L25.6965 61.3685C26.9084 62.0702 28.4031 62.0702 29.615 61.3685L52.984 47.8571C54.196 47.1553 54.9425 45.8603 54.9425 44.4584V17.4356C54.9425 16.0338 54.196 14.7388 52.984 14.037L29.6167 0.525587C28.4048 -0.176172 26.9101 -0.176172 25.6982 0.525587L2.32913 14.037C1.11718 14.7388 0.370711 16.0338 0.370711 17.4356H0.369019Z"
                        fill="url(#paint2_linear_908_1223)"
                    />
                    <path
                        d="M5.12366 20.1833V41.709C5.12366 43.1108 5.87013 44.4058 7.08208 45.1076L25.6981 55.8696C26.91 56.5714 28.4047 56.5714 29.6166 55.8696L48.2326 45.1076C49.4446 44.4058 50.1911 43.1108 50.1911 41.709V20.1833C50.1911 18.7815 49.4446 17.4864 48.2326 16.7847L29.6166 6.02266C28.4047 5.3209 26.91 5.3209 25.6981 6.02266L7.08208 16.7847C5.87013 17.4864 5.12366 18.7815 5.12366 20.1833Z"
                        fill="url(#paint3_linear_908_1223)"
                    />
                    <path
                        d="M6.31018 20.8698V41.0242C6.31018 42.426 7.05665 43.7211 8.2686 44.4228L25.6981 54.5C26.91 55.2018 28.4046 55.2018 29.6166 54.5L47.046 44.4228C48.258 43.7211 49.0045 42.426 49.0045 41.0242V20.8698C49.0045 19.468 48.258 18.173 47.046 17.4712L29.6166 7.394C28.4046 6.69224 26.91 6.69224 25.6981 7.394L8.2686 17.4712C7.05665 18.173 6.31018 19.468 6.31018 20.8698Z"
                        fill="url(#paint4_linear_908_1223)"
                    />
                    <path
                        d="M40.5282 44.1558C47.7361 36.9377 47.7361 25.2349 40.5282 18.0168C33.3204 10.7987 21.6341 10.7987 14.4262 18.0168C7.21837 25.2349 7.21837 36.9377 14.4262 44.1558C21.6341 51.3739 33.3204 51.3739 40.5282 44.1558Z"
                        fill="url(#paint5_radial_908_1223)"
                    />
                    <path
                        d="M24.344 26.6077H14.1355L27.4991 30.9572L24.344 26.6077Z"
                        fill="#C8C9C8"
                    />
                    <path
                        d="M27.4991 30.9572L35.7594 42.3412L32.6042 32.6166L27.4991 30.9572Z"
                        fill="#6E6E6E"
                    />
                    <path
                        d="M19.239 42.3412L27.4993 36.3305V30.9572L19.239 42.3412Z"
                        fill="#6E6E6E"
                    />
                    <path
                        d="M40.8645 26.6077H30.6543L27.4991 30.9572L40.8645 26.6077Z"
                        fill="#6E6E6E"
                    />
                    <path
                        d="M27.4991 36.3305L35.7594 42.3412L27.4991 30.9572V36.3305Z"
                        fill="#C8C9C8"
                    />
                    <path
                        d="M27.4993 30.9572L22.3958 32.6166L19.239 42.3412L27.4993 30.9572Z"
                        fill="#C8C9C8"
                    />
                    <path
                        d="M24.3441 26.6077L27.4993 30.9572V16.8848L24.3441 26.6077Z"
                        fill="#6E6E6E"
                    />
                    <path
                        d="M27.4991 16.8848V30.9572L30.6543 26.6077L27.4991 16.8848Z"
                        fill="#C8C9C8"
                    />
                    <path
                        d="M27.4991 30.9572L14.1355 26.6077L22.3957 32.6167L27.4991 30.9572Z"
                        fill="#6E6E6E"
                    />
                    <path
                        d="M27.4991 30.9572L32.6042 32.6167L40.8645 26.6077L27.4991 30.9572Z"
                        fill="#C8C9C8"
                    />
                    <path
                        d="M15.5084 16.5341C15.5107 15.3367 14.5433 14.3642 13.3477 14.3619C12.152 14.3596 11.1809 15.3284 11.1786 16.5257C11.1763 17.7231 12.1437 18.6956 13.3394 18.6979C14.535 18.7002 15.5061 17.7314 15.5084 16.5341Z"
                        fill="url(#paint6_radial_908_1223)"
                    />
                    <path
                        d="M13.3416 19.6358C13.3416 17.9203 11.9519 16.5287 10.2389 16.5287C11.9536 16.5287 13.3416 15.137 13.3416 13.4216C13.3416 15.137 14.7312 16.5287 16.4442 16.5287C14.7296 16.5287 13.3416 17.9203 13.3416 19.6358Z"
                        fill="white"
                    />
                    <path
                        d="M34.4387 53.2978C34.4404 52.4787 33.7787 51.8132 32.9607 51.8115C32.1427 51.8098 31.4782 52.4725 31.4765 53.2916C31.4748 54.1107 32.1365 54.7762 32.9545 54.7779C33.7725 54.7796 34.4369 54.1169 34.4387 53.2978Z"
                        fill="url(#paint7_radial_908_1223)"
                    />
                    <path
                        d="M32.958 55.4221C32.958 54.2474 32.0068 53.2948 30.8337 53.2948C32.0068 53.2948 32.958 52.3422 32.958 51.1675C32.958 52.3422 33.9093 53.2948 35.0823 53.2948C33.9093 53.2948 32.958 54.2474 32.958 55.4221Z"
                        fill="white"
                    />
                    <path
                        d="M43.0656 17.3239C44.739 17.3218 46.0939 15.9617 46.0919 14.2859C46.0898 12.6102 44.7317 11.2534 43.0583 11.2555C41.385 11.2576 40.0301 12.6177 40.0321 14.2935C40.0341 15.9692 41.3923 17.3259 43.0656 17.3239Z"
                        fill="url(#paint8_radial_908_1223)"
                    />
                    <path
                        d="M43.0634 18.6393C43.0634 16.2374 41.1185 14.2897 38.7183 14.2897C41.1185 14.2897 43.0634 12.3404 43.0634 9.93848C43.0634 12.3404 45.0082 14.2897 47.4084 14.2897C45.0082 14.2897 43.0634 16.2391 43.0634 18.641V18.6393Z"
                        fill="white"
                    />
                    <defs>
                        <linearGradient
                            id="paint0_linear_908_1223"
                            x1="51.1197"
                            y1="67.0046"
                            x2="39.3311"
                            y2="52.9771"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#8D8D8D" />
                            <stop
                                offset="1"
                                stop-color="#4C4C4C"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint1_linear_908_1223"
                            x1="3.88236"
                            y1="66.8342"
                            x2="15.6718"
                            y2="52.8052"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#8D8D8D" />
                            <stop
                                offset="1"
                                stop-color="#4C4C4C"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint2_linear_908_1223"
                            x1="27.6566"
                            y1="61.8939"
                            x2="27.6566"
                            y2="0.000116085"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#626262" />
                            <stop
                                offset="0.5"
                                stop-color="#8E8E8E"
                            />
                            <stop
                                offset="1"
                                stop-color="#C8C9C8"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint3_linear_908_1223"
                            x1="19.4081"
                            y1="53.6423"
                            x2="35.9462"
                            y2="8.26673"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#616161" />
                            <stop
                                offset="0.5"
                                stop-color="#9D9D9D"
                            />
                            <stop
                                offset="1"
                                stop-color="#575757"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint4_linear_908_1223"
                            x1="27.6565"
                            y1="55.0238"
                            x2="27.6565"
                            y2="6.86853"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#4F4F4F" />
                            <stop
                                offset="1"
                                stop-color="#6E6E6E"
                            />
                        </linearGradient>
                        <radialGradient
                            id="paint5_radial_908_1223"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(27.4784 31.0854) scale(18.4569 18.4831)"
                        >
                            <stop stop-color="#4E4E4E" />
                            <stop
                                offset="1"
                                stop-color="#6E6E6E"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint6_radial_908_1223"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(13.228 16.6249) scale(2.17085 2.17393)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#6E6E6E"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint7_radial_908_1223"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(32.9025 53.5159) scale(1.48744 1.48954)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#6E6E6E"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint8_radial_908_1223"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(43.0475 14.376) scale(3.04046 3.04477)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#6E6E6E"
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
                    class="relative z-10 grid h-[12rem] w-[16rem] rounded-lg bg-gradient-to-b from-white via-transparent to-transparent p-1 dark:from-[#2D3679]"
                >
                    {{-- Inner --}}
                    <div
                        class="grid h-[18rem] w-full place-items-center rounded bg-gradient-to-b from-blue-100/70 to-transparent pb-10 dark:from-[#121439]"
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
                    width="55"
                    height="71"
                    viewBox="0 0 55 71"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M43.5307 70.2963L46.4218 61.7889L55.0003 63.727L46.9381 49.649L35.4685 56.2166L43.5307 70.2963Z"
                        fill="url(#paint0_linear_908_1157)"
                    />
                    <path
                        d="M11.4695 70.0981L8.57677 61.5908L0 63.5289L8.0622 49.4492L19.5317 56.0185L11.4695 70.0981Z"
                        fill="url(#paint1_linear_908_1157)"
                    />
                    <path
                        d="M0.369141 17.4578V44.4424C0.369141 45.8422 1.11561 47.1354 2.32756 47.8362L25.6966 61.3285C26.9085 62.0293 28.4032 62.0293 29.6151 61.3285L52.9842 47.8362C54.1961 47.1354 54.9426 45.8422 54.9426 44.4424V17.4578C54.9426 16.058 54.1961 14.7648 52.9842 14.064L29.6168 0.571717C28.4049 -0.129049 26.9102 -0.129049 25.6983 0.571717L2.32926 14.064C1.1173 14.7648 0.370833 16.058 0.370833 17.4578H0.369141Z"
                        fill="url(#paint2_linear_908_1157)"
                    />
                    <path
                        d="M5.12378 20.2016V41.6968C5.12378 43.0966 5.87025 44.3898 7.0822 45.0906L25.6982 55.8374C26.9102 56.5382 28.4048 56.5382 29.6167 55.8374L48.2328 45.0906C49.4447 44.3898 50.1912 43.0966 50.1912 41.6968V20.2016C50.1912 18.8017 49.4447 17.5085 48.2328 16.8078L29.6167 6.06098C28.4048 5.36021 26.9102 5.36021 25.6982 6.06098L7.0822 16.8078C5.87025 17.5085 5.12378 18.8017 5.12378 20.2016Z"
                        fill="url(#paint3_linear_908_1157)"
                    />
                    <path
                        d="M6.31042 20.8872V41.0131C6.31042 42.4129 7.05689 43.7061 8.26885 44.4069L25.6983 54.4698C26.9102 55.1706 28.4049 55.1706 29.6168 54.4698L47.0463 44.4069C48.2582 43.7061 49.0047 42.4129 49.0047 41.0131V20.8872C49.0047 19.4874 48.2582 18.1942 47.0463 17.4934L29.6168 7.43048C28.4049 6.72972 26.9102 6.72972 25.6983 7.43048L8.26885 17.4934C7.05689 18.1942 6.31042 19.4874 6.31042 20.8872Z"
                        fill="url(#paint4_linear_908_1157)"
                    />
                    <path
                        d="M40.5282 44.1402C47.7361 36.9324 47.7361 25.2461 40.5282 18.0382C33.3204 10.8304 21.6341 10.8304 14.4262 18.0382C7.21838 25.2461 7.21838 36.9324 14.4262 44.1402C21.6341 51.3481 33.3204 51.3481 40.5282 44.1402Z"
                        fill="url(#paint5_radial_908_1157)"
                    />
                    <path
                        d="M24.344 26.6168H14.1355L27.4991 30.9602L24.344 26.6168Z"
                        fill="#E4C0A3"
                    />
                    <path
                        d="M27.4993 30.9602L35.7595 42.3282L32.6044 32.6173L27.4993 30.9602Z"
                        fill="#C68C65"
                    />
                    <path
                        d="M19.239 42.3282L27.4993 36.326V30.9602L19.239 42.3282Z"
                        fill="#C68C65"
                    />
                    <path
                        d="M40.8646 26.6168H30.6544L27.4993 30.9602L40.8646 26.6168Z"
                        fill="#C68C65"
                    />
                    <path
                        d="M27.4993 36.326L35.7595 42.3282L27.4993 30.9602V36.326Z"
                        fill="#E4C0A3"
                    />
                    <path
                        d="M27.4993 30.9602L22.3958 32.6173L19.239 42.3282L27.4993 30.9602Z"
                        fill="#E4C0A3"
                    />
                    <path
                        d="M24.3442 26.6168L27.4994 30.9602V16.9076L24.3442 26.6168Z"
                        fill="#C68C65"
                    />
                    <path
                        d="M27.4993 16.9076V30.9602L30.6544 26.6168L27.4993 16.9076Z"
                        fill="#E4C0A3"
                    />
                    <path
                        d="M27.4991 30.9602L14.1355 26.6168L22.3957 32.6173L27.4991 30.9602Z"
                        fill="#C68C65"
                    />
                    <path
                        d="M27.4993 30.9602L32.6044 32.6173L40.8646 26.6168L27.4993 30.9602Z"
                        fill="#E4C0A3"
                    />
                    <path
                        d="M15.5064 16.556C15.5084 15.3604 14.5409 14.3894 13.3452 14.3873C12.1496 14.3852 11.1786 15.3528 11.1765 16.5485C11.1744 17.7441 12.142 18.7151 13.3377 18.7172C14.5333 18.7192 15.5043 17.7517 15.5064 16.556Z"
                        fill="url(#paint6_radial_908_1157)"
                    />
                    <path
                        d="M13.3417 19.6549C13.3417 17.9419 11.952 16.5523 10.239 16.5523C11.9537 16.5523 13.3417 15.1626 13.3417 13.4496C13.3417 15.1626 14.7314 16.5523 16.4444 16.5523C14.7297 16.5523 13.3417 17.9419 13.3417 19.6549Z"
                        fill="white"
                    />
                    <path
                        d="M34.4404 53.271C34.4421 52.453 33.7804 51.7885 32.9624 51.7868C32.1444 51.7851 31.4799 52.4468 31.4782 53.2648C31.4765 54.0827 32.1382 54.7472 32.9562 54.749C33.7742 54.7507 34.4387 54.0889 34.4404 53.271Z"
                        fill="url(#paint7_radial_908_1157)"
                    />
                    <path
                        d="M32.958 55.3906C32.958 54.2176 32.0068 53.2663 30.8337 53.2663C32.0068 53.2663 32.958 52.315 32.958 51.142C32.958 52.315 33.9093 53.2663 35.0823 53.2663C33.9093 53.2663 32.958 54.2176 32.958 55.3906Z"
                        fill="white"
                    />
                    <path
                        d="M43.0657 17.3477C44.7391 17.3456 46.094 15.9875 46.0919 14.3141C46.0899 12.6407 44.7317 11.2859 43.0583 11.2879C41.385 11.29 40.0301 12.6482 40.0321 14.3215C40.0342 15.9949 41.3924 17.3497 43.0657 17.3477Z"
                        fill="url(#paint8_radial_908_1157)"
                    />
                    <path
                        d="M43.0634 18.6596C43.0634 16.261 41.1185 14.3162 38.7183 14.3162C41.1185 14.3162 43.0634 12.3696 43.0634 9.97107C43.0634 12.3696 45.0082 14.3162 47.4084 14.3162C45.0082 14.3162 43.0634 16.2627 43.0634 18.6612V18.6596Z"
                        fill="white"
                    />
                    <defs>
                        <linearGradient
                            id="paint0_linear_908_1157"
                            x1="51.125"
                            y1="66.9897"
                            x2="39.3559"
                            y2="52.9657"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#D9B395" />
                            <stop
                                offset="1"
                                stop-color="#743B23"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint1_linear_908_1157"
                            x1="3.87336"
                            y1="66.7852"
                            x2="15.6432"
                            y2="52.7596"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#D9B395" />
                            <stop
                                offset="1"
                                stop-color="#743B23"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint2_linear_908_1157"
                            x1="27.6567"
                            y1="61.8532"
                            x2="27.6567"
                            y2="0.0469899"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#AE704F" />
                            <stop
                                offset="0.5"
                                stop-color="#DCB698"
                            />
                            <stop
                                offset="1"
                                stop-color="#E4C0A3"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint3_linear_908_1157"
                            x1="19.4082"
                            y1="53.6132"
                            x2="35.905"
                            y2="8.28684"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#9D654B" />
                            <stop
                                offset="0.5"
                                stop-color="#E9C9BA"
                            />
                            <stop
                                offset="1"
                                stop-color="#8C5339"
                            />
                        </linearGradient>
                        <linearGradient
                            id="paint4_linear_908_1157"
                            x1="27.6567"
                            y1="54.9929"
                            x2="27.6567"
                            y2="6.90576"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#82452B" />
                            <stop
                                offset="1"
                                stop-color="#C2876A"
                            />
                        </linearGradient>
                        <radialGradient
                            id="paint5_radial_908_1157"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(27.4784 31.0884) scale(18.4569)"
                        >
                            <stop stop-color="#591F25" />
                            <stop
                                offset="1"
                                stop-color="#C2876A"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint6_radial_908_1157"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(13.4005 16.6448) scale(2.17085)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#C2876A"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint7_radial_908_1157"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(33.0835 53.488) scale(1.48744)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#C2876A"
                            />
                        </radialGradient>
                        <radialGradient
                            id="paint8_radial_908_1157"
                            cx="0"
                            cy="0"
                            r="1"
                            gradientUnits="userSpaceOnUse"
                            gradientTransform="translate(43.2231 14.4) scale(3.04046)"
                        >
                            <stop stop-color="white" />
                            <stop
                                offset="1"
                                stop-color="#C2876A"
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
</div>
