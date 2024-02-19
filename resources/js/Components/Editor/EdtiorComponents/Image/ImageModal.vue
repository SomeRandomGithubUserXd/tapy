<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import ImageComponent from "@/Components/Editor/EdtiorComponents/Image/ImageComponent.vue";

const self = getCurrentInstance()

const props = defineProps({
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    elementId: Number,
    modelValue: Boolean,
    data: Object,
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

const emit = defineEmits(['update:modelValue', 'dataChanged', 'closeAll'])

let editableData = ref(useForm(props.data))

let picModel = ref(null)

let picSrc = ref(props?.data?.picture)

function onUploadPic(val) {
    editableData.value.picture = val
}

function submit() {
    if (props.mode) {
        editableData.value.post(route('page_elements.update_image_element', props.elementId), {
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
            alias: 'image'
        })).post(route('pages.create_image_element', props.pageUuid), {
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
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
    >
        <template #title>
            {{ $root.translate('Image') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <div>
            <div class="EditBlockPreview" style="min-height: 200px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle">
                            <image-component :recursive="false" :data="editableData"/>
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
                    <single-image-uploader
                        :rounded-preview="false"
                        @onUpload="onUploadPic"
                        v-model="picModel"
                        :src="picSrc">
                        <template #label>
                            <label>{{ $root.translate('Image') }}</label>
                        </template>
                    </single-image-uploader>
                    <tapy-input
                        v-model="editableData.caption"
                        :with-optional-mark="true"
                        :label="$root.translate('Caption')"/>
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center" style="margin-bottom: 15px">
                            <a-switch v-model:checked="editableData.rounded"/>
                            <span class="ms-2">{{ $root.translate('Rounded corners') }}</span>
                        </div>
                        <div class="d-flex align-items-center" style="margin-bottom: 15px">
                            <a-switch v-model:checked="editableData.zoom"/>
                            <span class="ms-2">{{ $root.translate('Click to zoom') }}</span>
                        </div>
                    </div>
                    <a-radio-group size="small" v-model:value="editableData.view" style="margin-bottom: 20px;">
                        <a-radio-button value="square">{{ $root.translate('Square') }}</a-radio-button>
                        <a-radio-button value="center">{{ $root.translate('Original') }}</a-radio-button>
                    </a-radio-group>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
