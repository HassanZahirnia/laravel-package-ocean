<script setup lang="ts">
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import { find } from 'lodash'
import type { selectboxItem } from '@/types/selectbox'

const $props = defineProps<{
    items: selectboxItem<unknown>[]
    modelValue: selectboxItem<unknown>['value']
}>()

const $emit = defineEmits<{
    (e: 'update:modelValue', value: selectboxItem<unknown>['value']): void
}>()

const selectedItem = computed({
    get() {
        return find($props.items, { value: $props.modelValue }) as selectboxItem<unknown>
    },
    set(newItem) {
        $emit('update:modelValue', newItem.value)
    },
})
</script>

<template>
    <Listbox v-model="selectedItem">
        <div class="relative z-10">
            <ListboxButton
                class="relative cursor-pointer rounded-xl
                transition duration-300
                py-3 pl-3 pr-10
                w-full
                text-left
                text-sm
                bg-white/50
                hover:bg-white/80
                dark:bg-[#362B59]/20
                dark:hover:bg-[#362B59]/40
                 placeholder:text-[#9095AE]
                focus:outline-none
                focus-visible:border-indigo-500
                focus-visible:ring-2
                focus-visible:ring-white/75
                focus-visible:ring-offset-2
                focus-visible:ring-offset-blue-300
                shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] 
                "
                >
                <span class="block truncate">{{ selectedItem.name }}</span>
                <span
                    class="pointer-events-none
                    pr-3
                    flex items-center
                    absolute
                    inset-y-0 right-0
                    "
                    >
                    <div
                        class="i-ph-caret-down h-5 w-5 text-gray-400"
                        aria-hidden="true"
                        />
                </span>
            </ListboxButton>

            <transition
                enter-active-class="duration-150 ease-out"
                enter-from-class="-translate-y-1 opacity-0"
                enter-to-class="translate-y-0 rotate-0 opacity-100"
                leave-active-class="duration-150 ease-in"
                leave-from-class="translate-y-0 rotate-0 opacity-100"
                leave-to-class="-translate-y-1 opacity-0"
                >
                <ListboxOptions
                    class="overflow-auto rounded-md focus:outline-none
                    max-h-60 w-full
                    mt-1
                    absolute
                    text-base sm:text-sm
                    bg-white 
                    dark:bg-[#362B59]
                    shadow-lg
                    ring-1 ring-black/5
                    "
                    >
                    <ListboxOption
                        v-for="item in items"
                        v-slot="{ selected }"
                        :key="item.name"
                        :value="item"
                        as="template"
                        >
                        <li
                            class="group cursor-pointer
                            relative select-none
                            py-2.5 pl-9 pr-4
                            first:pt-3
                            last:pb-3
                            transition duration-200
                            "
                            :class="[
                                selected ?
                                    'bg-indigo-100 text-indigo-900 dark:bg-indigo-900 dark:text-indigo-100'
                                    : 'text-gray-900 dark:text-[#ABB0DD]',
                            ]"
                            >
                            <div
                                class="pl-1
                                transition duration-300
                                group-hover:translate-x-1
                                "
                                >
                                <div
                                    :class="[
                                        selected ? 'font-medium' : 'font-normal',
                                        'block truncate',
                                    ]"
                                    >
                                    {{ item.name }}
                                </div>
                                <div
                                    v-if="item.detail"
                                    class="text-xs truncate opacity-60"
                                    >
                                    {{ item.detail }}
                                </div>
                            </div>
                            <span
                                v-if="selected"
                                class="pl-2.5
                                flex items-center
                                transition duration-200
                                text-indigo-600
                                absolute inset-y-0 left-0
                                "
                                >
                                <div
                                    class="i-ph-check-bold h-5 w-5"
                                    aria-hidden="true"
                                    />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>
