<script setup>
import SlideUpDown from 'vue3-slide-up-down'
import {ref} from "vue";

const props = defineProps({
    elemStyle: String,
    item: Object,
    isEditable: Boolean
})

let showAnswer = ref(false)

const handleClick = () => {
    if(!props.isEditable) {
        showAnswer.value = !showAnswer.value
    }
}
</script>

<template>
    <div class="Faq-item" style="pointer-events: all" :class="{show: showAnswer}" @click="handleClick">
        <div class="question">
            <div class="icon">
                <div class="line" :style="'background-'+elemStyle"></div>
                <div class="line" :style="'background-'+elemStyle"></div>
            </div>
            <span>{{ item.url }}</span></div>
        <slide-up-down v-model="showAnswer" :duration="200">
            <div class="Faq-answer">{{ item.caption }}</div>
        </slide-up-down>
    </div>
</template>
