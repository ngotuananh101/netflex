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
        <auth-footer/>
    </div>
</template>

<script>
import Navbar from "../../components/navbars/Auth.vue";
import AuthFooter from "../../components/footers/Auth.vue";
import ArgonButton from "../../components/ArgonButton.vue";
import store from "../../stores";

export default {
    name: "Resend Email",
    components: {Navbar, AuthFooter, ArgonButton},
    title(){
        return this.$t('auth.sent.title');
    },
    data() {
        return {
            email: store.state.auth.user.email,
            sending: false,
            counter: null,
            count: 30,
            interval: null,
            unsubscribe: null,
        };
    },
    created() {
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
</style>
