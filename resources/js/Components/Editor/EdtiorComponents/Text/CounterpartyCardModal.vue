<script setup>
import {getCurrentInstance, ref} from "vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import {Inertia} from "@inertiajs/inertia";

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
            alias: 'counterparty'
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
            alias: 'counterparty'
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

const activeKey = ref(1)

let picModel = ref(editableData.value.organization[0].value)

let picSrc = ref(editableData.value.organization[0].value)

function onUploadPic(val) {
    Inertia.post(route('upload-temp-image'), {
        file: val
    }, {
        onSuccess: () => {
            editableData.value.organization[0].value = usePage().props.value.flash
        }
    })
}

function removePic() {
    editableData.value.organization[0].value = null
    picModel.value = null
    picSrc.value = null
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
            {{ $root.translate('Counterparty card') }}
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
                    <a-tabs v-model:activeKey="activeKey">
                        <a-tab-pane :key="1" :tab="$root.translate('Organization')">
                            <div v-for="(field, key) in editableData.organization" class="ant-form-item-control-input">
                                <div v-if="field.field_name !== 'Image'" class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate(field.field_name)"
                                        v-model="editableData.organization[key].value"/>
                                </div>
                                <div v-else>
                                    <single-image-uploader
                                        :rounded-preview="true"
                                        @onUpload="onUploadPic"
                                        @onRemove="removePic"
                                        v-model="picModel"
                                        :src="picSrc">
                                        <template #label>
                                            <label>{{ $root.translate('Logo') }}</label>
                                        </template>
                                    </single-image-uploader>
                                </div>
                            </div>
                        </a-tab-pane>
                        <a-tab-pane :key="2" :tab="$root.translate('Bank')">
                            <div v-for="(field, key) in editableData.bank" class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate(field.field_name)"
                                        v-model="editableData.bank[key].value"/>
                                </div>
                            </div>
                        </a-tab-pane>
                        <a-tab-pane :key="3" :tab="$root.translate('Contacts')">
                            <div v-for="(field, key) in editableData.contacts" class="ant-form-item-control-input">
                                <div class="ant-form-item-control-input-content">
                                    <tapy-input
                                        :with-label="true"
                                        :placeholder="$root.translate(field.field_name)"
                                        v-model="editableData.contacts[key].value"/>
                                </div>
                            </div>
                        </a-tab-pane>
                    </a-tabs>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
