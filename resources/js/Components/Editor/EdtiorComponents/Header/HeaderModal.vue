<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";

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
            alias: 'header'
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
            alias: 'header'
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
            {{ $root.translate('Header') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography"
                                         :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{ $root.translate('Settings') }}
                </span></template>
                    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
                        <div class="ant-col ant-form-item-label me-auto"><label for="params_heading"
                                                                                class="ant-form-item-required"
                                                                                title="Заголовок">{{ $root.translate('Header') }}</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">   <textarea
                                    :placeholder="$root.translate('Enter header here')" rows="4"
                                    id="params_heading"
                                    class="ant-input"
                                    style="font-weight: bold"
                                    :style="{fontStyle: editableData.fontStyle, textAlign: editableData.textAlign, textDecoration: editableData.textDecoration, fontSize: editableData.fontSize}"
                                    v-model="editableData.text"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item" style="row-gap: 0px;">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <div class="ant-space ant-space-horizontal ant-space-align-center"
                                         style="flex-wrap: wrap; gap: 8px;">
                                        <div class="ant-space-item" style="">
                                            <a-radio-group size="small" v-model:value="editableData.textAlign"
                                                           class="my-3">
                                                <a-radio-button value="left"><span role="img" aria-label="align-left"
                                                                                   class="anticon anticon-align-left"><svg
                                                    style="margin-top: -6px" viewBox="64 64 896 896" focusable="false"
                                                    data-icon="align-left"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M120 230h496c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8zm0 424h496c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8zm784 140H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0-424H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                </a-radio-button>
                                                <a-radio-button value="center"><span role="img"
                                                                                     aria-label="align-center"
                                                                                     class="anticon anticon-align-center"><svg
                                                    style="margin-top: -6px" viewBox="64 64 896 896" focusable="false"
                                                    data-icon="align-center"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M264 230h496c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H264c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8zm496 424c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H264c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496zm144 140H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0-424H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                </a-radio-button>
                                                <a-radio-button value="right"><span role="img" aria-label="align-right"
                                                                                    class="anticon anticon-align-right"><svg
                                                    style="margin-top: -6px" viewBox="64 64 896 896" focusable="false"
                                                    data-icon="align-right"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M904 158H408c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0 424H408c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0 212H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0-424H120c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                </a-radio-button>
                                                <a-radio-button value="justify"><span role="img" aria-label="menu"
                                                                                      class="anticon anticon-menu"><svg
                                                    style="margin-top: -6px" viewBox="64 64 896 896" focusable="false"
                                                    data-icon="menu"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M904 160H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0 624H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0-312H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                </a-radio-button>
                                            </a-radio-group>
                                        </div>
                                        <div class="ant-space-item" style="">
                                            <div class="ant-space ant-space-horizontal ant-space-align-center"
                                                 style="gap: 8px;">
                                                <div class="ant-space-item" style="">
                                                    <a-radio-group size="small" v-model:value="editableData.fontStyle">
                                                        <a-radio-button value="italic"
                                                                        @click="editableData.fontStyle === 'italic' ? editableData.fontStyle = 'normal' : null">
                                                            <span
                                                                role="img" aria-label="italic"
                                                                class="anticon anticon-italic"><svg
                                                                style="margin-top: -6px" viewBox="64 64 896 896"
                                                                focusable="false"
                                                                data-icon="italic"
                                                                width="1em" height="1em"
                                                                fill="currentColor"
                                                                aria-hidden="true"><path
                                                                d="M798 160H366c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h181.2l-156 544H229c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h432c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8H474.4l156-544H798c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                        </a-radio-button>
                                                    </a-radio-group>
                                                </div>
                                                <div class="ant-space-item">
                                                    <a-radio-group size="small"
                                                                   v-model:value="editableData.textDecoration">
                                                        <a-radio-button value="underline"
                                                                        @click="editableData.textDecoration === 'underline' ? editableData.textDecoration = 'none' : null">
                                                            <span role="img" aria-label="underline"
                                                                  class="anticon anticon-underline"><svg
                                                                style="margin-top: -6px"
                                                                viewBox="64 64 896 896" focusable="false"
                                                                data-icon="underline" width="1em" height="1em"
                                                                fill="currentColor" aria-hidden="true"><path
                                                                d="M824 804H200c-4.4 0-8 3.4-8 7.6v60.8c0 4.2 3.6 7.6 8 7.6h624c4.4 0 8-3.4 8-7.6v-60.8c0-4.2-3.6-7.6-8-7.6zm-312-76c69.4 0 134.6-27.1 183.8-76.2C745 602.7 772 537.4 772 468V156c0-6.6-5.4-12-12-12h-60c-6.6 0-12 5.4-12 12v312c0 97-79 176-176 176s-176-79-176-176V156c0-6.6-5.4-12-12-12h-60c-6.6 0-12 5.4-12 12v312c0 69.4 27.1 134.6 76.2 183.8C377.3 701 442.6 728 512 728z"></path></svg></span>
                                                        </a-radio-button>
                                                    </a-radio-group>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
                        <div class="ant-col ant-form-item-label me-auto"><label for="params_size" class=""
                                                                                title="Font size">{{
                                $root.translate('Font size')
                            }}</label></div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <a-radio-group size="default" v-model:value="editableData.fontSize">
                                        <a-radio-button value="17px">
                                            <span role="img"
                                       aria-label="font-size"
                                       class="anticon anticon-font-size"
                                       style="font-size: 12px;"><svg style="margin-top:-6px"
                                                                     viewBox="64 64 896 896" focusable="false"
                                                                     data-icon="font-size" width="1em"
                                                                     height="1em" fill="currentColor"
                                                                     aria-hidden="true"><path
                                     d="M920 416H616c-4.4 0-8 3.6-8 8v112c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-56h60v320h-46c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h164c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8h-46V480h60v56c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V424c0-4.4-3.6-8-8-8zM656 296V168c0-4.4-3.6-8-8-8H104c-4.4 0-8 3.6-8 8v128c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-64h168v560h-92c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h264c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8h-92V232h168v64c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8z"></path></svg></span>
                                        </a-radio-button>
                                        <a-radio-button value="20px">
                                            <span role="img" aria-label="font-size" class="anticon anticon-font-size"><svg viewBox="64 64 896 896" focusable="false" data-icon="font-size" width="1em" height="1em" fill="currentColor" aria-hidden="true" style="margin-top: -6px;"><path d="M920 416H616c-4.4 0-8 3.6-8 8v112c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-56h60v320h-46c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h164c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8h-46V480h60v56c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V424c0-4.4-3.6-8-8-8zM656 296V168c0-4.4-3.6-8-8-8H104c-4.4 0-8 3.6-8 8v128c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-64h168v560h-92c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h264c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8h-92V232h168v64c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8z"></path></svg></span>
                                        </a-radio-button>
                                        <a-radio-button value="24px">
                                            <span role="img" aria-label="font-size" class="anticon anticon-font-size" style="font-size: 20px;"><svg viewBox="64 64 896 896" focusable="false" data-icon="font-size" width="1em" height="1em" fill="currentColor" aria-hidden="true" style="margin-top: -6px;"><path d="M920 416H616c-4.4 0-8 3.6-8 8v112c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-56h60v320h-46c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h164c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8h-46V480h60v56c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V424c0-4.4-3.6-8-8-8zM656 296V168c0-4.4-3.6-8-8-8H104c-4.4 0-8 3.6-8 8v128c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-64h168v560h-92c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h264c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8h-92V232h168v64c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8z"></path></svg></span>
                                        </a-radio-button>
                                    </a-radio-group>
                                </div>
                            </div>
                        </div>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
