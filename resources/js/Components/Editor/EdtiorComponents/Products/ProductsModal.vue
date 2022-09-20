<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import {computed, getCurrentInstance, ref, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import ProductsComponent from "@/Components/Editor/EdtiorComponents/Products/ProductsComponent.vue";
import draggable from 'vuedraggable'
import ChooseProductsModal from "@/Components/Products/ChooseProductsModal.vue";
import {collect} from "collect.js";

const self = getCurrentInstance()

const drag = ref(false)

const removeBtn = (btn) => {
    btnsModel.value.splice(btnsModel.value.indexOf(btn), 1)
}

const dragOptions = computed({
    get() {
        return {
            animation: 200,
            group: "description",
            disabled: false,
            ghostClass: "ghost"
        };
    },
    set() {
    }
})


const props = defineProps({
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    elementId: Number,
    modelValue: Boolean,
    data: Object,
    products: Array,
    mode: {
        required: false,
        type: Number,
        default: 1
    },
    pageUuid: {
        required: false,
        type: String,
    },
})

const productsComponent = ref('')

const btnsModel = ref([])

let editableData = ref(useForm(props.data))

const fetchProducts = (productIds) => {
    axios.get(route('products.get_for_page', {product_ids: productIds})).then((resp) => {
        btnsModel.value = resp.data
    })
}

if(props.mode) {
    fetchProducts(props.data.product_ids)
}

watch(editableData, value => {
    console.log(productsComponent.value)
}, {deep: true})

watch(btnsModel, value => {
    editableData.value.product_ids = collect(value).pluck('id').all()
}, {deep: true})

const emit = defineEmits(['update:modelValue', 'dataChanged'])

function submit() {
    if(props.mode) {
        editableData.value.transform((data) => ({
            ...data,
            product_ids: collect(btnsModel.value).pluck('id').all(),
            props: {
                product_ids: collect(btnsModel.value).pluck('id').all()
            },
            alias: 'products'
        })).post(route('page_elements.update_static', props.elementId), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    } else {
        editableData.value.transform((data) => ({
            ...data,
            props: {
                product_ids: collect(btnsModel.value).pluck('id').all()
            },
            alias: 'products'
        })).post(route('pages.page_elements.create', props.pageUuid), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    }
}

const showProductsModal = ref(false)

const selectedValues = ref([])

watch(selectedValues, value => {
    showProductsModal.value = false
    fetchProducts(value)
}, {deep: true})
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Profile') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <choose-products-modal v-model="showProductsModal" v-model:selected-values="selectedValues" :products="products"/>
        <div>
            <div class="EditBlockPreview" style="min-height: 200px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle">
                            <products-component ref="productsComponent" :mode="props.mode" :element-id="props.elementId" :theme="props.theme" :recursive="false"
                                                :data="editableData"/>
                        </div>
                    </div>
                </div>
            </div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography"
                                         :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{ $root.translate('Settings') }}
                </span></template>
                    <div style="margin-bottom: 20px;">
                        <draggable
                            v-model="btnsModel"
                            tag="ul"
                            item-key="order_column"
                            handle=".DragHandler"
                            v-bind="dragOptions"
                            :component-data="{tag: 'ul',type: 'transition',name: !drag ? 'flip-list' : null,class: 'ul-flip-list'}"
                            @start="drag = true"
                            @end="drag = false">
                            <template #item="{element}">
                                <div role="button" tabindex="0"
                                     aria-roledescription="sortable"
                                     aria-describedby="DndDescribedBy-13"
                                     style="position: relative; transition: null 0s ease 0s, visibility 0s ease 0s; z-index: 1; opacity: 1;">
                                    <div class="SortablePanel" style="margin-bottom: 6px;">
                                        <div class="SortablePanel-drag">
                                            <div class="DragHandler"
                                                 style="height: 100%; background-color: rgb(233, 233, 233); color: rgba(0, 0, 0, 0.85); width: 28px;">
                                                <span role="img" aria-label="menu" class="anticon anticon-menu"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="menu"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M904 160H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0 624H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0-312H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8z"></path></svg></span>
                                            </div>
                                        </div>
                                        <div class="SortablePanel-content clickable">
                                            <div class="SortablePanel-title">
                                                {{ element.name }}
                                            </div>
                                        </div>
                                        <div @click="removeBtn(element)" class="SortablePanel-button"
                                             v-if="btnsModel.length > 1">
                                            <button type="button"
                                                    class="ant-btn ant-btn-link ant-btn-sm ant-btn-icon-only ant-btn-dangerous">
                                                <span role="img" aria-label="delete" class="anticon anticon-delete"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="delete"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                    <div style="display: block; margin-bottom: 20px;">
                        <button @click="showProductsModal = true" type="button" class="d-flex align-items-center ant-btn ant-btn-primary"
                                ant-click-animating-without-extra-node="false"><span role="img" aria-label="plus"
                                                                                     class="anticon anticon-plus"><svg
                            viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em"
                            fill="currentColor" aria-hidden="true"><path
                            d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path
                            d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path></svg></span><span>{{
                                $root.translate('Choose from catalog')
                            }}</span>
                        </button>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="ant-col ant-form-item-label me-auto"><label for="params_size" class=""
                                                                                title="Font size">{{
                                $root.translate('View')
                            }}</label></div>
                        <a-radio-group size="small" v-model:value="editableData.view" style="margin-bottom: 20px;">
                            <a-radio-button value="grid">{{ $root.translate('Grid') }}</a-radio-button>
                            <a-radio-button value="list">{{ $root.translate('List') }}</a-radio-button>
                        </a-radio-group>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
