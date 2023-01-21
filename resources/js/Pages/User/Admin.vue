<script setup>
import Authenticated from "@/Layouts/Authenticated.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {getCurrentInstance, onMounted, ref} from "vue";
import AddProductBtn from "@/Components/Products/AddProductBtn.vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {message} from "ant-design-vue";
import ProductsHero from "@/Components/Products/ProductsHero.vue";
import DomainModal from "@/Components/Misc/DomainModal.vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";
import {computed, defineComponent, reactive, toRefs} from 'vue';

const columns = [{
    title: 'ID',
    dataIndex: 'key',
},{
    title: 'Заблокирован',
    dataIndex: 'is_blocked',
}, {
    title: 'E-Mail',
    dataIndex: 'email',
}, {
    title: 'ПРО',
    dataIndex: 'is_pro',
}, {
    title: 'Админ',
    dataIndex: 'is_admin',
}, {
    title: 'Обновлял настройки',
    dataIndex: 'updated_at',
},{
    title: 'Обновлял страницы',
    dataIndex: 'page_last_updated_at',
},
];
const state = reactive({
    selectedRowKeys: [],
    // Check here to configure the default column
    loading: false,
});
const hasSelected = computed(() => state.selectedRowKeys.length > 0);
const start = () => {
    state.loading = true;
    // ajax request after empty completing
    setTimeout(() => {
        state.loading = false;
        state.selectedRowKeys = [];
    }, 1000);
};
const onSelectChange = selectedRowKeys => {
    state.selectedRowKeys = selectedRowKeys;
};
const self = getCurrentInstance()

const props = defineProps({
    users: Array,
    users_total: Number
})

onMounted(() => {
    // console.log(props.users)
})

const createPage = () => {
    Inertia.post(route('admin.create-page'), {}, {
        onSuccess: () => {
            permanentLink.value = usePage().props.value.flash
        },
        onError: () => {
            permanentLink.value = ''
        },
        onFinish: (resp) => {
            // console.log(resp)
        }
    })
}

const host = import.meta.env.VITE_APP_URL;

const permanentLink = ref('')

const blockUsers = () => {
    Inertia.post(route('admin.block-users'), {
        userIds: state.selectedRowKeys
    })
}

const unblockUsers = () => {
    Inertia.post(route('admin.unblock-users'), {
        userIds: state.selectedRowKeys
    })
}
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
                    <a-tab-pane key="2">
                        <template #tab><span class="ant-typography">
                    {{ $root.translate('Users') }}
                </span></template>
                        <div class="d-flex py-1">
                            <h2 class="fw-bold text-xl-start">Всего: {{props.users_total}}</h2>
                        </div>
                        <div class="d-flex py-3">
                            <button @click="blockUsers" type="button" class="me-2 ant-btn ant-btn-danger"><span>{{
                                    $root.translate('Block')
                                }}</span></button>
                            <button @click="unblockUsers" type="button" class="ant-btn ant-btn-secondary"><span>{{
                                    $root.translate('Unblock')
                                }}</span></button>
                        </div>
                        <a-table
                            :row-selection="{ selectedRowKeys: selectedRowKeys, onChange: onSelectChange }"
                            :columns="columns"
                            :data-source="props.users.data"
                        />
                    </a-tab-pane>
                </a-tabs>
            </div>
        </div>
    </Authenticated>
</template>
