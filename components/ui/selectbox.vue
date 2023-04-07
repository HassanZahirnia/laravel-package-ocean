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
                class="relative cursor-default rounded-xl
                transition duration-300
                py-3 pl-3 pr-10
                w-full
                text-left
                text-sm
                bg-white
                dark:bg-[#362B59]/20
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
                    pr-2
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
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
                >
                <ListboxOptions
                    class="overflow-auto rounded-md focus:outline-none
                    max-h-60 w-full
                    py-1
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
                        v-slot="{ active, selected }"
                        :key="item.name"
                        :value="item"
                        as="template"
                        >
                        <li
                            :class="[
                                active ? 'bg-indigo-100 text-indigo-900 dark:bg-indigo-900 dark:text-indigo-100' : 'text-gray-900 dark:text-[#ABB0DD]',
                                'relative cursor-default select-none py-2 pl-9 pr-4',
                            ]"
                            >
                            <span
                                :class="[
                                    selected ? 'font-medium' : 'font-normal',
                                    'block truncate',
                                ]"
                                >{{ item.name }}</span>
                            <span
                                v-if="selected"
                                class="pl-2
                                flex items-center
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
