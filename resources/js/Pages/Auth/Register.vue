<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import {Link, useForm} from "@inertiajs/inertia-vue3";
import {EyeInvisibleOutlined, EyeTwoTone} from '@ant-design/icons-vue';
import {ref} from "vue";
import TapyInput from "@/Components/Common/TapyInput.vue";

let showPassword = ref(false)

const form = useForm({
    email: '',
    password: '',
    terms: false,
});

function submit() {
    form.post(route('register'));
}
</script>

<template>
    <BreezeGuestLayout>
        <div class="LoginLayout-content" style="width: 400px;">
            <div class="ant-card ant-card-bordered" style="margin-bottom: 12px;">
                <div class="ant-card-body">
                    <div style="display: block; margin: 12px;">
                        <form @submit.prevent="submit" id="sign-up" class="ant-form ant-form-horizontal">
                            <tapy-input
                                :placeholder="this.$root.translate('Your email')"
                                type="email"
                                :error="this.$root.translate(form?.errors?.email)"
                                v-model="form.email">
                                <span role="img" aria-label="mail" class="anticon anticon-mail form-icon">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="mail" width="1em"
                                         height="1em" fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5 39.3-50.5 42.8 33.3h643.1l42.8-33.3 39.3 50.5-27.7 21.5zM833.6 232L512 482 190.4 232l-42.8-33.3-39.3 50.5 27.6 21.5 341.6 265.6a55.99 55.99 0 0068.7 0L888 270.8l27.6-21.5-39.3-50.5-42.7 33.2z"></path>
                                    </svg>
                                </span>
                            </tapy-input>
                            <tapy-input
                                :placeholder="this.$root.translate('Your password')"
                                type="password"
                                :can-show-password="true"
                                :error="this.$root.translate(form?.errors?.password)"
                                v-model="form.password">
                                <span role="img" aria-label="lock"
                                      class="anticon anticon-lock form-icon"><svg
                                    viewBox="64 64 896 896" focusable="false" data-icon="lock" width="1em"
                                    height="1em" fill="currentColor" aria-hidden="true"><path
                                    d="M832 464h-68V240c0-70.7-57.3-128-128-128H388c-70.7 0-128 57.3-128 128v224h-68c-17.7 0-32 14.3-32 32v384c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V496c0-17.7-14.3-32-32-32zM332 240c0-30.9 25.1-56 56-56h248c30.9 0 56 25.1 56 56v224H332V240zm460 600H232V536h560v304zM484 701v53c0 4.4 3.6 8 8 8h40c4.4 0 8-3.6 8-8v-53a48.01 48.01 0 10-56 0z"></path></svg></span>
                            </tapy-input>
                            <div class="ant-row ant-form-item" style="row-gap: 0px;">
                                <div class="ant-col ant-form-item-control">
                                    <div class="ant-form-item-control-input">
                                        <div class="ant-form-item-control-input-content">
                                            <button type="submit" class="ant-btn ant-btn-primary SignUpForm-button">
                                                <span>{{ this.$root.translate('Sign Up') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="display: block; text-align: center;">
                        {{ this.$root.translate('Already have an account?') }}
                        <Link :href="route('login')">{{ this.$root.translate('Login') }}</Link>
                    </div>
                </div>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
