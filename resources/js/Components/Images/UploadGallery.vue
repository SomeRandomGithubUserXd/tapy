<script setup>
import {QuestionCircleOutlined, UploadOutlined} from "@ant-design/icons-vue";
import {createVNode, ref, watch} from "vue";
import {VueDraggableNext} from 'vue-draggable-next'
import UploadGalleryElement from "@/Components/Images/UploadGalleryElement.vue";
import {Modal} from "ant-design-vue";
import {toBase64} from "@/Helpers/FileHelper";

const props = defineProps({
    modelValue: {
        require: true,
        type: Array,
        default: []
    },
    removeText: String,
    okText: String,
    cancelText: String,
    error: {
        required: false,
        type: String,
        default: ''
    },
})

const emit = defineEmits(['update:modelValue'])

async function onFileUpload(event) {
    const arr = [...props.modelValue]
    const image = {
        file: await toBase64(event.target.files[0]),
        preview: window.URL.createObjectURL(event.target.files[0]),
    }
    if (image) {
        arr.push(image)
        emit('update:modelValue', arr)
    }
}

function removeElement(element) {
    Modal.confirm({
        title: props.removeText,
        icon: createVNode(QuestionCircleOutlined),
        okText: props.okText,
        cancelText: props.cancelText,
        onOk() {
            const arr = [...props.modelValue]
            arr.splice(arr.indexOf(element), 1)
            emit('update:modelValue', arr)
        },
        onCancel() {},
    });
}

function onOrderChange({moved}) {
    const arr = [...props.modelValue]
    // console.log(moved)
    arr.splice(moved.oldIndex, 1);
    arr.splice(moved.newIndex, 0, moved.element);
    emit('update:modelValue', arr)
}

</script>

<template>
    <div class="ant-col ant-form-item-control">
        <div class="ant-form-item-control-input">
            <div class="ant-form-item-control-input-content">
                <div class="ImagesInput md">
                    <div class="ImagesInput-previews">
                        <vue-draggable-next handle=".draggable" class="d-flex flex-row flex-wrap" :model-value="modelValue" @change="onOrderChange">
                            <transition-group>
                                <div v-for="(element, key) in modelValue"
                                     :key="key" role="button" tabindex="0" aria-roledescription="sortable"
                                     class="draggable"
                                     aria-describedby="DndDescribedBy-1"
                                     style="position: relative; transition: null 0s ease 0s, visibility 0s ease 0s; z-index: 1; opacity: 1;">
                                    <upload-gallery-element :element="element" @remove="removeElement"/>
                                </div>
                            </transition-group>
                            <div @click="$refs['input'].click()"
                                 :key="modelValue.length + 1"
                                 class="ant-upload ant-upload-select ant-upload-select-text non-draggable">
                                <div class="ant-upload" role="button">
                                    <input @change="onFileUpload" ref="input" type="file" style="display: none;">
                                    <div class="ImagesInput-upload">
                                        <UploadOutlined/>
                                    </div>
                                </div>
                            </div>
                        </vue-draggable-next>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="props.error" class="ant-form-item-explain ant-form-item-explain-error animate__animated"
             :class="props.error ? 'animate__fadeInDown' : 'animate__fadeInDown'">
            <div role="alert">{{ props.error }}</div>
        </div>
    </div>
</template>
