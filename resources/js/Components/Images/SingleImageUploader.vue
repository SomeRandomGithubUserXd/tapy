<script setup>
import VueCropper from "vue-cropperjs"
import 'cropperjs/dist/cropper.css';
import {computed, createVNode, getCurrentInstance, ref} from "vue";
import {message, Modal} from "ant-design-vue";
import {Inertia} from "@inertiajs/inertia";
import {QuestionCircleOutlined} from "@ant-design/icons-vue";


const self = getCurrentInstance()

const emit = defineEmits(['onUpload', 'onRemove'])

const props = defineProps({
    modelValue: null,
    src: {
        required: false,
        type: String,
        default: ''
    },
    roundedPreview: {
        required: false,
        type: Boolean,
        default: false
    },
})

let faviconFile = ref()
let showFaviconModal = ref(false)
let favInput = ref(null)
let favCropper = ref(null)
let favPreview = ref('')

const getFaviconPreview = computed({
    get() {
        if (faviconFile.value) {
            return window.URL.createObjectURL(faviconFile.value)
        }
        if (props.src) {
            return props.src
        }
    },
    set() {
    }
})

function openFaviconModal(event) {
    const preview = window.URL.createObjectURL(event.target.files[0])
    favPreview.value = preview
    favInput.value.value = ''
    showFaviconModal.value = true
    try {
        favCropper.value.replace(preview)
    } catch (exc) {
        // console.log(exc)
    }
}

function removeFavicon() {
    Modal.confirm({
        title: self.parent.ctx.translate('Are you sure?'),
        icon: createVNode(QuestionCircleOutlined),
        okText: self.parent.ctx.translate('Yes'),
        cancelText: self.parent.ctx.translate('Cancel'),
        onOk() {
            faviconFile.value = null
            emit('onRemove')
        },
        onCancel() {
        },
    });
}

function setFavicon() {
    const dataURI = favCropper.value.getCroppedCanvas().toDataURL('image/jpeg')
    let byteString = atob(dataURI.split(',')[1]);
    let mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    let ab = new ArrayBuffer(byteString.length);
    let ia = new Uint8Array(ab);
    for (let i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    faviconFile.value = new Blob([ab], {type: mimeString})
    showFaviconModal.value = false
    emit('onUpload', faviconFile.value)
}

</script>

<template>
    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0;">
        <div class="ant-col ant-form-item-label me-auto" v-if="!!$slots['label']">
            <slot name="label"/>
        </div>
        <div class="ant-col ant-form-item-control">
            <div class="ant-form-item-control-input">
                <div class="ant-form-item-control-input-content">
                    <div class="ImageInput">
                        <div class="ImageInput-preview">
                            <img alt="" v-if="faviconFile?.size || props.src" width="60"
                                 :style="props.roundedPreview ? 'border-radius: 50%' : ''"
                                 height="60"
                                 :src="getFaviconPreview"/>
                            <div v-else class="ImageInput-preview-empty"
                                 :style="props.roundedPreview ? 'border-radius: 50%' : ''"
                                 style="width: 60px; height: 60px; border-radius: 3px;">
                                            <span role="img"
                                                  aria-label="camera"
                                                  class="anticon anticon-camera"><svg
                                                viewBox="64 64 896 896" focusable="false" data-icon="camera" width="1em"
                                                height="1em" fill="currentColor" aria-hidden="true"><path
                                                d="M864 248H728l-32.4-90.8a32.07 32.07 0 00-30.2-21.2H358.6c-13.5 0-25.6 8.5-30.1 21.2L296 248H160c-44.2 0-80 35.8-80 80v456c0 44.2 35.8 80 80 80h704c44.2 0 80-35.8 80-80V328c0-44.2-35.8-80-80-80zm8 536c0 4.4-3.6 8-8 8H160c-4.4 0-8-3.6-8-8V328c0-4.4 3.6-8 8-8h186.7l17.1-47.8 22.9-64.2h250.5l22.9 64.2 17.1 47.8H864c4.4 0 8 3.6 8 8v456zM512 384c-88.4 0-160 71.6-160 160s71.6 160 160 160 160-71.6 160-160-71.6-160-160-160zm0 256c-53 0-96-43-96-96s43-96 96-96 96 43 96 96-43 96-96 96z"></path></svg></span>
                            </div>
                        </div>
                        <div
                            class="ant-space ant-space-horizontal ant-space-align-center"
                            style="gap: 8px;">
                            <div @click="$refs['favInput'].click()" class="ant-space-item"><span
                                class=""><div
                                class="ant-upload ant-upload-select ant-upload-select-text"><span
                                tabindex="0" class="ant-upload" role="button"><input ref="favInput"
                                                                                     type="file"
                                                                                     @change="openFaviconModal"
                                                                                     style="display: none;"><button
                                type="button"
                                :class="faviconFile?.size || props.src ? 'ant-btn-default' : 'ant-btn-primary'"
                                class="ant-btn d-flex align-items-center"><span role="img"
                                                                                aria-label="upload"
                                                                                class="anticon anticon-upload"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="upload" width="1em"
                                height="1em" fill="currentColor" aria-hidden="true"><path
                                d="M400 317.7h73.9V656c0 4.4 3.6 8 8 8h60c4.4 0 8-3.6 8-8V317.7H624c6.7 0 10.4-7.7 6.3-12.9L518.3 163a8 8 0 00-12.6 0l-112 141.7c-4.1 5.3-.4 13 6.3 13zM878 626h-60c-4.4 0-8 3.6-8 8v154H214V634c0-4.4-3.6-8-8-8h-60c-4.4 0-8 3.6-8 8v198c0 17.7 14.3 32 32 32h684c17.7 0 32-14.3 32-32V634c0-4.4-3.6-8-8-8z"></path></svg></span><span>{{
                                    faviconFile?.size || props.src ? $root.translate('Change') : $root.translate('Upload')
                                }}</span></button></span></div><div
                                class="ant-upload-list ant-upload-list-text"></div></span></div>
                            <div v-if="faviconFile?.size || props.src"
                                 @click="removeFavicon" class="ant-space-item">
                                <button type="button" class="ant-btn ant-btn-icon-only ant-btn-dangerous">
                                                <span role="img" aria-label="delete" class="anticon anticon-delete"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="delete"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a-modal
        :cancel-text="$root.translate('Cancel')"
            class="animate__animated tabs-modal"
            :class="showFaviconModal ? 'animate__zoomIn' : 'animate__zoomOut'"
            :ok-text="$root.translate('OK')"
            v-model:visible="showFaviconModal"
            @ok="setFavicon"
            >
            <template #title>
                {{ $root.translate('Select area') }}
            </template>
            <vue-cropper
                ref="favCropper"
                :src="favPreview"
                alt="Source Image">
            </vue-cropper>
        </a-modal>
    </div>
</template>
