<script setup>
const props = defineProps({
    smooth: {
        required: false,
        type: Boolean,
        default: false
    },
    fw: {
        required: false,
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <div class="Separator" :class="props.fw ? 'full' : ''">
        <div class="left" :style="props.smooth ? 'background: linear-gradient(to left, rgb(68, 69, 74) 0%, transparent 100%);' : 'background: rgb(68, 69, 74);'"></div>
        <div class="center dots" style="border-color: rgb(68, 69, 74);"></div>
        <div class="right" :style="props.smooth ? 'background: linear-gradient(to right, rgb(68, 69, 74) 0%, transparent 100%);' : 'background: rgb(68, 69, 74);'"></div>
    </div>
</template>
