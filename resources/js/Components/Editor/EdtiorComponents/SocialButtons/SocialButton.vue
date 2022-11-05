<script setup>
import {socialButtons} from "@/Helpers/EditorHelper";
import {computed} from "vue";

const props = defineProps({
    alias: String,
    value: String,
    btnCaption: String,
    btnText: String,
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

const viewTypesWithLabel = ['list', 'list:c']

const btnLabel = computed({
    get() {
        let label = ''
        if(viewTypesWithLabel.includes(props.view)) {
            label = props?.btnText || socialComponent.value?.rlabel || socialComponent.value.label
        } else {
            label = "&nbsp;"
        }
        return label;
    },
    set() {
    }
})

const registerClick = () => {
    axios.post(route('api.register_link_click'), {
        link: window.location.pathname.split('/')[1],
        link_name: socialComponent.value.label
    });
}
</script>

<template>
    <div class="SocialNetworks-block" :class="props.view">
        <div class="SocialNetworks-block-network">
            <a @click="registerClick" class="Link only-icon" rel="noopener nofollow ugc" :href="`${socialComponent.valuePrefix}${props.value}`" target="_blank"
               :style="btnStyle">
                <div class="Link-icon"><i :class="socialComponent.icon"
                                          style="font-size: 22px;"></i></div>
                <div class="Link-label" v-html="btnLabel"></div>
                <div v-if="btnCaption && viewTypesWithLabel.includes(props.view)" class="Link-caption">{{btnCaption}}</div>
            </a>
        </div>
    </div>
</template>
