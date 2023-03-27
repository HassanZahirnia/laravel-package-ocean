<script setup lang="ts">
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'
import { find } from 'lodash'
import type { PackageSortFields } from '@/types/package'

const $props = defineProps<{
    sortField: PackageSortFields
}>()

const $emit = defineEmits<{
    (e: 'update:sort-field', field: PackageSortFields): void
}>()

type orderItem = {
    name: string
    value: PackageSortFields
}

const orderItems: orderItem[] = [
    { name: 'Newest', value: 'first_release_at' },
    { name: 'Recently Updated', value: 'latest_release_at' },
    { name: 'Most Stars', value: 'stars' },
]

const selectedItem = ref(find(orderItems, { value: $props.sortField }) as orderItem)

watch(selectedItem, (newItem, oldItem) => {
    if (newItem.value !== oldItem.value)
        $emit('update:sort-field', newItem.value)
})
</script>

<template>
    <Listbox v-model="selectedItem">
        <div class="relative z-10">
            <ListboxButton
                class="relative w-full cursor-default rounded-xl
                bg-white py-3 pl-3 pr-10 text-left
                text-sm
                shadow-[8.05051px_24.1515px_89.4501px_-11.6285px_rgba(22,52,80,0.05)] transition
                duration-300 placeholder:text-[#9095AE]
                focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2
                focus-visible:ring-white/75 focus-visible:ring-offset-2
                focus-visible:ring-offset-blue-300 dark:bg-[#362B59]/20
                "
                >
                <span class="block truncate">{{ selectedItem.name }}</span>
                <span
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
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
                    class="absolute mt-1 max-h-60 w-full overflow-auto
                    rounded-md bg-white py-1 text-base shadow-lg
                    ring-1 ring-black/5 focus:outline-none dark:bg-[#362B59]
                    sm:text-sm
                    "
                    >
                    <ListboxOption
                        v-for="item in orderItems"
                        v-slot="{ active, selected }"
                        :key="item.name"
                        :value="item"
                        as="template"
                        >
                        <li
                            :class="[
                                active ? 'bg-indigo-100 text-indigo-900 dark:bg-indigo-900 dark:text-indigo-100' : 'text-gray-900 dark:text-[#ABB0DD]',
                                'relative cursor-default select-none py-2 pl-10 pr-4',
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
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-indigo-600"
                                >
                                <div
                                    class="i-ph-check h-5 w-5"
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
