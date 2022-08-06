<script setup>
import {ref} from "vue";
import LinkModal from "@/Components/Editor/EdtiorComponents/Link/LinkModal.vue";

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

let showEditModal = ref(false)

// function handleChange(val) {
//     data.value = val.data()
// }
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <link-modal :theme="theme" @dataChanged="handleChange" v-if="recursive" v-model="showEditModal" :data="data"
                    :element-id="props.elementId"/>
        <div class="Block preview mobile first">
            <a class="Link" :class="data.position === 'center' ? 'icon-label-center' : 'icon-label-left'"
               rel="noopener nofollow ugc" :href="data.href" target="_blank"
               :style="`pointer-events:${isEditable ? 'none': 'auto'};` + theme.elementStyle">
                <div v-if="!data.hide_icon" class="Link-icon"><i class="Icon icon-link" style="font-size: 22px;"></i>
                </div>
                <div class="Link-label">{{ data.text }}</div>
                <div v-if="data.caption" class="Link-caption">{{ data.caption }}</div>
            </a>
        </div>
    </div>
</template>
