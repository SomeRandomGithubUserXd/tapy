<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {Link} from "@inertiajs/inertia-vue3";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>
        <div class="LoginLayout-content" style="width: 400px;">
            <div style="display: flex; margin-bottom: 12px;">
                <div data-show="true" class="ant-alert ant-alert-info" role="alert"><span role="img"
                                                                                          aria-label="info-circle"
                                                                                          class="anticon anticon-info-circle ant-alert-icon"><svg
                    viewBox="64 64 896 896" focusable="false" data-icon="info-circle" width="1em" height="1em"
                    fill="currentColor" aria-hidden="true"><path
                    d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm32 664c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V456c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v272zm-32-344a48.01 48.01 0 010-96 48.01 48.01 0 010 96z"></path></svg></span>
                    <div class="ant-alert-content">
                        <div class="ant-alert-message">
                            {{ this.$root.translate("Enter your user account's email address and we will send you a password reset link.")}}
                        </div>
                        <div class="ant-alert-description"></div>
                    </div>
                </div>
            </div>
            <div class="ant-card ant-card-bordered" style="margin-bottom: 12px;">
                <div class="ant-card-body">
                    <div style="display: block; margin: 12px;">
                        <form id="forgot-password" class="ant-form ant-form-horizontal">
                            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content"><span
                                            class="ant-input-affix-wrapper"><span class="ant-input-prefix"><span
                                            role="img" aria-label="mail" class="anticon anticon-mail form-icon"><svg
                                            viewBox="64 64 896 896" focusable="false" data-icon="mail" width="1em"
                                            height="1em" fill="currentColor" aria-hidden="true"><path
                                            d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5 39.3-50.5 42.8 33.3h643.1l42.8-33.3 39.3 50.5-27.7 21.5zM833.6 232L512 482 190.4 232l-42.8-33.3-39.3 50.5 27.6 21.5 341.6 265.6a55.99 55.99 0 0068.7 0L888 270.8l27.6-21.5-39.3-50.5-42.7 33.2z"></path></svg></span></span><input
                                            placeholder="Email" type="text" id="forgot-password_email" class="ant-input"
                                            value=""></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <button type="submit"
                                                    class="ant-btn ant-btn-primary ForgotPasswordForm-button"><span>{{ this.$root.translate('Send reset link') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="display: block; text-align: center;"><Link :href="route('login')">{{ this.$root.translate('Return to log in page') }}</Link>
                    </div>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
