<!-- Burger/Menu button -->
<button
    class="grid h-10 w-10 cursor-pointer place-items-center rounded-lg transition duration-300 hover:bg-white hover:shadow-lg hover:shadow-black/5 dark:hover:bg-slate-700/50 sm:hidden"
    aria-label="Open Menu"
    @click="openModal"
>
    <div class="i-ph-list text-3xl" />
</button>
<!-- Dialog -->
<TransitionRoot
    appear
    :show="isOpen"
    as="template"
>
    <dialog
        as="div"
        class="relative z-[100]"
        @close="closeModal"
    >
        <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-lg" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
            <div
                class="flex min-h-full items-center justify-center p-4 text-center"
            >
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0 scale-95"
                    enter-to="opacity-100 scale-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100 scale-100"
                    leave-to="opacity-0 scale-95"
                >
                    <DialogPanel
                        class="w-full max-w-xs transform overflow-hidden rounded-2xl bg-[#f2f3fb] px-6 py-5 text-left align-middle shadow-xl transition duration-300 dark:bg-[#04041F] dark:text-[#EAEFFB]"
                    >
                        <!-- Dialog title -->
                        <DialogTitle
                            class="flex items-center justify-between gap-2 text-left text-lg font-medium leading-6 text-gray-900 dark:text-inherit"
                        >
                            <!-- Menu title -->
                            <div class="">Menu</div>
                            <!-- Close button -->
                            <button
                                type="button"
                                class="inline-flex justify-center rounded-full border border-transparent bg-white/60 px-2 py-2 text-sm font-medium text-indigo-900 transition duration-300 hover:bg-white focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:bg-indigo-950/50 dark:text-indigo-300 dark:hover:bg-indigo-900/50"
                                @click="closeModal"
                            >
                                <div class="i-ph-x text-lg" />
                            </button>
                        </DialogTitle>
                        <div class="relative mt-5 space-y-4">
                            <!-- Suggest a new package -->
                            <a
                                href="https://github.com/HassanZahirnia/laravel-package-ocean/discussions/categories/package-suggestions"
                                target="_blank"
                                class="mr-1 block w-full select-none rounded-full bg-white/60 px-5 py-3 text-center text-sm font-medium text-indigo-900 ring-1 ring-slate-200/20 backdrop-blur-xl transition duration-300 hover:bg-white hover:text-slate-900 dark:bg-transparent dark:text-[#ABB0DD] dark:ring-[#627288]/40 dark:hover:bg-slate-900/50"
                            >
                                Suggest a new package
                            </a>
                            <!-- Icons -->
                            <div
                                class="relative flex items-center justify-center gap-5"
                            >
                                <!-- Github link -->
                                <a
                                    class="block select-none p-2 transition duration-300 hover:text-slate-600 dark:text-[#ABB0DD] dark:hover:text-[#bcc1ef]"
                                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                                    target="_blank"
                                    aria-label="Github"
                                >
                                    <div
                                        class="i-carbon-logo-github text-3xl"
                                    />
                                </a>
                                <!-- Theme toggle  -->
                                <ui-theme-toggle />
                            </div>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </div>
    </dialog>
</TransitionRoot>
