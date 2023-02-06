<script setup>
import {socialButtons} from "@/Helpers/EditorHelper";
import {groupBy} from "underscore";
import SocialButtonModal from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonModal.vue";
import {ref, watch} from "vue";

const props = defineProps({
    modelValue: Boolean,
    elementId: Number
})
const emit = defineEmits(['update:modelValue', 'dataChanged'])

const currentButton = ref(null)

const showSocialButtonModal = ref(false)

const addBtn = (btn) => {
    const setCurrentButton = new Promise((resolve, reject) => {
        currentButton.value = btn
        resolve(btn)
    })
    setCurrentButton.then(() => {
        showSocialButtonModal.value = true
    })
}

const newBtn = ref({
    alias: '',
    value: '',
    btn_text: '',
    btn_caption: '',
    btn_extra: '',
    btn_sum: '',
})

watch(newBtn, (val) => {
    showSocialButtonModal.value = false
    emit('dataChanged', val)
}, {deep: true})
</script>

<template>
    <a-modal
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)">
        <template #title>
            {{ $root.translate('Select button') }}
        </template>
        <div v-for="(data, groupName) in groupBy(socialButtons, 'group')"
             class="ant-row ant-row-stretch SocialNetworkSelectModal-networks"
             style="margin-left: -8px; margin-right: -8px; row-gap: 16px;">
            <div class="ant-col ant-col-24 SocialNetworkSelectModal-category"
                 style="padding-left: 8px; padding-right: 8px;">{{ groupName }}
            </div>
            <div @click="addBtn(btn)" v-for="btn in data" class="ant-col gutter-row ant-col-xs-24 ant-col-sm-12 ant-col-md-8 ant-col-lg-8"
                 style="padding-left: 8px; padding-right: 8px;">
                <div class="SocialNetworkButton" :style="{backgroundColor: btn.bgColor, color: btn.color}">
                    <svg style="margin-left: 2px" v-if="btn.label === 'SBER'" xmlns="http://www.w3.org/2000/svg" width="30" height="23" viewBox="0 0 40 33" fill="none">
                        <path d="M28.9083 6.35486C29.6749 7.35932 30.3239 8.45058 30.8421 9.60673L16.1419 20.5889L9.99829 16.6859V11.9904L16.1419 15.8934L28.9083 6.35486Z" fill="#21A038"/>
                        <path d="M3.72827 16.3545C3.72827 16.1438 3.73334 15.9345 3.74348 15.7264L0.0202772 15.5415C0.00760464 15.8112 4.49933e-06 16.0835 4.49933e-06 16.3583C-0.00157962 18.5055 0.415154 20.6318 1.22631 22.6153C2.03746 24.5989 3.22706 26.4006 4.72687 27.9171L7.36783 25.2419C6.21333 24.0766 5.29746 22.6915 4.67286 21.1663C4.04826 19.6411 3.72725 18.0058 3.72827 16.3545Z" fill="url(#paint0_linear)"/>
                        <path d="M16.1385 3.77747C16.3463 3.77747 16.5528 3.78518 16.7581 3.79545L16.9444 0.0208629C16.6775 0.00801981 16.4088 0.00159904 16.1385 0.00159904C14.0188 -0.00102064 11.9196 0.420712 9.96126 1.24258C8.00291 2.06445 6.22405 3.27027 4.72681 4.7908L7.36777 7.4673C8.51766 6.29688 9.8845 5.36835 11.3897 4.73512C12.8949 4.10189 14.5087 3.77643 16.1385 3.77747Z" fill="url(#paint1_linear)"/>
                        <path d="M16.1385 28.9318C15.9307 28.9318 15.7241 28.9318 15.5176 28.9151L15.3313 32.6884C15.5991 32.7021 15.8682 32.709 16.1385 32.709C18.2573 32.7112 20.3555 32.2892 22.3128 31.4671C24.2701 30.645 26.0478 29.439 27.5439 27.9185L24.908 25.2433C23.7579 26.4131 22.3912 27.3411 20.8863 27.9741C19.3814 28.6071 17.7679 28.9326 16.1385 28.9318Z" fill="url(#paint2_linear)"/>
                        <path d="M23.1339 5.97207L26.2716 3.6282C23.4037 1.27465 19.8238 -0.0065332 16.1335 2.50537e-05V3.77718C18.6324 3.77404 21.0733 4.53938 23.1339 5.97207Z" fill="url(#paint3_linear)"/>
                        <path d="M32.2759 16.3545C32.2779 15.3719 32.1931 14.391 32.0224 13.4237L28.5489 16.018C28.5489 16.1298 28.5489 16.2415 28.5489 16.3545C28.5498 18.1118 28.1863 19.8497 27.4821 21.4555C26.7778 23.0613 25.7484 24.4992 24.4607 25.676L26.9661 28.4823C28.6402 26.9506 29.978 25.0795 30.8927 22.9903C31.8075 20.901 32.2787 18.6402 32.2759 16.3545Z" fill="#21A038"/>
                        <path d="M16.1386 28.9318C14.4045 28.9324 12.6896 28.5639 11.1049 27.8502C9.52028 27.1365 8.10119 26.0934 6.93956 24.7886L4.17188 27.3264C5.68303 29.0233 7.52923 30.3793 9.59077 31.3066C11.6523 32.2338 13.8831 32.7116 16.1386 32.7089V28.9318Z" fill="url(#paint4_linear)"/>
                        <path d="M7.81645 7.0329L5.31235 4.22668C3.63776 5.75806 2.29948 7.62906 1.3843 9.71834C0.469132 11.8076 -0.00249507 14.0685 9.92663e-06 16.3544H3.72828C3.72751 14.5972 4.09104 12.8593 4.79529 11.2535C5.49955 9.64775 6.52883 8.20981 7.81645 7.0329Z" fill="url(#paint5_linear)"/>

                        <defs>
                            <linearGradient id="paint0_linear" x1="5.48089" y1="27.4458" x2="1.30964" y2="15.5477" gradientUnits="userSpaceOnUse">
                                <stop offset="0.14" stop-color="#F1E813"/>
                                <stop offset="0.3" stop-color="#E6E418"/>
                                <stop offset="0.58" stop-color="#C9DA26"/>
                                <stop offset="0.89" stop-color="#A2CC39"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="5.7913" y1="5.45864" x2="16.3181" y2="1.50029" gradientUnits="userSpaceOnUse">
                                <stop offset="0.06" stop-color="#0FA7DF"/>
                                <stop offset="0.54" stop-color="#0098F8"/>
                                <stop offset="0.92" stop-color="#0290EA"/>
                            </linearGradient>
                            <linearGradient id="paint2_linear" x1="15.0855" y1="30.4293" x2="26.9647" y2="27.7813" gradientUnits="userSpaceOnUse">
                                <stop offset="0.12" stop-color="#A2CC39"/>
                                <stop offset="0.28" stop-color="#86C239"/>
                                <stop offset="0.87" stop-color="#219F38"/>
                            </linearGradient>
                            <linearGradient id="paint3_linear" x1="15.358" y1="1.26507" x2="25.5244" y2="4.36073" gradientUnits="userSpaceOnUse">
                                <stop offset="0.06" stop-color="#0290EA"/>
                                <stop offset="0.79" stop-color="#0C89CA"/>
                            </linearGradient>
                            <linearGradient id="paint4_linear" x1="5.10711" y1="26.8666" x2="16.1833" y2="30.9512" gradientUnits="userSpaceOnUse">
                                <stop offset="0.13" stop-color="#F1E813"/>
                                <stop offset="0.3" stop-color="#EAE616"/>
                                <stop offset="0.53" stop-color="#D8DF1F"/>
                                <stop offset="0.8" stop-color="#BAD52D"/>
                                <stop offset="0.98" stop-color="#A2CC39"/>
                            </linearGradient>
                            <linearGradient id="paint5_linear" x1="1.38892" y1="16.8116" x2="5.92478" y2="5.16889" gradientUnits="userSpaceOnUse">
                                <stop offset="0.07" stop-color="#A2CC39"/>
                                <stop offset="0.26" stop-color="#81C45E"/>
                                <stop offset="0.92" stop-color="#0FA7DF"/>
                            </linearGradient>
                            <clipPath id="clip0">
                                <rect width="168.414" height="21.6207" fill="white" transform="translate(40.9656 5.6897)"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <svg v-else-if="btn.label === 'Copy'" fill="#fff" height="30px" width="23px" version="1.1" id="Layer_1"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
<g id="Text-files">
	<path d="M53.9791489,9.1429005H50.010849c-0.0826988,0-0.1562004,0.0283995-0.2331009,0.0469999V5.0228
		C49.7777481,2.253,47.4731483,0,44.6398468,0h-34.422596C7.3839517,0,5.0793519,2.253,5.0793519,5.0228v46.8432999
		c0,2.7697983,2.3045998,5.0228004,5.1378999,5.0228004h6.0367002v2.2678986C16.253952,61.8274002,18.4702511,64,21.1954517,64
		h32.783699c2.7252007,0,4.9414978-2.1725998,4.9414978-4.8432007V13.9861002
		C58.9206467,11.3155003,56.7043495,9.1429005,53.9791489,9.1429005z M7.1110516,51.8661003V5.0228
		c0-1.6487999,1.3938999-2.9909999,3.1062002-2.9909999h34.422596c1.7123032,0,3.1062012,1.3422,3.1062012,2.9909999v46.8432999
		c0,1.6487999-1.393898,2.9911003-3.1062012,2.9911003h-34.422596C8.5049515,54.8572006,7.1110516,53.5149002,7.1110516,51.8661003z
		 M56.8888474,59.1567993c0,1.550602-1.3055,2.8115005-2.9096985,2.8115005h-32.783699
		c-1.6042004,0-2.9097996-1.2608986-2.9097996-2.8115005v-2.2678986h26.3541946
		c2.8333015,0,5.1379013-2.2530022,5.1379013-5.0228004V11.1275997c0.0769005,0.0186005,0.1504021,0.0469999,0.2331009,0.0469999
		h3.9682999c1.6041985,0,2.9096985,1.2609005,2.9096985,2.8115005V59.1567993z"/>
    <path d="M38.6031494,13.2063999H16.253952c-0.5615005,0-1.0159006,0.4542999-1.0159006,1.0158005
		c0,0.5615997,0.4544001,1.0158997,1.0159006,1.0158997h22.3491974c0.5615005,0,1.0158997-0.4542999,1.0158997-1.0158997
		C39.6190491,13.6606998,39.16465,13.2063999,38.6031494,13.2063999z"/>
    <path d="M38.6031494,21.3334007H16.253952c-0.5615005,0-1.0159006,0.4542999-1.0159006,1.0157986
		c0,0.5615005,0.4544001,1.0159016,1.0159006,1.0159016h22.3491974c0.5615005,0,1.0158997-0.454401,1.0158997-1.0159016
		C39.6190491,21.7877007,39.16465,21.3334007,38.6031494,21.3334007z"/>
    <path d="M38.6031494,29.4603004H16.253952c-0.5615005,0-1.0159006,0.4543991-1.0159006,1.0158997
		s0.4544001,1.0158997,1.0159006,1.0158997h22.3491974c0.5615005,0,1.0158997-0.4543991,1.0158997-1.0158997
		S39.16465,29.4603004,38.6031494,29.4603004z"/>
    <path d="M28.4444485,37.5872993H16.253952c-0.5615005,0-1.0159006,0.4543991-1.0159006,1.0158997
		s0.4544001,1.0158997,1.0159006,1.0158997h12.1904964c0.5615025,0,1.0158005-0.4543991,1.0158005-1.0158997
		S29.0059509,37.5872993,28.4444485,37.5872993z"/>
</g>
</svg>
                    <svg v-else-if="btn.label === 'SMS'" fill="#fff" height="30px" width="23px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
<path d="M256,0C114.6,0,0,85.9,0,192c0,75,57.5,139.8,141.1,171.4L85.3,512l160.5-128.4c3.4,0.1,6.7,0.4,10.2,0.4
	c141.4,0,256-85.9,256-192C512,85.9,397.4,0,256,0z"/>
</svg>
                    <i v-else
                        class="Icon" :class="btn.icon" style="font-size: 24px;"></i>
                    <div class="SocialNetworkButton-label">{{ btn.rlabel || btn.label }}</div>
            </div>
        </div>
        </div>
        <social-button-modal :element-id="elementId" :misc="currentButton" v-model="showSocialButtonModal" v-model:content="newBtn" :mode="1"/>
    </a-modal>
</template>
