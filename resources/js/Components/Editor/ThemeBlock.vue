<script setup>
const props = defineProps({
    theme: Object,
    isPro: {
        required: false,
        type: Boolean,
        default: false
    },
})
</script>

<template>
    <div class="ThemePicker-theme relative" :style="props.theme.containerStyle">
        <span v-if="isPro" class="ant-tag ant-tag-has-color absolute top-2 right-2 z-10 m-0" style="background-color: rgb(0, 0, 0);z-index: 99">PRO</span>
        <div class="ThemePicker-theme-wrapper" :style="props.theme.blockStyle">
            <div class="ThemePicker-theme-button" v-for="key in 2" :style="props.theme.elementStyle"></div>
        </div>
    </div>
</template>
