<script setup lang="ts">
import tippy from 'tippy.js'
import 'tippy.js/dist/tippy.css'
import 'tippy.js/animations/shift-away.css'

interface Props {
    content: string
    placement?: 'top' | 'bottom' | 'left' | 'right'
    theme?: 'indigo' | 'blue' | 'rose' | 'cyan' | 'amber' | 'yellow' | 'pink'
    size?: 'small' | 'medium'
    condition?: boolean
}

const $props = withDefaults(defineProps<Props>(), {
    placement: 'bottom',
    theme: 'indigo',
    size: 'medium',
    condition: true,
})

const tooltip = ref()
const tooltipInstance = ref()

onMounted(()=>{
    nextTick(() => {
        if(tooltip.value && $props.condition){
            tooltipInstance.value = tippy(tooltip.value, {
                content: $props.content,
                theme: $props.theme,
                placement: $props.placement,
                animation: 'shift-away',
                touch: 'hold',
            })
        }
    })
})
watch(() => $props.content, () => {
    if(tooltipInstance.value)
        tooltipInstance.value.setContent($props.content)
    
})
</script>

<template>
    <div ref="tooltip">
        <slot />
    </div>
</template>

<style lang="stylus">
.tippy-box[data-theme~='indigo']
    @apply bg-slate-800 rounded-full py-1 px-2 shadow-lg shadow-black/5 text-xs font-poppins;
.tippy-box[data-theme~='indigo'][data-placement^='top'] > .tippy-arrow::before
    @apply border-t-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='bottom'] > .tippy-arrow::before
    @apply border-b-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='left'] > .tippy-arrow::before
    @apply border-l-slate-800;
.tippy-box[data-theme~='indigo'][data-placement^='right'] > .tippy-arrow::before
    @apply border-r-slate-800;
</style>