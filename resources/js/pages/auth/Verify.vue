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
                        <div class="col-md-5 col-12 text-center">
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.0.title') }}</p>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.0.title2') }}</p>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.0.subtitle') }}</p>
                                </div>
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
        };
    },
    created() {
        this.language = this.$root.language;
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            switch (mutation.type) {
                case 'auth/request':
                    this.isRegister = true;
                    this.$root.showSnackbar('warning', this.$t('auth.signup.wait'));
                    break;
                case 'auth/registerSuccess':
                    this.$root.showSnackbar('success', this.$t('auth.signup.success'));
                    this.$router.push({name: 'login'});
                    break;
                case 'auth/error':
                    this.isRegister = false;
                    this.$root.showSnackbar('danger', this.$t('auth.signup.error'));
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
