<script setup>
import {computed, ref} from "vue";
import VideoModal from "@/Components/Editor/EdtiorComponents/Video/VideoModal.vue";

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

const getSrc = computed({
    get(){
        const params = new URLSearchParams(props.data.url.split("?")[1])
        console.log(params)
        console.log(props.data.url)
        console.log(params.get("v"))
        return `https://www.youtube.com/embed/${params.get("v")}`
    },
    set(){}
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
    set(){}
})

let showEditModal = ref(false)
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <video-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                    :element-id="props.elementId"/>
        <div class="Block preview mobile last" :style="elemStyle">
            <iframe style="width: 100%" :src="getSrc">
            </iframe>
        </div>
    </div>
</template>
