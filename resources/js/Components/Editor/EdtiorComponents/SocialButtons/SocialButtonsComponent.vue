<script setup>
import {computed, ref} from "vue";
import SocialButton from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButton.vue";
import SocialButtonsModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsModal.vue";

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
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <social-buttons-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                              :element-id="props.elementId"/>
        <div class="Block mobile last" :class="{preview: props.isEditable}">
            <div class="social-btns" :class="props.data.view">
                <social-button v-for="btn in props.data.buttons" :alias="btn.alias" :value="btn.value"
                               :btn-text="btn.btn_text" :btn-caption="btn.btn_caption" :btn-extra="btn.btn_extra" :view="props.data.view"/>
            </div>
        </div>
    </div>
</template>
