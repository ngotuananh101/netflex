<template>
    <div class="position-fixed top-1 end-1" style="z-index: 99999;">
        <argon-snackbar
            v-for="(notification, index) in notifications"
            :title="this.$t('app.system')"
            date=""
            class="notification"
            :data-i="index"
            :description="notification.message"
            :icon="{ component: 'ni ni-check-bold', color: 'white' }"
            :color="notification.color"
            :close-handler="closeSnackbar"
        />
    </div>
    <router-view></router-view>
</template>

<script>
import {changeLanguage} from "i18next";
import ArgonSnackbar from "./components/ArgonSnackbar.vue";

export default {
    name: "App",
    title() {
        return this.$t('app.title');
    },
    data() {
        return {
            language: 'en',
            notifications: [],
        }
    },
    components: {
        ArgonSnackbar
    },
    methods: {
        changeLanguage(language) {
            this.language = language;
            localStorage.setItem('language', language);
            this.$i18next.changeLanguage(language);
        },
        showSnackbar(color, message) {
            this.notifications.push({
                message,
                color
            });
            setTimeout(() => {
                this.notifications.splice(0, 1);
            }, 5000);
        },
        closeSnackbar(e) {
            let index = parseInt(e.target.closest('.notification').dataset.i);
            this.notifications.splice(index, 1);
        },
    },
    mounted() {
        this.language = localStorage.getItem('language') || 'en';
        changeLanguage(this.language);
    }
}
</script>

<style scoped>

</style>
