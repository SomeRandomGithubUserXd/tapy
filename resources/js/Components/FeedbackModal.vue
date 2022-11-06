<script setup>
import {ref} from "vue";

const props = defineProps({
    modelValue: Boolean,
})

const content = ref('')

const emit = defineEmits(['update:modelValue'])

const submit = () => {

}
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        :cancel-button-props="{style: 'display:none'}"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Send feedback') }}
        </template>
        <form id="create-feedback" class="ant-form ant-form-vertical p-3">
            <div style="display: block; padding-bottom: 20px;"><p><span
                class="ant-typography">{{ $root.translate('Help to make QCD better!') }}</span></p><span class="ant-typography">
                🤔 {{ $root.translate("Didn't find the function you want?") }}
            </span><br><span
                class="ant-typography">😑 {{ $root.translate('Found a bug?') }}</span><br><span
                class="ant-typography">😊 {{ $root.translate('Have a suggestion?') }}</span></div>
            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                <div class="ant-col ant-form-item-control">
                    <div class="ant-form-item-control-input">
                        <div class="ant-form-item-control-input-content">
                            <textarea
                                v-model="content"
                                :placeholder="$root.translate('Enter your feedback here')" id="create-feedback_text"
                                class="ant-input"></textarea></div>
                    </div>
                </div>
            </div>
        </form>
    </a-modal>
</template>
