<script setup>
import {ref} from "vue";

const props = defineProps({
    element: Object
})

let showPreview = ref(false)

const emit = defineEmits(['remove'])
</script>

<template>
    <div class="ImagesInput-preview">
        <img alt="" class="ImagesInput-preview-img" :src="props.element.preview"/>
        <div style="position: absolute; inset: 0px;"></div>
        <div style="position: absolute; bottom: 0px; left: 50%; transform: translate(-50%, 50%);">
            <div class="ant-space ant-space-horizontal ant-space-align-center" style="gap: 8px;">
                <div class="ant-space-item" @click="showPreview = true">
                    <span role="img" aria-label="eye"
                          tabindex="-1"
                          class="anticon anticon-eye"
                          style="background-color: rgb(255, 255, 255); border-radius: 50%; font-size: 13px; padding: 5px; border: 1px solid rgb(217, 217, 217); opacity: 0.7;">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="eye" width="1em" height="1em"
                             fill="currentColor" aria-hidden="true">
                            <path
                                d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 000 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0-51.5zM512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766zm-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112 112 50.1 112 112-50.1 112-112 112z"></path>
                        </svg>
                    </span>
                </div>
                <div class="ant-space-item" @click="emit('remove', props.element)">
                    <span role="img" aria-label="close" tabindex="-1"
                          class="anticon anticon-close"
                          style="background-color: rgb(255, 255, 255); border-radius: 50%; font-size: 13px; padding: 5px; border: 1px solid rgb(217, 217, 217); opacity: 0.7;">
                        <svg
                            viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em"
                            height="1em" fill="currentColor" aria-hidden="true">
                            <path
                                d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <a-modal
        :cancel-text="$root.translate('Cancel')"
            class="animate__animated"
            :class="showPreview ? 'animate__zoomIn' : 'animate__zoomOut'"
            v-model:visible="showPreview"
            :title="$root.translate('Image preview')"
            :footer="false"
            >
            <div>
                <div class="ImagePreviewModal-wrapper">
                    <img class="ImagePreviewModal-image" :src="props.element.preview" alt=""/>
                </div>
            </div>
        </a-modal>
    </div>
</template>
