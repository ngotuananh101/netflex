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
            <div class="min-vh-75">
                <div class="container h-100">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-12 mt-3">
                            <div class="card border-0 mb-0 p-md-5 p-3 mx-md-5">
                                <div class="card-header pt-0 bg-transparent pb-0 mt-md-3">
                                    <h3 class="text-white text-start">{{ $t('auth.forgot.title') }}</h3>
                                </div>
                                <div class="card-body py-0">
                                    <form role="form" class="text-start needs-validation" novalidate
                                          @submit.prevent="send">
                                        <p class="text-white text-start mt-4">{{ $t('auth.forgot.how') }}</p>
                                        <div class="mb-3">
                                            <div class="form-check ps-0">
                                                <input class="radio" type="radio" name="type"
                                                       id="email" value="email" v-model="type">
                                                <label class="label" for="email">
                                                    {{ $t('auth.forgot.email') }}
                                                </label>
                                            </div>
                                            <div class="form-check ps-0">
                                                <input class="radio" type="radio" name="type"
                                                       id="phone" value="phone" v-model="type">
                                                <label class="label" for="phone">
                                                    {{ $t('auth.forgot.phone') }}
                                                </label>
                                            </div>
                                        </div>
                                        <p class="text-white text-start mt-4">{{ $t('auth.forgot.subtitle') }}</p>
                                        <div class="form-group mb-3" v-if="type === 'email'">
                                            <input type="email" name="email" class="form-control"
                                                   id="email-data"
                                                   placeholder="admin@ponas.dev" v-model="data"
                                                   required>
                                            <div class="invalid-feedback">
                                                {{ $t('auth.forgot.email_invalid') }}
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row" v-if="type === 'phone'">
                                            <div class="col-md-4 col-12">
                                                <select class="form-group " aria-label="Default select" v-model="code">
                                                    <option :value="key" v-for="(value, key) in countryCodesObject">
                                                        {{ value }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-8 col-12">
                                                <input type="text" name="phone" class="form-control"
                                                       id="phone-data"
                                                       placeholder="12345689" v-model="data"
                                                       pattern="[0-9]{9,10}"
                                                       required>
                                                <div class="invalid-feedback">
                                                    {{ $t('auth.forgot.phone_invalid') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <argon-button
                                                color="danger"
                                                full-width
                                                size="lg"
                                                class="mt-3"
                                            >
                                                {{ type === 'email' ? $t('auth.forgot.send_email') : $t('auth.forgot.send_sms') }}
                                            </argon-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="border-0 mb-0 px-0 pt-3 mx-md-5">
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
import ArgonRadio from "../../components/ArgonRadio.vue";
import Navbar from "../../components/navbars/Auth.vue";
import AuthFooter from "../../components/footers/Auth.vue";
import countryCodes from 'country-codes-list';

export default {
    name: "Forgot Password",
    components: {
        Navbar,
        ArgonButton,
        ArgonRadio,
        AuthFooter,
    },
    title() {
        return this.$t('auth.forgot.title');
    },
    data() {
        return {
            type: 'email',
            data: 'ngotuananh2101@gmail.com',
            code: '84',
            countryCodesObject: countryCodes.customList('countryCallingCode', '[{countryCode}] +{countryCallingCode}'),
        }
    },
    created() {
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            switch (mutation.type) {
                case 'auth/request':
                    this.$root.showSnackbar('info', this.$t('auth.forgot.sending'));
                    break;
                case 'auth/forgotSuccess':
                    this.$root.showSnackbar('success', mutation.payload.message);
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
                e.preventDefault();
                let data = {
                    type: this.type,
                };
                if (this.type === 'email') {
                    data.email = this.data;
                    this.$store.dispatch('auth/forgot', data);
                } else {
                    data.phone = '+' + this.code + Number(this.data);
                    // show not support yet
                    this.$root.showSnackbar('danger', this.$t('auth.forgot.not_support'));
                    this.type = 'email';
                    this.data = '';
                }
            }
            form.classList.add('was-validated');
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
    font-size: 1.2rem;
    height: 3rem;
}

input:focus {
    background: #313131;
    color: #fff;
}

#phone-data {
    border-radius: 0 0.2rem 0.2rem 0;
}

.form-group select {
    border: 0;
    border-radius: 0.2rem 0 0 0.2rem;
    color: #fff;
    background: #3f3f3f;
    font-size: 1.2rem;
    height: 3rem;
    padding: 0 0.5rem;
}

label {
    color: #8c8c8c;
    top: -3%;
}

.form-control:invalid {
    border-bottom: 2px solid #e87c03;
}

.page-header {
    background-image: url("../../assets/img/background/forgot.jpg");
}

footer a:hover {
    text-decoration: 1px underline;
}

.form-check {
    display: flex;
    align-items: center;

    .radio {
        width: 1.4rem;
        height: 2.5rem !important;
    }

    .label {
        margin-bottom: 0;
        margin-left: 0.5rem;
        color: white;
        font-size: 1rem;
        font-weight: normal;
    }
}
</style>
