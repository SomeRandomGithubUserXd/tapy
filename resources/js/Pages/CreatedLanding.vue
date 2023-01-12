<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue"
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue"
import HeaderComponent from "@/Components/Editor/EdtiorComponents/Header/HeaderComponent.vue"
import ATCComponent from "@/Components/Editor/EdtiorComponents/ATC/ATCComponent.vue"
import TextComponent from "@/Components/Editor/EdtiorComponents/Text/TextComponent.vue"
import FAQComponent from "@/Components/Editor/EdtiorComponents/FAQ/FAQComponent.vue"
import SocialButtonsComponent from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsComponent.vue"
import ProductsComponent from "@/Components/Editor/EdtiorComponents/Products/ProductsComponent.vue"
import HTMLComponent from "@/Components/Editor/EdtiorComponents/HTML/HTMLComponent.vue"
import ImageComponent from "@/Components/Editor/EdtiorComponents/Image/ImageComponent.vue"
import VideoComponent from "@/Components/Editor/EdtiorComponents/Image/ImageComponent.vue"
import SeparatorComponent from "@/Components/Editor/EdtiorComponents/Separator/SeparatorComponent.vue";
import ImageGallery from "@/Components/Editor/EdtiorComponents/ImageGallery/ImageGalleryComponent.vue";
import VideoGallery from "@/Components/Editor/EdtiorComponents/VideoGallery/VideoGalleryComponent.vue"
import LogoBlack from "@/Components/Misc/LogoBlack.vue";
import {usePage} from "@inertiajs/inertia-vue3";
import {onMounted} from "vue";

const components = {
    profile: Profile,
    video: VideoComponent,
    image: ImageComponent,
    link: LinkComponent,
    header: HeaderComponent,
    html: HTMLComponent,
    atc: ATCComponent,
    text: TextComponent,
    faq: FAQComponent,
    social_buttons: SocialButtonsComponent,
    products: ProductsComponent,
    separator: SeparatorComponent,
    image_gallery: ImageGallery,
    video_gallery: VideoGallery,
}

const pro_components = ['html']

const allowedElements = (elements, isPro) => {
    let allowed = elements
    if (!isPro) {
        allowed = []
        for (const element of elements) {
            if(!pro_components.includes(element.component_alias)) {
                allowed.push(element)
            }
        }
    }
    return allowed
}
const prettyUrl = import.meta.env.VITE_PRETTY_URL
const appUrl = import.meta.env.VITE_APP_URL

</script>

<template>
    <div style="min-height: 100vh;" class="BlocksWrapper preview mobile py-5"
         :style="$page.props.page.theme[0].containerStyle">
        <div class="BlocksWrapper-inner" :style="$page.props.page.theme[0].blockStyle">
            <component
                class="block-production"
                :is-editable="false"
                v-for="element in allowedElements($page.props.page.page_elements, $page.props.is_pro)"
                :element-id="element.id"
                :data="element.props"
                :theme="$page.props.page.theme[0]"
                :recursive="false"
                :is="components[element.component_alias]"/>
            <div class="d-flex justify-content-center w-100 my-4" v-if="!$page.props.page.hide_logo">
                Made on <logo-black style="width: 10%;"/> <a :href="appUrl">{{prettyUrl}}</a>
            </div>
        </div>
    </div>
</template>
