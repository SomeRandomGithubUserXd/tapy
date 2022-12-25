<script setup>
import {computed, ref} from "vue";
import VideoGalleryModal from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryModal.vue";
import VideoGalleryItem from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryItem.vue";
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

function tryEditModal() {
    if (props.recursive) {
        showEditModal.value = true
    }
}

const getSrc = (video) => {
    const params = new URLSearchParams(video.split("?")[1])
    return `https://www.youtube.com/embed/${params.get("v")}`
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
        <div class="w-100" :class="props.isEditable ? 'Block preview mobile' : ''">
            <div class="w-100 px-3">
                <swiper
                    class="w-100"
                    ref="themeSwiper"
                    :slides-per-view="1"
                    :spaceBetween="50"
                    @swiper="() => {}">
                    <swiper-slide
                        v-for="video in props.data.faqs"
                        class="d-flex flex-column justify-content-center cursor-drag w-100">
                        <iframe style="width: 100%" :src="getSrc(video.url)">
                        </iframe>
                        <div class="caption text-center mt-3">{{ video.caption }}</div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>
