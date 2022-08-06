<script setup>
import LogoWhite from "@/Components/Misc/LogoWhite.vue";
import LogoInstagram from "@/Components/Misc/LogoInstagram.vue";
import LogoTelegram from "@/Components/Misc/LogoTelegram.vue";
import LocaleDropdown from "@/Components/LocaleDropdown.vue";
import {getCurrentInstance, reactive} from "vue";
import {ShoppingCartOutlined, FileTextOutlined} from '@ant-design/icons-vue';
import {Link} from "@inertiajs/inertia-vue3";
import {message} from "ant-design-vue";

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
        selected:  route().current('products.index'),
    }
])
</script>

<template>
    <section class="ant-layout ant-layout-has-sider AppLayout">
        <aside class="ant-layout-sider ant-layout-sider-dark"
               style="flex: 0 0 220px; max-width: 220px; min-width: 220px; width: 220px;">
            <div class="ant-layout-sider-children">
                <div>
                    <a href="/">
                        <div class="AppLayout-logo">
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
                                    this.$root.translate(item.name)
                                }}</Link></span>
                        </li>
                    </ul>
                    <div aria-hidden="true" style="display: none;"></div>
                </div>
                <div class="AppLayout-sider-footer">
                    <div
                        style="display: flex; border: 1px solid rgb(43, 37, 42); color: rgba(255, 255, 255, 0.65); border-radius: 10px; padding: 12px; margin-bottom: 36px; flex-direction: column;">
                        {{ this.$root.translate('Subscribe to stay tuned to the news and contribute to the development of') }} {{ this.$root.translate(this.$root.appName)}}
                        <div style="display: flex; margin-top: 12px;"><a href="https://www.instagram.com/tapy.me/"
                                                                         target="_blank" rel="noreferrer">
                            <logo-instagram
                                class="tapy-social"
                                width="32" height="32" style="display: block; margin-right: 12px;"/>
                        </a><a
                            href="https://t.me/tapyme" target="_blank" rel="noreferrer">
                            <logo-telegram class="tapy-social"
                                           src="https://tapy.me/land-assets/images/socials/telegram.svg"
                                           alt="" width="32"
                                           height="32"
                                           style="display: block;"/>
                        </a>
                        </div>
                    </div>
                    <locale-dropdown
                        theme="SwitchLanguageDropdown-button"
                        placement="topLeft"
                        @switchLocale="this.$root.switchLocale"
                        :current-locale-obj="this.$root.currentLocale._misc.name"
                        :locales-available="this.$root.getLocalesAvailable()"/>
                </div>
            </div>
        </aside>
        <section class="ant-layout AppLayout-inner">
            <header class="ant-layout-header AppLayout-header">
                <div class="AppLayout-header-content">
                    <div class="AppLayout-title" style="display: block; margin-left: 24px; font-size: 20px;">
                        <slot name="header"/>
                    </div>
                </div>
                <div class="AppLayout-header-content">
                    <div class="ant-space ant-space-horizontal ant-space-align-center" style="gap: 8px;">
                        <div class="ant-space-item" style="">
                            <button type="button" class="ant-btn ant-btn-text ant-btn-icon-only"><span role="img"
                                                                                                       aria-label="like"
                                                                                                       class="anticon anticon-like"><svg
                                viewBox="64 64 896 896" focusable="false" data-icon="like" width="1em" height="1em"
                                fill="currentColor" aria-hidden="true"><path
                                d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 00-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4A106.62 106.62 0 00471 99.9c-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81zm636.4-353l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4a56.2 56.2 0 016.9 27.3c0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5a44.1 44.1 0 0142.2-32.3c7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path></svg></span>
                            </button>
                        </div>
                        <div class="ant-space-item">
                            <div class="AppLayout-user"><span
                                class="ant-avatar ant-avatar-circle ant-dropdown-trigger AppLayout-user-avatar"
                                style="background-color: rgb(210, 55, 161);"><span class="ant-avatar-string"
                                                                                   style="transform: scale(1) translateX(-50%) translateY(-15%);"><span
                                role="img" aria-label="user" class="anticon anticon-user"><svg viewBox="64 64 896 896"
                                                                                               focusable="false"
                                                                                               data-icon="user"
                                                                                               width="1em" height="1em"
                                                                                               fill="currentColor"
                                                                                               aria-hidden="true"><path
                                d="M858.5 763.6a374 374 0 00-80.6-119.5 375.63 375.63 0 00-119.5-80.6c-.4-.2-.8-.3-1.2-.5C719.5 518 760 444.7 760 362c0-137-111-248-248-248S264 225 264 362c0 82.7 40.5 156 102.8 201.1-.4.2-.8.3-1.2.5-44.8 18.9-85 46-119.5 80.6a375.63 375.63 0 00-80.6 119.5A371.7 371.7 0 00136 901.8a8 8 0 008 8.2h60c4.4 0 7.9-3.5 8-7.8 2-77.2 33-149.5 87.8-204.3 56.7-56.7 132-87.9 212.2-87.9s155.5 31.2 212.2 87.9C779 752.7 810 825 812 902.2c.1 4.4 3.6 7.8 8 7.8h60a8 8 0 008-8.2c-1-47.8-10.9-94.3-29.5-138.2zM512 534c-45.9 0-89.1-17.9-121.6-50.4S340 407.9 340 362c0-45.9 17.9-89.1 50.4-121.6S466.1 190 512 190s89.1 17.9 121.6 50.4S684 316.1 684 362c0 45.9-17.9 89.1-50.4 121.6S557.9 534 512 534z"></path></svg></span></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="ant-layout-content AppLayout-content" style="margin: 24px; min-height: auto;">
                <slot/>
            </main>
        </section>
    </section>
</template>
