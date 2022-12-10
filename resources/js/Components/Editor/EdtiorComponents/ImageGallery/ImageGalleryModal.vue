<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import {getCurrentInstance, ref, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import ImageGalleryComponent from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryComponent.vue";
import UploadGallery from "@/Components/Images/UploadGallery.vue";

const self = getCurrentInstance()

let images = ref([])

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

function toDataUrl(url, callback) {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        let reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}

const formatImages = () => {
    if (props.data?.images?.length) {
        const imagesLocal = []
        for (const image of props.data.images) {
            toDataUrl(image, function(base) {
                imagesLocal.push({
                    preview: image,
                    file: base
                })
            });
        }
        console.log(imagesLocal)
        images.value = imagesLocal
    }
}

watch(images, value => {}, {deep: true})

formatImages()

const emit = defineEmits(['update:modelValue', 'dataChanged', 'closeAll'])

let editableData = ref(useForm(props.data))

function submit() {
    if (props.mode) {
        editableData.value.transform((data) => ({
            props: images.value,
            alias: 'image_gallery'
        })).post(route('page_elements.update_image_gallery_element', props.elementId), {
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
            props: images.value,
            alias: 'image_gallery'
        })).post(route('pages.create_image_gallery_element', props.pageUuid), {
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
            {{ $root.translate('Image gallery') }}
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
                    <upload-gallery
                        v-model="images"
                        :remove-text="$root.translate('Are you sure?')"
                        :ok-text="$root.translate('Yes')"
                        :cancel-text="$root.translate('Cancel')"/>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
