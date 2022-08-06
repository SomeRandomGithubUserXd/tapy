<script setup>
import axios from "axios";
import {watch, ref, getCurrentInstance} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";

const props = defineProps({
    modelValue: Boolean,
    elementId: Number
})

const emit = defineEmits(['update:modelValue', 'closeItself'])

let pages = ref([])

fetchPages()

const self = getCurrentInstance()

function fetchPages() {
    axios.get(route('api.pages')).then(({data}) => {
        pages.value = data
    })
}

let selectedPage = ref(0)

function log(page) {
    selectedPage.value = page.uuid
}

function submit() {
    console.log(props.elementId)
    Inertia.post(route('page_elements.copy', props.elementId), {
        pageId: selectedPage.value
    }, {
        onSuccess: () => {
            message.success(
                self.parent.ctx.translate('Saved'), 2
            );
            emit('update:modelValue', false)
            emit('closeItself', false)
        }
    })
}
</script>

<template>
    <a-modal
        class="animate__animated"
        width="800px"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)"
        :wrap-style="{ overflow: 'hidden' }">
        <template #title>
            {{ $root.translate('Copy to page...') }}
        </template>
        <template #footer>
            <button @click="emit('update:modelValue', false)" type="button" class="ant-btn">
                <span>{{ $root.translate('Cancel') }}</span></button>
            <button @click="submit" type="button" class="ant-btn ant-btn-primary" :disabled="selectedPage === 0"><span>{{
                    $root.translate('Apply')
                }}</span></button>
        </template>
        <form class="ant-table-wrapper" style="overflow: auto; background: rgb(255, 255, 255);">
            <div class="ant-spin-nested-loading">
                <div class="ant-spin-container">
                    <div class="ant-table">
                        <div class="ant-table-container">
                            <div class="ant-table-content">
                                <table style="table-layout: auto;">
                                    <colgroup>
                                        <col class="ant-table-selection-col">
                                    </colgroup>
                                    <tbody class="ant-table-tbody">
                                    <tr v-for="page in pages"
                                        @click="log(page)"
                                        class="ant-table-row ant-table-row-level-0 ant-table-row-selected">
                                        <td class="ant-table-cell ant-table-selection-column"><label
                                            class="ant-radio-wrapper"
                                            :class="{'ant-radio-wrapper-checked': page.uuid === selectedPage}"><span
                                            :class="{'ant-radio-checked': page.uuid === selectedPage}"
                                            class="ant-radio"><input type="radio"
                                                                     name="radio"
                                                                     :value="page.uuid"
                                                                     v-model="selectedPage"
                                                                     class="ant-radio-input"><span
                                            class="ant-radio-inner"></span></span></label></td>
                                        <td class="ant-table-cell">{{ page.name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </a-modal>
</template>
