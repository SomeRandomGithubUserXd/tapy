<script setup>
import TapyInput from "@/Components/Common/TapyInput.vue";
import {computed, ref, watch} from "vue";

const props = defineProps({
    modelValue: Boolean,
    misc: Object,
    content: Object,
    elementId: Number,
    mode: Number
})

const emit = defineEmits(['update:modelValue', 'update:content', 'editingStuff'])

const content = ref(props.content.value)
const btn_text = ref(props.content.btn_text)
const btn_caption = ref(props.content.btn_caption)
const btn_extra = ref(props.content.btn_extra)
const btn_sum = ref(props.content.btn_sum)

watch(() => props.content, value => {
    content.value = value.value
    btn_text.value = value.btn_text
    btn_caption.value = value.btn_caption
    btn_extra.value = value.btn_extra
    btn_sum.value = value.btn_sum
}, {deep: true})

const submit = () => {
    const emitUpdate = new Promise((resolve, reject) => {
        const btn = {
            alias: props.misc.label.toLowerCase(),
            value: content.value,
            btn_text: btn_text.value,
            btn_caption: btn_caption.value,
            btn_extra: btn_extra.value,
            btn_sum: btn_sum.value,
        }
        emit('update:content', btn)
        emit('editingStuff', btn)
        resolve(btn)
    })
    emitUpdate.then(() => {
        if (props.mode) {
            content.value = ''
            btn_text.value = ''
            btn_caption.value = ''
            btn_extra.value = ''
            btn_sum.value = ''
        }
    })
}

const extraText = computed({
    get: () => {
        let extra = ''
        switch (props.misc.label) {
            case 'SMS':
                extra = 'Message'
                break
            case 'Whatsapp':
                extra = 'Message'
                break
            case 'Telegram':
                extra = 'Message'
                break
        }
        return extra
    },
    set: () => {

    }
})

</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Edit button') }}
        </template>
        <tapy-input :label="$root.translate(props.misc.inputLabel)"
                    :placeholder="$root.translate(props.misc.placeholder)"
                    :with-required-mark="true"
                    v-model="content"
                    type="text"/>
        <tapy-input :label="$root.translate('Button text')"
                    :placeholder="$root.translate('Button text')"
                    :with-required-mark="false"
                    v-model="btn_text"
                    type="text"/>
        <tapy-input :label="$root.translate('Button caption')"
                    :placeholder="$root.translate('Button caption')"
                    :with-required-mark="false"
                    v-model="btn_caption"
                    type="text"/>
        <tapy-input
            v-if="!!extraText"
            :label="$root.translate(extraText)"
            :placeholder="$root.translate(extraText)"
            :with-required-mark="false"
            v-model="btn_extra"
            type="text"/>
        <tapy-input
            v-if="props.misc.label === 'SBER'"
            :label="$root.translate('Sum')"
            :placeholder="$root.translate('Sum')"
            :with-required-mark="false"
            v-model="btn_sum"
            type="text"/>
    </a-modal>
</template>
