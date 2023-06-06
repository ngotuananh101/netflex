<template>
    <div class="page-header min-vh-100 flex-column justify-content-between">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <navbar btn-background="bg-gradient-success" :dark-mode="true"/>
                </div>
            </div>
        </div>
        <main class="main-content main-content-bg mt-3 w-100">
            <div class="min-vh-75">
                <div class="container min-vh-75">
                    <div class="row justify-content-center align-items-center min-vh-75">
                        <div class="col-md-8 col-12 text-center">
                            <h3 class="fw-bold text-white fs-3">{{ $t('auth.sent.title') }}</h3>
                            <p class="text-white fs-6" v-html="$t('auth.sent.subtitle', { email: this.email })"></p>
                            <p class="text-white fs-6 mb-0" v-html="$t('auth.sent.contact', { email: 'ngotuananh2101@gmail.com' })"></p>
                            <argon-button color="danger" size="sm"
                                          class="mt-4 py-3 fs-5 text-white btnRegister"
                                          :class="sending ? 'disabled' : ''"
                                          style="border-radius: 2px;" @click="resend">
                                {{ sending ? this.$t('auth.sent.wait') : this.$t('auth.sent.resend') }}
                            </argon-button>
                            <p class="text-white fs-6 mb-0" v-if="counter != null" v-html="$t('auth.sent.count', { time: count })"></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="w-100 mt-md-5" style="background-color: rgba(255, 255, 255, 0.2);">
            <div class="container my-5 position-relative" style="z-index: 3;">
                <div class="row opacity-6">
                    <div class="col-12 mb-3">
                        <a :href="this.$t('landing.footers.0.link')" class="fs-6 text-white">{{
                                this.$t('landing.footers.0.title')
                            }}</a>
                    </div>
                    <div class="col-md-3 col-6 mt-2" v-for="value in footer">
                        <a :href="this.$t('landing.footers.' + value + '.link')" class="text-light text-sm">{{
                                this.$t('landing.footers.' + value + '.title')
                            }}</a>
                    </div>
                    <div class="col-12 mb-3"></div>
                    <div class="col-md-2 col-6 mt-2 d-flex flex-column">
                        <select id="choices-language" class="form-control px-4 fs-6 text-white" name="choices-language"
                                style="max-height: 100%;" @change="changeLanguage" v-model="language">
                            <option value="vi" data-select-text="Tiếng Việt">Tiếng Việt</option>
                            <option value="en" data-select-text="English">English</option>
                        </select>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import Navbar from "../../components/navbars/SignUp.vue";
import ArgonButton from "../../components/ArgonButton.vue";
import store from "../../stores";

export default {
    name: "Resend Email",
    components: {Navbar, ArgonButton},
    title(){
        return this.$t('auth.sent.title');
    },
    data() {
        return {
            language: 'en',
            footer: [1, 2, 8, 9, 10, 11],
            email: store.state.auth.user.email,
            sending: false,
            counter: null,
            count: 30,
            interval: null,
            unsubscribe: null,
        };
    },
    created() {
        this.language = this.$root.language;
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            let payload = mutation.payload;
            switch (mutation.type) {
                case 'auth/request':
                    this.sending = true;
                    this.$root.showSnackbar('warning', this.$t('auth.sent.wait'));
                    break;
                case 'auth/resendSuccess':
                    this.counter ? clearTimeout(this.counter) : null;
                    this.counter = setTimeout(() => {
                        this.sending = false;
                        this.counter = null;
                        this.count = 30;
                    }, 30000);
                    this.interval = setInterval(() => {
                        this.count--;
                        if (this.count <= 0) {
                            clearInterval(this.interval);
                            this.count = 30;
                        }
                    }, 1000);
                    this.$root.showSnackbar('success', this.$t('auth.sent.success'));
                    break;
                case 'auth/error':
                    this.sending = false;
                    this.$root.showSnackbar('danger', payload.response.data.message);
                    break;
            }
        });
    },
    beforeUnmount() {
        this.unsubscribe();
    },
    methods: {
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        },
        resend(){
            this.$store.dispatch('auth/resend', this.email);
        }
    },
}
</script>

<style scoped>
.page-header {
    background-color: rgba(0, 0, 0, 1);
}

#choices-language {
    background-color: #000;
    color: #fff;
}

.form-control {
    border-radius: 2px;
}
</style>
