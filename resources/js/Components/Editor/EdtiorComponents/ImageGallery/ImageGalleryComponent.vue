<script setup>
import {computed, ref, watch} from "vue";
import ImageModal from "@/Components/Editor/EdtiorComponents/Image/ImageModal.vue";
import ImageGalleryModal from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryModal.vue";
import {Swiper, SwiperSlide, useSwiper} from 'swiper/vue';
import 'swiper/css';

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

const showImage = ref(false)

const imageSrc = ref('')

const setImageModal = (src) => {
    showImage.value = true
    imageSrc.value = src
}
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <a-modal
        :cancel-text="$root.translate('Cancel')"
            class="animate__animated np-modal"
            :class="showImage ? 'animate__zoomIn' : 'animate__zoomOut'"
            v-model:visible="showImage"
            :footer="false"
            :width="1200"
            :title="false"
            @change="emit('update:modelValue', false)">
            <img style="width: 100%;" :src="imageSrc"/>
        </a-modal>
        <image-gallery-modal :theme="theme" @dataChanged="handleChange" v-if="recursive" v-model="showEditModal"
                             :data="data"
                             :element-id="props.elementId"/>
        <div class="w-100" :class="props.isEditable ? 'Block preview mobile' : ''">
            <div class="w-100 px-3">
                <swiper
                    class="w-100"
                    ref="themeSwiper"
                    :slides-per-view="1"
                    :spaceBetween="50"
                    @swiper="() => {}">
                    <swiper-slide
                        @click="setImageModal(image)"
                        v-for="image in props.data.images"
                        class="d-flex justify-content-center cursor-drag w-100">
                        <div class="Image rounded w-100" style="color: rgb(68, 69, 74);">
                            <div class="Image-square"
                                 :style="`background-image: url(${image}); border-radius: 14px;'`"></div>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>
