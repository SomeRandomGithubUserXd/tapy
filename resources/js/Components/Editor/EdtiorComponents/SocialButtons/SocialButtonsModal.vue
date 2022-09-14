<script setup>
import {computed, getCurrentInstance, reactive, ref, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import SocialButtonsComponent from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsComponent.vue";
import ButtonListModal from "@/Components/Editor/EdtiorComponents/SocialButtons/ButtonListModal.vue";
import draggable from 'vuedraggable'
import {capitalizeFirstLetter} from "@/Helpers/Helpers.js";


const self = getCurrentInstance()

const props = defineProps({
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    elementId: Number,
    modelValue: Boolean,
    data: Object,
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

const emit = defineEmits(['update:modelValue', 'dataChanged'])

let editableData = ref(useForm(props.data))

watch(editableData, value => {
}, {deep: true})

watch(props.data, value => {
    if (value.value) {
        editableData.value = useForm(value.value)
        btnsModel.value = value.value.buttons
    } else {

    }
    // console.log(editableData.value)
}, {deep: true})

function submit() {
    if (props.mode) {
        editableData.value.transform((data) => ({
            ...data,
            buttons: btnsModel.value,
            alias: 'social_buttons'
        })).post(route('page_elements.update_static', props.elementId), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    } else {
        editableData.value.transform((data) => ({
            ...data,
            props: {
                ...data,
                buttons: btnsModel.value,
            },
            buttons: btnsModel.value,
            alias: 'social_buttons'
        })).post(route('pages.page_elements.create', props.pageUuid), {
            onError: err => console.log(err),
            onSuccess: () => {
                emit('update:modelValue', false)
                emit('dataChanged', editableData.value)
                message.success(
                    self.parent.ctx.translate('Saved'), 2
                );
            },
        })
    }
}

const addBtn = () => {
    showListModal.value = true
}

let showListModal = ref(false)

const handleDataChange = (btn) => {
    showListModal.value = false
    editableData.value.buttons.push(btn)
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

const btnsModel = ref(props.data.buttons)

const drag = ref(false)

const removeBtn = (btn) => {
    btnsModel.value.splice(btnsModel.value.indexOf(btn), 1)
}
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Social button') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="1" :with-copy-action="true"/>
        </template>
        <button-list-modal @dataChanged="handleDataChange" :element-id="elementId" v-model="showListModal"/>
        <div>
            <div class="EditBlockPreview" style="min-height: 200px;" :style="theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-1e2ocyy">
                        <div class="BlocksWrapper-inner css-1mtpsyn" :style="theme.blockStyle">
                            <social-buttons-component :recursive="false" :data="editableData"/>
                        </div>
                    </div>
                </div>
            </div>
            <a-tabs style="padding: 0 26px">
                <a-tab-pane key="1">
                    <template #tab><span class="ant-typography"
                                         :class="{'ant-typography-danger': !!editableData?.errors.length}">
                    {{ $root.translate('Settings') }}
                </span></template>
                    <div style="display: block; margin-bottom: 20px;">
                        <div data-show="true" class="ant-alert ant-alert-warning" role="alert"><span role="img"
                                                                                                     aria-label="exclamation-circle"
                                                                                                     class="anticon anticon-exclamation-circle ant-alert-icon"><svg
                            viewBox="64 64 896 896" focusable="false" data-icon="exclamation-circle" width="1em"
                            height="1em" fill="currentColor" aria-hidden="true"><path
                            d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm-32 232c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v272c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V296zm32 440a48.01 48.01 0 010-96 48.01 48.01 0 010 96z"></path></svg></span>
                            <div class="ant-alert-content">
                                <div class="ant-alert-message">
                                    {{ $root.translate('You can add multiple buttons to this block') }}
                                </div>
                                <div class="ant-alert-description"></div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <draggable
                            v-model="btnsModel"
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
                                            <div class="SortablePanel-title">{{
                                                    capitalizeFirstLetter(element.alias)
                                                }}
                                            </div>
                                        </div>
                                        <div @click="removeBtn(element)" class="SortablePanel-button"
                                             v-if="btnsModel.length > 1">
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
                    </div>
                    <div style="display: block; margin-bottom: 20px;">
                        <button @click="addBtn" type="button" class="d-flex align-items-center ant-btn ant-btn-primary"
                                ant-click-animating-without-extra-node="false"><span role="img" aria-label="plus"
                                                                                     class="anticon anticon-plus"><svg
                            viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em"
                            fill="currentColor" aria-hidden="true"><path
                            d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path
                            d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path></svg></span><span>{{
                                $root.translate('Add another button')
                            }}</span>
                        </button>
                    </div>
                    <div>
                        <p>{{ $root.translate('View') }}</p>
                        <a-radio-group class="w-100" size="small" v-model:value="editableData.view"
                                       style="margin-bottom: 20px;">
                            <div class="d-flex justify-content-sm-between w-100">
                                <div class="d-flex flex-column">
                                    <a-radio value="circle">{{ $root.translate('Circle') }}</a-radio>
                                    <a-radio value="square">{{ $root.translate('Square') }}</a-radio>
                                    <a-radio value="apps">{{ $root.translate('Apps') }}</a-radio>
                                </div>
                                <div class="d-flex flex-column">
                                    <a-radio value="grid">{{ $root.translate('Grid') }}</a-radio>
                                    <a-radio value="list">{{ $root.translate('List') }}</a-radio>
                                    <a-radio value="list:c">{{ $root.translate('List (label centered)') }}</a-radio>
                                </div>
                            </div>
                        </a-radio-group>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
