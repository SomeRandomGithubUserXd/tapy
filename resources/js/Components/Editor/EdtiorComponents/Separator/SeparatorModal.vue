<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import HTMLComponent from "@/Components/Editor/EdtiorComponents/HTML/HTMLComponent.vue";
import SeparatorComponent from "@/Components/Editor/EdtiorComponents/Separator/SeparatorComponent.vue";

const self = getCurrentInstance()

const props = defineProps({
    elementId: Number,
    modelValue: Boolean,
    data: Object,
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    mode: {
        required: false,
        default: 1,
        type: Number
    },
    pageUuid: {
        required: false,
        default: 0,
        type: String
    },
})

const emit = defineEmits(['update:modelValue', 'dataChanged'])

let editableData = ref(useForm(props.data))

function submit() {
    if(props.mode) {
        editableData.value.transform((data) => ({
            ...data,
            alias: 'html'
        })).post(route('page_elements.update_static', props.elementId), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    } else {
        editableData.value.transform((data) => ({
            ...data,
            props: data,
            alias: 'html'
        })).post(route('pages.page_elements.create', props.pageUuid), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    }
}
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
        >
        <template #title>
            {{ $root.translate('Custom html') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="0" :with-copy-action="true"/>
        </template>
        <div>
            <div class="EditBlockPreview" style="min-height: 200px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle">
                            <separator-component  ref="productsComponent" :mode="props.mode" :element-id="props.elementId" :theme="props.theme" :recursive="false"
                                                  :data="editableData"/>
                        </div>
                    </div>
                </div>
            </div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography"
                                         :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{ $root.translate('Settings') }}
                </span></template>
                    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
                        <div class="ant-col ant-form-item-label me-auto"><label for="params_heading"
                                                                                class="ant-form-item-required">{{
                                $root.translate('Type')
                            }}</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <a-radio-group v-model:value="editableData.type">
                                <a-radio :value="1">Option A</a-radio>
                                <a-radio :value="2">Option B</a-radio>
                                <a-radio :value="3">(empty)</a-radio>
                            </a-radio-group>
                        </div>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
