<script setup>
import {computed, ref} from "vue";
import VideoGalleryModal from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryModal.vue";
import VideoGalleryItem from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryItem.vue";

const props = defineProps({
    isEditable: {
        required: false,
        default: true,
        type: Boolean,
    },
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    data: Object,
    elementId: Number,
    recursive: {
        required: false,
        type: Boolean,
        default: true
    }
})

function tryEditModal() {
    if (props.recursive) {
        showEditModal.value = true
    }
}

const elemStyle = computed({
    get() {
        let style = props.theme.blockStyle
        let styleArr = style.split(';')
        let res = styleArr.filter(function (value) {
            return value.includes('color');
        });
        style = res.join(';');
        return style
    },
    set() {
    }
})

let showEditModal = ref(false)
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <video-gallery-modal v-model:faqs="data.faqs" :theme="theme" v-if="recursive" v-model="showEditModal"
                    :element-id="props.elementId"/>
        <div class="Block preview mobile last" :style="elemStyle">
            <div class="Faq" v-for="item in data.faqs" :style="elemStyle">
                <video-gallery-item :is-editable="isEditable" :item="item" :elem-style="elemStyle"/>
            </div>
        </div>
    </div>
</template>
