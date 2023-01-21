<script setup>
import {computed, ref} from "vue";
import CounterpartyCardModal from "@/Components/Editor/EdtiorComponents/Text/CounterpartyCardModal.vue";

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
        <counterparty-card-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                                 :element-id="props.elementId"/>
        <div class="Block preview mobile last" :style="elemStyle">
            <div class="d-flex w-100 my-2 justify-content-center" v-if="!!data.organization[0].value">
                <img style="width: 80%;border-radius: 10px" alt="logo" :src="data.organization[0].value"/>
            </div>
            <div v-for="(part, key) in data" class="py-2">
                <h4 style="text-transform: capitalize" class="text-md-center">{{ $root.translate(key) }}</h4>
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="field in part">
                        <td v-if="field.field_name !== 'Image'" class="fw-bold">{{
                                $root.translate(field.field_name)
                            }}
                        </td>
                        <td v-if="field.field_name !== 'Image'">{{ field.value || '-' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
