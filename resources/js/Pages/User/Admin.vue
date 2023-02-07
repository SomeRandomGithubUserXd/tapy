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
}, {
    title: 'Заблокирован',
    dataIndex: 'is_blocked',
}, {
    title: 'E-Mail',
    dataIndex: 'email',
}, {
    title: 'ПРО истек/истекает',
    dataIndex: 'is_pro',
}, {
    title: 'Админ',
    dataIndex: 'is_admin',
}, {
    title: 'Страницы',
    dataIndex: 'page_links',
}, {
    title: 'Количество страниц',
    dataIndex: 'pages_amount',
    key: 'pages_amount',
},  {
    title: 'Продлить про (от текущей даты в месяцах)',
    dataIndex: 'give_pro',
    key: 'give_pro',
}, {
    title: 'Обновлял настройки',
    dataIndex: 'updated_at',
}, {
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

const updateUserPagesLimit = (userId, limit) => {
    Inertia.post(route('admin.update-pages-limit', userId), {
            limit
        },
        {
            onSuccess: () => {

            },
            onError: (err) => {
                console.log(err)
            }
        })
}


const givePro = (userId, period) => {
    Inertia.post(route('admin.give-pro', userId), {
            period
        },
        {
            onSuccess: () => {

            },
            onError: (err) => {
                console.log(err)
            }
        })
}

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
                            <h2 class="fw-bold text-xl-start">Всего: {{ props.users_total }}</h2>
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
                            style="overflow: scroll"
                            :row-selection="{ selectedRowKeys: selectedRowKeys, onChange: onSelectChange }"
                            :columns="columns"
                            :data-source="props.users.data">
                            <template #bodyCell="{ column, record }">
                                <template v-if="column.key === 'pages_amount'">
                                    <ul class="d-flex">
                                        <li title="1" tabindex="0"
                                            @click="updateUserPagesLimit(record.key, 1)"
                                            :class="record.pages_limit === 1 ? 'ant-pagination-item-active' : ''"
                                            class="ant-pagination-item ant-pagination-item-1">
                                            <a rel="nofollow">
                                                1
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="updateUserPagesLimit(record.key, 10)"
                                            :class="record.pages_limit === 10 ? 'ant-pagination-item-active' : ''"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                10
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="updateUserPagesLimit(record.key, 20)"
                                            :class="record.pages_limit === 20 ? 'ant-pagination-item-active' : ''"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                20
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="updateUserPagesLimit(record.key, 50)"
                                            :class="record.pages_limit === 50 ? 'ant-pagination-item-active' : ''"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                50
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="updateUserPagesLimit(record.key, 100)"
                                            :class="record.pages_limit === 100 ? 'ant-pagination-item-active' : ''"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                100
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                                <template v-if="column.key === 'give_pro'">
                                    <ul class="d-flex">
                                        <li title="1" tabindex="0"
                                            @click="givePro(record.key, 1)"
                                            class="ant-pagination-item ant-pagination-item-1">
                                            <a rel="nofollow">
                                                1
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="givePro(record.key, 3)"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                3
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="givePro(record.key, 6)"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                6
                                            </a>
                                        </li>
                                        <li title="1" tabindex="0"
                                            @click="givePro(record.key, 12)"
                                            class="ant-pagination-item ant-pagination-item-1 ml-1">
                                            <a rel="nofollow">
                                                12
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </template>
                        </a-table>
                    </a-tab-pane>
                </a-tabs>
            </div>
        </div>
    </Authenticated>
</template>
