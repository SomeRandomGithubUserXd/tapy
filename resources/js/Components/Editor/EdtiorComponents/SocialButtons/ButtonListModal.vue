<script setup>
import {socialButtons} from "@/Helpers/EditorHelper";
import {groupBy} from "underscore";
import SocialButtonModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonModal.vue";
import {ref, watch} from "vue";

const props = defineProps({
    modelValue: Boolean,
    elementId: Number
})
const emit = defineEmits(['update:modelValue', 'dataChanged'])

const currentButton = ref(null)

const showSocialButtonModal = ref(false)

const addBtn = (btn) => {
    const setCurrentButton = new Promise((resolve, reject) => {
        currentButton.value = btn
        resolve(btn)
    })
    setCurrentButton.then(() => {
        showSocialButtonModal.value = true
    })
}

const newBtn = ref({
    alias: '',
    value: '',
    btn_text: '',
    btn_caption: '',
})

watch(newBtn, (val) => {
    showSocialButtonModal.value = false
    emit('dataChanged', val)
}, {deep: true})
</script>

<template>
    <a-modal
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Select button') }}
        </template>
        <div v-for="(data, groupName) in groupBy(socialButtons, 'group')"
             class="ant-row ant-row-stretch SocialNetworkSelectModal-networks"
             style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
            <div class="ant-col ant-col-24 SocialNetworkSelectModal-category"
                 style="padding-left: 8px; padding-right: 8px;">{{ groupName }}
            </div>
            <div @click="addBtn(btn)" v-for="btn in data" class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="SocialNetworkButton" :style="{backgroundColor: btn.bgColor, color: btn.color}"><i
                    class="Icon" :class="btn.icon" style="font-size: 24px;"></i>
                    <div class="SocialNetworkButton-label">{{ btn.label }}</div>
                </div>
            </div>
        </div>
        <social-button-modal :element-id="elementId" :misc="currentButton" v-model="showSocialButtonModal" v-model:content="newBtn" :mode="1"/>
    </a-modal>
</template>
