<script setup>
import {socialButtons} from "@/Helpers/EditorHelper";
import {computed} from "vue";

const props = defineProps({
    alias: String,
    value: String,
    theme: {
        required: false,
        type: Object,
        default: {}
    },
    view: String
})

const socialComponent = computed({
    get() {
        return socialButtons[props.alias]
    },
    set(){
    }
})

const btnStyle = computed({
    get() {
        const meta = socialComponent.value
        return {
            backgroundColor: meta.bgColor,
            color: meta.color
        }
    },
    set() {
    }
})


const btnLabel = computed({
    get() {
        let label = ''
        const viewTypesWithLabel = ['list', 'list:c']
        if(viewTypesWithLabel.includes(props.view)) {
            label = socialComponent.value.label
        } else {
            label = "&nbsp;"
        }
        return label;
    },
    set() {
    }
})

</script>

<template>
    <div class="SocialNetworks-block" :class="props.view">
        <div class="SocialNetworks-block-network">
            <a class="Link only-icon" rel="noopener nofollow ugc" :href="`${socialComponent.valuePrefix}${props.value}`" target="_blank"
               :style="btnStyle">
                <div class="Link-icon"><i :class="socialComponent.icon"
                                          style="font-size: 22px;"></i></div>
                <div class="Link-label" v-html="btnLabel"></div>
            </a>
        </div>
    </div>
</template>
