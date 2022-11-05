<script setup>
import {computed, getCurrentInstance, ref} from "vue";
import {message} from "ant-design-vue";

const self = getCurrentInstance()

const props = defineProps({
    modelValue: Boolean,
    pageLink: String,
    qrCode: String
})

const emit = defineEmits(['update:modelValue', 'showSettings'])

const appUrl = import.meta.env.VITE_APP_URL

const link = computed({
    get() {
        return appUrl + '/' + props.pageLink
    },
    set() {
    }
})

let activeKey = ref(1)

const copyLink = () => {
    navigator.clipboard.writeText(link.value).then(function () {
        message.success(self.parent.ctx.translate('Link copied'), 2)
    }, function (err) {
        console.error('Async: Could not copy text: ', err);
    });
}

const downloadQrCode = () => {
    const canvas = document.createElement("canvas");
    const svg = props.qrCode;
    const base64doc = btoa(unescape(encodeURIComponent(svg)));
    const w = 100;
    const h = 100;
    const img_to_download = document.createElement('img');
    img_to_download.src = 'data:image/svg+xml;base64,' + base64doc;
    img_to_download.onload = function () {
        // console.log('img loaded');
        canvas.setAttribute('width', w);
        canvas.setAttribute('height', h);
        const context = canvas.getContext("2d");
        //context.clearRect(0, 0, w, h);
        context.drawImage(img_to_download,0,0,w,h);
        const dataURL = canvas.toDataURL('image/png');
        if (window.navigator.msSaveBlob) {
            window.navigator.msSaveBlob(canvas.msToBlob(), "qr_code.png");
            e.preventDefault();
        } else {
            const a = document.createElement('a');
            const my_evt = new MouseEvent('click');
            a.download = 'download.png';
            a.href = dataURL;
            a.dispatchEvent(my_evt);
        }
        //canvas.parentNode.removeChild(canvas);
    }
}
</script>

<template>
    <a-modal
        class="animate__animated np-modal"
        :footer="false"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)"
        >
        <template #title>
            {{ $root.translate('Share page') }}
        </template>
        <a-collapse accordion v-model:activeKey="activeKey" :bordered="false">
            <a-collapse-panel key="1" :header="$root.translate('Link to your page')">
                <span class="ant-typography"><pre
                    style="white-space: normal!important;word-wrap: normal!important;margin-top: 0px;">
                    <a :href="link" target="_blank" rel="noreferrer"><span role="img" aria-label="link"
                                                                           class="anticon anticon-link"><svg
                        style="margin-top: -6px" viewBox="64 64 896 896" focusable="false" data-icon="link" width="1em"
                        height="1em" fill="currentColor" aria-hidden="true"><path
                        d="M574 665.4a8.03 8.03 0 00-11.3 0L446.5 781.6c-53.8 53.8-144.6 59.5-204 0-59.5-59.5-53.8-150.2 0-204l116.2-116.2c3.1-3.1 3.1-8.2 0-11.3l-39.8-39.8a8.03 8.03 0 00-11.3 0L191.4 526.5c-84.6 84.6-84.6 221.5 0 306s221.5 84.6 306 0l116.2-116.2c3.1-3.1 3.1-8.2 0-11.3L574 665.4zm258.6-474c-84.6-84.6-221.5-84.6-306 0L410.3 307.6a8.03 8.03 0 000 11.3l39.7 39.7c3.1 3.1 8.2 3.1 11.3 0l116.2-116.2c53.8-53.8 144.6-59.5 204 0 59.5 59.5 53.8 150.2 0 204L665.3 562.6a8.03 8.03 0 000 11.3l39.8 39.8c3.1 3.1 8.2 3.1 11.3 0l116.2-116.2c84.5-84.6 84.5-221.5 0-306.1zM610.1 372.3a8.03 8.03 0 00-11.3 0L372.3 598.7a8.03 8.03 0 000 11.3l39.6 39.6c3.1 3.1 8.2 3.1 11.3 0l226.4-226.4c3.1-3.1 3.1-8.2 0-11.3l-39.5-39.6z"></path></svg></span>
                        {{ link }}</a></pre></span>
                <div class="ant-space ant-space-horizontal ant-space-align-start"
                     style="width: 100%; justify-content: space-between; gap: 20px;">
                    <div class="ant-space-item" style=""><span class="ant-typography ant-typography-secondary">{{
                            $root.translate('You can change the link to your page in the settings')
                        }} <button
                            type="button" @click="emit('showSettings')" class="ant-btn ant-btn-link ant-btn-sm"><span
                            role="img" aria-label="setting"
                            class="anticon anticon-setting"><svg
                            style="margin-top: -6px"
                            viewBox="64 64 896 896" focusable="false" data-icon="setting" width="1em" height="1em"
                            fill="currentColor" aria-hidden="true"><path
                            d="M924.8 625.7l-65.5-56c3.1-19 4.7-38.4 4.7-57.8s-1.6-38.8-4.7-57.8l65.5-56a32.03 32.03 0 009.3-35.2l-.9-2.6a443.74 443.74 0 00-79.7-137.9l-1.8-2.1a32.12 32.12 0 00-35.1-9.5l-81.3 28.9c-30-24.6-63.5-44-99.7-57.6l-15.7-85a32.05 32.05 0 00-25.8-25.7l-2.7-.5c-52.1-9.4-106.9-9.4-159 0l-2.7.5a32.05 32.05 0 00-25.8 25.7l-15.8 85.4a351.86 351.86 0 00-99 57.4l-81.9-29.1a32 32 0 00-35.1 9.5l-1.8 2.1a446.02 446.02 0 00-79.7 137.9l-.9 2.6c-4.5 12.5-.8 26.5 9.3 35.2l66.3 56.6c-3.1 18.8-4.6 38-4.6 57.1 0 19.2 1.5 38.4 4.6 57.1L99 625.5a32.03 32.03 0 00-9.3 35.2l.9 2.6c18.1 50.4 44.9 96.9 79.7 137.9l1.8 2.1a32.12 32.12 0 0035.1 9.5l81.9-29.1c29.8 24.5 63.1 43.9 99 57.4l15.8 85.4a32.05 32.05 0 0025.8 25.7l2.7.5a449.4 449.4 0 00159 0l2.7-.5a32.05 32.05 0 0025.8-25.7l15.7-85a350 350 0 0099.7-57.6l81.3 28.9a32 32 0 0035.1-9.5l1.8-2.1c34.8-41.1 61.6-87.5 79.7-137.9l.9-2.6c4.5-12.3.8-26.3-9.3-35zM788.3 465.9c2.5 15.1 3.8 30.6 3.8 46.1s-1.3 31-3.8 46.1l-6.6 40.1 74.7 63.9a370.03 370.03 0 01-42.6 73.6L721 702.8l-31.4 25.8c-23.9 19.6-50.5 35-79.3 45.8l-38.1 14.3-17.9 97a377.5 377.5 0 01-85 0l-17.9-97.2-37.8-14.5c-28.5-10.8-55-26.2-78.7-45.7l-31.4-25.9-93.4 33.2c-17-22.9-31.2-47.6-42.6-73.6l75.5-64.5-6.5-40c-2.4-14.9-3.7-30.3-3.7-45.5 0-15.3 1.2-30.6 3.7-45.5l6.5-40-75.5-64.5c11.3-26.1 25.6-50.7 42.6-73.6l93.4 33.2 31.4-25.9c23.7-19.5 50.2-34.9 78.7-45.7l37.9-14.3 17.9-97.2c28.1-3.2 56.8-3.2 85 0l17.9 97 38.1 14.3c28.7 10.8 55.4 26.2 79.3 45.8l31.4 25.8 92.8-32.9c17 22.9 31.2 47.6 42.6 73.6L781.8 426l6.5 39.9zM512 326c-97.2 0-176 78.8-176 176s78.8 176 176 176 176-78.8 176-176-78.8-176-176-176zm79.2 255.2A111.6 111.6 0 01512 614c-29.9 0-58-11.7-79.2-32.8A111.6 111.6 0 01400 502c0-29.9 11.7-58 32.8-79.2C454 401.6 482.1 390 512 390c29.9 0 58 11.6 79.2 32.8A111.6 111.6 0 01624 502c0 29.9-11.7 58-32.8 79.2z"></path></svg></span><span>{{
                                $root.translate('Open settings')
                            }}</span></button></span>
                    </div>
                    <div class="ant-space-item">
                        <button type="button" @click="copyLink" class="ant-btn ant-btn-primary">
                            <span>{{ $root.translate('Copy link') }}</span></button>
                    </div>
                </div>
            </a-collapse-panel>
            <a-collapse-panel key="2" :header="$root.translate('QR code')">
                <div class="ant-space ant-space-vertical ant-space-align-center" style="width: 100%; gap: 8px;">
                    <div class="ant-space-item" style="">
                        <div id="qrcode" v-html="qrCode"></div>
                    </div>
                    <div class="ant-space-item">
                        <button type="button" @click="downloadQrCode" class="ant-btn"><span role="img" aria-label="download"
                                                                    class="anticon anticon-download"><svg
                            style="margin-top: -6px"
                            viewBox="64 64 896 896" focusable="false" data-icon="download" width="1em" height="1em"
                            fill="currentColor" aria-hidden="true"><path
                            d="M505.7 661a8 8 0 0012.6 0l112-141.7c4.1-5.2.4-12.9-6.3-12.9h-74.1V168c0-4.4-3.6-8-8-8h-60c-4.4 0-8 3.6-8 8v338.3H400c-6.7 0-10.4 7.7-6.3 12.9l112 141.8zM878 626h-60c-4.4 0-8 3.6-8 8v154H214V634c0-4.4-3.6-8-8-8h-60c-4.4 0-8 3.6-8 8v198c0 17.7 14.3 32 32 32h684c17.7 0 32-14.3 32-32V634c0-4.4-3.6-8-8-8z"></path></svg></span><span>{{ $root.translate('Download QR code') }}</span>
                        </button>
                    </div>
                </div>
            </a-collapse-panel>
        </a-collapse>
    </a-modal>
</template>
