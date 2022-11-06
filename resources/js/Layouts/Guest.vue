<script setup>
import LocaleDropdown from "@/Components/LocaleDropdown.vue";

const landingUrl = import.meta.env.VITE_LANDING_URL
</script>

<template>
    <div class="LoginLayout-wrapper">
        <a class="LoginLayout-logo" :href="landingUrl"><img src="/logo.svg" alt=""></a>
        <slot/>
        <locale-dropdown
            @switchLocale="$root.switchLocale"
            :current-locale-obj="$root.currentLocale._misc.name"
            :locales-available="$root.getLocalesAvailable()"/>
    </div>
</template>
