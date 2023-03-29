<script setup lang="ts">
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}
</script>

<template>
    <button
        class="grid sm:hidden place-items-center
        rounded-lg cursor-pointer
        w-10 h-10
        transition duration-300
        hover:bg-white
        dark:hover:bg-slate-700/50
        hover:shadow-lg hover:shadow-black/5
        "
        @click="openModal"
        >
        <div class="i-ph-list text-3xl" />
    </button>
    <TransitionRoot
        appear
        :show="isOpen"
        as="template"
        >
        <Dialog
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
                            class="w-full
                            px-6 py-5
                            max-w-xs
                            transform
                            overflow-hidden
                            rounded-2xl
                            text-left
                            align-middle
                            shadow-xl
                            transition duration-300
                            bg-[#f2f3fb]
                            dark:bg-[#04041F]
                            dark:text-[#EAEFFB]
                            "
                            >
                            <DialogTitle
                                class="text-lg
                                flex items-center gap-2 justify-between
                                font-medium
                                text-left
                                leading-6
                                text-gray-900
                                dark:text-inherit
                                "
                                >
                                <div class="">
                                    Menu
                                </div>
                                <button
                                    type="button"
                                    class="rounded-full
                                    transition duration-300
                                    px-2 py-2
                                    inline-flex justify-center
                                    border
                                    border-transparent
                                    text-sm
                                    font-medium
                                    text-indigo-900
                                    bg-white/60
                                    hover:bg-white
                                    dark:bg-indigo-950/50
                                    dark:hover:bg-indigo-900/50
                                    dark:text-indigo-300
                                    focus:outline-none
                                    focus-visible:ring-2
                                    focus-visible:ring-indigo-500
                                    focus-visible:ring-offset-2
                                    "
                                    @click="closeModal"
                                    >
                                    <div class="i-ph-x text-lg" />
                                </button>
                            </DialogTitle>
                            <div
                                class="mt-5 relative
                                space-y-4
                                "
                                >
                                <!-- Suggest a new package -->
                                <a
                                    href="https://github.com/HassanZahirnia/laravel-package-ocean"
                                    target="_blank"
                                    class="mr-1 block w-full text-center
                                    select-none rounded-full
                                    backdrop-blur-xl
                                    transition duration-300
                                    px-5 py-3
                                    text-sm
                                    font-medium
                                    bg-white/60 dark:bg-transparent
                                    hover:bg-white
                                    dark:hover:bg-slate-900/50
                                    text-indigo-900
                                    hover:text-slate-900
                                    dark:text-[#ABB0DD]
                                    ring-1 ring-slate-200/20
                                    dark:ring-[#627288]/40
                                    "
                                    >
                                    Suggest a new package
                                </a>
                                <div
                                    class="relative
                                    flex gap-5 items-center justify-center
                                    "
                                    >
                                    <!-- Github link -->
                                    <a
                                        class="select-none block
                                        p-2
                                        transition duration-300
                                        hover:text-slate-600
                                        dark:text-[#ABB0DD]
                                        dark:hover:text-[#bcc1ef]
                                        "
                                        href="https://github.com/HassanZahirnia/laravel-package-ocean"
                                        target="_blank"
                                        aria-label="Github"
                                        >
                                        <div class="i-carbon-logo-github text-3xl" />
                                    </a>
                                    <!-- Theme toggle  -->
                                    <ui-theme-toggle />
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
