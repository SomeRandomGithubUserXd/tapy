<script setup>
import {computed, ref} from "vue";
import HTMLModal from "@/Components/Editor/EdtiorComponents/HTML/HTMLModal.vue";

const props = defineProps({
    isEditable: {
        required: false,
        default: true,
        type: Boolean,
    },
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    data: Object,
    elementId: Number,
    recursive: {
        required: false,
        type: Boolean,
        default: true
    }
})

function tryEditModal() {
    if (props.recursive) {
        showEditModal.value = true
    }
}

const elemStyle = computed({
    get() {
        let style = props.theme.blockStyle
        let styleArr = style.split(';')
        let res = styleArr.filter(function (value) {
            return value.includes('color');
        });
        style = res.join(';');
        return style
    },
    set(){}
})

let showEditModal = ref(false)
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <h-t-m-l-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                    :element-id="props.elementId"/>
        <div class="Block mobile last" :style="elemStyle" :class="isEditable ? 'preview' : ''">
            <div v-html="props.data.html"></div>
        </div>
    </div>
</template>
