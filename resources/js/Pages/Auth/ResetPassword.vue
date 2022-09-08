<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import {Link, useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {getCurrentInstance, ref} from "vue";
import {message} from "ant-design-vue";

const self = getCurrentInstance()

const props = defineProps({
    email: String,
    token: String
})

const submit = () => {
    form.transform((data) => ({
        ...data,
        email: props.email,
        token: props.token,
    })).post(route('password.update'), {
        onSuccess: () => {
            linkIsRequested.value = true
            message.success(
                self.parent.ctx.translate('Password changed successfully'), 2
            );
        }
    })
}

const form = useForm({
    password: '',
    password_confirmation: ''
})

const linkIsRequested = ref(false)
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
                        <div class="ant-alert-message">{{ $root.translate('Please enter your new password') }}</div>
                        <div class="ant-alert-description"></div>
                    </div>
                </div>
            </div>
            <div class="ant-card ant-card-bordered" style="margin-bottom: 12px;">
                <div class="ant-card-body">
                    <div style="display: block; margin: 12px;">
                        <form v-if="!linkIsRequested" @submit.prevent="submit" class="ant-form ant-form-horizontal">
                            <tapy-input :placeholder="$root.translate('New password')" v-model="form.password"
                                        type="password" :error="$root.translate(form?.errors?.password)">
                                <span class="ant-input-prefix"><span role="img" aria-label="lock"
                                                                     class="anticon anticon-lock form-icon"><svg
                                    viewBox="64 64 896 896" focusable="false" data-icon="lock" width="1em" height="1em"
                                    fill="currentColor" aria-hidden="true"><path
                                    d="M832 464h-68V240c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM332 240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v224H332V240zm460 600H232V536h560v304zM484 701v53c0 4.4 3.6 8 8 8h40c4.4 0 8-3.6 8-8v-53a48.01 48.01 0 10-56 0z"></path></svg></span></span>
                            </tapy-input>
                            <tapy-input :placeholder="$root.translate('Confirm new password')"
                                        v-model="form.password_confirmation"
                                        type="password">
                                <span class="ant-input-prefix"><span role="img" aria-label="lock"
                                                                     class="anticon anticon-lock form-icon"><svg
                                    viewBox="64 64 896 896" focusable="false" data-icon="lock" width="1em" height="1em"
                                    fill="currentColor" aria-hidden="true"><path
                                    d="M832 464h-68V240c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM332 240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v224H332V240zm460 600H232V536h560v304zM484 701v53c0 4.4 3.6 8 8 8h40c4.4 0 8-3.6 8-8v-53a48.01 48.01 0 10-56 0z"></path></svg></span></span>
                            </tapy-input>
                            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <button type="submit" class="ant-btn ant-btn-primary LoginForm-button">
                                                <span>{{ $root.translate('Set password') }}</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div v-else style="display: block; margin: 12px;">
                            <div class="ant-result ant-result-success">
                                <div class="ant-result-icon"><span role="img" aria-label="check-circle"
                                                                   class="anticon anticon-check-circle"><svg
                                    viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em"
                                    height="1em" fill="currentColor" aria-hidden="true"><path
                                    d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm193.5 301.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.2 0 19.9 4.9 25.9 13.3l71.2 98.8 157.2-218c6-8.3 15.6-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.5 12.7z"></path></svg></span>
                                </div>
                                <div class="ant-result-title">{{ $root.translate('Success') }}</div>
                                <div class="ant-result-subtitle">
                                    {{ $root.translate('We sent a recovery link to your email') }}
                                </div>
                            </div>
                        </div>
                        <div style="display: block; text-align: center;">
                            <Link :href="route('login')">{{
                                    $root.translate('Return to login page')
                                }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
