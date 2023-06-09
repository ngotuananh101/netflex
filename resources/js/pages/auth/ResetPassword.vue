<template>
    <div class="page-header min-vh-100 flex-column justify-content-between">
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
        <main class="main-content main-content-bg mt-3 w-100">
            <div class="min-vh-75 d-flex justify-content-center align-items-center">
                <div class="container h-100">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-5 col-12 mt-2">
                            <div class="card border-0 mb-0 p-md-5 p-3">
                                <div class="card-header pt-0 bg-transparent pb-0">
                                    <h3 class="text-white text-start">{{ $t('auth.reset.title') }}</h3>
                                </div>
                                <div class="card-body py-0">
                                    <p class="text-white text-start" v-html="$t('auth.reset.subtitle')"></p>
                                    <form role="form" class="text-start needs-validation" novalidate
                                          @submit.prevent="send">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="floatingEmail"
                                                   :placeholder="$t('auth.reset.email')" v-model="email" required disabled>
                                            <label for="floatingEmail" class="fw-bold">{{
                                                    $t('auth.login.email')
                                                }}</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control"
                                                   id="floatingPassword"
                                                   :placeholder="$t('auth.reset.password')" v-model="password"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$"
                                                   required>
                                            <label for="floatingPassword" class="fw-bold">{{
                                                    $t('auth.reset.password')
                                                }}</label>
                                            <div class="invalid-feedback text-xs">
                                                {{ $t('auth.login.password_invalid') }}
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="floatingPassword2"
                                                   :placeholder="$t('auth.reset.confirm')" v-model="password_confirmation"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$"
                                                   required>
                                            <label for="floatingPassword2" class="fw-bold">{{
                                                    $t('auth.reset.confirm')
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
                                                class="mt-3"
                                            >
                                                {{ $t('auth.reset.title') }}
                                            </argon-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="border-0 mt-3">
                                <p>
                                    <span class="text-white me-1 opacity-8">{{ $t('auth.login.protected') }}</span>
                                    <router-link :to="{name: 'login'}" class="text-primary">
                                        {{ $t('auth.login.protected_link') }}
                                    </router-link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <auth-footer/>
    </div>
</template>

<script>
import ArgonButton from "../../components/ArgonButton.vue";
import Navbar from "../../components/navbars/Auth.vue";
import AuthFooter from "../../components/footers/Auth.vue";

export default {
    name: "Reset Password",
    components: {
        Navbar,
        ArgonButton,
        AuthFooter,
    },
    title() {
        return this.$t('auth.reset.title');
    },
    data() {
        return {
            email: this.$route.query.email,
            token: this.$route.params.token,
            password: '',
            password_confirmation: '',
        }
    },
    created() {
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            switch (mutation.type) {
                case 'auth/request':
                    this.$root.showSnackbar('info', this.$t('auth.forgot.sending'));
                    break;
                case 'auth/resetSuccess':
                    this.$root.showSnackbar('success', mutation.payload.message);
                    this.$router.push({name: 'login'});
                    break;
                case 'auth/error':
                    this.$root.showSnackbar('danger', mutation.payload.response.data.message);
                    break;
            }
        });
    },
    beforeUnmount() {
        this.unsubscribe();
    },
    methods: {
        send(e) {
            let form = e.target;
            if (form.checkValidity()) {
                if(this.password !== this.password_confirmation){
                    this.$root.showSnackbar('danger', this.$t('auth.reset.password_not_match'));
                    return;
                }
                this.$store.dispatch('auth/reset', {
                    email: this.email,
                    token: this.token,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });
            }
            if(!form.classList.contains('was-validated')){
                form.classList.add('was-validated');
            }
        },
    },
}
</script>

<style scoped>
.card {
    border-radius: 0.3rem;
    border: 0;
    box-shadow: none;
    background-color: rgba(255, 255, 255, 0.2);
}

input {
    border: 0;
    border-radius: 0.2rem;
    color: #fff;
    background: #3f3f3f;
    font-size: 1rem;
    height: 2.5rem;
}

input:disabled {
    background: #1f1f1f;
    color: #fff;
}

input:focus {
    background: #313131;
    color: #fff;
}

label {
    color: #8c8c8c;
    //top: -1%;
}

.page-header {
    background-image: url("../../assets/img/background/forgot.jpg");
}

footer a:hover {
    text-decoration: 1px underline;
}
</style>

