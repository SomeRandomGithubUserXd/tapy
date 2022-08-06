<script setup>
import {components} from "@/Helpers/EditorHelper";
</script>

<template>
    <div style="height: 100vh;" class="BlocksWrapper preview mobile" :style="$page.props.page.theme[0].containerStyle">
        <div class="BlocksWrapper-inner" :style="$page.props.page.theme[0].blockStyle">
            <component
                class="block-production"
                :is-editable="false"
                v-for="element in $page.props.page.page_elements"
                :element-id="element.id"
                :data="element.props"
                :theme="$page.props.page.theme[0]"
                :recursive="false"
                :is="components[element.component_alias]"/>
        </div>
    </div>
</template>
