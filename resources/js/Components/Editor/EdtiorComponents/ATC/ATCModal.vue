<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import {Inertia} from "@inertiajs/inertia";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";

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
            alias: 'atc'
        })).post(route('page_elements.update_contact_element', props.elementId), {
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
            alias: 'atc'
        })).post(route('pages.create_contact_element', props.pageUuid), {
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

let picModel = ref(null)

let picSrc = ref(props?.data?.picture)

function onUploadPic(val) {
    editableData.value.picture = val
}
function removePic() {
    if (props.mode) {
        Inertia.delete(route('page_elements.remove_contact_picture', props.elementId), {
            onSuccess: () => {
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
                picSrc.value = editableData.value.picture = null
                emit('dataChanged', editableData.value)
            }
        })
    } else {
        picSrc.value = editableData.value.picture = null
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
            {{ $root.translate('Add to contacts') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="1" :with-copy-action="true"/>
        </template>
        <div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography"
                                         :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{ $root.translate('Settings') }}
                </span></template>
                    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
                        <div class="ant-col ant-form-item-control">
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :with-required-mark="true"
                                        :placeholder="'Имя'"
                                        v-model="editableData.name"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Surname')"
                                        v-model="editableData.surname"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Patronymic')"
                                        v-model="editableData.patronymic"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Personal phone number')"
                                        v-model="editableData.phn"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Work phone number')"
                                        v-model="editableData.wpn"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Company')"
                                        v-model="editableData.company"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Address')"
                                        v-model="editableData.address"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate('Website')"
                                        v-model="editableData.website"/>
                                </div>
                            </div>
                            <div class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
