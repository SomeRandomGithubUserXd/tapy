import Profile from "@/Components/Editor/EdtiorComponents/Profile/Profile.vue";
import LinkComponent from "@/Components/Editor/EdtiorComponents/Link/LinkComponent.vue";
import HeaderComponent from "@/Components/Editor/EdtiorComponents/Header/HeaderComponent.vue";
import TextComponent from "@/Components/Editor/EdtiorComponents/Text/TextComponent.vue";
import FAQComponent from "@/Components/Editor/EdtiorComponents/FAQ/FAQComponent.vue";
import SocialButtonsComponent from "@/Components/Editor/EdtiorComponents/SocialButtons/SocialButtonsComponent.vue";
import ProductsComponent from "@/Components/Editor/EdtiorComponents/Products/ProductsComponent.vue";


export const components = {
    profile: Profile,
    link: LinkComponent,
    header: HeaderComponent,
    text: TextComponent,
    faq: FAQComponent,
    social_buttons: SocialButtonsComponent,
    products: ProductsComponent
}


export const socialButtons = {
    phone: {
        inputLabel: 'Your phone number',
        label: 'Phone',
        placeholder: '+123456789',
        bgColor: '#000',
        icon: 'Icon icon-call',
        valuePrefix: "tel:",
        color: '#fff',
        group: 'Misc'
    },
    email: {
        inputLabel: 'Your email',
        label: 'Email',
        placeholder: 'example@gmail.com',
        bgColor: '#000',
        icon: 'Icon icon-mail',
        valuePrefix: "mailto:",
        color: '#fff',
        group: 'Misc'
    },
    website: {
        inputLabel: 'Link to your website',
        label: 'Website',
        placeholder: 'https://example.com',
        bgColor: '#000',
        icon: 'Icon icon-web',
        valuePrefix: "",
        color: '#fff',
        group: 'Misc'
    },
    "messenger": {
        "inputLabel": "Facebook username",
        "label": "Messenger",
        "placeholder": "https://m.me/username",
        "bgColor": "rgb(0, 132, 255)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-fbm",
        "valuePrefix": "",
        "group": "Messengers"
    },
    "whatsapp": {
        "inputLabel": "Your WhatsApp phone number",
        "label": "WhatsApp",
        "placeholder": "+123456789",
        "bgColor": "rgb(37, 211, 102)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-wa",
        "valuePrefix": "https://api.whatsapp.com/send?phone=",
        "group": "Messengers"
    },
    "telegram": {
        "inputLabel": "Link to your Telegram account or channel",
        "label": "Telegram",
        "placeholder": "https://t.me/username",
        "bgColor": "rgb(31, 155, 218)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-telegram",
        "valuePrefix": "",
        "group": "Messengers"
    },
    "viber": {
        "inputLabel": "Your Viber phone number",
        "label": "Viber",
        "placeholder": "+123456789",
        "bgColor": "rgb(131, 73, 149)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-viber",
        "valuePrefix": "viber://chat?number=",
        "group": "Messengers"
    },
    "facebook": {
        "inputLabel": "Link",
        "label": "Facebook",
        "placeholder": "https://facebook.com/example",
        "bgColor": "rgb(0, 132, 255)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-fb",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "instagram": {
        "inputLabel": "Link",
        "label": "Instagram",
        "placeholder": "https://instagram.com/username",
        "bgColor": "rgb(225, 48, 108)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-inst",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "twitter": {
        "inputLabel": "Link",
        "label": "Twitter",
        "placeholder": "https://twitter.com/elonmusk",
        "bgColor": "rgb(29, 161, 242)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-twitter",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "vkontakte": {
        "inputLabel": "Link",
        "label": "Vkontakte",
        "placeholder": "https://vk.com/example",
        "bgColor": "rgb(39, 135, 245)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-vk",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "ok": {
        "inputLabel": "Link",
        "label": "Ok",
        "placeholder": "https://ok.ru/example",
        "bgColor": "rgb(247, 148, 29)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-ok",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "snapchat": {
        "inputLabel": "Link",
        "label": "Snapchat",
        "placeholder": "https://www.snapchat.com/add/username",
        "bgColor": "rgb(255, 255, 0)",
        "color": "rgb(0, 0, 0)",
        "icon": "icon-sc",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "youtube": {
        "inputLabel": "Link",
        "label": "YouTube",
        "placeholder": "https://www.youtube.com/watch?v=123",
        "bgColor": "rgb(233, 50, 35)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-yt",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "vimeo": {
        "inputLabel": "Link",
        "label": "Vimeo",
        "placeholder": "https://vimeo.com/example",
        "bgColor": "rgb(26, 183, 234)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-vimeo",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "twitch": {
        "inputLabel": "Link",
        "label": "Twitch",
        "placeholder": "https://twitch.tv/example",
        "bgColor": "rgb(100, 65, 163)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-twitch",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "tiktok": {
        "inputLabel": "Link",
        "label": "TikTok",
        "placeholder": "https://tiktok.com/@username",
        "bgColor": "rgb(0, 0, 0)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-tik",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "patreon": {
        "inputLabel": "Link",
        "label": "Patreon",
        "placeholder": "https://patreon.com/username",
        "bgColor": "rgb(232, 91, 69)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-patr",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "linkedin": {
        "inputLabel": "Link",
        "label": "LinkedIn",
        "placeholder": "https://linkedin.com/username",
        "bgColor": "rgb(0, 123, 181)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-linked",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "pinterest": {
        "inputLabel": "Link",
        "label": "Pinterest",
        "placeholder": "https://pinterest.com/username",
        "bgColor": "rgb(230, 0, 35)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-pinterest",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "discord": {
        "inputLabel": "Link",
        "label": "Discord",
        "placeholder": "https://discord.com/invite/username",
        "bgColor": "rgb(88, 101, 242)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-discord",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "donationalerts": {
        "inputLabel": "Link",
        "label": "DonationAlerts",
        "placeholder": "https://www.donationalerts.com/r/username",
        "bgColor": "rgb(31, 31, 31)",
        "color": "rgb(245, 125, 7)",
        "icon": "icon-donationalerts",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "steam": {
        "inputLabel": "Link",
        "label": "Steam",
        "placeholder": "https://steamcommunity.com/id/username",
        "bgColor": "rgb(23, 26, 33)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-steam",
        "valuePrefix": "",
        "group": "Social networks"
    },
    "apple music": {
        "inputLabel": "Link",
        "label": "Apple Music",
        "placeholder": "https://music.apple.com/us/album",
        "bgColor": "rgb(227, 62, 69)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-applm",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "yandex music": {
        "inputLabel": "Link",
        "label": "Yandex Music",
        "placeholder": "https://music.yandex.ru/album/123",
        "bgColor": "rgb(255, 216, 72)",
        "color": "rgb(0, 0, 0)",
        "icon": "icon-yandexmusic",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "spotify": {
        "inputLabel": "Link",
        "label": "Spotify",
        "placeholder": "https://open.spotify.com/user/username",
        "bgColor": "rgb(29, 185, 84)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-spot",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "deezer": {
        "inputLabel": "Link",
        "label": "Deezer",
        "placeholder": "https://www.deezer.com/en/artist/123",
        "bgColor": "rgb(0, 0, 0)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-deezer",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "youtube music": {
        "inputLabel": "Link",
        "label": "YouTube Music",
        "placeholder": "https://music.youtube.com/watch?v=123",
        "bgColor": "rgb(233, 50, 35)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-youtube-music",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "vk music": {
        "inputLabel": "Link",
        "label": "VK Music",
        "placeholder": "https://share.boom.ru/track/321?share_auth=123",
        "bgColor": "rgb(255, 81, 255)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-vk-music",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "apple podcasts": {
        "inputLabel": "Link",
        "label": "Apple Podcasts",
        "placeholder": "https://podcasts.apple.com/us/podcast/",
        "bgColor": "rgb(125, 80, 223)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-applepod",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "google podcasts": {
        "inputLabel": "Link",
        "label": "Google Podcasts",
        "placeholder": "https://podcasts.google.com/feed/123",
        "bgColor": "rgb(234, 67, 53)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-google-podcasts",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "castbox": {
        "inputLabel": "Link",
        "label": "Castbox",
        "placeholder": "https://castbox.fm/episode/123",
        "bgColor": "rgb(255, 98, 34)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-castbox",
        "valuePrefix": "",
        "group": "Music & Podcasts"
    },
    "zoom": {
        "inputLabel": "Link",
        "label": "Zoom",
        "placeholder": "https://example.zoom.us/j/123",
        "bgColor": "rgb(45, 140, 255)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-zoom",
        "valuePrefix": "",
        "group": "Video calls"
    },
    "behance": {
        "inputLabel": "Link",
        "label": "Behance",
        "placeholder": "https://behance.net/username",
        "bgColor": "rgb(0, 87, 254)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-be",
        "valuePrefix": "",
        "group": "Design"
    },
    "dribble": {
        "inputLabel": "Link",
        "label": "Dribble",
        "placeholder": "https://dribbble.com/username",
        "bgColor": "rgb(234, 76, 137)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-dribble",
        "valuePrefix": "",
        "group": "Design"
    },
    "deviantart": {
        "inputLabel": "Link",
        "label": "DeviantArt",
        "placeholder": "https://www.deviantart.com/username",
        "bgColor": "rgb(5, 204, 70)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-devian",
        "valuePrefix": "",
        "group": "Design"
    },
    "flickr": {
        "inputLabel": "Link",
        "label": "Flickr",
        "placeholder": "https://www.flickr.com/photos/123",
        "bgColor": "rgb(238, 238, 238)",
        "color": "rgb(0, 0, 0)",
        "icon": "icon-flickr",
        "valuePrefix": "",
        "group": "Design"
    },
    "apple store": {
        "inputLabel": "Link",
        "label": "Apple Store",
        "placeholder": "https://apps.apple.com/us/app/example/id123",
        "bgColor": "rgb(0, 0, 0)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-apple",
        "valuePrefix": "",
        "group": "Application stores"
    },
    "google play": {
        "inputLabel": "Link",
        "label": "Google Play",
        "placeholder": "https://play.google.com/store/apps/details?id=example",
        "bgColor": "rgb(0, 0, 0)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-gplay",
        "valuePrefix": "",
        "group": "Application stores"
    },
    "github": {
        "inputLabel": "Link",
        "label": "Github",
        "placeholder": "https://github.com/username",
        "bgColor": "rgb(51, 51, 51)",
        "color": "rgb(255, 255, 255)",
        "icon": "icon-github",
        "valuePrefix": "",
        "group": "Other"
    }
}
