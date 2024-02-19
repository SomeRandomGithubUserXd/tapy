<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import HTMLComponent from "@/Components/Editor/EdtiorComponents/HTML/HTMLComponent.vue";
import UpgradeToProModal from "@/Components/Misc/UpgradeToProModal.vue";

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
    if (props.mode) {
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

const showUpgradeModal = ref(false)
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Custom html') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <upgrade-to-pro-modal v-model="showUpgradeModal"/>
        <div style="display: flex; margin: 10px 26px;" v-if="!$page.props.auth.user.is_pro">
            <div data-show="true" class="ant-alert ant-alert-error ant-alert-no-icon" role="alert">
                <div class="ant-alert-content">
                    <div class="ant-alert-message">
                        {{
                            $root.translate("This block requires a PRO tariff plan and will not be shown on your page.")
                        }}
                        <a href="#" @click="showUpgradeModal = true">{{ $root.translate('Upgrade plan') }}</a></div>
                    <div class="ant-alert-description"></div>
                </div>
            </div>
        </div>
        <div>
            <div class="EditBlockPreview" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle">
                            <div class="Block preview mobile last" :style="theme.elemStyle">
                                <div v-html="editableData.html"></div>
                            </div>
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
                                $root.translate('HTML')
                            }}</label>
                        </div>
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">   <textarea
                                    :placeholder="$root.translate('Enter html here')" rows="4"
                                    id="params_heading"
                                    class="ant-input"
                                    v-model="editableData.html"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Hint ant-alert mb-3"><span role="img" aria-label="info-circle"
                                                           class="anticon anticon-info-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="info-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path
                        d="M464 336a48 48 0 1096 0 48 48 0 10-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"></path></svg></span>
                        <div class="ant-alert-content">
                            <div class="ant-alert-message">
                                {{
                                    $root.translate('Please note that the JS code will be ignored in the editor, but it will work on your page.')
                                }}
                            </div>
                        </div>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
