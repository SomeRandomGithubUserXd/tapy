<script setup>
const props = defineProps({
    name: String,
    modelValue: String,
    withPlaceholder: {
        required: false,
        type: Boolean,
        default: true
    }
})

const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
        <div class="ant-col ant-form-item-label me-auto">
            <label :title="name">{{ name }}</label>
        </div>
        <div class="ant-col ant-form-item-control">
            <div class="ant-form-item-control-input">
                <div class="ant-form-item-control-input-content">
                    <textarea
                        :placeholder="withPlaceholder ? name : ''"
                        :value="modelValue"
                        @input="emit('update:modelValue', $event.target.value)"
                        class="ant-input"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>
