<script setup>
import LogoWhite from "@/Components/Misc/LogoWhite.vue";
import LogoInstagram from "@/Components/Misc/LogoInstagram.vue";
import LogoTelegram from "@/Components/Misc/LogoTelegram.vue";
import LocaleDropdown from "@/Components/LocaleDropdown.vue";
import {computed, getCurrentInstance, reactive, ref} from "vue";
import {ShoppingCartOutlined, FileTextOutlined, SettingOutlined, UserOutlined} from '@ant-design/icons-vue';
import {Link, usePage} from "@inertiajs/inertia-vue3";
import {message} from "ant-design-vue";
import {MenuOutlined} from "@ant-design/icons-vue";
import {Inertia} from "@inertiajs/inertia";
import FeedbackModal from "@/Components/FeedbackModal.vue";
import UpgradeToProModal from "@/Components/Misc/UpgradeToProModal.vue";

const self = getCurrentInstance()

const menuItems = reactive([
    {
        name: 'Pages',
        icon: FileTextOutlined,
        href: route('pages.index'),
        selected: route().current('pages.index') || route().current('pages.edit'),
    },
    {
        name: 'Products',
        icon: ShoppingCartOutlined,
        href: route('products.index'),
        selected: route().current('products.index'),
    },
    {
        name: 'Settings',
        icon: SettingOutlined,
        href: route('settings.index'),
        selected: route().current('settings.index'),
    }
])

if (usePage().props.value.auth.user?.is_admin) {
    menuItems.push({
        name: 'Admin',
        icon: UserOutlined,
        href: route('admin.index'),
        selected: route().current('admin.index'),
    })
}

let isMobile = computed({
    get() {
        return !window.matchMedia("(min-width: 768px)").matches
    }, set() {
    }
})

const logout = () => {
    Inertia.post(route('logout'), {}, {
        onSuccess: () => location.href = '/'
    })
}

let showSidebar = ref(false)

let sidebarStyle = computed({
    get() {
        if (!isMobile) return 'display: block'
        if (isMobile.value && !showSidebar.value) {
            return 'd-none'
        }
        if (isMobile.value && showSidebar.value) {
            return 'animate__slideInLeft'
        }
    }, set() {
    }
})

function showMenu() {
    showSidebar.value = true
}

const feedbackModel = ref(false)
const showUpgradeModal = ref(false)
</script>

<template>
    <section class="ant-layout ant-layout-has-sider AppLayout">
        <feedback-modal v-model="feedbackModel"/>
        <upgrade-to-pro-modal v-model="showUpgradeModal"/>
        <aside class="ant-layout-sider ant-layout-sider-dark animate__animated"
               :class="sidebarStyle"
               style="flex: 0 0 220px; max-width: 220px; min-width: 220px; width: 220px;">
            <div class="ant-layout-sider-children">
                <div>
                    <a href="/">
                        <div class="AppLayout-logo py-2">
                            <logo-white width="120"/>
                        </div>
                    </a>
                    <ul class="ant-menu ant-menu-root ant-menu-vertical ant-menu-dark" role="menu" tabindex="0"
                        data-menu-list="true" style="overflow: auto;">
                        <li class="ant-menu-item" :class="item.selected ? 'ant-menu-item-selected' : ''"
                            v-for="item in menuItems" role="menuitem" tabindex="-1"
                            aria-disabled="false" data-menu-id="rc-menu-uuid-54004-3-pages">
                            <component :is="item.icon"/>
                            <span class="ant-menu-title-content"><Link :href="item.href">{{
                                    $root.translate(item.name)
                                }}</Link></span>
                        </li>
                    </ul>
                    <div aria-hidden="true" style="display: none;"></div>
                </div>
                <div class="AppLayout-sider-footer">
                    <div
                        style="display: flex; border: 1px solid rgb(43, 37, 42); color: rgba(255, 255, 255, 0.65); border-radius: 10px; padding: 12px; margin-bottom: 36px; flex-direction: column;">
                        {{
                            $root.translate('Subscribe to stay tuned to the news and contribute to the development of')
                        }} {{ $root.translate($root.appName) }}
                        <div style="display: flex; margin-top: 12px;"><a
                            href="https://instagram.com/qcd_barnaul?igshid=YmMyMTA2M2Y="
                            target="_blank" rel="noreferrer">
                            <logo-instagram
                                class="tapy-social"
                                width="32" height="32" style="display: block; margin-right: 12px;"/>
                        </a><a
                            style="display: block; margin-right: 12px;"
                            href="https://t.me/qcqinfo" target="_blank" rel="noreferrer">
                            <logo-telegram class="tapy-social"
                                           src="https://tapy.me/land-assets/images/socials/telegram.svg"
                                           alt="" width="32"
                                           height="32"
                                           style="display: block;"/>
                        </a><a
                            href="https://vk.com/qcd_barnaul" target="_blank" rel="noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                 fill="none">
                                <path
                                    d="M0 14.4C0 7.61 0 4.22 2.1 2.1 4.23 0 7.62 0 14.4 0h1.2c6.79 0 10.18 0 12.3 2.1C30 4.23 30 7.62 30 14.4v1.2c0 6.79 0 10.18-2.1 12.3C25.77 30 22.38 30 15.6 30h-1.2c-6.79 0-10.18 0-12.3-2.1C0 25.77 0 22.38 0 15.6v-1.2Z"
                                    fill="#07F"/>
                                <path
                                    d="M15.96 21.61c-6.84 0-10.74-4.68-10.9-12.48H8.5c.11 5.72 2.63 8.14 4.63 8.64V9.13h3.23v4.93c1.97-.21 4.05-2.46 4.75-4.94h3.22a9.53 9.53 0 0 1-4.38 6.23 9.87 9.87 0 0 1 5.13 6.26h-3.55c-.76-2.37-2.66-4.21-5.17-4.46v4.46h-.39Z"
                                    fill="#fff"/>
                            </svg>
                        </a>
                        </div>
                    </div>
                    <locale-dropdown
                        theme="SwitchLanguageDropdown-button"
                        placement="topLeft"
                        @switchLocale="$root.switchLocale"
                        :current-locale-obj="$root.currentLocale._misc.name"
                        :locales-available="$root.getLocalesAvailable()"/>
                </div>
            </div>
        </aside>
        <section class="ant-layout AppLayout-inner">
            <header class="ant-layout-header AppLayout-header">
                <div class="AppLayout-header-content">
                    <div class="AppLayout-title"
                         style="display: flex; align-items: center; margin-left: 24px; font-size: 20px;">
                        <div v-if="isMobile" @click="showMenu" style="height: 1em;display: flex;margin-left: -25px">
                            <span role="img" aria-label="bars" class="anticon anticon-bars"><svg viewBox="0 0 1024 1024"
                                                                                                 focusable="false"
                                                                                                 data-icon="bars"
                                                                                                 width="1em"
                                                                                                 height="1em"
                                                                                                 fill="currentColor"
                                                                                                 aria-hidden="true"><path
                                d="M912 192H328c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h584c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0 284H328c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h584c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm0 284H328c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h584c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zM104 228a56 56 0 10112 0 56 56 0 10-112 0zm0 284a56 56 0 10112 0 56 56 0 10-112 0zm0 284a56 56 0 10112 0 56 56 0 10-112 0z"></path></svg></span>
                        </div>
                        <div style="margin-left: 10px">
                            <slot name="header"/>
                        </div>
                    </div>
                </div>
                <div class="AppLayout-header-content">
                    <div class="ant-space ant-space-horizontal ant-space-align-center" style="gap: 8px;">
                        <div style="margin-right: 15px;color: green">
                            0 ₽
                        </div>
                        <div v-if="$page.props.auth.user.is_pro" class="ant-space-item" style="">
                            <div><span class="ant-tag ant-tag-has-color" style="background-color: black;">PRO</span>
                            </div>
                        </div>
                        <div v-else style="" @click="showUpgradeModal = true">
                            <span class="ant-tag ant-tag-volcano cursor-pointer py-1">🚀 Перейти на PRO</span>
                        </div>
                        <div class="ant-space-item" style="">
                            <button @click="feedbackModel = true" type="button"
                                    class="ant-btn ant-btn-text ant-btn-icon-only"><span role="img"
                                                                                         aria-label="like"
                                                                                         class="anticon anticon-like"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="like" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true"><path
                                d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 00-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 00471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0142.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg></span>
                            </button>
                        </div>
                        <div class="ant-space-item">
                            <a-dropdown :trigger="['click']">
                                <div class="AppLayout-user"><span
                                    class="ant-avatar ant-avatar-circle ant-dropdown-trigger AppLayout-user-avatar"
                                    style="background-color: rgb(210, 55, 161);"><span class="ant-avatar-string"
                                                                                       style="transform: scale(1) translateX(-50%) translateY(-15%);"><span
                                    role="img" aria-label="user" class="anticon anticon-user"><svg
                                    viewBox="64 64 896 896"
                                    focusable="false"
                                    data-icon="user"
                                    width="1em" height="1em"
                                    fill="currentColor"
                                    aria-hidden="true"><path
                                    d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z"></path></svg></span></span></span>
                                </div>
                                <template #overlay>
                                    <a-menu>
                                        <a-menu-item disabled key="0">
                                            <span
                                                class="ant-typography ant-typography-secondary">{{
                                                    $page.props.auth.user.email
                                                }}</span>
                                        </a-menu-item>
                                        <a-menu-divider/>
                                        <a-menu-item key="1">
                                            <div class="d-flex align-items-center">
                                                <span role="img" aria-label="logout"
                                                      class="anticon anticon-logout ant-dropdown-menu-item-icon"><svg
                                                    viewBox="64 64 896 896" focusable="false" data-icon="logout"
                                                    width="1em" height="1em" fill="currentColor" aria-hidden="true"><path
                                                    d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 01-112.7 75.9A352.8 352.8 0 01512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 01-112.7-75.9 353.28 353.28 0 01-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 000-12.6z"></path></svg></span>
                                                <span @click="logout" class="ant-dropdown-menu-title-content">{{
                                                        $root.translate('Logout')
                                                    }}</span>
                                            </div>
                                        </a-menu-item>
                                    </a-menu>
                                </template>
                            </a-dropdown>
                        </div>
                    </div>
                </div>
            </header>
            <main @click="showSidebar = false" class="ant-layout-content AppLayout-content"
                  style="margin: 24px; min-height: auto;">
                <slot/>
            </main>
        </section>
    </section>
</template>
