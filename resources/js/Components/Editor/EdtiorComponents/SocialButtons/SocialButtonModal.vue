<script setup>
import TapyInput from "@/Components/Common/TapyInput.vue";
import {ref} from "vue";

const props = defineProps({
    modelValue: Boolean,
    misc: Object,
    elementId: Number
})

const emit = defineEmits(['update:modelValue', 'update:content'])

const content = ref('')

const submit = () => {
    const emitUpdate = new Promise((resolve, reject) => {
        const btn = {
            alias: props.misc.label.toLowerCase(),
            value: content.value
        }
        emit('update:content', btn)
        resolve(btn)
    })
    emitUpdate.then(() => {
        content.value = ''
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
    </a-modal>
</template>
