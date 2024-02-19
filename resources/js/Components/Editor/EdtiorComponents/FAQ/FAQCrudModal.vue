<script setup>
import {ref} from "vue";

const props = defineProps({
    faq: Object,
    modelValue: Boolean
})

const emit = defineEmits(['update:modelValue', 'addFaq'])

let faq = ref({
    question: '',
    answer: ''
})

const submit = () => {
    if(faq.value.question && faq.value.answer) {
        emit('addFaq', faq.value)
        faq.value.question = faq.value.answer = ''
    }
}
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
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
        <form id="item-form" class="ant-form ant-form-vertical"><input type="hidden" id="item-form_id"
                                                                       class="ant-input"
                                                                       value="ac1209f7-47bd-478f-a466-1bd95b1786fe">
            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                <div class="ant-col ant-form-item-label"><label for="item-form_question"
                                                                class="ant-form-item-required"
                                                                title="Вопрос">{{ $root.translate('Question') }}</label></div>
                <div class="ant-col ant-form-item-control">
                    <div class="ant-form-item-control-input">
                        <div class="ant-form-item-control-input-content"><input :placeholder="$root.translate('Question')" type="text"
                                                                                id="item-form_question"
                                                                                class="ant-input"
                                                                                v-model="faq.question"></div>
                    </div>
                </div>
            </div>
            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                <div class="ant-col ant-form-item-label"><label for="item-form_answer"
                                                                class="ant-form-item-required"
                                                                title="Ответ">{{ $root.translate('Answer') }}</label></div>
                <div class="ant-col ant-form-item-control">
                    <div class="ant-form-item-control-input">
                        <div class="ant-form-item-control-input-content"><textarea :placeholder="$root.translate('Answer')" rows="4"
                                                                                   v-model="faq.answer"
                                                                                   id="item-form_answer"
                                                                                   class="ant-input"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </a-modal>
</template>
