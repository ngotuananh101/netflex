import './bootstrap';
import "../css/app.css";
import "./assets/css/nucleo-icons.css";
import "./assets/css/nucleo-svg.css";
import {createApp} from "vue";
import router from "./routes";
import store from "./stores";
import VueTilt from "vue-tilt.js";
import VueSweetalert2 from "vue-sweetalert2";
import Argon from "./argon";
import i18next from 'i18next';
import I18NextVue from 'i18next-vue';
import LanguageDetector from 'i18next-browser-languagedetector';
import translationEN from './locales/en/translation.json';
import translationVI from './locales/vi/translation.json';
i18next.use(LanguageDetector).init({
    fallbackLng: 'en',
    resources: {
        en: { translation: translationEN },
        vi: { translation: translationVI }
    },
});
import App from "./App.vue";
const app = createApp(App);
app.use(I18NextVue, { i18next });
app.use(router);
app.use(store);
app.use(VueTilt);
app.use(VueSweetalert2);
app.use(Argon);
app.mount("#app");
