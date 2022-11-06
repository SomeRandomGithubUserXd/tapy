<script setup>
import Authenticated from "@/Layouts/Authenticated.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {getCurrentInstance, ref} from "vue";
import AddProductBtn from "@/Components/Products/AddProductBtn.vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {message} from "ant-design-vue";
import ProductsHero from "@/Components/Products/ProductsHero.vue";

const self = getCurrentInstance()

let showEditModal = ref(false)

let editingProduct = ref({})

const editProduct = (product) => {
    editingProduct.value = product
    showEditModal.value = true
}
</script>

<template>
    <Authenticated>
        <template #header>{{ $root.translate('Products') }}</template>
        <products-hero @editProduct="editProduct" :products="$page.props.products"/>
        <product-modal v-model="showEditModal" :product="editingProduct" :mode="1"
                       :remove-text="$root.translate('Are you sure?')"
                       :ok-text="$root.translate('Yes')"
                       :cancel-text="$root.translate('Cancel')"/>
    </Authenticated>
</template>
