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
                        <div class="col-md-7 col-12 text-center">
                            <p class="fw-bold text-white fs-3">{{ this.$t('auth.verify.verify') }}</p>
                            <div v-if="status === 'loading'">
                                <div class="spinner-border text-danger my-4 fs-4 p-3" role="status">
                                    <span class="sr-only"></span>
                                </div>
                                <p class="text-warning fs-6 mb-0 mt-2">{{ this.$t('auth.verify.wait') }}</p>
                            </div>
                            <div v-if="status === 'success'" class="mt-2 fs-4 p-3">
                                <i class="fa-light fa-circle-check text-success fs-1"></i>
                                <p class="text-success fs-6 mb-0 my-2">{{ this.$t('auth.verify.success') }}</p>
                                <p class="mb-0 text-white" v-html="this.$t('auth.verify.redirect', {time: this.time})"></p>
                            </div>
                            <div v-if="status === 'error'" class="mt-2 fs-4 p-3">
                                <i class="fa-light fa-circle-xmark text-danger fs-1"></i>
                                <p class="text-danger fs-6 mb-0 my-2" v-html="this.$t('auth.verify.error', { email:'ngotuananh2101@gmail.com' })"></p>
                            </div>
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

export default {
    name: "Verify Email Page",
    components: {Navbar},
    data() {
        return {
            language: 'en',
            footer: [1, 2, 8, 9, 10, 11],
            status: "loading",
            time: 5,
            counter: null,
            unsubscribe: null,
        };
    },
    created() {
        this.language = this.$root.language;
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            switch (mutation.type) {
                case 'auth/request':
                    this.status = 'loading';
                    break;
                case 'auth/verifySuccess':
                    this.status = 'success';
                    this.counter ? clearInterval(this.counter) : null;
                    this.counter = setInterval(() => {
                        this.time--;
                        if (this.time === 0) {
                            clearInterval(this.counter);
                            this.$router.push({name: 'home'});
                        }
                    }, 1000);
                    this.$root.showSnackbar('success', this.$t('auth.signup.success'));
                    break;
                case 'auth/error':
                    this.status = 'error';
                    let payload = mutation.payload;
                    let code = payload.response.data.message;
                    this.$root.showSnackbar('danger', (code > 10) ? this.$t('error.' + code) : code);
                    break;
            }
        });
        this.verify();
    },
    beforeUnmount() {
        this.unsubscribe();
    },
    methods: {
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        },
        verify(){
            let id = this.$route.params.id;
            let hash = this.$route.params.hash;
            let expires = this.$route.query.expires;
            let signature = this.$route.query.signature;
            this.$store.dispatch('auth/verify', {id, hash, expires, signature});
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
</style>
