<script setup>
import Authenticated from "@/Layouts/Authenticated.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {getCurrentInstance, ref} from "vue";
import AddProductBtn from "@/Components/Products/AddProductBtn.vue";
import ProductModal from "@/Components/Products/ProductModal.vue";
import {message} from "ant-design-vue";
import ProductsHero from "@/Components/Products/ProductsHero.vue";
import DomainModal from "@/Components/Misc/DomainModal.vue";

const self = getCurrentInstance()

const props = defineProps({
    domains: Array
})


const editDomain = (id) => {
    editingDomainEntity.value = id
    editDomainModal.value = true
}

const editingDomainEntity = ref(null)
const editDomainModal = ref(false)
</script>

<template>
    <Authenticated>
        <template #header>{{ $root.translate('Settings') }}</template>
        <div class="Content">
            <domain-modal :domain-entity="editingDomainEntity" v-model="editDomainModal"/>
            <div class="Content-inner" style="max-width: 900px;">
                <a-tabs style="padding: 0 26px">
                    <a-tab-pane key="1">
                        <template #tab><span class="ant-typography">
                    {{ $root.translate('Domains') }}
                </span></template>
                        <div>
                            <div style="display: flex; margin-bottom: 24px;">
                                <button type="button" @click="editDomain({})"
                                        class="ant-btn ant-btn-primary"><span role="img" aria-label="plus"
                                                                              class="anticon anticon-plus"><svg
                                    style="margin-top: -7px;"
                                    viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em"
                                    fill="currentColor" aria-hidden="true"><defs></defs><path
                                    d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path
                                    d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path></svg></span><span>{{
                                        $root.translate('Add domain')
                                    }}</span>
                                </button>
                            </div>
                            <div class="Domains">
                                <div class="ant-table-wrapper">
                                    <div class="ant-spin-nested-loading">
                                        <div class="ant-spin-container">
                                            <div class="ant-table">
                                                <div class="ant-table-container">
                                                    <div class="ant-table-content">
                                                        <table style="table-layout: auto;">
                                                            <colgroup></colgroup>
                                                            <thead class="ant-table-thead">
                                                            <tr>
                                                                <th class="ant-table-cell font-bold">
                                                                    {{ $root.translate('Domain') }}
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="ant-table-tbody">
                                                            <tr @click="editDomain(entity)" v-for="entity in domains"
                                                                class="ant-table-row ant-table-row-level-0 cursor-pointer">
                                                                <td class="ant-table-cell font-bold">{{
                                                                        entity.domain
                                                                    }}
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a-tab-pane>
                </a-tabs>
            </div>
        </div>
    </Authenticated>
</template>
