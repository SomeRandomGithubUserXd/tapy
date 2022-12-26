<script setup>
import {getCurrentInstance, ref, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import TapyInput from "@/Components/Common/TapyInput.vue";
import {message} from "ant-design-vue";
import EditModalFooter from "@/Components/Editor/EdtiorComponents/EditModalFooter.vue";
import {Inertia} from "@inertiajs/inertia";

const self = getCurrentInstance()

const props = defineProps({
    domainEntity: Object,
    modelValue: Boolean,
})

const emit = defineEmits(['update:modelValue'])

watch(() => props.domainEntity, value => {
}, {
    deep: true
})

const deleteElement = () => {
    Inertia.delete(route('settings.delete-domain', props.domainEntity.id
    ), {
        onSuccess: () => emit('update:modelValue', false)
    })
}

const submit = () => {
    if (!props.domainEntity.domain) {
        Inertia.post(route('settings.add-domain'), {
            domain: kostil.value.value
        }, {
            onSuccess: () => emit('update:modelValue', false)
        })
    }
}

const kostil = ref(null)
</script>

<template>
    <a-modal
        class="animate__animated"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @ok="submit"
        @change="emit('update:modelValue', false)"
    >
        <template #title>
            {{ $root.translate('Edit domain') }}
        </template>
        <template #footer>
            <div class="d-flex">
                <a-dropdown v-if="domainEntity?.domain" placement="topLeft" class="me-auto" :trigger="['click']">
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
                                         @click="deleteElement">
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
                <a-button key="submit" class="ms-auto" type="primary" @click="submit">
                    {{
                        $root.translate('Save')
                    }}
                </a-button>
            </div>
        </template>
        <div>
            <div class="Hint ant-alert mb-5 text-sm"><span role="img" aria-label="info-circle"
                                                           class="anticon anticon-info-circle"><svg
                viewBox="64 64 896 896" focusable="false" data-icon="info-circle" width="1em" height="1em"
                fill="currentColor" aria-hidden="true"><path
                d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path><path
                d="M464 336a48 48 0 1096 0 48 48 0 10-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"></path></svg></span>
                <div class="ant-alert-content">
                    <div class="ant-alert-message" v-html="$root.translate('If you don\'t have your own domain, you can register it on godaddy.com, namecheap.com, nic.ua, reg.ru, or any other registrar.\n'+
'There are 2 ways to connect a domain:\n'+
'\n'+
'Method 1: In your domain\'s DNS settings, add a CNAME record:\n'+
'- name: @ (or subdomain name if you want to connect a subdomain)\n'+
'- alias: domain.tapy.me. (dot at the end is required)\n'+
'\n'+
'Method 2: In your domain\'s DNS settings, add an A record:\n'+
'- name: @ (or subdomain name if you want to connect a subdomain)\n'+
'- host addresses: 159.253.23.182\n'+
'\n'+
'Please note that the domain will work only after a few hours.')"></div>
                </div>
            </div>
            <form id="domain" class="ant-form ant-form-vertical">
                <div class="ant-row ant-form-item" style="row-gap: 0px;">
                    <div class="ant-col ant-form-item-label"><label for="domain_domain"
                                                                    class="ant-form-item-required"
                                                                    title="Домен">{{
                            $root.translate('Domain')
                        }}</label>
                    </div>
                    <div class="ant-col ant-form-item-control">
                        <div class="ant-form-item-control-input">
                            <div class="ant-form-item-control-input-content"><input
                                ref="kostil"
                                placeholder="example.com" type="text"
                                :disabled="!!domainEntity.domain"
                                id="domain_domain" class="ant-input" :value="domainEntity?.domain"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </a-modal>
</template>
