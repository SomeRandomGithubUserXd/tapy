<script setup>
const props = defineProps({
    theme: Object,
})
</script>

<template>
    <div class="ThemePicker-theme" :style="props.theme.containerStyle">
        <div class="ThemePicker-theme-wrapper" :style="props.theme.blockStyle">
            <div class="ThemePicker-theme-button" v-for="key in 2" :style="props.theme.elementStyle"></div>
        </div>
    </div>
</template>
