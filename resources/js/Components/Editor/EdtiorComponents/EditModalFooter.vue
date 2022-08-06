<script setup>
import {Inertia} from "@inertiajs/inertia";
import {createVNode, getCurrentInstance, ref} from "vue";
import {Modal} from "ant-design-vue";
import {QuestionCircleOutlined} from "@ant-design/icons-vue";
import CopyModal from "@/Components/Editor/CopyModal.vue";

const props = defineProps({
    elementId: [Number, String],
    mode: {
        required: false,
        default: 0,
        type: Number
    },
    withCopyAction: {
        required: false,
        default: false,
        type: Boolean
    },
})

const emit = defineEmits(['onOK', 'needsClosing'])

const copyElement = () => {
    showCopyModal.value = true
    // Inertia.post(route())
}

const self = getCurrentInstance()

const deleteElement = () => {
    Modal.confirm({
        title: self.parent.ctx.translate('Are you sure?'),
        icon: createVNode(QuestionCircleOutlined),
        okText: self.parent.ctx.translate('Yes'),
        cancelText: self.parent.ctx.translate('Cancel'),
        onOk() {
            Inertia.delete(route('page_elements.destroy', props.elementId), {
                onSuccess: () => {
                    emit('needsClosing')
                }
            })
        },
        onCancel() {
        },
    })
}

let showCopyModal = ref(false)
</script>

<template>
    <div class="d-flex">
        <copy-modal :element-id="elementId" v-model="showCopyModal" @closeItself="emit('needsClosing')"/>
        <a-dropdown v-if="mode" placement="topLeft" class="me-auto" :trigger="['click']">
            <a class="ant-dropdown-link" @click.prevent>
                <div class="ant-col">
                    <button type="button" class="ant-btn ant-dropdown-trigger d-flex align-items-center"
                            ant-click-animating-without-extra-node="false"><span role="img" aria-label="more"
                                                                                 class="anticon anticon-more"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="more" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M456 231a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0z"></path></svg></span><span>{{
                            $root.translate('Actions')
                        }}</span>
                    </button>
                </div>
            </a>
            <template #overlay>
                <a-menu>
                    <a-menu-item v-if="props.withCopyAction" class="ant-dropdown-menu-item"
                                 @click="copyElement">
                        <div class="d-flex align-items-center">
                            <span role="img" aria-label="copy" class="anticon anticon-copy ant-dropdown-menu-item-icon"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true"><path
                                d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span>
                            <span class="ant-dropdown-menu-title-content">{{ $root.translate('Copy') }}</span>
                        </div>
                    </a-menu-item>
                    <a-menu-item class="ant-dropdown-menu-item ant-dropdown-menu-item-danger"
                                 @click="deleteElement">
                        <div class="d-flex align-items-center">
                                  <span role="img"
                                        aria-label="delete"
                                        class="anticon anticon-delete ant-dropdown-menu-item-icon"><svg
                                      viewBox="64 64 896 896" focusable="false" data-icon="delete" width="1em"
                                      height="1em" fill="currentColor" aria-hidden="true"><path
                                      d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span><span
                            class="ant-dropdown-menu-title-content">{{ $root.translate('Delete') }}</span>
                        </div>
                    </a-menu-item>
                </a-menu>
            </template>
        </a-dropdown>
        <a-button key="submit" class="ms-auto" type="primary" @click="emit('onOK')">
            {{
                mode ? $root.translate('Save') : $root.translate('Add')
            }}
        </a-button>
    </div>
</template>
