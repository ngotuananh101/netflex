<template>
    <div class="page-header min-vh-100 flex-column justify-content-between">
        <span class="mask opacity-5" style="background: #000;"></span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <navbar
                        btn-background="bg-gradient-success"
                        :dark-mode="true"
                    />
                </div>
            </div>
        </div>
        <main class="main-content main-content-bg mt-3">
            <div class="min-vh-75">
                <div class="container h-100">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-12 mt-2 mx-md-5">
                            <div class="card border-0 mb-0 px-md-5 px-3 py-5 mx-md-5">
                                <div class="card-header pt-0 bg-transparent pb-0 mt-md-3">
                                    <h3 class="text-white text-start">{{ $t('auth.login.title') }}</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form" class="text-start mb-5 needs-validation" novalidate
                                          @submit.prevent="login">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="floatingEmail"
                                                   :placeholder="$t('auth.login.email')" v-model="email" required>
                                            <label for="floatingEmail" class="fw-bold">{{
                                                    $t('auth.login.email')
                                                }}</label>
                                            <div class="invalid-feedback text-xs">
                                                {{ $t('auth.login.email_invalid') }}
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control"
                                                   id="floatingPassword"
                                                   :placeholder="$t('auth.login.password')" v-model="password"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$"
                                                   required>
                                            <label for="floatingPassword" class="fw-bold">{{
                                                    $t('auth.login.password')
                                                }}</label>
                                            <div class="invalid-feedback text-xs">
                                                {{ $t('auth.login.password_invalid') }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <argon-button
                                                color="danger"
                                                full-width
                                                size="lg"
                                                class="mt-4"
                                            >{{ $t('auth.login.title') }}
                                            </argon-button>
                                        </div>
                                        <div class="mt-2 d-flex justify-content-between">
                                            <argon-checkbox id="remember" name="remember_me">
                                                {{ $t('auth.login.remember_me') }}
                                            </argon-checkbox>
                                            <a href="#" style="font-size: 0.8rem; color: #b3b3b3;">{{
                                                    $t('auth.login.need_help')
                                                }}</a>
                                        </div>
                                    </form>
                                    <div class="text-start" style="margin-top: 5rem;">
                                        <p class="text-white mb-2">
                                            <span class="opacity-7 me-2">{{ $t('auth.login.new_to_netflex') }}</span>
                                            <router-link :to="{name: 'login'}" class="text-white">
                                                {{ $t('auth.login.sign_up_now') }}
                                            </router-link>
                                        </p>
                                        <p class="text-white text-xs">
                                            <span class="opacity-7 me-1">{{ $t('auth.login.protected') }}</span>
                                            <router-link :to="{name: 'login'}" class="text-primary">
                                                {{ $t('auth.login.protected_link') }}
                                            </router-link>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="w-100 mt-md-5" style="background-color: rgba(0, 0, 0, 0.7);">
            <div class="container my-5 position-relative" style="z-index: 3;">
                <div class="row opacity-6">
                    <div class="col-12 mb-3">
                        <a :href="$t('landing.footers.0.link')" class="fs-6 text-white">{{
                                $t('landing.footers.0.title')
                            }}</a>
                    </div>
                    <div class="col-md-3 col-6 mt-2" v-for="value in footer">
                        <a :href="$t('landing.footers.' + value + '.link')"
                           class="text-light text-sm">{{ $t('landing.footers.' + value + '.title') }}</a>
                    </div>
                    <div class="col-12 mb-3"></div>
                    <div class="col-md-2 col-6 mt-2 d-flex flex-column">
                        <select
                            id="choices-language"
                            class="form-control px-4 fs-6 text-white"
                            name="choices-language"
                            style="max-height: 100%;"
                            @change="changeLanguage"
                            v-model="language"
                        >
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
import ArgonButton from "../../components/ArgonButton.vue";
import ArgonCheckbox from "../../components/ArgonCheckbox.vue";
import Navbar from "../../components/navbars/LogIn.vue";
import {mapMutations} from "vuex";

export default {
    name: "Login",
    components: {
        Navbar,
        ArgonButton,
        ArgonCheckbox,
    },
    data() {
        return {
            email: '',
            password: '',
            footer: [1, 2, 8, 9, 10, 11],
            language: 'en',
        }
    },
    created() {
        this.$store.state.hideConfigButton = true;
        this.toggleDefaultLayout();
        this.language = this.$root.language;
    },
    beforeUnmount() {
        this.$store.state.hideConfigButton = false;
        this.toggleDefaultLayout();
    },
    methods: {
        login(e) {
            let form = e.target;
            if (form.checkValidity()) {
                let formData = new FormData(form);
                console.log(formData.get('email'));
            }
            form.classList.add('was-validated');
        },
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        },
        ...mapMutations({
            toggleDefaultLayout: "config/toggleDefaultLayout",
        }),
    },
}
</script>

<style scoped>
.card {
    border-radius: 0.3rem;
    border: 0;
    box-shadow: none;
    background-color: rgba(0, 0, 0, 0.7);
}

input {
    border: 0;
    border-radius: 0.3rem;
    color: #fff;
    height: 3rem !important;
    line-height: 3rem !important;
    padding: 1rem 1rem 0 !important;
    background: #333;
    font-size: 1rem;
}

input:focus {
    background: #444;
    color: #fff;
}

label {
    color: #8c8c8c;
    top: -3%;
}

.form-control:invalid {
    border-bottom: 2px solid #e87c03;
}

.invalid-feedback {
    color: #e87c03;
}

.page-header {
    background-image: url("../../assets/img/background.jpg");
}

footer a:hover {
    text-decoration: 1px underline;
}
</style>
