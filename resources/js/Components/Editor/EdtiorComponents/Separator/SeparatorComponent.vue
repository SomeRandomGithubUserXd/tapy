<script setup>
import {computed, ref} from "vue";
import HTMLModal from "@/Components/Editor/EdtiorComponents/HTML/HTMLModal.vue";
import SeparatorModal from "@/Components/Editor/EdtiorComponents/Separator/SeparatorModal.vue";
import SeparatorOne from "@/Components/Editor/EdtiorComponents/Separator/SeparatorOne.vue";
import SeparatorTwo from "@/Components/Editor/EdtiorComponents/Separator/SeparatorTwo.vue";
import SeparatorThree from "@/Components/Editor/EdtiorComponents/Separator/SeparatorThree.vue";

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
    set() {
    }
})

let showEditModal = ref(false)

const getSeparator = computed({
    get() {
        let separator = null;
        switch (props.data.type) {
            case 1:
                separator = SeparatorOne
                break;
            case 2:
                separator = SeparatorTwo
                break;
            case 3:
                separator = SeparatorThree
                break;
        }
        return separator
    },
    set() {

    }
})
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <separator-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                         :element-id="props.elementId"/>
        <div class="Block mobile last" :style="elemStyle" :class="isEditable ? 'preview' : ''">
            <component :fw="props.data.fw" :smooth="props.data.smooth" :is="getSeparator"/>
        </div>
    </div>
</template>
