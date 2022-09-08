<script setup>
import {computed, onMounted, ref} from "vue";
import ProductsModal from "@/Components/Editor/EdtiorComponents/Products/ProductsModal.vue";

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

const products = ref([])

const fetchProducts = () => {
    axios.get(route('products.get_for_page', {element_id: props.elementId})).then((resp) => {
        products.value = resp.data
    })
}

onMounted(() => {
    fetchProducts()
})
</script>

<template>
    <div :class="!props.isEditable ? '' : 'EditorBlockListItem-block'" @click="tryEditModal">
        <products-modal :theme="theme" v-if="recursive" v-model="showEditModal" :data="data"
                      :element-id="props.elementId"/>
        <div class="Block preview mobile" :style="elemStyle">
            <div>
                <div class="Modal">
                    <div class="Modal-overlay"></div>
                    <div class="Modal-content-wrapper">
                        <div class="Modal-content css-1tyk8rz"
                             style="width: 640px;">
                            <div class="Modal-header"><span><span>&nbsp;</span></span>
                                <div class="Modal-close css-j2xx8s"></div>
                            </div>
                            <div class="Modal-body"></div>
                        </div>
                    </div>
                </div>
                <div class="Lightbox">
                    <div class="Lightbox-overlay">
                        <div class="Lightbox-close"></div>
                        <div class="Lightbox-content"></div>
                    </div>
                </div>
                <div class="Products-block grid">
                    <div v-for="product in products" class="Products-block-item" style="width: calc(33.3333%);">
                        <div class="Products-block-item-photo"
                             :style="{backgroundImage: 'url('+ product.preview_photo +')'}"
                             style="width: 100%; height: auto; border-radius: 20px;"></div>
                        <div class="Products-block-item-info">
                            <div class="Products-block-item-title">{{ product.name }}</div>
                            <div class="Products-block-item-price"><span>{{
                                    product.price || ''
                                }}</span><span>{{ product.currency || '' }}</span>
                                <div v-if="product.old_price && product.price" class="Products-block-item-old-price">
                                    {{ product.old_price }} {{ product.currency }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
