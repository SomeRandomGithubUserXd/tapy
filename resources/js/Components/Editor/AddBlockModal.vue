<script setup>
import {Inertia} from "@inertiajs/inertia";
import {FileTextOutlined} from "@ant-design/icons-vue";
import {message} from "ant-design-vue";
import {getCurrentInstance, reactive, ref, watch} from "vue";
import ProfileModal from "@/Components/Editor/EdtiorComponents/Profile/ProfileModal.vue";
import LinkModal from "@/Components/Editor/EdtiorComponents/Link/LinkModal.vue";
import SocialButton from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButton.vue";
import SocialButtonsModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsModal.vue";
import HeaderModal from "@/Components/Editor/EdtiorComponents/Header/HeaderModal.vue";
import TextModal from "@/Components/Editor/EdtiorComponents/Text/TextModal.vue";
import FAQModal from "@/Components/Editor/EdtiorComponents/FAQ/FAQModal.vue";
import SocialButtonModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonModal.vue";
import ButtonListModal from "@/Components/Editor/EdtiorComponents/SocialButtons/ButtonListModal.vue";
import ProductsModal from "@/Components/Editor/EdtiorComponents/Products/ProductsModal.vue";
import ATCModal from "@/Components/Editor/EdtiorComponents/ATC/ATCModal.vue";
import HTMLModal from "@/Components/Editor/EdtiorComponents/HTML/HTMLModal.vue";
import ImageModal from "@/Components/Editor/EdtiorComponents/Image/ImageModal.vue";
import VideoModal from "@/Components/Editor/EdtiorComponents/Video/VideoModal.vue";
import SeparatorModal from "@/Components/Editor/EdtiorComponents/Separator/SeparatorModal.vue";
import ImageGalleryModal from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryModal.vue";
import VideoGalleryModal from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryModal.vue";
import CounterpartyCardModal from "@/Components/Editor/EdtiorComponents/Text/CounterpartyCardModal.vue";


const props = defineProps({
    pageUuid: String,
    modelValue: null,
    userProducts: Array,
    theme: Object
})

const self = getCurrentInstance()

const emit = defineEmits(['update:modelValue'])

const showListModal = ref(false)

const modals = ref({})

function addElement(alias) {
    // Inertia.post(route('pages.page_elements.create', props.pageUuid), {
    //     alias
    // }, {
    //     onSuccess: () => {
    //         message.success(
    //             self.parent.ctx.translate('Saved'), 2
    //         );
    //         emit('update:modelValue', false)
    //     }
    // })
    modals.value[alias] = true
}

const addProduct = () => {
    if (props.userProducts.length) {
        addElement('products')
    } else {
        Inertia.visit(route('products.index'), {
            data: {
                add_product_notification: true
            }
        })
    }
}

const socialButtonsData = reactive({})

const handleDataChange = (data) => {
    socialButtonsData.value = {"buttons": [data], "view": "circle", "use_theme_colors": false}
    showListModal.value = true
    modals.value.social_buttons = false
}

watch(socialButtonsData, value => {
    // console.log(value)
}, {deep: true})
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated"
        width="800px"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Choose block') }}
        </template>
        <image-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"picture":"/placeholders/img.png","view":"square","rounded":false,"zoom":false,"caption": ""}'
            v-model="modals.image"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <image-gallery-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"pictures": []}'
            v-model="modals.image_gallery"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <video-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"url":"","caption": ""}'
            v-model="modals.video"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <video-gallery-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"faqs":[]}'
            :faqs="[]"
            v-model="modals.video_gallery"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <separator-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"type":1,"fw": false,"smooth": false}'
            v-model="modals.separator"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <profile-modal
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"picture":"/placeholders/logo.svg","username":"@username","caption":"","position":"center"}'
            v-model="modals.profile"
            :mode="0"
            :theme="theme"
            @dataChanged="emit('update:modelValue', false)"
        />
        <link-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"custom_styles": false,"href":"","text":"","caption":"","position":"center","hide_icon":false,"style": ""}'
            v-model="modals.link"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <social-buttons-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data="socialButtonsData"
            v-model="showListModal"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <button-list-modal @dataChanged="handleDataChange" :element-id="0" v-model="modals.social_buttons"/>
        <header-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"text":"","textAlign":"justify","fontStyle":"normal","textDecoration":"none","fontSize":"20px"}'
            v-model="modals.header"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <text-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"text":"","textAlign":"justify","fontStyle":"normal","textDecoration":"none","fontSize":"15px"}'
            v-model="modals.text"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <f-a-q-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"faqs":[]}'
            :faqs="[]"
            v-model="modals.faq"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <h-t-m-l-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{"html":"Hello <b>world</b>"}'
            v-model="modals.html"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <counterparty-card-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{
                "organization":
                 [
                     {
                         "field_name": "Image",
                         "value": ""
                     },
                     {
                         "field_name": "Full name",
                         "value": ""
                     },
                     {
                         "field_name": "Short name",
                         "value": ""
                     },
                     {
                         "field_name": "Declared address",
                         "value": ""
                     },
                     {
                         "field_name": "Actual address",
                         "value": ""
                     },
                     {
                         "field_name": "Post address",
                         "value": ""
                     },
                     {
                         "field_name": "INN \\ ORGNIP",
                         "value": ""
                     },
                     {
                         "field_name": "OKPO \\ OKATO \\ OKTMO",
                         "value": ""
                     },
                ],
                "bank":
                 [
                     {
                         "field_name": "Bank name",
                         "value": ""
                     },
                     {
                         "field_name": "Correspondent account",
                         "value": ""
                     },
                     {
                         "field_name": "BIK",
                         "value": ""
                     },
                     {
                         "field_name": "Checking account",
                         "value": ""
                     },
                     {
                         "field_name": "INN \\ KPP",
                         "value": ""
                     },
                ],
                "contacts":
                 [
                     {
                         "field_name": "Director",
                         "value": ""
                     },
                     {
                         "field_name": "E-Mail",
                         "value": ""
                     },
                     {
                         "field_name": "Website",
                         "value": ""
                     },
                     {
                         "field_name": "Phone",
                         "value": ""
                     },
                ],
            }'
            v-model="modals.counterparty"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <products-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data="{'view': 'list'}"
            :products="userProducts"
            v-model="modals.products"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <a-t-c-modal
            :theme="theme"
            :recursive="false"
            :page-uuid="props.pageUuid"
            :data='{
                name: "",
                surname: "",
                patronymic: "",
                phn: "",
                wpn: "",
                company: "",
                address: "",
                website: "",
                note: "",
                picture: "",
            }'
            v-model="modals.atc"
            :mode="0"
            @dataChanged="emit('update:modelValue', false)"
        />
        <div class="ant-row ant-row-stretch" style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
            <div @click="addElement('profile')"
                 class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0 3C0 1.34315 1.34315 0 3 0H29C30.6569 0 32 1.34315 32 3V15C32 16.6569 30.6569 18 29 18H3C1.34315 18 0 16.6569 0 15V3Z"
                                fill="#8791AB"></path>
                            <path
                                d="M27 20C27 26.0751 22.0751 31 16 31C9.92487 31 5 26.0751 5 20C5 13.9249 9.92487 9 16 9C22.0751 9 27 13.9249 27 20Z"
                                fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16 31C9.92486 31 5 26.0751 5 20C5 13.9249 9.92486 9 16 9C22.0751 9 27 13.9249 27 20C27 26.0751 22.0751 31 16 31ZM22.0935 27.8571C22.0112 27.7361 21.9075 27.5858 21.8242 27.4685C21.6791 27.2621 21.534 27.0557 21.4041 26.8514C21.3979 26.842 20.6802 25.8792 18.0952 25.7619C17.1959 25.7619 16.5421 25.0872 16.5406 24.1559L16.5238 23.6667C16.5238 23.596 16.5154 23.7442 16.5238 23.6667V23.1429L17.0476 22.619C17.4305 22.4415 17.9171 22.1429 18.3021 21.8522L18.3729 21.8035C18.6772 21.6102 19.1025 21.2032 19.1429 21.0476L19.1617 20.848C19.3571 19.8408 19.6667 18.0085 19.6667 17.381C19.6667 14.9138 18.4671 13.7143 16 13.7143C13.4988 13.7143 12.3333 14.8792 12.3333 17.381C12.3333 18.0252 12.6429 19.8486 12.8378 20.8465L12.8561 21.0309C12.8891 21.1948 13.2746 21.583 13.6151 21.7967L13.6664 21.8291C14.0792 22.1178 14.5726 22.4394 14.9524 22.619L15.4762 23.1429V23.6667C15.4835 23.739 15.4762 23.5902 15.4762 23.6667L15.4589 24.1559C15.4589 25.0857 14.8062 25.7609 13.9488 25.7609C13.9482 25.7609 13.9477 25.7609 13.9472 25.7609C11.3512 25.8661 10.5985 26.8488 10.5974 26.8488C10.4654 27.0562 10.3209 27.2621 10.1747 27.469C10.0925 27.5863 9.98876 27.7361 9.906 27.8571C11.5911 29.1656 13.701 29.9524 15.9995 29.9524C18.298 29.9524 20.4084 29.1656 22.0935 27.8571ZM16 10.0476C10.5037 10.0476 6.04762 14.5037 6.04762 20C6.04762 22.8212 7.22619 25.3622 9.11191 27.173C9.312 26.8771 9.52571 26.5817 9.71429 26.2857C9.71429 26.2857 10.589 24.8489 13.9048 24.7143C14.2426 24.7143 14.4113 24.4932 14.4113 24.1559H14.4118C14.4113 23.883 14.4113 23.6667 14.4113 23.6667C14.4113 23.5986 14.4003 23.5373 14.3971 23.4713C14.0179 23.2921 13.5779 23.0449 13.0672 22.6887C13.0672 22.6887 11.81 21.9156 11.81 21.0476C11.81 21.0476 11.2862 18.3678 11.2862 17.381C11.2862 14.9484 12.3265 12.6667 16.0005 12.6667C19.6253 12.6667 20.7148 14.9484 20.7148 17.381C20.7148 18.3437 20.191 21.0476 20.191 21.0476C20.191 21.8915 18.9339 22.6887 18.9339 22.6887C18.4336 23.0664 17.9905 23.3183 17.6018 23.4985C17.5992 23.5556 17.5898 23.608 17.5898 23.6667C17.5898 23.6667 17.5892 23.883 17.5892 24.1559H17.5898C17.5887 24.4932 17.7574 24.7143 18.0952 24.7143C21.4602 24.8651 22.2857 26.2857 22.2857 26.2857C22.4743 26.5817 22.6875 26.8771 22.8876 27.173C24.7733 25.3622 25.9524 22.8212 25.9524 20C25.9524 14.5037 21.4963 10.0476 16 10.0476Z"
                                  fill="#8791AB"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Profile') }}</div>
                </div>
            </div>
            <div @click="addElement('link')"
                 class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.1555 17.4222C13.7663 18.2388 14.5456 18.9144 15.4404 19.4033C16.3353 19.8922 17.3248 20.1829 18.3419 20.2558C19.359 20.3286 20.3798 20.1819 21.3352 19.8255C22.2906 19.4691 23.1582 18.9114 23.8791 18.1902L28.1458 13.9236C29.4411 12.5824 30.1579 10.7861 30.1417 8.92159C30.1255 7.05708 29.3776 5.27353 28.0591 3.95507C26.7407 2.63661 24.9571 1.88874 23.0926 1.87254C21.2281 1.85634 19.4318 2.5731 18.0907 3.86845L15.6444 6.30045"
                                stroke="#8791AB" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"></path>
                            <path
                                d="M18.8444 14.5778C18.2337 13.7612 17.4544 13.0856 16.5596 12.5967C15.6647 12.1078 14.6752 11.8171 13.6581 11.7442C12.641 11.6714 11.6201 11.8181 10.6648 12.1745C9.70936 12.5309 8.84179 13.0886 8.12089 13.8098L3.85422 18.0764C2.55887 19.4176 1.84211 21.2139 1.85832 23.0784C1.87452 24.9429 2.62239 26.7265 3.94084 28.0449C5.2593 29.3634 7.04286 30.1113 8.90737 30.1275C10.7719 30.1437 12.5682 29.4269 13.9093 28.1316L16.3413 25.6996"
                                stroke="#8791AB" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Link') }}</div>
                </div>
            </div>
            <div @click="addElement('social_buttons')"
                 class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.90001 20.05C5.70001 20.05 3.95001 18.3 3.95001 16.1C3.95001 13.9 5.70001 12.15 7.90001 12.15C10.1 12.15 11.85 13.9 11.85 16.1C11.85 18.25 10.1 20.05 7.90001 20.05ZM7.90001 13.6C6.55001 13.6 5.45001 14.7 5.45001 16.05C5.45001 17.4 6.55001 18.5 7.90001 18.5C9.25001 18.5 10.35 17.4 10.35 16.05C10.35 14.75 9.25001 13.6 7.90001 13.6Z"
                                fill="#8791AB"></path>
                            <path
                                d="M23.95 12C21.75 12 20 10.25 20 8.05C20 5.85 21.75 4.10001 23.95 4.10001C26.15 4.10001 27.9 5.85 27.9 8.05C27.9 10.25 26.1 12 23.95 12ZM23.95 5.60001C22.6 5.60001 21.5 6.7 21.5 8.05C21.5 9.4 22.6 10.5 23.95 10.5C25.3 10.5 26.4 9.4 26.4 8.05C26.4 6.7 25.3 5.60001 23.95 5.60001Z"
                                fill="#8791AB"></path>
                            <path
                                d="M23.95 28.05C21.75 28.05 20 26.3 20 24.1C20 21.9 21.75 20.15 23.95 20.15C26.15 20.15 27.9 21.9 27.9 24.1C27.9 26.3 26.1 28.05 23.95 28.05ZM23.95 21.65C22.6 21.65 21.5 22.75 21.5 24.1C21.5 25.45 22.6 26.55 23.95 26.55C25.3 26.55 26.4 25.45 26.4 24.1C26.4 22.75 25.3 21.65 23.95 21.65Z"
                                fill="#8791AB"></path>
                            <path d="M20.7 23.4L10.4 18.25L11.1 16.8L21.45 21.95L20.7 23.4Z" fill="#8791AB"></path>
                            <path d="M11.1 15.35L10.4 13.95L20.7 8.8L21.45 10.2L11.1 15.35Z" fill="#8791AB"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Social buttons') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('header')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 28H18.1772V17.7143H6.82278V28H1V4H6.82278V13.7253H18.1772V4H24V28Z"
                                  fill="#8791AB"></path>
                            <path
                                d="M30.9231 2.21645V0H24V2.21645H26.3077V28.8139H24V31.0303H30.9231V28.8139H28.6154V2.21645H30.9231Z"
                                fill="#8791AB"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Header') }}</div>
                </div>
            </div>
            <div @click="addElement('text')"
                 class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 4.4329V8.8658H9.23077V28.8139H13.8462V8.8658H23.0769V4.4329H0Z"
                                  fill="#8791AB"></path>
                            <path
                                d="M30 2.21645V0H23.0769V2.21645H25.3846V28.8139H23.0769V31.0303H30V28.8139H27.6923V2.21645H30Z"
                                fill="#8791AB"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Text') }}</div>
                </div>
            </div>
            <div @click="addElement('faq')"
                 class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M13.4219 20.0156C13.4219 18.5573 13.599 17.3958 13.9531 16.5312C14.3073 15.6667 14.9531 14.8177 15.8906 13.9844C16.8385 13.1406 17.4688 12.4583 17.7812 11.9375C18.0938 11.4062 18.25 10.849 18.25 10.2656C18.25 8.50521 17.4375 7.625 15.8125 7.625C15.0417 7.625 14.4219 7.86458 13.9531 8.34375C13.4948 8.8125 13.2552 9.46354 13.2344 10.2969H8.70312C8.72396 8.30729 9.36458 6.75 10.625 5.625C11.8958 4.5 13.625 3.9375 15.8125 3.9375C18.0208 3.9375 19.7344 4.47396 20.9531 5.54688C22.1719 6.60938 22.7812 8.11458 22.7812 10.0625C22.7812 10.9479 22.5833 11.7865 22.1875 12.5781C21.7917 13.3594 21.099 14.2292 20.1094 15.1875L18.8438 16.3906C18.0521 17.151 17.599 18.0417 17.4844 19.0625L17.4219 20.0156H13.4219ZM12.9688 24.8125C12.9688 24.1146 13.2031 23.5417 13.6719 23.0938C14.151 22.6354 14.7604 22.4062 15.5 22.4062C16.2396 22.4062 16.8438 22.6354 17.3125 23.0938C17.7917 23.5417 18.0312 24.1146 18.0312 24.8125C18.0312 25.5 17.7969 26.0677 17.3281 26.5156C16.8698 26.9635 16.2604 27.1875 15.5 27.1875C14.7396 27.1875 14.125 26.9635 13.6562 26.5156C13.1979 26.0677 12.9688 25.5 12.9688 24.8125Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="32" height="32" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('FAQ') }}</div>
                </div>
            </div>
            <div
                @click="addElement('products')"
                class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M25.4547 22H13.4627C11.7333 22 10.2 20.8653 9.732 19.24L5.67867 5.50534C5.53467 5.008 5.056 4.66667 4.50933 4.66667H1.33333C0.596 4.66667 0 4.06933 0 3.33333C0 2.59733 0.596 2 1.33333 2H4.50933C6.23867 2 7.77066 3.13467 8.23866 4.76L8.99733 7.33334H29.3907C30.2227 7.33334 31.012 7.72934 31.5013 8.39334C31.9867 9.05201 32.1267 9.87601 31.8853 10.6547L29.1347 19.3853C28.596 20.9613 27.12 22 25.4547 22ZM29.392 10H29.4053H29.392Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M13.5 31C11.5697 31 10 29.4303 10 27.5C10 25.5697 11.5697 24 13.5 24C15.4303 24 17 25.5697 17 27.5C17 29.4303 15.4303 31 13.5 31ZM13.5 27.4983V27.5V27.4983Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M25.5 31C23.5697 31 22 29.4303 22 27.5C22 25.5697 23.5697 24 25.5 24C27.4303 24 29 25.5697 29 27.5C29 29.4303 27.4303 31 25.5 31ZM25.5 27.4983V27.5V27.4983Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="32" height="32" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Products') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('image')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <path
                                    d="M24 11.6129C25.8929 11.6129 27.4286 10.0524 27.4286 8.12903C27.4286 6.20564 25.8929 4.64516 24 4.64516C22.1072 4.64516 20.5714 6.20564 20.5714 8.12903C20.5714 10.0524 22.1072 11.6129 24 11.6129Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M30 0H2C0.885714 0 0 0.921774 0 2.05403V25.8169C0 26.9492 0.885714 27.871 2 27.871H30C31.1143 27.871 32 26.9492 32 25.8169V2.05403C32 0.921774 31.1143 0 30 0ZM22.6357 14.3492C22.4214 14.0952 22.0929 13.8992 21.7214 13.8992C21.3571 13.8992 21.1 14.0734 20.8071 14.3129L19.4714 15.4597C19.1929 15.6629 18.9714 15.8008 18.65 15.8008C18.3429 15.8008 18.0643 15.6847 17.8643 15.5032C17.7929 15.4379 17.6643 15.3145 17.5571 15.2056L13.7143 10.9815C13.4286 10.6476 13 10.4371 12.5214 10.4371C12.0429 10.4371 11.6 10.6766 11.3214 11.0032L2.28571 22.079V3.17177C2.35714 2.67823 2.73571 2.32258 3.22143 2.32258H28.7714C29.2643 2.32258 29.6643 2.69274 29.6929 3.19355L29.7143 22.0935L22.6357 14.3492Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="32" height="27.871" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Image') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('image_gallery')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect x="4.875" y="0.875" width="26.25" height="22.75" fill="white"></rect>
                                <path
                                    d="M25 10.1613C26.6562 10.1613 28 8.79587 28 7.1129C28 5.42994 26.6562 4.06452 25 4.06452C23.3437 4.06452 22 5.42994 22 7.1129C22 8.79587 23.3437 10.1613 25 10.1613Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M30.25 0H5.75C4.775 0 4 0.806553 4 1.79728V22.5898C4 23.5805 4.775 24.3871 5.75 24.3871H30.25C31.225 24.3871 32 23.5805 32 22.5898V1.79728C32 0.806553 31.225 0 30.25 0ZM23.8062 12.5555C23.6187 12.3333 23.3313 12.1618 23.0063 12.1618C22.6875 12.1618 22.4625 12.3142 22.2062 12.5238L21.0375 13.5272C20.7938 13.705 20.6 13.8257 20.3188 13.8257C20.05 13.8257 19.8063 13.7241 19.6313 13.5653C19.5688 13.5082 19.4562 13.4002 19.3625 13.3049L16 9.60877C15.75 9.31663 15.375 9.13246 14.9563 9.13246C14.5375 9.13246 14.15 9.34204 13.9062 9.62782L6 19.3192V2.7753C6.0625 2.34345 6.39375 2.03226 6.81875 2.03226H29.175C29.6062 2.03226 29.9563 2.35615 29.9813 2.79435L30 19.3319L23.8062 12.5555Z"
                                    fill="#8791AB"></path>
                                <rect x="0.875" y="4.35887" width="26.25" height="22.75" fill="white"></rect>
                                <path
                                    d="M21 13.6452C22.6562 13.6452 24 12.2797 24 10.5968C24 8.91381 22.6562 7.54839 21 7.54839C19.3437 7.54839 18 8.91381 18 10.5968C18 12.2797 19.3437 13.6452 21 13.6452Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M26.25 3.48387H1.75C0.775 3.48387 0 4.29042 0 5.28115V26.0737C0 27.0644 0.775 27.871 1.75 27.871H26.25C27.225 27.871 28 27.0644 28 26.0737V5.28115C28 4.29042 27.225 3.48387 26.25 3.48387ZM19.8062 16.0394C19.6187 15.8171 19.3313 15.6457 19.0063 15.6457C18.6875 15.6457 18.4625 15.7981 18.2062 16.0077L17.0375 17.0111C16.7938 17.1889 16.6 17.3096 16.3188 17.3096C16.05 17.3096 15.8063 17.208 15.6313 17.0492C15.5688 16.992 15.4562 16.8841 15.3625 16.7888L12 13.0926C11.75 12.8005 11.375 12.6163 10.9563 12.6163C10.5375 12.6163 10.15 12.8259 9.90625 13.1117L2 22.803V6.25917C2.0625 5.82732 2.39375 5.51613 2.81875 5.51613H25.175C25.6062 5.51613 25.9563 5.84002 25.9813 6.27823L26 22.8157L19.8062 16.0394Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="32" height="27.871" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Image gallery') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('video')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect x="1" y="1" width="30" height="26" fill="white"></rect>
                                <path
                                    d="M30 0H2C0.885714 0 0 0.921774 0 2.05403V25.8169C0 26.9492 0.885714 27.871 2 27.871H30C31.1143 27.871 32 26.9492 32 25.8169V2.05403C32 0.921774 31.1143 0 30 0ZM28.7714 25.6176C28.5714 25.6176 4 25.6176 3.42857 25.6176C2.85714 25.6176 2.28571 25.1429 2.28571 24.5714C2.28571 24 2.28571 3.17177 2.28571 3.17177C2.35714 2.67823 2.73571 2.32258 3.22143 2.32258H28.7714C29.2643 2.32258 29.6643 2.69274 29.6929 3.19355C29.6929 3.19355 29.7143 24 29.7143 24.5714C29.7143 25.1429 28.9714 25.6176 28.7714 25.6176Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M24.0789 12.0519C25.4123 12.8217 25.4123 14.7462 24.0789 15.516L12.1428 22.4073C10.8095 23.1771 9.14285 22.2149 9.14285 20.6753L9.14285 6.89267C9.14285 5.35307 10.8095 4.39082 12.1428 5.16062L24.0789 12.0519Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="32" height="27.871" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Video') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('video_gallery')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="29" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect x="4.875" y="0.875103" width="26.25" height="22.7527" fill="white"></rect>
                                <path
                                    d="M30.25 0H5.75C4.775 0 4 0.806649 4 1.79749V22.5925C4 23.5834 4.775 24.39 5.75 24.39H30.25C31.225 24.39 32 23.5834 32 22.5925V1.79749C32 0.806649 31.225 0 30.25 0ZM29.175 22.4181C29 22.4181 7.5 22.4181 7 22.4181C6.5 22.4181 6 22.0026 6 21.5026C6 21.0025 6 2.77563 6 2.77563C6.0625 2.34373 6.39375 2.0325 6.81875 2.0325H29.175C29.6062 2.0325 29.9563 2.35643 29.9813 2.79469C29.9813 2.79469 30 21.0025 30 21.5026C30 22.0026 29.35 22.4181 29.175 22.4181Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M24.6945 10.3304C26.0278 11.1002 26.0278 13.0246 24.6945 13.7944L15.0001 19.3922C13.6668 20.1621 12 19.1998 12 17.6602L12 6.46466C12 4.92502 13.6668 3.96277 15.0001 4.73267L24.6945 10.3304Z"
                                    fill="#8791AB"></path>
                            </g>
                            <g clip-path="url(#clip1)">
                                <rect x="0.875" y="4.3651" width="26.25" height="22.7527" fill="white"></rect>
                                <path
                                    d="M26.25 3.49H1.75C0.775 3.49 0 4.29665 0 5.28749V26.0825C0 27.0734 0.775 27.88 1.75 27.88H26.25C27.225 27.88 28 27.0734 28 26.0825V5.28749C28 4.29665 27.225 3.49 26.25 3.49ZM25.175 25.9081C25 25.9081 3.5 25.9081 3 25.9081C2.5 25.9081 2 25.4926 2 24.9926C2 24.4925 2 6.26563 2 6.26563C2.0625 5.83373 2.39375 5.5225 2.81875 5.5225H25.175C25.6062 5.5225 25.9563 5.84643 25.9813 6.28469C25.9813 6.28469 26 24.4925 26 24.9926C26 25.4926 25.35 25.9081 25.175 25.9081Z"
                                    fill="#8791AB"></path>
                                <path
                                    d="M20.6945 13.8204C22.0278 14.5903 22.0278 16.5146 20.6945 17.2844L11.0001 22.8822C9.66675 23.6521 8 22.6898 8 21.1502L8 9.95467C8 8.41502 9.66676 7.45278 11.0001 8.22267L20.6945 13.8204Z"
                                    fill="#8791AB"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="28" height="24.39" fill="white" transform="translate(4)"></rect>
                                </clipPath>
                                <clipPath id="clip1">
                                    <rect width="28" height="24.39" fill="white" transform="translate(0 3.49)"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Video gallery') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('separator')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="4" viewBox="0 0 32 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="21" y="3" width="2" height="11" rx="1" transform="rotate(-90 21 3)"
                                  fill="#8791AB"></rect>
                            <rect y="3" width="2" height="11" rx="1" transform="rotate(-90 0 3)" fill="#8791AB"></rect>
                            <circle cx="16" cy="2" r="2" fill="#8791AB"></circle>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Separator') }}</div>
                </div>
            </div>
            <div
                @click="addElement('atc')"
                class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg focusable="false" class="" data-icon="contacts" width="32" height="32"
                             fill="currentColor" aria-hidden="true" viewBox="64 64 896 896">
                            <path
                                fill="#8791AB"
                                d="M594.3 601.5a111.8 111.8 0 0029.1-75.5c0-61.9-49.9-112-111.4-112s-111.4 50.1-111.4 112c0 29.1 11 55.5 29.1 75.5a158.09 158.09 0 00-74.6 126.1 8 8 0 008 8.4H407c4.2 0 7.6-3.3 7.9-7.5 3.8-50.6 46-90.5 97.2-90.5s93.4 40 97.2 90.5c.3 4.2 3.7 7.5 7.9 7.5H661a8 8 0 008-8.4c-2.8-53.3-32-99.7-74.7-126.1zM512 578c-28.5 0-51.7-23.3-51.7-52s23.2-52 51.7-52 51.7 23.3 51.7 52-23.2 52-51.7 52zm416-354H768v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H548v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H328v-56c0-4.4-3.6-8-8-8h-56c-4.4 0-8 3.6-8 8v56H96c-17.7 0-32 14.3-32 32v576c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V256c0-17.7-14.3-32-32-32zm-40 568H136V296h120v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h148v56c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-56h120v496z"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Add to contacts') }}</div>
                </div>
            </div>
            <div
                @click="addElement('counterparty')"
                class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"></div>
                    <div class="BlockSelectorModal-icon">
                        <svg focusable="false" class="" data-icon="file-text" width="1em" height="1em"
                             fill="currentColor" aria-hidden="true" viewBox="64 64 896 896"
                             style="  width: 32px;  height: 32px;">
                            <path
                                fill="#8791AB"
                                d="M854.6 288.6L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326zm1.8 562H232V136h302v216a42 42 0 0042 42h216v494zM504 618H320c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zM312 490v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H320c-4.4 0-8 3.6-8 8z"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Counterparty card') }}</div>
                </div>
            </div>
            <div class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 @click="addElement('html')"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="BlockSelectorModal-block">
                    <div class="BlockSelectorModal-plan"><span class="ant-tag ant-tag-has-color"
                                                               style="background-color: rgb(0, 0, 0);"
                                                               ant-click-animating-without-extra-node="false">PRO</span>
                    </div>
                    <div class="BlockSelectorModal-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.6252 20.233C10.6252 20.4261 10.5454 20.6032 10.3858 20.7642C10.2421 20.9091 10.0825 20.9815 9.90694 20.9815C9.73137 20.9815 9.60368 20.9574 9.52388 20.9091L1.69507 17.3594C1.21624 17.134 0.984811 16.7959 1.00077 16.3452V16.1761C1.00077 15.7093 1.2322 15.3712 1.69507 15.1619L9.52388 11.6122C9.61964 11.58 9.74733 11.5639 9.90694 11.5639C10.0825 11.5478 10.2421 11.6203 10.3858 11.7813C10.5454 11.9422 10.6252 12.1193 10.6252 12.3125C10.6252 12.6989 10.4496 12.9564 10.0985 13.0852L3.03578 16.2727L10.0985 19.4361C10.2581 19.5005 10.3858 19.6051 10.4815 19.75C10.5773 19.8788 10.6252 20.0398 10.6252 20.233Z"
                                fill="#8791AB"></path>
                            <path
                                d="M17.8555 7.5554C17.9672 7.18513 18.2305 7 18.6455 7C18.869 7 19.0525 7.08049 19.1962 7.24148C19.3558 7.40246 19.4356 7.54735 19.4356 7.67614C19.4356 7.88542 19.4116 8.0303 19.3638 8.1108L14.1685 23.4446C14.0568 23.8149 13.8014 24 13.4024 24C13.1789 24 12.9874 23.9195 12.8278 23.7585C12.6682 23.5975 12.5884 23.4446 12.5884 23.2997C12.5884 23.1065 12.6123 22.9697 12.6602 22.8892L17.8555 7.5554Z"
                                fill="#8791AB"></path>
                            <path
                                d="M22.4761 20.9091C22.3804 20.9413 22.2447 20.9654 22.0691 20.9815C21.9095 20.9815 21.7499 20.9091 21.5903 20.7642C21.4466 20.6032 21.3748 20.4261 21.3748 20.233C21.3748 19.8466 21.5504 19.581 21.9015 19.4361L28.9882 16.2727L21.9015 13.0852C21.7419 13.0208 21.6142 12.9242 21.5185 12.7955C21.4227 12.6506 21.3748 12.4896 21.3748 12.3125C21.3748 12.1193 21.4466 11.9422 21.5903 11.7813C21.7499 11.6203 21.9095 11.5398 22.0691 11.5398C22.2287 11.5398 22.3644 11.5639 22.4761 11.6122L30.3049 15.1619C30.7838 15.3873 31.0152 15.7254 30.9992 16.1761V16.3452C30.9992 16.812 30.7678 17.1501 30.3049 17.3594L22.4761 20.9091Z"
                                fill="#8791AB"></path>
                        </svg>
                    </div>
                    <div class="BlockSelectorModal-title">{{ $root.translate('Custom HTML') }}</div>
                </div>
            </div>
        </div>
    </a-modal>
</template>
