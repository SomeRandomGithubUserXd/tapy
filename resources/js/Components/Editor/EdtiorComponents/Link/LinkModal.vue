<script setup>
import {computed, getCurrentInstance, onMounted, ref, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue";

const self = getCurrentInstance()

const props = defineProps({
    elementId: Number,
    modelValue: Boolean,
    data: Object,
    theme: {
        required: false,
        type: Object,
        default: {}
    },
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

const getStyleObject = (str) => {
    const regex = /([\w-]*)\s*:\s*([^;]*)/g;
    let match, properties = {};
    while (match = regex.exec(str)) properties[match[1].replace('-', '_')] = match[2].trim();
    return properties
}

const customStyles = ref({})

watch(customStyles, value => {
    editableData.value.custom_elem_style = decompileCustomStyles(customStyles.value)
}, {deep: true})

const rgbToHex = (rgb) => {
    rgb = rgb.replace(')', '').replace('(', '').replace('rgb', '').split(',')
    return '#' + [Number(rgb[0]), Number(rgb[1]), Number(rgb[2])].map(x => {
        const hex = x.toString(16)
        return hex.length === 1 ? '0' + hex : hex
    }).join('')
}

onMounted(() => {
    customStyles.value = compileCustomStyles(editableData.value.custom_styles ? editableData.value.custom_elem_style : props.theme.elementStyle)
})

const compileCustomStyles = (source) => {
    const styles = getStyleObject(source)
    let bg_color = styles.background_color.replace(' !important', '')
    if (bg_color.includes('rgb')) {
        bg_color = rgbToHex(bg_color)
    }
    let color = styles.color.replace(' !important', '')
    if (color.includes('rgb')) {
        color = rgbToHex(color)
    }
    let opacity = styles.opacity
    return {
        background_color: bg_color,
        color: color,
        border_radius: styles.border_radius.replace('px', ''),
        opacity: styles.opacity || 1,
    }
}

const decompileCustomStyles = (source) => {
    const styles = {
        background_color: source.background_color,
        color: source.color,
        border_radius: source.border_radius + 'px',
        opacity: source.opacity
    }
    return Object.entries(styles).map(([k, v]) => `${k.replace('_', '-')}:${v}`).join(';')
}

const emit = defineEmits(['update:modelValue', 'dataChanged'])

let editableData = ref(useForm(props.data))

function submit() {
    if (props.mode) {
        editableData.value.transform((data) => ({
            ...data,
            custom_elem_style: !!editableData.value.custom_styles ? decompileCustomStyles(customStyles.value) : null,
            custom_styles: !!editableData.value.custom_styles,
            alias: 'link'
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
            custom_elem_style: !!editableData.value.custom_styles ? decompileCustomStyles(customStyles.value) : null,
            custom_styles: !!editableData.value.custom_styles,
            props: {
                ...data,
                custom_elem_style: !!editableData.value.custom_styles ? decompileCustomStyles(customStyles.value) : null,
                custom_styles: !!editableData.value.custom_styles,
            },
            alias: 'link'
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
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated np-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
    >
        <template #title>
            {{ $root.translate('Link') }}
        </template>
        <template #footer>
            <edit-modal-footer @needsClosing="emit('update:modelValue', false)" @onOK="submit"
                               :element-id="props.elementId" :mode="props.mode" :with-copy-action="true"/>
        </template>
        <div>
            <div class="EditBlockPreview" style="min-height: 156px;" :style="props.theme.containerStyle">
                <div class="EditBlockPreview-inner">
                    <div class="BlocksWrapper preview single-block css-uz6lmh">
                        <div class="BlocksWrapper-inner css-1x2ymmp" :style="props.theme.blockStyle">
                            <div class="Block preview mobile">
                                <link-component :theme="props.theme" :recursive="false" :data="editableData"/>
                            </div>
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
                    <tapy-input
                        :with-required-mark="true"
                        v-model="editableData.href"
                        :label="$root.translate('Link')"/>
                    <tapy-input
                        v-model="editableData.text"
                        :with-optional-mark="true"
                        :label="$root.translate('Button text')"/>
                    <tapy-input
                        v-model="editableData.caption"
                        :with-optional-mark="true"
                        :label="$root.translate('Button caption')"/>
                    <a-radio-group size="small" v-model:value="editableData.position" style="margin-bottom: 20px;">
                        <a-radio-button value="left">{{ $root.translate('Left') }}</a-radio-button>
                        <a-radio-button value="center">{{ $root.translate('Center') }}</a-radio-button>
                    </a-radio-group>
                    <div class="d-flex align-items-center" style="margin-bottom: 15px">
                        <a-switch v-model:checked="editableData.hide_icon"/>
                        <span class="ms-2">{{ $root.translate('Hide icon') }}</span>
                    </div>
                    <div class="d-flex align-items-center" style="margin-bottom: 15px">
                        <a-switch v-model:checked="editableData.custom_styles"/>
                        <span class="ms-2">{{ $root.translate('Custom styles') }}</span>
                    </div>
                    <div class="d-flex flex-column" v-if="editableData.custom_styles">
                        <div class="d-flex flex-column" style="margin-bottom: 15px">
                            <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                   class="" title="Background type">{{
                                    $root.translate('Background color')
                                }}</label></div>
                            <input type="color" v-model="customStyles.background_color">
                        </div>
                        <div class="d-flex flex-column" style="margin-bottom: 15px">
                            <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                   class="" title="Background type">{{
                                    $root.translate('Color')
                                }}</label></div>
                            <input type="color" v-model="customStyles.color">
                        </div>
                        <div class="d-flex flex-column" style="margin-bottom: 15px">
                            <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                   class="" title="Background type">{{
                                    $root.translate('Border radius')
                                }}</label></div>
                            <a-slider v-model:value="customStyles.border_radius"/>
                        </div>
                        <div class="d-flex flex-column" style="margin-bottom: 15px">
                            <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                   class="" title="Background type">{{
                                    $root.translate('Opacity')
                                }}</label></div>
                            <a-slider :min="0" :max="1" :step="0.01" v-model:value="customStyles.opacity"/>
                        </div>
                    </div>
                </a-tab-pane>
            </a-tabs>
        </div>
    </a-modal>
</template>
