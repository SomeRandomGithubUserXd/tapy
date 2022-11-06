<script setup>
const props = defineProps({
    label: String,
    modelValue: String,
    error: {
        required: false,
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="ant-row ant-form-item" style="margin-top: 24px; row-gap: 0px;">
        <div v-if="props.label" class="ant-col ant-form-item-label">
            <label class="ant-form-item-required">
                {{ props.label }}
            </label>
        </div>
        <div class="ant-col ant-form-item-control">
            <div class="ant-form-item-control-input">
                <div class="ant-form-item-control-input-content">
                    <a-select :value="props.modelValue" @change="emit('update:modelValue', $event)">
                        <a-select-option :value="$root.translate('Buy')">
                            {{ $root.translate('Buy') }}
                        </a-select-option>
                        <a-select-option :value="$root.translate('Order')">
                            {{ $root.translate('Order') }}
                        </a-select-option>
                        <a-select-option :value="$root.translate('More')">
                            {{ $root.translate('More') }}
                        </a-select-option>
                    </a-select>
                </div>
            </div>
        </div>
        <div v-if="props.error" class="ant-form-item-explain ant-form-item-explain-error animate__animated"
             :class="props.error ? 'animate__fadeInDown' : 'animate__fadeInDown'">
            <div role="alert">{{ props.error }}</div>
        </div>
    </div>
</template>
