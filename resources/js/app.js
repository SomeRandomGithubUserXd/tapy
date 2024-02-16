import './bootstrap';
import '../css/app.css';

import Antd from 'ant-design-vue';
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/inertia-vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import {collect} from "collect.js";
import {default as lang} from "@/Lang/lang.json";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const localeMixin = {
    created() {
        const regexp = /^\d+/g;
        const browserLang = window.navigator.language.split('-')[0]
        if (localStorage.getItem('lang')) {
            this.websiteLocale = localStorage.getItem('lang')
        } else {
            localStorage.setItem('lang', browserLang)
            this.websiteLocale = browserLang
        }

    },
    data() {
        return {
            websiteLocale: 'ru',
            appName: appName
        }
    },
    computed: {
        currentLocale() {
            return collect(lang).where('_misc.self', '===', this.websiteLocale).first()
        },
    },
    methods: {
        switchLocale(localeSelf) {
            localStorage.setItem('lang', localeSelf)
            this.websiteLocale = localeSelf
        },
        getLocalesAvailable() {
            return collect(lang)
                .pluck('_misc')
                .all()
                .filter(locale => locale.self !== this.currentLocale._misc.self)
        },
        translate(string) {
            const locale = this.currentLocale
            if (locale._misc.self === 'en') return string;
            return locale[string] || string;
        }
    }
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Antd)
            .mixin(localeMixin)
            .mount(el);
    }
});
