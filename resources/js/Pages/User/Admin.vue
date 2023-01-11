<script setup>
import Authenticated from "@/Layouts/Authenticated.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {getCurrentInstance, ref} from "vue";
import AddProductBtn from "@/Components/Products/AddProductBtn.vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {message} from "ant-design-vue";
import ProductsHero from "@/Components/Products/ProductsHero.vue";
import DomainModal from "@/Components/Misc/DomainModal.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";

const self = getCurrentInstance()

const props = defineProps({})

const createPage = () => {
    Inertia.post(route('admin.create-page'), {}, {
        onSuccess: () => {
            permanentLink.value = usePage().props.value.flash
        },
        onError: () => {
            permanentLink.value = ''
        },
        onFinish: (resp) => {
            console.log(resp)
        }
    })
}

const host = import.meta.env.VITE_APP_URL;

const permanentLink = ref('')
</script>

<template>
    <Authenticated>
        <template #header>{{ $root.translate('Settings') }}</template>
        <div class="Content">
            <div class="Content-inner" style="max-width: 900px;">
                <a-tabs style="padding: 0 26px">
                    <a-tab-pane key="1">
                        <template #tab><span class="ant-typography">
                    {{ $root.translate('Pages') }}
                </span></template>
                        <div>
                            <tapy-input :with-label="true" :placeholder="$root.translate('Permanent link')"
                                        :value="host + '/' + permanentLink" :disabled="true"
                                        type="text"/>
                            <button @click="createPage" type="button" class="ant-btn">
                                <span>{{ $root.translate('Create') }}</span></button>
                        </div>
                    </a-tab-pane>
                </a-tabs>
            </div>
        </div>
    </Authenticated>
</template>
