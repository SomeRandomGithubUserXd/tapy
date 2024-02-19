<script setup>
import {computed, getCurrentInstance, ref} from "vue";
import {message} from "ant-design-vue";

const self = getCurrentInstance()

const props = defineProps({
    userIsPro: Boolean,
    modelValue: Boolean,
})

const emit = defineEmits(['update:modelValue', 'showSettings'])
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated np-modal"
        :footer="false"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        :ok-text="$root.translate('Upgrade to PRO')"
        @change="emit('update:modelValue', false)"
    >
        <template #title>
            {{ $root.translate('Share page') }}
        </template>
        <div class="ant-modal-confirm-body-wrapper">
            <div class="ant-modal-confirm-body"><span role="img" aria-label="exclamation-circle"
                                                      class="anticon anticon-exclamation-circle"><svg
                viewBox="64 64 896 896" focusable="false" data-icon="exclamation-circle" width="1em" height="1em"
                fill="currentColor" aria-hidden="true"><path
                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path
                d="M464 688a48 48 0 1096 0 48 48 0 10-96 0zm24-112h48c4.4 0 8-3.6 8-8V296c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8z"></path></svg></span>
                <p class="ant-modal-confirm-title" v-if="props.userIsPro">
                    {{ $root.translate('Apply the new theme?') }}
                </p>
                <p class="ant-modal-confirm-title" v-else>
                    {{ $root.translate('We saved your theme, but you can apply it only in PRO plan. Upgrade now?') }}
                </p>
                <div class="ant-modal-confirm-content"></div>
            </div>
        </div>
    </a-modal>
</template>
