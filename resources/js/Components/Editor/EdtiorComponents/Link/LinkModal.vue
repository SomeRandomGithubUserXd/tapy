<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue";

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
})

const emit = defineEmits(['update:modelValue', 'dataChanged'])

let editableData = ref(useForm(props.data))

function submit() {
    editableData.value.transform((data) => ({
        ...data,
        alias: 'link'
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
            {{ $root.translate('Link') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="1" :with-copy-action="true"/>
        </template>
        <div>
            <div class="EditBlockPreview" style="min-height: 156px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-uz6lmh">
                        <div class="BlocksWrapper-inner css-1x2ymmp" :style="theme.blockStyle">
                            <div class="Block preview mobile">
                                <link-component :theme="theme" :recursive="false" :data="editableData"/>
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
                    <tapy-input
                        :with-required-mark="true"
                        v-model="editableData.href"
                        :label="$root.translate('Link')"/>
                    <tapy-input
                        v-model="editableData.text"
                        :with-optional-mark="true"
                        :label="$root.translate('Button text')"/>
                    <tapy-input
                        v-model="editableData.caption"
                        :with-optional-mark="true"
                        :label="$root.translate('Button caption')"/>
                    <a-radio-group size="small" v-model:value="editableData.position" style="margin-bottom: 20px;">
                        <a-radio-button value="left">{{ $root.translate('Left') }}</a-radio-button>
                        <a-radio-button value="center">{{ $root.translate('Center') }}</a-radio-button>
                    </a-radio-group>
                    <div class="d-flex align-items-center" style="margin-bottom: 15px">
                        <a-switch v-model:checked="editableData.hide_icon"/>
                        <span class="ms-2">{{ $root.translate('Hide icon') }}</span>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
