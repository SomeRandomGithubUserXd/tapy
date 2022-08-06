<script setup>
import Authenticated from "@/Layouts/Authenticated.vue";
import {QuestionCircleOutlined, PlusOutlined} from "@ant-design/icons-vue";
import {ref} from "vue";
import AddProductBtn from "@/Components/Products/AddProductBtn.vue";
import ProductModal from "@/Components/Products/ProductModal.vue";

let showEditModal = ref(false)

let editingProduct = ref({})

function editProduct(product) {
    editingProduct.value = product
    showEditModal.value = true
}
</script>

<template>
    <Authenticated>
        <template #header>{{ this.$root.translate('Products') }}</template>
        <div class="Content">
            <div class="Content-inner" style="max-width: 900px;">
                <div v-if="!$page.props.products.length" class="ant-empty">
                    <div class="ant-empty-image">
                        <svg class="ant-empty-img-default" width="184" height="152" viewBox="0 0 184 152"
                             xmlns="http://www.w3.org/2000/svg">
                            <g fill="none" fill-rule="evenodd">
                                <g transform="translate(24 31.67)">
                                    <ellipse class="ant-empty-img-default-ellipse" cx="67.797" cy="106.89"
                                             rx="67.797" ry="12.668"></ellipse>
                                    <path class="ant-empty-img-default-path-1"
                                          d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z"></path>
                                    <path class="ant-empty-img-default-path-2"
                                          d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z"
                                          transform="translate(13.56)"></path>
                                    <path class="ant-empty-img-default-path-3"
                                          d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z"></path>
                                    <path class="ant-empty-img-default-path-4"
                                          d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z"></path>
                                </g>
                                <path class="ant-empty-img-default-path-5"
                                      d="M149.121 33.292l-6.83 2.65a1 1 0 0 1-1.317-1.23l1.937-6.207c-2.589-2.944-4.109-6.534-4.109-10.408C138.802 8.102 148.92 0 161.402 0 173.881 0 184 8.102 184 18.097c0 9.995-10.118 18.097-22.599 18.097-4.528 0-8.744-1.066-12.28-2.902z"></path>
                                <g class="ant-empty-img-default-g" transform="translate(149.65 15.383)">
                                    <ellipse cx="20.654" cy="3.167" rx="2.849" ry="2.815"></ellipse>
                                    <path d="M5.698 5.63H0L2.898.704zM9.259.704h4.985V5.63H9.259z"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="ant-empty-description">{{ this.$root.translate('Add your first product') }}</div>
                    <div class="ant-empty-footer d-flex justify-content-center">
                        <add-product-btn/>
                    </div>
                </div>
                <div style="display: flex; margin-bottom: 24px;" v-else>
                    <add-product-btn/>
                </div>
                <div v-if="$page.props.products.length" class="Products">
                    <div class="ant-table-wrapper">
                        <div class="ant-spin-nested-loading">
                            <div class="ant-spin-container">
                                <div class="ant-table">
                                    <div class="ant-table-container">
                                        <div class="ant-table-content">
                                            <table style="table-layout: auto;">
                                                <colgroup>
                                                    <col style="width: 90px;">
                                                </colgroup>
                                                <thead class="ant-table-thead">
                                                <tr>
                                                    <th class="ant-table-cell">Photo</th>
                                                    <th class="ant-table-cell">Title</th>
                                                    <th class="ant-table-cell">Price</th>
                                                </tr>
                                                </thead>
                                                <tbody class="ant-table-tbody">
                                                <tr v-for="product in $page.props.products"
                                                    @click="editProduct(product)"
                                                    class="ant-table-row ant-table-row-level-0">
                                                    <td class="ant-table-cell">
                                                        <div
                                                            :style="{backgroundImage: `url(${product.preview_photo})`}"
                                                            style="width: 32px; height: 32px; background-color: rgb(217, 217, 217); background-size: cover; background-position: center center; border-radius: 3px;"></div>
                                                    </td>
                                                    <td class="ant-table-cell">{{ product.name }}</td>
                                                    <td class="ant-table-cell">
                                                        {{
                                                            product.price ? `${product.price} ${product.currency}` : null
                                                        }}
                                                        <div v-if="product.old_price && product.price"
                                                             class="Products-block-item-old-price">
                                                            {{ product.old_price + " " + product.currency }}
                                                        </div>
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
        </div>
        <product-modal v-model="showEditModal" :product="editingProduct" :mode="1"
                       :remove-text="this.$root.translate('Are you sure?')"
                       :ok-text="this.$root.translate('Yes')"
                       :cancel-text="this.$root.translate('Cancel')"/>
    </Authenticated>
</template>
