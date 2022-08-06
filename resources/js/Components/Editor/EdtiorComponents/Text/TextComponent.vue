<script setup>
import {computed, ref} from "vue";
import TextModal from "@/Components/Editor/EdtiorComponents/Text/TextModal.vue";

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
        <text-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                    :element-id="props.elementId"/>
        <div class="Block preview mobile last" :style="elemStyle">
            <p
                style="color: inherit !important"
                :style="{fontStyle: data.fontStyle, textAlign: data.textAlign, textDecoration: data.textDecoration, fontSize: data.fontSize}">
                {{ data.text }}
            </p>
        </div>
    </div>
</template>
