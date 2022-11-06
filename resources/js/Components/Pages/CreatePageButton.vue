<script setup>
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {createVNode, getCurrentInstance, ref} from "vue";
import {Modal} from "ant-design-vue";

const emit = defineEmits(['createPage'])

const props = defineProps({
    withConfirmation: {
        type: Boolean,
        required: false,
        default: false
    },
    createText: {
        type: String,
        required: false,
        default: 'Create?'
    },
    okText: {
        type: String,
        required: false,
        default: 'Ok'
    },
    cancelText: {
        type: String,
        required: false,
        default: 'Cancel'
    },
})

function btnClick() {
    if (props.withConfirmation) {
        const app = getCurrentInstance()
        Modal.confirm({
            title: props.createText,
            icon: createVNode(QuestionCircleOutlined),
            okText: props.okText,
            cancelText: props.cancelText,
            onOk() {
                emit('createPage')
            },
            onCancel() {},
        });
    } else {
        emit('createPage')
    }
}
</script>

<template>
    <button type="button" @click="btnClick"
            class="d-flex align-items-center ant-btn ant-btn-primary">
        <plus-outlined/>
        <span>{{ $root.translate('Create page') }}</span>
    </button>
</template>
