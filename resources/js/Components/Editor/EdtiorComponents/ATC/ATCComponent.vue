<script setup>
import {computed, ref} from "vue";
import ATCModal from "@/Components/Editor/EdtiorComponents/ATC/ATCModal.vue";

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

console.log(props.data)
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <a-t-c-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                     :element-id="props.elementId"/>
        <div class="Block preview mobile last" :style="elemStyle">
            <a class="Link"
               rel="noopener nofollow ugc"
               :href="route('add_to_contacts', props.elementId)"
               :style="`pointer-events:${isEditable ? 'none': 'auto'};` + theme.elementStyle">
                {{ $root.translate("Add to contacts") }}
            </a>
        </div>
    </div>
</template>
