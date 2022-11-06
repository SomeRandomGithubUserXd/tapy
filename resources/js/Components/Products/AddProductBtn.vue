<script setup>
import {ref} from "vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {PlusOutlined} from "@ant-design/icons-vue";

const props = defineProps({
    mode: {
        required: false,
        default: 1,
        type: Number
    }
})

let showModal = ref(false)

function addProduct() {
    showModal.value = true
}
</script>

<template>
    <button type="button" @click="addProduct"
            :class="props.mode ? 'd-flex align-items-center ant-btn ant-btn-primary' : 'd-flex align-items-center ant-btn ant-btn-sm'">
        <plus-outlined/>
        <span>{{ props.mode ? $root.translate('Add product') : $root.translate('Add new product') }}</span>
    </button>
    <product-modal v-model="showModal"/>
</template>
