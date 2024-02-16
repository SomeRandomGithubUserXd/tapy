<script setup>
import Vue3ColorPicker from "vue3-colorpicker";
import "vue3-colorpicker/style.css";
import Authenticated from "@/Layouts/Authenticated.vue";
import SettingsModal from "@/Components/Editor/SettingsModal.vue";
import {computed, createVNode, getCurrentInstance, ref, watch} from "vue";
import SlideUpDown from 'vue3-slide-up-down'
import {Swiper, SwiperSlide, useSwiper} from 'swiper/vue';
import 'swiper/css';
import ThemeBlock from "@/Components/Editor/ThemeBlock.vue";
import {Inertia} from "@inertiajs/inertia";
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue";
import HeaderComponent from "@/Components/Editor/EdtiorComponents/Header/HeaderComponent.vue";
import SocialButtonsComponent from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsComponent.vue";
import {message, Modal} from "ant-design-vue";
import AddBlockModal from "@/Components/Editor/AddBlockModal.vue";
import ShareModal from "@/Components/Editor/ShareModal.vue";
import TextComponent from "@/Components/Editor/EdtiorComponents/Text/TextComponent.vue";
import FAQComponent from "@/Components/Editor/EdtiorComponents/FAQ/FAQComponent.vue";
import ProductsComponent from "@/Components/Editor/EdtiorComponents/Products/ProductsComponent.vue";
import LinkModal from "@/Components/Editor/EdtiorComponents/Link/LinkModal.vue";
import AnalyticsModal from "@/Components/Editor/AnalyticsModal.vue";
import ATCComponent from "@/Components/Editor/EdtiorComponents/ATC/ATCComponent.vue"
import ImageComponent from "@/Components/Editor/EdtiorComponents/Image/ImageComponent.vue"
import SocialButton from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButton.vue";
import SocialButtonsModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsModal.vue";
import draggable from 'vuedraggable'
import HTMLComponent from "@/Components/Editor/EdtiorComponents/HTML/HTMLComponent.vue"
import VideoComponent from "@/Components/Editor/EdtiorComponents/Video/VideoComponent.vue"
import SeparatorComponent from "@/Components/Editor/EdtiorComponents/Separator/SeparatorComponent.vue"
import ImageGallery from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryComponent.vue"
import VideoGallery from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryComponent.vue"
import CounterpartyCardComponent from "@/Components/Editor/EdtiorComponents/Text/CounterpartyCardComponent.vue"
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";
import {usePage} from "@inertiajs/inertia-vue3";
import collect from "collect.js";
import ThemeCreatedAlert from "@/Components/Editor/ThemeCreatedAlert.vue";
import {ExclamationCircleOutlined, CloseOutlined} from "@ant-design/icons-vue";
import UpgradeToProModal from "@/Components/Misc/UpgradeToProModal.vue";

const components = {
    profile: Profile,
    video: VideoComponent,
    image: ImageComponent,
    link: LinkComponent,
    header: HeaderComponent,
    html: HTMLComponent,
    atc: ATCComponent,
    text: TextComponent,
    faq: FAQComponent,
    social_buttons: SocialButtonsComponent,
    products: ProductsComponent,
    separator: SeparatorComponent,
    image_gallery: ImageGallery,
    video_gallery: VideoGallery,
    counterparty: CounterpartyCardComponent,
}

const pro_components = ['html']

const selectedThemeIsCustom = ref(false)

const self = getCurrentInstance()

let slidesPerView = 8
let spaceBetween = 50
if (!window.matchMedia("(min-width: 768px)").matches) {
    slidesPerView = 3
    spaceBetween = 30
}

const showLinkModal = ref(false)

function addLink() {
    showLinkModal.value = true
}

let editor = ref([]);

const props = defineProps({
    page: Object,
    chart: Object,
    visits: Object,
    link_clicks: Object,
    themes: Array,
    user_products: Array,
})

let settingsModal = ref(false)

let analyticsModal = ref(false)

let themeSwiper = ref(null)

let currentThemeKey = ref(props.page.theme[0].id)

const themeSwiperReady = (val) => {
    selectedThemeIsCustom.value = !!collect(usePage().props.value.themes).where('id', '==', currentThemeKey.value).first().user_id
};

const onSlideChange = (val) => {
    const id = document.querySelectorAll('[data-theme-id]')[val.activeIndex].getAttribute('data-theme-id')
    currentThemeKey.value = id
    selectedThemeIsCustom.value = !!collect(usePage().props.value.themes).where('id', '==', id).first().user_id
};

let showThemePicker = ref(false)

function triggerThemePicker() {
    showThemePicker.value = !showThemePicker.value
}

const refreshStyles = ref(0)

const showUpgradeModal = ref(false)

const saveTheme = () => {
    if(selectedThemeIsCustom.value && !usePage().props.value.auth.user.is_pro) {
        showUpgradeModal.value = true
        currentThemeKey.value = 1
        return
    }
    Inertia.put(route('pages.update.theme', props.page.uuid), {theme_key: currentThemeKey.value}, {
        onSuccess: () => {
            showThemePicker.value = false
            message.success(
                self.parent.ctx.translate('Saved'), 2
            );
        },
        onError: (err) => console.log(err)
    });
}
const editingTheme = ref(null)
const themeStyles = computed({
    get() {
        if (editingTheme.value) {
            return editingTheme.value
        }
        if (showThemeConstructor.value) {
            return customTheme.value
        }
        if (showThemePicker.value) {
            return collect(props.themes).where('id', '==', currentThemeKey.value).first()
        }
        return props.page.theme[0];
    },
    set() {
    }
})

let drag = ref(false)

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

const elements = ref(props.page.page_elements)

const reorderElements = () => {
    axios.post(route('pages.page_elements.reorder', props.page.uuid), {
        objects: elements.value
    }).then(value => {
        message.success(
            self.parent.ctx.translate('Saved'), 2
        );
    })
}

let showAddBlockModal = ref(false)
let showShareModal = ref(false)

watch(props, value => {
    elements.value = value.page.page_elements
}, {deep: true})


const showSettingsThroughShare = () => {
    showShareModal.value = false
    settingsModal.value = true
}

const showThemeConstructor = ref(false)

const themeConstructor = () => {
    showThemeConstructor.value = true
    showThemePicker.value = false
}

function onUploadPic(val) {
    customThemeImage.value = val
}

function removePic() {
    customThemeImage.value = null
}

const customThemeProps = ref({
    background_color_type: '',
    background_image: null,
    background_type: 'cover',
    background_color: '',
    background_color_gr1: '',
    background_color_gr2: '',
    wrapper_color_type: '',
    wrapper_color: '',
    wrapper_color_gr1: '',
    wrapper_color_gr2: '',
    wrapper_radius: 15,
    text_color: '#000000',
    link_bg_color: 'rgb(96, 104, 138)',
    link_color: '#ffffff',
    link_border_radius: 10,
    link_opacity: 90
})

const getStyleObject = (str) => {
    const regex = /([\w-]*)\s*:\s*([^;]*)/g;
    let match, properties = {};
    while (match = regex.exec(str)) properties[match[1].replace('-', '_')] = match[2].trim();
    return properties
}

const applyOverlayStyle = (style, theme) => {
    theme.value.overlayStyle = Object.entries(style).map(([k, v]) => `${k.replace('_', '-')}:${v}`).join(';')
}

const applyContainerStyle = (style, theme) => {
    theme.value.containerStyle = Object.entries(style).map(([k, v]) => `${k.replace('_', '-')}:${v}`).join(';')
}

const applyWrapperStyle = (style, theme) => {
    theme.value.blockStyle = Object.entries(style).map(([k, v]) => `${k.replace('_', '-')}:${v}`).join(';')
}

const applyelementStyle = (style, theme) => {
    theme.value.elementStyle = Object.entries(style).map(([k, v]) => `${k.replace('_', '-')}:${v}`).join(';')
}

const hexToRgb = hex =>
    hex.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i
        , (m, r, g, b) => '#' + r + r + g + g + b + b)
        .substring(1).match(/.{2}/g)
        .map(x => parseInt(x, 16))

const doThemeStuff = (value) => {
    let themeRef = customTheme
    if(editingTheme.value) {
        themeRef = editingTheme
    }
    const overlayStyle = getStyleObject(themeRef.value.overlayStyle)
    const containerStyle = getStyleObject(themeRef.value.containerStyle)
    const wrapperStyle = getStyleObject(themeRef.value.blockStyle)
    const elementStyle = getStyleObject(themeRef.value.elementStyle)

    overlayStyle.background_image = value.background_image
    overlayStyle.background_size = value.background_type

    let color = '';
    if (value.background_color_type === 'plain') {
        containerStyle.background_image = 'url()'
        color = hexToRgb(value.background_color || '#000000')
        color = `rgb(${color[0] || 0},${color[1] || 0},${color[2] || 0})`
        if (customThemeImage.value) {
            color = color
                .replace('rgb', 'rgba')
                .replace(')', ',0.5)')
        }
        containerStyle.background_color = color
    } else if (value.background_color_type === 'gradient') {
        containerStyle.background_color = 'rgba(0,0,0,0)'
        const col1 = hexToRgb(value.background_color_gr1 || '#000000')
        const col2 = hexToRgb(value.background_color_gr2 || '#000000')
        color = `linear-gradient(rgba(${col1[0] || 0},${col1[1] || 0},${col1[2] || 0}, ${customThemeImage.value ? '0.5' : '1'}), rgba(${col2[0] || 0},${col2[1] || 0},${col2[2] || 0}, ${customThemeImage.value ? '0.5' : '1'}));`
        containerStyle.background_image = color
    } else if (value.background_color_type === 'no') {
        containerStyle.background_color = 'rgba(0,0,0,0)'
        containerStyle.background_image = 'url()'
    }

    let wrapper_color = '';
    if (value.wrapper_color_type === 'plain') {
        wrapperStyle.background_image = 'url()'
        wrapper_color = hexToRgb(value.wrapper_color || '#000000')
        wrapper_color = `rgb(${wrapper_color[0] || 0},${wrapper_color[1] || 0},${wrapper_color[2] || 0})`
        wrapperStyle.background_color = wrapper_color
    } else if (value.wrapper_color_type === 'gradient') {
        wrapperStyle.background_color = 'rgba(0,0,0,0)'
        const col1 = hexToRgb(value.wrapper_color_gr1 || '#000000')
        const col2 = hexToRgb(value.wrapper_color_gr2 || '#000000')
        wrapper_color = `linear-gradient(rgba(${col1[0] || 0},${col1[1] || 0},${col1[2] || 0}, 1), rgba(${col2[0] || 0},${col2[1] || 0},${col2[2] || 0}, 1));`
        wrapperStyle.background_image = wrapper_color
    } else if (value.wrapper_color_type === 'no') {
        wrapperStyle.background_color = 'rgba(0,0,0,0)'
        wrapperStyle.background_image = 'url()'
    }
    wrapperStyle.border_radius = value.wrapper_radius + 'px'
    wrapperStyle.color = value.text_color + '!important'

    elementStyle.background_color = value.link_bg_color
    elementStyle.color = value.link_color + '!important'
    elementStyle.border_radius = value.link_border_radius + 'px'
    if (value.link_opacity !== 100) {
        elementStyle.opacity = '0.' + value.link_opacity
    } else {
        elementStyle.opacity = 1
    }


    applyOverlayStyle(overlayStyle, themeRef)
    applyContainerStyle(containerStyle, themeRef)
    applyWrapperStyle(wrapperStyle, themeRef)
    applyelementStyle(elementStyle, themeRef)
}

watch(customThemeProps, (value, previous) => {
    doThemeStuff(value)
}, {deep: true})

const customThemeImage = ref(null)

watch(customThemeImage, (value, previous) => {
    if (value) {
        Inertia.post(route('upload-temp-image'), {
            file: value
        }, {
            onSuccess: () => {
                customThemeProps.value.background_image = `url(${usePage().props.value.flash})`
            }
        })
    } else {
        customThemeProps.value.background_color = ''
        customThemeProps.value.background_image = 'url()'
    }
}, {deep: true})

const initialSlide = usePage().props.value.current_theme_key


const customTheme = ref({
    overlayStyle: 'background-image: url();background-size:cover;',
    containerStyle: 'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: ;',
    blockStyle: 'background-color: rgb(255, 255, 255);border-radius: 15px;color: black;background-image: url();',
    elementStyle: 'background-color: rgb(24, 26, 34); opacity: 0.9; border: 2px none; border-radius: 10px;color: white !important;',
})

watch(customTheme, value => {
    // console.log(value)
}, {deep: true})

const save = () => {
    if(editingTheme.value) {
        showThemeConstructor.value = false
    }
    Inertia.post(route('add-theme'), {
        theme: customTheme.value
    }, {
        onSuccess: () => {
            showThemeConstructor.value = false
            let content = self.parent.ctx.translate('We saved your theme, but you can apply it only in PRO plan. Upgrade now?')
            let okText = self.parent.ctx.translate('Upgrade plan')
            let onOk = () => {
                showUpgradeModal.value = true
            }
            if (usePage().props.value.auth.user.is_pro) {
                content = self.parent.ctx.translate('Apply the new theme?')
                okText = self.parent.ctx.translate('Yes')
                onOk = () => {
                    currentThemeKey.value = usePage().props.value.flash
                    saveTheme()
                }
            }
            Modal.confirm({
                title: content,
                icon: createVNode(ExclamationCircleOutlined),
                okText,
                cancelText: self.parent.ctx.translate('Cancel'),
                onOk: onOk
            });
        }
    })
}

const destroy = () => {

}

const deleteTheme = () => {
    Inertia.delete(route('destroy-theme', currentThemeKey.value), {
        onSuccess: () => {
            currentThemeKey.value = 1
        }
    })
}

watch(showThemeConstructor, value => {
    if(value === false) editingTheme.value = null
})
</script>

<template>
    <Authenticated>
        <template #header>{{ $root.translate('Editor') }}</template>
        <upgrade-to-pro-modal v-model="showUpgradeModal"/>
        <settings-modal v-model="settingsModal"
                        :page="$page.props.page"
                        :remove-text="$root.translate('Are you sure?')"
                        :ok-text="$root.translate('Yes')"
                        :cancel-text="$root.translate('Cancel')"/>
        <analytics-modal v-model="analyticsModal"
                         :page="$page.props.page"
                         :link_clicks="props.link_clicks"
                         :visits="props.visits"
                         :chart_stuff="props.chart"/>
        <add-block-modal
            :theme="themeStyles"
            :user-products="props.user_products"
            v-model="showAddBlockModal"
            :page-uuid="$page.props.page.uuid"/>
        <share-modal :qr-code="props.page.qr_code" :page-link="props.page.link" @showSettings="showSettingsThroughShare"
                     v-model="showShareModal"/>
        <link-modal
            :theme="themeStyles"
            :recursive="false"
            :page-uuid="props.page.uuid"
            :data='{"href":"","text":"","caption":"","position":"center","hide_icon":false}'
            v-model="showLinkModal"
            :mode="0"
        />
        <div
            :class="showThemeConstructor ? 'animate__zoomIn' : 'animate__zoomOut'"
            :hidden="!showThemeConstructor"
            class="d-flex flex-column theme-editor-responsive"
            style="position:fixed;right: 0;top: 0;height: 100vh;background: white;box-shadow: 0 0 10px rgba(0,0,0,0.5);z-index: 9999">
            <div style="height: 5%" class="flex items-center justify-between p-3 bg-white align-items-center">
                <div style="font-size: 1.125rem">{{ $root.translate('Theme editor') }}</div>
                <div style="margin-left: auto" class="ml-auto flex gap-x-1">
                    <div class="d-flex justify-content-center align-items-center" @click="showThemeConstructor = false"><span
                        role="img"
                        aria-label="close"
                        class="anticon anticon-close"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path></svg></span>
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto bg-slate-100 px-3 py-2" style="background: rgb(241 245 249);height: 90%">
                <div data-show="true" class="ant-alert ant-alert-error ant-alert-no-icon mb-2" role="alert">
                    <div class="ant-alert-content">
                        <div class="ant-alert-message">
                            {{ $root.translate('Own themes are available only in the PRO plan.') }}
                        </div>
                        <div class="ant-alert-description"></div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <a-collapse :accordion="true">
                        <a-collapse-panel key="1" :header="$root.translate('Background')">
                            <single-image-uploader
                                :rounded-preview="true"
                                @onUpload="onUploadPic"
                                @onRemove="removePic"
                                v-model="customThemeImage"
                                :src="null">
                                <template #label>
                                    <label>{{ $root.translate('Background image') }}</label>
                                </template>
                            </single-image-uploader>
                            <div v-if="customThemeImage"
                                 class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Background type')
                                    }}</label></div>
                                <a-radio-group size="small" v-model:value="customThemeProps.background_type"
                                               style="margin-bottom: 20px;">
                                    <a-radio-button value="cover">{{ $root.translate('Stretch') }}</a-radio-button>
                                    <a-radio-button value="auto">{{ $root.translate('Repeat') }}</a-radio-button>
                                </a-radio-group>
                            </div>
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Background color')
                                    }}</label></div>
                                <a-radio-group size="small" v-model:value="customThemeProps.background_color_type"
                                               style="margin-bottom: 20px;">
                                    <a-radio-button value="no">{{ $root.translate('No color') }}</a-radio-button>
                                    <a-radio-button value="plain">{{ $root.translate('Color') }}</a-radio-button>
                                    <a-radio-button value="gradient">{{ $root.translate('Gradient') }}</a-radio-button>
                                </a-radio-group>
                                <div v-if="customThemeProps.background_color_type === 'plain'">
                                    <input type="color" v-model="customThemeProps.background_color">
                                </div>
                                <div v-if="customThemeProps.background_color_type === 'gradient'">
                                    <input type="color" v-model="customThemeProps.background_color_gr1">
                                    <input type="color" v-model="customThemeProps.background_color_gr2">
                                </div>
                            </div>
                        </a-collapse-panel>
                        <a-collapse-panel key="2" :header="$root.translate('Wrapper')">
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Wrapper color')
                                    }}</label></div>
                                <a-radio-group size="small" v-model:value="customThemeProps.wrapper_color_type"
                                               style="margin-bottom: 20px;">
                                    <a-radio-button value="no">{{ $root.translate('No color') }}</a-radio-button>
                                    <a-radio-button value="plain">{{ $root.translate('Color') }}</a-radio-button>
                                    <a-radio-button value="gradient">{{ $root.translate('Gradient') }}</a-radio-button>
                                </a-radio-group>
                                <div v-if="customThemeProps.wrapper_color_type === 'plain'">
                                    <input type="color" v-model="customThemeProps.wrapper_color">
                                </div>
                                <div v-if="customThemeProps.wrapper_color_type === 'gradient'">
                                    <input type="color" v-model="customThemeProps.wrapper_color_gr1">
                                    <input type="color" v-model="customThemeProps.wrapper_color_gr2">
                                </div>
                            </div>
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Wrapper border radius')
                                    }}</label></div>
                                <a-slider v-model:value="customThemeProps.wrapper_radius"/>
                            </div>
                        </a-collapse-panel>
                        <a-collapse-panel key="3" :header="$root.translate('Text')">
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Text color')
                                    }}</label></div>
                                <div>
                                    <input type="color" v-model="customThemeProps.text_color">
                                </div>
                            </div>
                        </a-collapse-panel>
                        <a-collapse-panel key="4" :header="$root.translate('Links')">
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Link background')
                                    }}</label></div>
                                <div>
                                    <input type="color" v-model="customThemeProps.link_bg_color">
                                </div>
                            </div>
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Link color')
                                    }}</label></div>
                                <div>
                                    <input type="color" v-model="customThemeProps.link_color">
                                </div>
                            </div>
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Link border radius')
                                    }}</label></div>
                                <a-slider v-model:value="customThemeProps.link_border_radius"/>
                            </div>
                            <div class="d-flex flex-column ant-row ant-form-item" style="row-gap: 0px;margin: 0">
                                <div class="ant-col ant-form-item-label d-flex"><label for="update-page_backgroundSize"
                                                                                       class="" title="Background type">{{
                                        $root.translate('Link opacity')
                                    }}</label></div>
                                <a-slider v-model:value="customThemeProps.link_opacity"/>
                            </div>
                        </a-collapse-panel>
                    </a-collapse>
                </div>
            </div>
            <div style="height: 5%" class="flex items-center justify-between p-3 bg-white">
                <div class="d-flex w-100">
                    <a-dropdown v-if="true" placement="topLeft" class="me-auto" :trigger="['click']">
                        <a class="ant-dropdown-link" @click.prevent>
                            <div class="ant-col">
<!--                                <button type="button" class="ant-btn ant-dropdown-trigger d-flex align-items-center"-->
<!--                                        ant-click-animating-without-extra-node="false"><span role="img"-->
<!--                                                                                             aria-label="more"-->
<!--                                                                                             class="anticon anticon-more"><svg-->
<!--                                    viewBox="64 64 896 896" focusable="false" data-icon="more" width="1em" height="1em"-->
<!--                                    fill="currentColor" aria-hidden="true"><path-->
<!--                                    d="M456 231a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0z"></path></svg></span><span>{{-->
<!--                                        $root.translate('Actions')-->
<!--                                    }}</span>-->
<!--                                </button>-->
                            </div>
                        </a>
                        <template #overlay>
                            <a-menu>
                                <a-menu-item class="ant-dropdown-menu-item ant-dropdown-menu-item-danger"
                                             @click="destroy">
                                    <div class="d-flex align-items-center">
                                  <span role="img"
                                        aria-label="delete"
                                        class="anticon anticon-delete ant-dropdown-menu-item-icon"><svg
                                      viewBox="64 64 896 896" focusable="false" data-icon="delete" width="1em"
                                      height="1em" fill="currentColor" aria-hidden="true"><path
                                      d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path></svg></span><span
                                        class="ant-dropdown-menu-title-content">{{ $root.translate('Delete') }}</span>
                                    </div>
                                </a-menu-item>
                            </a-menu>
                        </template>
                    </a-dropdown>
                    <a-button key="submit" class="ms-auto" type="primary" @click="save">
                        {{ $root.translate('Save') }}
                    </a-button>
                </div>
            </div>
        </div>
        <div class="Content EditorPage-content">
            <div class="Content-inner" style="max-width: 900px;">
                <div style="display: block; margin-bottom: 20px;">
                    <div class="ant-row" style="row-gap: 0px;">
                        <div class="ant-col ant-col-12">
                            <div class="ant-space ant-space-horizontal ant-space-align-center" style="gap: 8px;">
                                <div class="ant-space-item" style="">
                                    <button type="button" class="ant-btn ant-btn-icon-only"
                                            @click="settingsModal = true"
                                            ant-click-animating-without-extra-node="false"><span role="img"
                                                                                                 aria-label="setting"
                                                                                                 class="anticon anticon-setting"><svg
                                        viewBox="64 64 896 896" focusable="false" data-icon="setting" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true"><path
                                        d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z"></path></svg></span>
                                    </button>
                                </div>
                                <div class="ant-space-item" style="">
                                    <button type="button"
                                            @click="analyticsModal = true"
                                            class="ant-btn ant-btn-icon-only"><span role="img"
                                                                                    aria-label="line-chart"
                                                                                    class="anticon anticon-line-chart"><svg
                                        viewBox="64 64 896 896" focusable="false" data-icon="line-chart" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true"><path
                                        d="M888 792H200V168c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v688c0 4.4 3.6 8 8 8h752c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zM305.8 637.7c3.1 3.1 8.1 3.1 11.3 0l138.3-137.6L583 628.5c3.1 3.1 8.2 3.1 11.3 0l275.4-275.3c3.1-3.1 3.1-8.2 0-11.3l-39.6-39.6a8.03 8.03 0 00-11.3 0l-230 229.9L461.4 404a8.03 8.03 0 00-11.3 0L266.3 586.7a8.03 8.03 0 000 11.3l39.5 39.7z"></path></svg></span>
                                    </button>
                                </div>
                                <div class="ant-space-item">
                                    <button @click="triggerThemePicker" type="button"
                                            class="ant-btn ant-btn-icon-only EditorPage-theme-button"><span
                                        role="img" aria-label="bg-colors" class="anticon anticon-bg-colors"><svg
                                        viewBox="64 64 896 896" focusable="false" data-icon="bg-colors" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true"><path
                                        d="M766.4 744.3c43.7 0 79.4-36.2 79.4-80.5 0-53.5-79.4-140.8-79.4-140.8S687 610.3 687 663.8c0 44.3 35.7 80.5 79.4 80.5zm-377.1-44.1c7.1 7.1 18.6 7.1 25.6 0l256.1-256c7.1-7.1 7.1-18.6 0-25.6l-256-256c-.6-.6-1.3-1.2-2-1.7l-78.2-78.2a9.11 9.11 0 00-12.8 0l-48 48a9.11 9.11 0 000 12.8l67.2 67.2-207.8 207.9c-7.1 7.1-7.1 18.6 0 25.6l255.9 256zm12.9-448.6l178.9 178.9H223.4l178.8-178.9zM904 816H120c-4.4 0-8 3.6-8 8v80c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-80c0-4.4-3.6-8-8-8z"></path></svg></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="ant-col ant-col-12">
                            <div @click="showShareModal = true" style="display: flex; justify-content: flex-end;">
                                <button type="button" class="ant-btn ant-btn-primary"><span role="img"
                                                                                            aria-label="share-alt"
                                                                                            class="anticon anticon-share-alt"><svg
                                    style="margin-top: -6px"
                                    viewBox="64 64 896 896" focusable="false" data-icon="share-alt" width="1em"
                                    height="1em"
                                    fill="currentColor" aria-hidden="true"><path
                                    d="M752 664c-28.5 0-54.8 10-75.4 26.7L469.4 540.8a160.68 160.68 0 000-57.6l207.2-149.9C697.2 350 723.5 360 752 360c66.2 0 120-53.8 120-120s-53.8-120-120-120-120 53.8-120 120c0 11.6 1.6 22.7 4.7 33.3L439.9 415.8C410.7 377.1 364.3 352 312 352c-88.4 0-160 71.6-160 160s71.6 160 160 160c52.3 0 98.7-25.1 127.9-63.8l196.8 142.5c-3.1 10.6-4.7 21.8-4.7 33.3 0 66.2 53.8 120 120 120s120-53.8 120-120-53.8-120-120-120zm0-476c28.7 0 52 23.3 52 52s-23.3 52-52 52-52-23.3-52-52 23.3-52 52-52zM312 600c-48.5 0-88-39.5-88-88s39.5-88 88-88 88 39.5 88 88-39.5 88-88 88zm440 236c-28.7 0-52-23.3-52-52s23.3-52 52-52 52 23.3 52 52-23.3 52-52 52z"></path></svg></span><span>{{
                                        $root.translate('Share')
                                    }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <slide-up-down v-model="showThemePicker" :duration="200">
                    <div class="ant-collapse ant-collapse-icon-position-left ant-collapse-ghost ThemePicker">
                        <div class="ant-collapse-item ant-collapse-item-active">
                            <div class="ant-collapse-header" role="button" tabindex="0" aria-expanded="true"><span
                                role="img" aria-label="right" class="anticon anticon-right ant-collapse-arrow"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true" style="transform: rotate(90deg);"><path
                                d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z"></path></svg></span>
                            </div>
                            <div class="ant-collapse-content ant-collapse-content-active" style="">
                                <div class="ant-collapse-content-box">
                                    <div class="ThemePicker-wrapper">
                                        <button @click="themeConstructor"
                                                style="position: absolute;left: 15px;top: 15px"
                                                class="ant-btn ant-btn-primary ant-btn-sm">
                                            {{ $root.translate('Add theme') }}
                                        </button>
                                        <button @click="triggerThemePicker" class="ThemePicker-close"><span role="img"
                                                                                                            aria-label="close"
                                                                                                            class="anticon anticon-close"><svg
                                            viewBox="64 64 896 896" focusable="false" data-icon="close" width="1em"
                                            height="1em" fill="currentColor" aria-hidden="true"><path
                                            d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z"></path></svg></span>
                                        </button>
                                        <swiper
                                            style="margin-top: 15px"
                                            :initial-slide="initialSlide"
                                            ref="themeSwiper"
                                            :slides-per-view="slidesPerView"
                                            :spaceBetween="spaceBetween"
                                            :centeredSlides="true"
                                            :slide-to-clicked-slide="true"
                                            @swiper="themeSwiperReady"
                                            @slideChange="onSlideChange">
                                            <swiper-slide v-for="theme in $page.props.themes"
                                                          :data-theme-id="theme.id"
                                                          class="d-flex justify-content-center cursor-drag">
                                                <theme-block :is-pro="!!theme.user_id" :theme="theme"/>
                                            </swiper-slide>
                                        </swiper>
                                        <div style="display: flex; justify-content: center; padding-top: 10px;">
                                            <div class="ant-space ant-space-horizontal ant-space-align-center"
                                                 style="gap: 8px;">
                                                <div class="ant-space-item">
                                                    <button
                                                        @click="saveTheme"
                                                        :disabled="currentThemeKey == $page.props?.page?.theme[0]?.id"
                                                        type="button"
                                                        class="ant-btn ant-btn-primary ant-btn-sm">
                                                        <span>{{
                                                                currentThemeKey == $page.props?.page?.theme[0]?.id ? $root.translate('Current') : $root.translate('Save')
                                                            }}</span></button>
                                                </div>
                                                <div v-if="selectedThemeIsCustom" class="ant-space-item">
                                                    <button type="button"
                                                            v-if="currentThemeKey != $page.props?.page?.theme[0]?.id"
                                                            @click="deleteTheme"
                                                            class="ant-btn ant-btn-danger ant-btn-sm ant-btn-icon-only">
                                                        <close-outlined/>
                                                     </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </slide-up-down>
                <div class="w-100" :style="themeStyles.overlayStyle">
                    <div class="BlocksWrapper preview mobile" :style="themeStyles.containerStyle">
                        <div class="BlocksWrapper-inner" :style="themeStyles.blockStyle">
                            <draggable
                                delay="100"
                                delay-on-touch-only
                                @change="reorderElements"
                                v-model="elements"
                                tag="ul"
                                item-key="order_column"
                                v-bind="dragOptions"
                                :component-data="{tag: 'ul',type: 'transition',name: !drag ? 'flip-list' : null,class: 'ul-flip-list'}"
                                @start="drag = true"
                                @end="drag = false"
                            >
                                <template #item="{element}">
                                    <li class="list-group-item"
                                        style="position: relative; transition: null 0s ease 0s, visibility 0s ease 0s; z-index: 1; opacity: 1;margin-bottom: 10px;">
                                        <div class="EditorBlockListItem"
                                             :class="pro_components.includes(element.component_alias) && !$page.props.auth.user.is_pro ? 'error' : ''">
                                            <div
                                                v-if="pro_components.includes(element.component_alias) && !$page.props.auth.user.is_pro"
                                                class="EditorBlockListItem-error"><span class="ant-tag ant-tag-error"
                                                                                        style="margin-right: 0px;"
                                                                                        ant-click-animating-without-extra-node="false">PRO</span>
                                            </div>
                                            <component
                                                :products="props.user_products"
                                                :element-id="element.id"
                                                :data="element.props"
                                                :theme="themeStyles"
                                                :is="components[element.component_alias]"/>
                                        </div>
                                    </li>
                                </template>
                            </draggable>
                            <div style="display: flex; margin: 20px;">
                                <button type="button"
                                        @click="addLink"
                                        class="ant-btn ant-btn-primary ant-btn-round ant-btn-lg ant-btn-block"
                                        style="overflow: hidden;"><span>{{ $root.translate('Add link') }}</span>
                                </button>
                                <button type="button"
                                        @click="showAddBlockModal = true"
                                        class="ant-btn ant-btn-primary ant-btn-circle ant-btn-lg ant-btn-icon-only"
                                        style="margin-left: 8px;"><span role="img" aria-label="appstore"
                                                                        class="anticon anticon-appstore"><svg
                                    viewBox="64 64 896 896" focusable="false" data-icon="appstore" width="1em"
                                    height="1em"
                                    fill="currentColor" aria-hidden="true"><path
                                    d="M464 144H160c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16zm-52 268H212V212h200v200zm452-268H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V160c0-8.8-7.2-16-16-16zm-52 268H612V212h200v200zM464 544H160c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V560c0-8.8-7.2-16-16-16zm-52 268H212V612h200v200zm452-268H560c-8.8 0-16 7.2-16 16v304c0 8.8 7.2 16 16 16h304c8.8 0 16-7.2 16-16V560c0-8.8-7.2-16-16-16zm-52 268H612V612h200v200z"></path></svg></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Authenticated>
</template>

<style>
.ul-flip-list {
    padding: 0;
}

.button {
    margin-top: 35px;
}

.flip-list-move {
    transition: transform 0.5s;
}

.no-move {
    transition: transform 0s;
}

.ghost {
    /*opacity: 0.5;*/
    /*background: #c8ebfb;*/
}

.list-group {
    min-height: 20px;
}

.list-group-item {
    color: inherit !important;
    padding: 0 !important;
    border: 0 !important;
    cursor: move;
    background: transparent;
}

.list-group-item i {
    cursor: pointer;
}
</style>
