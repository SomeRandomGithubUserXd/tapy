<script setup>
import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue"
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue"
import HeaderComponent from "@/Components/Editor/EdtiorComponents/Header/HeaderComponent.vue"
import TextComponent from "@/Components/Editor/EdtiorComponents/Text/TextComponent.vue"
import FAQComponent from "@/Components/Editor/EdtiorComponents/FAQ/FAQComponent.vue"
import SocialButtonsComponent from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsComponent.vue"
import ProductsComponent from "@/Components/Editor/EdtiorComponents/Products/ProductsComponent.vue"

const components = {
    profile: Profile,
    link: LinkComponent,
    header: HeaderComponent,
    text: TextComponent,
    faq: FAQComponent,
    social_buttons: SocialButtonsComponent,
    products: ProductsComponent
}

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
