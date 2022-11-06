<script setup>
import TapyInput from "@/Components/Common/TapyInput.vue";
import {ref, watch} from "vue";

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

watch(() => props.content, value => {
    content.value = value.value
    btn_text.value = value.btn_text
    btn_caption.value = value.btn_caption
}, {deep: true})

const submit = () => {
    const emitUpdate = new Promise((resolve, reject) => {
        const btn = {
            alias: props.misc.label.toLowerCase(),
            value: content.value,
            btn_text: btn_text.value,
            btn_caption: btn_caption.value,
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
        }
    })
}

</script>

<template>
    <a-modal
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
                    :with-required-mark="true"
                    v-model="btn_text"
                    type="text"/>
        <tapy-input :label="$root.translate('Button caption')"
                    :placeholder="$root.translate('Button text')"
                    :with-required-mark="true"
                    v-model="btn_caption"
                    type="text"/>
    </a-modal>
</template>
