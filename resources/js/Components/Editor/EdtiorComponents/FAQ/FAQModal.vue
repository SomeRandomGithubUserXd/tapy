<script setup>
import FAQCrudModal from "@/Components/Editor/EdtiorComponents/FAQ/FAQCrudModal.vue";
import {computed, getCurrentInstance, ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import draggable from 'vuedraggable'

const props = defineProps({
    modelValue: Boolean,
    elementId: Number,
    faqs: Array,
    mode: {
        required: false,
        default: 1,
        type: Number
    },
    pageUuid: {
        required: false,
        default: 0,
        type: String
    },
})

const self = getCurrentInstance()

let faqsModel = ref(props.faqs)

console.log(props.faqs)

const emit = defineEmits(['update:modelValue', 'dataChanged'])

const submit = () => {
    if(props.mode) {
        Inertia.post(route('page_elements.update_static', props.elementId), {
            faqs: faqsModel.value,
            alias: 'faq'
        }, {
            onError: err => console.log(err),
            onSuccess: () => {
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
                faqsModel.value = []
                emit('update:modelValue', false)
                emit('dataChanged', true)
            }
        })
    } else {
        Inertia.post(route('pages.page_elements.create', props.pageUuid), {
            faqs: faqsModel.value,
            props: {
                faqs: faqsModel.value
            },
            alias: 'faq'
        }, {
            onError: err => console.log(err),
            onSuccess: () => {
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
                faqsModel.value = []
                emit('update:modelValue', false)
                emit('dataChanged', true)
            }
        })
    }
}

const addQuestion = () => {
    showCrudModal.value = true
}

let showCrudModal = ref(false)

const addFaq = (val) => {
    console.log(val)
    faqsModel.value = [...faqsModel.value, {
        ...val,
        order: faqsModel.value + 1
    }]
    console.log(faqsModel.value)
    showCrudModal.value = false
}

const dragOptions = computed({
    get() {
        return {
            animation: 200,
            group: "description",
            disabled: false,
            ghostClass: "ghost"
        };
    },
    set() {
    }
})

const removeFaq = (elem) => {
    faqsModel.value.splice(faqsModel.value.indexOf(elem), 1)
}

watch(faqsModel.value, value => {
}, {deep: true})

let drag = ref(false)
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
        >
        <template #title>
            {{ $root.translate('FAQ') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <f-a-q-crud-modal v-model="showCrudModal" @addFaq="addFaq"/>
        <a-tabs style="padding: 0 26px">
            <a-tab-pane key="1">
                <template #tab><span class="ant-typography">
                    {{ $root.translate('Settings') }}
                </span></template>
                <div class="ant-row ant-form-item" style="row-gap: 0px;">
                    <div class="ant-col ant-form-item-control">
                        <div class="ant-form-item-control-input">
                            <div class="ant-form-item-control-input-content">
                                <draggable
                                    v-model="faqsModel"
                                    tag="ul"
                                    item-key="order_column"
                                    handle=".DragHandler"
                                    v-bind="dragOptions"
                                    :component-data="{tag: 'ul',type: 'transition',name: !drag ? 'flip-list' : null,class: 'ul-flip-list'}"
                                    @start="drag = true"
                                    @end="drag = false">
                                    <template #item="{element}">
                                        <div role="button" tabindex="0"
                                             aria-roledescription="sortable"
                                             aria-describedby="DndDescribedBy-13"
                                             style="position: relative; transition: null 0s ease 0s, visibility 0s ease 0s; z-index: 1; opacity: 1;">
                                            <div class="SortablePanel" style="margin-bottom: 6px;">
                                                <div class="SortablePanel-drag">
                                                    <div class="DragHandler"
                                                         style="height: 100%; background-color: rgb(233, 233, 233); color: rgba(0, 0, 0, 0.85); width: 28px;">
                                                <span role="img" aria-label="menu" class="anticon anticon-menu"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="menu"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M904 160H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0 624H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8zm0-312H120c-4.4 0-8 3.6-8 8v64c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-64c0-4.4-3.6-8-8-8z"></path></svg></span>
                                                    </div>
                                                </div>
                                                <div class="SortablePanel-content clickable">
                                                    <div class="SortablePanel-title">{{ element.question }}</div>
                                                </div>
                                                <div @click="removeFaq(element)" class="SortablePanel-button"
                                                     v-if="faqsModel.length > 1">
                                                    <button type="button"
                                                            class="ant-btn ant-btn-link ant-btn-sm ant-btn-icon-only ant-btn-dangerous">
                                                <span role="img" aria-label="delete" class="anticon anticon-delete"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="delete"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </draggable>
                                <button @click="addQuestion" type="button" class="ant-btn ant-btn-primary"><span
                                    role="img" aria-label="plus"
                                    class="anticon anticon-plus"><svg
                                    style="margin-top: -6px"
                                    viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em"
                                    fill="currentColor" aria-hidden="true"><path
                                    d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path
                                    d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path></svg></span><span>{{
                                        $root.translate('Add question')
                                    }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </a-tab-pane>
        </a-tabs>
    </a-modal>
</template>
