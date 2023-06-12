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
                        <div class="col-md-5 col-12" v-if="activeStep === 1">
                            <span class="text-uppercase fw-bold text-white text-xs">{{
                                    this.$t('auth.signup.step')
                                }} 1/3</span>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.0.title') }}</p>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.0.title2') }}</p>
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.0.subtitle') }}</p>
                                    <form role="form" class="text-start mb-5 needs-validation" novalidate
                                          @submit.prevent="checkFormValidity">
                                        <div class="form-floating mt-4">
                                            <input type="email" name="email" class="form-control" id="floatingEmail"
                                                   :placeholder="this.$t('auth.login.email')" v-model="email" required>
                                            <label for="floatingEmail" class="fw-bold">{{
                                                    this.$t('auth.login.email')
                                                }}</label>
                                            <div class="invalid-feedback text-xs">
                                                {{ this.$t('auth.login.email_invalid') }}
                                            </div>
                                        </div>
                                        <div class="form-floating mt-3">
                                            <input type="password" name="password" class="form-control"
                                                   id="floatingPassword" :placeholder="$t('auth.login.password')"
                                                   v-model="password"
                                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,60}$"
                                                   required>
                                            <label for="floatingPassword" class="fw-bold">{{
                                                    this.$t('auth.login.password')
                                                }}</label>
                                            <div class="invalid-feedback text-xs">
                                                {{ this.$t('auth.login.password_invalid') }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <argon-button color="danger" full-width size="lg" class="mt-4 py-3 fs-5"
                                                          style="border-radius: 2px;">{{ this.$t('auth.signup.next') }}
                                            </argon-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 text-center" v-if="activeStep === 2">
                            <i class="fa-light fa-circle-check fs-1" style="color: var(--nf-default-color);"></i>
                            <p class="text-uppercase fw-bold text-white text-xs mt-4">{{ this.$t('auth.signup.step') }}
                                2/3</p>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.1.title') }}</p>
                            <div class="text-start mt-4 mb-2 step2">
                                <div v-for="n in 3" class="d-flex align-items-center">
                                    <i class="fa-light fa-check fs-3"></i>
                                    <div class="col-10 fs-6 text-white">
                                        {{ this.$t('auth.signup.steps.1.options.' + (n - 1)) }}
                                    </div>
                                </div>
                            </div>
                            <argon-button color="danger" full-width size="lg" class="mt-4 py-3 fs-5"
                                          style="border-radius: 2px;" @click="nextStep">{{
                                    this.$t('auth.signup.next')
                                }}
                            </argon-button>
                            <p class="text-white mt-3 text-center" @click="prevStep">{{
                                    this.$t('auth.signup.back')
                                }}</p>
                        </div>
                        <div class="col-md-9 col-12 text-start" v-if="activeStep === 3">
                            <p class="text-uppercase fw-bold text-white text-xs mb-2">{{ this.$t('auth.signup.step') }}
                                2/3</p>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.2.title') }}</p>
                            <div class="row text-start step3">
                                <div class="col-12 fs-6 mt-2 text-white" v-for="n in 3">
                                    <i class="fa-light fa-check"></i>{{
                                        this.$t('auth.signup.steps.2.options.' + (n - 1))
                                    }}
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <div class="mb-4 col-lg-4 mb-lg-0 col-12">
                                    <pricing-card
                                        badge="Basic"
                                        class="price active"
                                        data-index="0"
                                        @click="planClick"
                                        :price="{ currency: '', value: 'FREE' }"
                                        :specifications="[
                                            { label: 'Other Source', includes: true },
                                            { label: 'HD (720p)', includes: false },
                                            { label: 'Full HD (1080p)', includes: false },
                                            { label: 'Ultra HD (4K)', includes: false },
                                        ]"/>
                                </div>
                                <div class="mb-4 col-lg-4 mb-lg-0 col-12">
                                    <pricing-card
                                        badge="Standard"
                                        class="price"
                                        data-index="1"
                                        @click="planClick"
                                        :price="{ currency: '', value: getPrice(1) }"
                                        :specifications="[
                                            { label: 'Other Source', includes: true },
                                            { label: 'HD (720p)', includes: true },
                                            { label: 'Full HD (1080p)', includes: true },
                                            { label: 'Ultra HD (4K)', includes: false },
                                        ]"/>
                                </div>
                                <div class="mb-4 col-lg-4 mb-lg-0 col-12">
                                    <pricing-card
                                        badge="Premium"
                                        class="price"
                                        data-index="2"
                                        @click="planClick"
                                        :price="{ currency: '', value: getPrice(2) }"
                                        :specifications="[
                                            { label: 'Other Source', includes: true },
                                            { label: 'HD (720p)', includes: true },
                                            { label: 'Full HD (1080p)', includes: true },
                                            { label: 'Ultra HD (4K)', includes: true },
                                        ]"/>
                                </div>
                                <div class="col-12 mt-4">
                                    <p class="text-white text-sm">{{ this.$t('auth.signup.steps.2.subtitle') }}</p>
                                    <p class="text-white text-sm">{{ this.$t('auth.signup.steps.2.subtitle2') }}</p>
                                </div>
                                <div class="col-md-6 col-12 my-3">
                                    <argon-button color="danger" full-width size="lg" class="mt-4 py-3 fs-5"
                                                  style="border-radius: 2px;" @click="nextStep">
                                        {{ this.$t('auth.signup.next') }}
                                    </argon-button>
                                    <p class="text-white mt-3 text-center" @click="prevStep">{{
                                            this.$t('auth.signup.back')
                                        }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5 col-12 text-center" v-if="activeStep === 4">
                            <i class="fa-light fa-lock-keyhole fs-5 p-2"
                               style="color: var(--nf-default-color); border: 2px solid var(--nf-default-color); border-radius: 50%;"></i>
                            <p class="text-uppercase fw-bold text-white text-xs mt-4">{{ this.$t('auth.signup.step') }}
                                3/3</p>
                            <p class="fw-bold text-white fs-3 mb-0">{{ this.$t('auth.signup.steps.3.title') }}</p>
                            <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.3.subtitle') }}</p>
                            <img :src="qrCode" alt="QrCode" class="img-fluid w-75 mt-3"
                                 style="border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                            <div class="d-flex justify-content-center">
                                <argon-alert color="success" class="w-75"
                                             style="border-top-left-radius: 0; border-top-right-radius: 0;">
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.3.receiver') }}:
                                        <strong>NGO
                                            TUAN ANH</strong></p>
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.3.phone_number') }}:
                                        <strong>0396902252</strong></p>
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.3.amount') }}:
                                        <strong>{{ getPrice(plan_index) }}</strong></p>
                                    <p class="text-white fs-6 mb-0">{{ this.$t('auth.signup.steps.3.content') }}:
                                        <strong class="text-danger">{{ transfer_code }}</strong></p>
                                </argon-alert>
                            </div>
                            <argon-button color="danger" full-width size="lg"
                                          class="mt-4 py-3 fs-5 text-white btnRegister"
                                          :class="{ disabled: isRegister }"
                                          style="border-radius: 2px;" @click="register">
                                {{ isRegister ? this.$t('auth.signup.loading') : this.$t('auth.signup.next') }}
                            </argon-button>
                            <p class="text-white mt-3 text-center" @click="prevStep" v-if="!isRegister">
                                {{ this.$t('auth.signup.back') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <auth-footer/>
    </div>
</template>

<script>
import ArgonCheckbox from "../../components/ArgonCheckbox.vue";
import ArgonButton from "../../components/ArgonButton.vue";
import PricingCard from "../../components/cards/PricingCard.vue";
import ArgonAlert from "../../components/ArgonAlert.vue";
import Navbar from "../../components/navbars/Auth.vue";
import AuthFooter from "../../components/footers/Auth.vue";

export default {
    name: "Register",
    components: {Navbar, ArgonButton, ArgonCheckbox, ArgonAlert, PricingCard, AuthFooter},
    title() {
        return this.$t('auth.signup.title');
    },
    data() {
        return {
            plans: ['Basic', 'Standard', 'Premium'],
            prices: [0, 50000, 100000],
            step: 4,
            activeStep: 1,
            email: this.$route.query.email || 'ngotuananh2101@gmail.com',
            password: "TuanAnh2101@",
            plan_index: 0,
            transfer_code: "",
            unsubscribe: null,
            btnRegister: null,
            isRegister: false,
            language: 'en'
        };
    },
    created() {
        this.transfer_code = this.code;
        this.language = this.$root.language;
        this.btnRegister = document.querySelector('.btnRegister');
        this.unsubscribe = this.$store.subscribe((mutation) => {
            switch (mutation.type) {
                case 'auth/request':
                    this.isRegister = true;
                    this.$root.showSnackbar('warning', this.$t('auth.signup.wait'));
                    break;
                case 'auth/registerSuccess':
                    this.$root.showSnackbar('success', this.$t('auth.signup.success'));
                    this.$router.push({name: 'sent'});
                    break;
                case 'auth/error':
                    this.isRegister = false;
                    console.log(mutation.payload.response.data.message);
                    this.$root.showSnackbar('danger', mutation.payload.response.data.message);
                    break;
            }
        });
    },
    beforeUnmount() {
        this.unsubscribe();
    },
    methods: {
        checkFormValidity(e) {
            const form = e.target;
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            this.nextStep();
        },
        nextStep() {
            if (this.activeStep < this.step) {
                this.activeStep += 1;
            } else {
                this.activeStep -= 1;
            }
        },
        prevStep() {
            if (this.activeStep > 1) {
                this.activeStep -= 1;
            } else {
                this.activeStep += 1;
            }
        },
        planClick(event) {
            let price = event.target.closest('.price');
            this.plan_index = price.dataset.index;
            let prices = document.querySelectorAll('.price');
            prices.forEach((price) => {
                price.classList.remove('active');
            });
            prices[this.plan_index].classList.add('active');
        },
        getPrice(index) {
            let formatter;
            let price = this.prices[index];
            if (this.language === 'vi') {
                formatter = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                });
            } else {
                formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                });
                price = price / 24000;
            }
            return formatter.format(price);
        },
        register() {
            this.$store.dispatch('auth/register', {
                email: this.email,
                password: this.password,
                plan: this.plan_index + 1,
                transfer_code: this.transfer_code,
            });
        },
    },
    computed: {
        qrCode() {
            let price = this.prices[this.plan_index];
            let plan = this.plans[this.plan_index] + ' plan';
            return `https://momofree.apimienphi.com/api/QRCode?phone=0396902252&amount=${price}&note=${plan}`;
        },
        code() {
            let code = '';
            for (let i = 0; i < 6; i++) {
                code += Math.floor(Math.random() * 10);
            }
            return code;
        },
    },
}
</script>

<style scoped>
footer {
    background-color: rgba(255, 255, 255, 0.12) !important;
}
.page-header {
    background-color: rgba(0, 0, 0, 1);
}

.form-control {
    border-radius: 2px;
}

.step2 i {
    color: var(--nf-default-color);
    font-size: 2rem;
    margin-right: 1rem;
}

.step3 i {
    color: var(--nf-default-color);
    font-size: 1.3rem;
    margin-right: 0.5rem;
}

.price {
    background-color: rgba(255, 255, 255, 0.7);
    border-radius: 0.5rem;
}

.price.active {
    background-color: var(--nf-default-color);
    color: white !important;
}
</style>
