<script setup>
import UploadGallery from "@/Components/Images/UploadGallery.vue";
import TapyTextarea from "@/Components/Common/TapyTextarea.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import TapySelect from "@/Components/Common/TapySelect.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {computed, createVNode, getCurrentInstance, onMounted, ref, watch} from "vue";
import axios from "axios";
import {Inertia} from "@inertiajs/inertia";
import {Modal} from "ant-design-vue";

const props = defineProps({
    product: {
        required: false,
        type: Object,
        default: {}
    },
    modelValue: Boolean,
    mode: {
        required: false,
        type: Number,
        default: 0
    },
    removeText: String,
    okText: String,
    cancelText: String,
})

const self = getCurrentInstance()


let form = ref(useForm({
    id: props.product?.id || null,
    photos: props.product?.photos || [],
    name: props.product?.name || '',
    description: props.product?.description || '',
    price: props.product?.price || '',
    old_price: props.product?.old_price || '',
    currency: props.product?.currency || 'RUB',
    action_btn: props.product?.action_btn || false,
    btn_label: props.product?.btn_label || self.parent.ctx.translate('Buy'),
    btn_link: props.product?.btn_link || ''
}))

let action_btn = ref(false)

watch(() => props.product, (product) => {
    form.value = useForm({
        id: product?.id || null,
        photos: product?.photos || [],
        name: product?.name || '',
        description: product?.description || '',
        price: product?.price || '',
        old_price: product?.old_price || '',
        currency: product?.currency || 'RUB',
        action_btn: product?.action_btn || false,
        btn_label: product?.btn_label || self.parent.ctx.translate('Buy'),
        btn_link: product?.btn_link || ''
    })
    action_btn.value = Boolean(product?.action_btn)
}, {deep: true});

watch(() => action_btn.value, (val) => {
    form.value.action_btn = val
})

const emit = defineEmits(['update:modelValue'])

let currencies = ref([]);

onMounted(() => {
    axios.get(route('api.currencies')).then((resp) => {
        currencies.value = resp.data
    })
})

const options = {
    onSuccess: () => {
        form.value.reset()
        emit('update:modelValue', false)
    },
}

function submit() {
    if (props.mode) {
        form.value.patch(route('products.update', form.value.id), options)
    } else {
        form.value.post(route('products.store'), options)
    }
}

function destroyProduct() {
    Modal.confirm({
        title: props.removeText,
        icon: createVNode(QuestionCircleOutlined),
        okText: props.okText,
        cancelText: props.cancelText,
        onOk() {
            Inertia.delete(route('products.destroy', form.value.id), options)
        },
        onCancel() {},
    });
}
</script>

<template>
    <a-modal
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)"
        @ok="submit"
        >
        <template #title>
            <div>{{ $root.translate('New product') }}</div>
        </template>
        <form id="product" class="ant-form ant-form-vertical">
            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                <div class="ant-col ant-form-item-label">
                    <label
                        class="ant-form-item-required"
                        title="Photos">
                        {{ $root.translate('Photos') }}
                    </label>
                </div>
                <upload-gallery
                    :error="$root.translate(form?.errors?.photos)"
                    v-model="form.photos"
                    :remove-text="$root.translate('Are you sure?')"
                    :ok-text="$root.translate('Yes')"
                    :cancel-text="$root.translate('Cancel')"/>
            </div>
            <tapy-input
                :with-label="true"
                :with-required-mark="true"
                :placeholder="$root.translate('Name')"
                :error="$root.translate(form?.errors?.name)"
                v-model="form.name"/>
            <tapy-textarea
                :name="$root.translate('Description')"
                :error="$root.translate(form?.errors?.description)"
                v-model="form.description"/>
            <tapy-input
                :with-label="true"
                :placeholder="$root.translate('Price')"
                v-model="form.price"
                :error="$root.translate(form?.errors?.price)"
                v-model:select-value="form.currency"
                :select-options="currencies"/>
            <tapy-input
                :with-label="true"
                :error="$root.translate(form?.errors?.old_price)"
                :placeholder="$root.translate('Old price')"
                v-model="form.old_price"
                :select-value="form.currency"/>
            <div class="ant-card ant-card-bordered">
                <div class="ant-card-body">
                    <div class="d-flex align-items-center">
                        <a-switch v-model:checked="action_btn"/>
                        <span class="ms-2">{{ $root.translate('Action button') }}</span>
                    </div>
                    <div class="d-flex flex-column" v-if="form.action_btn">
                        <tapy-select :error="$root.translate(form?.errors?.btn_label)"
                                     v-model="form.btn_label" :label="$root.translate('Button label')"/>
                        <tapy-input
                            :error="$root.translate(form?.errors?.btn_link)"
                            :with-required-mark="true"
                            :with-label="true"
                            :label="$root.translate('Link')"
                            placeholder="https://google.com"
                            v-model="form.btn_link"/>
                    </div>
                </div>
            </div>
        </form>
        <template #footer>
            <div class="d-flex">
                <a-dropdown v-if="props.mode" placement="topLeft" class="me-auto" :trigger="['click']">
                    <a class="ant-dropdown-link" @click.prevent>
                        <div class="ant-col">
                            <button type="button" class="ant-btn ant-dropdown-trigger d-flex align-items-center"
                                    ant-click-animating-without-extra-node="false"><span role="img" aria-label="more"
                                                                                         class="anticon anticon-more"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="more" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true"><path
                                d="M456 231a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0z"></path></svg></span><span>{{
                                    $root.translate('Actions')
                                }}</span>
                            </button>
                        </div>
                    </a>
                    <template #overlay>
                        <a-menu>
                            <a-menu-item class="ant-dropdown-menu-item ant-dropdown-menu-item-danger" @click="destroyProduct">
                              <div class="d-flex align-items-center">
                                  <span role="img"
                                        aria-label="delete"
                                        class="anticon anticon-delete ant-dropdown-menu-item-icon"><svg
                                      viewBox="64 64 896 896" focusable="false" data-icon="delete" width="1em"
                                      height="1em" fill="currentColor" aria-hidden="true"><path
                                      d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span><span
                                  class="ant-dropdown-menu-title-content">{{ $root.translate('Delete') }}</span>
                              </div>
                            </a-menu-item>
                        </a-menu>
                    </template>
                </a-dropdown>
                <a-button key="submit" class="ms-auto" type="primary" @click="submit">{{ props.mode ? $root.translate('Save') : $root.translate('Add') }}</a-button>
            </div>
        </template>
    </a-modal>
</template>
