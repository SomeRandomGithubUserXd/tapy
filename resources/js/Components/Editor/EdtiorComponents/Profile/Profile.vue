<script setup>
import {computed, ref, watch} from "vue";
import ProfileModal from "@/Components/Editor/EdtiorComponents/Profile/ProfileModal.vue";

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

const getPicture = computed({
    get() {
        if(typeof data.value.picture === 'string') {
            return data.value.picture
        } else {
            return window.URL.createObjectURL(data.value.picture)
        }
    },
    set(){}
})

function handleChange(val) {
    data.value = val.data()
}
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <profile-modal :theme="theme" @dataChanged="handleChange" v-if="recursive" v-model="showEditModal" :data="data" :element-id="props.elementId"/>
        <div class="Block preview mobile first">
            <div>
                <div class="Cover no-image" :class="data?.position">
                    <div class="info">
                        <div v-if="data?.picture" class="logo-wrapper"><img :src="getPicture"
                                                       alt="ProfilePic"></div>
                        <span class="title-wrapper">
                            <span class="title">{{ data.username }}</span>
                            <span v-if="data.caption" class="subtitle">{{ data.caption }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
