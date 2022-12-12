<script setup>
import {ref} from "vue";
import TapyInput from "@/Components/Common/TapyInput.vue";

const props = defineProps({
    faq: Object,
    modelValue: Boolean
})

const emit = defineEmits(['update:modelValue', 'addFaq'])

let faq = ref({
    caption: '',
    url: ''
})

const submit = () => {
    if(faq.value.url) {
        emit('addFaq', faq.value)
        faq.value.url = faq.value.caption = ''
    }
}
</script>

<template>
    <a-modal
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
        >
        <template #title>
            {{ $root.translate('Editing') }}
        </template>
        <template #footer>
            <button type="button" @click="submit" form="item-form" class="ant-btn ant-btn-primary"><span>{{ $root.translate('Add') }}</span></button>
        </template>
        <div class="ant-row ant-form-item d-flex flex-column" style="row-gap: 0px;">
            <div class="ant-form-item-control-input">
                <div class="ant-form-item-control-input-content">
                    <tapy-input
                        :with-label="true"
                        :placeholder="$root.translate('URL')"
                        v-model="faq.url"/>
                </div>
            </div>
            <div class="ant-form-item-control-input">
                <div class="ant-form-item-control-input-content">
                    <tapy-input
                        :with-label="true"
                        :placeholder="$root.translate('Caption')"
                        v-model="faq.caption"/>
                </div>
            </div>
        </div>
    </a-modal>
</template>
