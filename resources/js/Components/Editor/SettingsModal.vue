<script setup>
import {QuestionCircleOutlined} from "@ant-design/icons-vue";

import {computed, createVNode, getCurrentInstance, ref} from "vue";
import TapyInput from "@/Components/Common/TapyInput.vue";
import TapyTextarea from "@/Components/Common/TapyTextarea.vue";
import {message, Modal} from "ant-design-vue";
import VueCropper from "vue-cropperjs"
import 'cropperjs/dist/cropper.css';
import {useForm} from "@inertiajs/inertia-vue3";
import {toBase64} from "@/Helpers/FileHelper";
import {Inertia} from "@inertiajs/inertia";
import SingleImageUploader from "@/Components/Images/SingleImageUploader.vue";

const props = defineProps({
    page: Object,
    modelValue: Boolean,
    removeText: String,
    okText: String,
    cancelText: String,
})

const self = getCurrentInstance()

const prettyUrl = import.meta.env.VITE_PRETTY_URL

const emit = defineEmits(['update:modelValue'])

let activeTab = ref()

let form = ref(useForm({
    name: props.page.name,
    link: props.page.link,
    facebook_pixel_id: props.page?.page_tracking?.facebook_pixel_id || '',
    google_analytics_tracking_id: props.page?.page_tracking?.google_analytics_tracking_id || '',
    yandex_metrika_id: props.page?.page_tracking?.yandex_metrika_id || '',
    tik_tok_pixel_id: props.page?.page_tracking?.tik_tok_pixel_id || '',
    title: props.page?.page_seo?.title || '',
    description: props.page?.page_seo?.description || '',
    favicon: null,
    hide_logo: !!props.page?.hide_logo || false
}))

let faviconModel = ref(null)

function onUploadFavicon(val) {
    faviconModel.value = val
}

function removeFavicon() {
    Inertia.delete(route('pages.update.settings.seo.favicon.delete', props.page.uuid))
    message.success(
        'Saved', 2
    );
}

async function submit() {
    if (faviconModel.value) {
        form.value.favicon = await toBase64(faviconModel.value)
    }
    form.value.put(route('pages.update.settings', props.page.uuid), {
        onSuccess: () => {
            message.success(
                self.parent.ctx.translate('Saved'), 2
            );
        },
        onError: (err) => {
            // console.log(err, form.value)
        },
    })
}

function destroyPage() {
    Modal.confirm({
        title: props.removeText,
        icon: createVNode(QuestionCircleOutlined),
        okText: props.okText,
        cancelText: props.cancelText,
        onOk() {
            Inertia.delete(route('pages.destroy', props.page.id))
        },
        onCancel() {
        },
    });
}
</script>

<template>
    <a-modal
        :cancel-text="$root.translate('Cancel')"
        class="animate__animated tabs-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)"
        >
        <template #title>
            <div>{{ $root.translate('Update Page') }}</div>
        </template>
        <template #footer>
            <div class="d-flex">
                <a-dropdown placement="topLeft" class="me-auto" :trigger="['click']">
                    <a class="ant-dropdown-link" @click.prevent>
                        <div class="ant-col">
                            <button type="button" class="ant-btn ant-dropdown-trigger d-flex align-items-center"
                                    ant-click-animating-without-extra-node="false"><span role="img" aria-label="more"
                                                                                         class="anticon anticon-more"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="more" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true"><path
                                d="M456 231a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0zm0 280a56 56 0 10112 0 56 56 0 10-112 0z"></path></svg></span><span>{{
                                    $root.translate('Actions')
                                }}</span>
                            </button>
                        </div>
                    </a>
                    <template #overlay>
                        <a-menu>
                            <a-menu-item class="ant-dropdown-menu-item ant-dropdown-menu-item-danger"
                                         @click="destroyPage">
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
                <a-button key="submit" class="ms-auto" type="primary" @click="submit">{{
                        $root.translate('Save')
                    }}
                </a-button>
            </div>
        </template>
        <a-tabs v-model:activeKey="activeTab">
            <a-tab-pane key="1">
                <template #tab><span class="ant-typography" :class="{'ant-typography-danger': form?.errors?.name || form?.errors?.link}">
                    {{$root.translate('Settings')}}
                </span></template>
                <tapy-input
                    v-model="form.name"
                    :with-required-mark="true"
                    :error="form?.errors?.name"
                    :label="$root.translate('Page name')"
                    :placeholder="$root.translate('My page')">
                    <template #afterLabel>
                        <a-tooltip>
                            <template #title>{{ $root.translate('Visible only to yourself') }}</template>
                            <question-circle-outlined class="anticon anticon-question-circle ant-form-item-tooltip"/>
                        </a-tooltip>
                    </template>
                </tapy-input>
                <tapy-input
                    v-model="form.link"
                    :error="form?.errors?.link"
                    :with-required-mark="true"
                    :select-value="`${prettyUrl}/`"
                    :select-position="1"
                    :label="$root.translate('Page link')"
                    :info='$root.translate("Only letters, digits and \".-_\" symbols")'
                    :placeholder="$root.translate('xxxxxx')"/>
                <div class="d-flex w-100 align-items-center mb-3">
                    <a-switch :disabled="!$page.props.auth.user.is_pro" v-model:checked="form.hide_logo" class="me-3" />
                    {{$root.translate('Hide QCD logo')}}
                    <div class="ant-space-item ms-2"><span class="ant-tag ant-tag-has-color" style="background-color: rgb(0, 0, 0);">PRO</span></div>
                </div>
            </a-tab-pane>
            <a-tab-pane key="2" :tab="$root.translate('Tracking')">
                <div style="display: flex; padding-bottom: 20px;">
                    <div class="Hint ant-alert"><span role="img" aria-label="info-circle"
                                                      class="anticon anticon-info-circle"><svg viewBox="64 64 896 896"
                                                                                               focusable="false"
                                                                                               data-icon="info-circle"
                                                                                               width="1em" height="1em"
                                                                                               fill="currentColor"
                                                                                               aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path
                        d="M464 336a48 48 0 1096 0 48 48 0 10-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"></path></svg></span>
                        <div class="ant-alert-content">
                            <div class="ant-alert-message">
                                {{
                                    $root.translate('Tracking will allow you to measure the effectiveness of your advertising campaigns, as well as do retargeting to users who have already visited your QCD page.')
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <tapy-input
                    v-model="form.facebook_pixel_id"
                    :label="$root.translate('Facebook Pixel ID')"
                    placeholder="585358156020126"/>
                <tapy-input
                    v-model="form.google_analytics_tracking_id"
                    :label="$root.translate('Google Analytics Tracking ID')"
                    placeholder="G-GQ34KMV74F"/>
                <tapy-input
                    v-model="form.yandex_metrika_id"
                    :label="$root.translate('Yandex Metrika ID')"
                    placeholder="86096584"/>
                <tapy-input
                    v-model="form.tiktok_pixel_id"
                    :label="$root.translate('TikTok Pixel ID')"
                    placeholder="C6KEQS44L0UCTH07LRR1"/>
            </a-tab-pane>
            <a-tab-pane key="3" :tab="$root.translate('SEO')">
                <div style="display: flex; padding-bottom: 20px;">
                    <div class="Hint ant-alert"><span role="img" aria-label="info-circle"
                                                      class="anticon anticon-info-circle"><svg viewBox="64 64 896 896"
                                                                                               focusable="false"
                                                                                               data-icon="info-circle"
                                                                                               width="1em" height="1em"
                                                                                               fill="currentColor"
                                                                                               aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path
                        d="M464 336a48 48 0 1096 0 48 48 0 10-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"></path></svg></span>
                        <div class="ant-alert-content">
                            <div class="ant-alert-message">
                                {{
                                    $root.translate('Choose the title, description and favicon to appear on search engines and social posts')
                                }}
                            </div>
                        </div>
                    </div>
                </div>
                <tapy-input
                    v-model="form.title"
                    :label="$root.translate('Page title')"/>
                <tapy-textarea
                    v-model="form.description"
                    :with-placeholder="false"
                    :name="$root.translate('Page description')"/>
                <single-image-uploader
                    @onUpload="onUploadFavicon"
                    @onRemove="removeFavicon"
                    v-model="faviconModel"
                    :src="props.page?.page_seo?.favicon">
                    <template #label>
                        <label for="reset-password_seo_favicon" class="" title="Favicon">{{ $root.translate('Favicon') }}
                            <a-tooltip>
                                <template #title>{{ $root.translate('500x500px for best fits') }}</template>
                                <question-circle-outlined class="anticon anticon-question-circle ant-form-item-tooltip"/>
                            </a-tooltip>
                        </label>
                    </template>
                </single-image-uploader>
            </a-tab-pane>
        </a-tabs>
    </a-modal>
</template>
