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
    },
})

function tryEditModal() {
    if (props.recursive) {
        showEditModal.value = true
    }
}

let showEditModal = ref(false)

const registerClick = () => {
    axios.post(route('api.register_link_click'), {
        link: window.location.pathname.split('/')[1],
        link_name: props.data.text || "Ссылка"
    });
}

console.log(props.data.custom_elem_style)
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <link-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                    :element-id="props.elementId"/>
        <div class="Block preview mobile first">
            <a class="Link"
               :class="data.position === 'center' ? 'icon-label-center' : 'icon-label-left'"
               rel="noopener nofollow ugc" :href="data.href" target="_blank"
               @click="registerClick"
               :style="`pointer-events:${isEditable ? 'none': 'auto'};` + (!!props.data.custom_styles ? props.data.custom_elem_style : theme.elementStyle)">
                <div v-if="!data.hide_icon" class="Link-icon"><i class="Icon icon-link" style="font-size: 22px;"></i>
                </div>
                <div class="Link-label">{{ data.text || $root.translate('Link') }}</div>
                <div v-if="data.caption" class="Link-caption">{{ data.caption }}</div>
            </a>
        </div>
    </div>
</template>
