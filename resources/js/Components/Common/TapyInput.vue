<script setup>
import {computed, ref} from "vue";
import {EyeInvisibleOutlined, EyeTwoTone} from '@ant-design/icons-vue';

const props = defineProps({
    type: {
        required: false,
        type: String,
        default: 'text'
    },
    placeholder: String,
    modelValue: [String, Number],
    selectValue: String,
    selectPosition: {
        required: false,
        type: Number,
        default: 0
    },
    error: {
        required: false,
        type: String,
        default: ''
    },
    canShowPassword: {
        type: Boolean,
        required: false,
        default: false
    },
    label: {
        type: String,
        required: false,
        default: ''
    },
    withLabel: {
        type: Boolean,
        required: false,
        default: false
    },
    withRequiredMark: {
        type: Boolean,
        required: false,
        default: false
    },
    withOptionalMark: {
        type: Boolean,
        required: false,
        default: false
    },
    selectOptions: {
        type: Array,
        required: false,
        default: []
    },
    info: String
});

let showPassword = ref(false)

const type = computed({
    get() {
        if (props.type === 'password' && props.canShowPassword) {
            return showPassword.value
                ? 'text'
                : 'password'
        }
        return props.type
    },
    set() {
    }
})

const wrapperClass = computed({
    get() {
        if (!!props.selectOptions.length || !!props.selectValue) {
            return 'ant-input-wrapper ant-input-group'
        } else {
            return 'ant-input-affix-wrapper'
        }
    },
    set() {
    }
})

const emit = defineEmits(['update:modelValue', 'update:selectValue'])
</script>

<template>
    <div>
        <div class="ant-row ant-form-item d-flex flex-column"
             :class="[props.error ? 'ant-form-item-with-help ant-form-item-has-error' : '']"
             style="row-gap: 0;">
            <div class="ant-col d-flex ant-form-item-label" v-if="props.withLabel || !!props.label">
                <label
                    class="me-auto"
                    :class="{'ant-form-item-required': props.withRequiredMark}"
                    :title="props.label || props.placeholder">{{
                        props.label || props.placeholder
                    }}
                    <span v-if="props.withOptionalMark" class="Optional">({{ $root.translate('Optional') }})</span>
                    <slot name="afterLabel"/>
                </label>
            </div>
            <div class="ant-col ant-form-item-control">
                <div class="ant-form-item-control-input">
                    <div class="ant-form-item-control-input-content">
                    <span :class="wrapperClass">
                        <span v-if="!!props.selectValue && !props.selectOptions.length && selectPosition" class="ant-input-group-addon">
                            <span style="padding-right: 22px;">{{ props.selectValue }}</span>
                        </span>
                        <span v-if="!!$slots['default']" class="ant-input-prefix">
                            <slot/>
                        </span>
                        <input
                            :placeholder="props.placeholder"
                            class="ant-input"
                            :type="type"
                            :value="props.modelValue"
                            @input="emit('update:modelValue', $event.target.value)">
                        <span class="d-flex align-items-center"
                              v-if="props.type === 'password' && props.canShowPassword">
                            <eye-invisible-outlined
                                class="d-flex align-items-center cursor-pointer transition-3 grey:hover-black"
                                v-if="!showPassword" @click="showPassword = true"/>
                            <eye-two-tone class="d-flex align-items-center cursor-pointer" v-if="showPassword"
                                          @click="showPassword = false"/>
                        </span>
                        <span v-if="!!props.selectOptions.length" class="ant-input-group-addon">
                            <a-select :value="selectValue" @change="emit('update:selectValue', $event)"
                                      style="width: 80px">
                                <a-select-option v-for="option in selectOptions" :value="option">
                                    {{ option }}
                                </a-select-option>
                            </a-select>
                        </span>
                        <span v-if="!!props.selectValue && !props.selectOptions.length && !selectPosition" class="ant-input-group-addon">
                            <span style="padding-right: 22px;">{{ props.selectValue }}</span>
                        </span>
                    </span>
                    </div>
                </div>
                <div v-if="props.error" class="ant-form-item-explain ant-form-item-explain-error animate__animated"
                     :class="props.error ? 'animate__fadeInDown' : 'animate__fadeInDown'">
                    <div role="alert">{{ props.error }}</div>
                </div>
            </div>
        </div>
        <div v-if="props.info" style="display: flex; padding-bottom: 20px; font-size: 15px;"><span class="ant-typography ant-typography-secondary">{{props.info}}</span></div>
    </div>
</template>
