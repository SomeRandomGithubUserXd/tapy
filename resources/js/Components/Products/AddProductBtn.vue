<script setup>
import {ref} from "vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {PlusOutlined} from "@ant-design/icons-vue";

let showModal = ref(false)

function addProduct() {
    showModal.value = true
}
</script>

<template>
    <button type="button" @click="addProduct"
            class="d-flex align-items-center ant-btn ant-btn-primary">
        <plus-outlined/>
        <span>{{ this.$root.translate('Add product') }}</span>
    </button>
    <product-modal v-model="showModal"/>
</template>
