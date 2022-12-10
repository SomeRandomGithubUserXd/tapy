<script setup>
import {computed, ref, watch} from "vue";
import ImageModal from "@/Components/Editor/EdtiorComponents/Image/ImageModal.vue";
import ImageGalleryModal from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryModal.vue";

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



let showEditModal = ref(false)

function tryEditModal() {
    if (props.recursive) {
        showEditModal.value = true
    }
}

let data = ref(props.data)

watch(props.data, value => {
}, {deep: true})

function handleChange(val) {
    data.value = val.data()
}
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <image-gallery-modal :theme="theme" @dataChanged="handleChange" v-if="recursive" v-model="showEditModal" :data="data"
                       :element-id="props.elementId"/>
        <div class="Block preview mobile">
            <div>

            </div>
        </div>
    </div>
</template>
