<script setup>
import LocaleDropdown from "@/Components/LocaleDropdown.vue";

const landingUrl = import.meta.env.VITE_LANDING_URL
</script>

<template>
    <div class="LoginLayout-wrapper">
        <a class="LoginLayout-logo" :href="landingUrl"><img src="/logo.svg" alt=""></a>
        <slot/>
        <locale-dropdown
            @switchLocale="this.$root.switchLocale"
            :current-locale-obj="this.$root.currentLocale._misc.name"
            :locales-available="this.$root.getLocalesAvailable()"/>
    </div>
</template>
