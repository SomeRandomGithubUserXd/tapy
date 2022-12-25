<script setup>
import {ref} from "vue";
import OneMonth from "@/Components/ProPlans/OneMonth.vue";
import TwelveMonth from "@/Components/ProPlans/TwelveMonth.vue";

const props = defineProps({
    modelValue: Boolean,
})

const emit = defineEmits(['update:modeValue'])

const selectedTab = ref('months_12')

const setRadio = (value) => {
    selectedTab.value = value
}
</script>

<template>
    <a-modal
        class="animate__animated"
        width="800px"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        footer=""
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Available plans') }}
        </template>
        <div class="d-flex justify-content-center w-100">
            <div class="ant-radio-group ant-radio-group-solid ant-radio-group-small">
                <label
                    @click="setRadio('months_1')"
                    :class="selectedTab === 'months_1' ? 'ant-radio-button-wrapper-checked' : ''"
                    class="ant-radio-button-wrapper">
                    <span
                        :class="selectedTab === 'months_1' ? 'ant-radio-button-checked' : ''" class="ant-radio-button">
                        <span class="ant-radio-button-inner">

                        </span>
                    </span>
                    <span>{{ $root.translate('1 month') }}</span>
                </label>
                <label
                    @click="setRadio('months_12')"
                    :class="selectedTab === 'months_12' ? 'ant-radio-button-wrapper-checked' : ''"
                    class="ant-radio-button-wrapper">
                    <span
                        :class="selectedTab === 'months_12' ? 'ant-radio-button-checked' : ''"
                        class="ant-radio-button">
                        <input type="radio" class="ant-radio-button-input" value="months_12">
                        <span
                            class="ant-radio-button-inner"></span>
                    </span>
                    <span>{{ $root.translate('12 months') }}
                        <span
                            class="ant-tag ant-tag-geekblue"
                            style="position: absolute; right: 0px; top: -19px;">-50%
                        </span>
                    </span>
                </label>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="w-50 mt-4">
                <one-month v-if="selectedTab === 'months_1'"/>
                <twelve-month v-else/>
            </div>
        </div>
    </a-modal>
</template>
