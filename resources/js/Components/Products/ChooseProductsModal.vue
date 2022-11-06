<script setup>
import ProductsHero from "@/Components/Products/ProductsHero.vue";
import {ref} from "vue";
import ProductModal from "@/Components/Products/ProductModal.vue";

const props = defineProps({
    pageUuid: String,
    modelValue: Boolean,
    userProducts: Array,
    theme: Object,
    products: Array,
    selectedValues: Array
})

const emit = defineEmits(['update:modelValue', 'update:selectedValues'])

const selectedProducts = ref(props.selectedValues)

const submit = () => {
    emit('update:selectedValues', selectedProducts.value)
}

let showEditModal = ref(false)

let editingProduct = ref({})

const editProduct = (product) => {
    editingProduct.value = product
    showEditModal.value = true
}
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="props.modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="props.modelValue"
        :ok-text="$root.translate('Apply')"
        :cancel-text="$root.translate('Cancel')"
        @ok="submit"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Choose products') }}
        </template>
        <products-hero
            v-model="selectedProducts"
            :mode="0"
            @editProduct="editProduct"
            :products="products"/>
        <product-modal v-model="showEditModal" :product="editingProduct" :mode="1"
                       :remove-text="$root.translate('Are you sure?')"
                       :ok-text="$root.translate('Yes')"
                       :cancel-text="$root.translate('Cancel')"/>
    </a-modal>
</template>
