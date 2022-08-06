<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";

const self = getCurrentInstance()

const props = defineProps({
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    elementId: Number,
    modelValue: Boolean,
    data: Object
})

const emit = defineEmits(['update:modelValue', 'dataChanged'])

let editableData = ref(useForm(props.data))

let picModel = ref(null)

let picSrc = ref(props?.data?.picture)

function onUploadPic(val) {
    editableData.value.picture = val
}

function submit() {
    editableData.value.post(route('page_elements.update_profile_element', props.elementId), {
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

function removePic() {
    Inertia.delete(route('page_elements.remove_profile_picture', props.elementId), {
        onSuccess: () => {
            message.success(
                self.parent.ctx.translate('Saved'), 2
            );
            picSrc.value = editableData.value.picture = null
            emit('dataChanged', editableData.value)
        }
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
        :wrap-style="{ overflow: 'hidden' }">
        <template #title>
            {{ $root.translate('Profile') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit" :element-id="props.elementId" :mode="1" :with-copy-action="true"/>
        </template>
        <div>
            <div class="EditBlockPreview" style="min-height: 200px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle" >
                            <profile :recursive="false" :data="editableData"/>
                        </div>
                    </div>
                </div>
            </div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography" :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{$root.translate('Settings')}}
                </span></template>
                    <single-image-uploader
                        :rounded-preview="true"
                        @onUpload="onUploadPic"
                        @onRemove="removePic"
                        v-model="picModel"
                        :src="picSrc">
                        <template #label>
                            <label>{{ $root.translate('Avatar') }}</label>
                        </template>
                    </single-image-uploader>
                    <tapy-input
                        v-model="editableData.username"
                        :label="$root.translate('Title')"/>
                    <tapy-input
                        v-model="editableData.caption"
                        :with-optional-mark="true"
                        :label="$root.translate('Caption')"/>
                    <a-radio-group size="small" v-model:value="editableData.position" style="margin-bottom: 20px;">
                        <a-radio-button value="left">{{ $root.translate('Left') }}</a-radio-button>
                        <a-radio-button value="center">{{ $root.translate('Center') }}</a-radio-button>
                    </a-radio-group>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
