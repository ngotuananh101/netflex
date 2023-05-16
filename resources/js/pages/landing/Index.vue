<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <navbar
                    btn-background="bg-gradient-success"
                    :dark-mode="true"
                />
            </div>
        </div>
    </div>
    <main class="main-content main-content-bg mt-0">
        <div class="page-header min-vh-75">
            <span class="mask"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <h1
                        class="col-12 text-white text-center mt-5 font-weight-bolder"
                    >
                        {{ $t('landing.title') }}
                    </h1>
                    <h4 class="col-12 text-white text-center mt-2">
                        {{ $t('landing.subtitle') }}
                    </h4>
                    <h5 class="col-12 text-white text-center mt-4">
                        {{ $t('landing.subtitle2') }}
                    </h5>
                    <div class="col-md-8 col-12 row justify-content-center">
                        <div class="col-lg-9 col-12 mt-3">
                            <input
                                class="form-control fs-4 p-3 text-white"
                                v-model="email"
                                type="email"
                                :placeholder="$t('landing.input')"
                            />
                        </div>
                        <router-link :to="{ name: 'signup', query: { email: email } }"
                            class="btn btn-danger col-lg-3 col-8 fs-4 mb-0 mt-3 d-flex justify-content-center align-items-center"
                        >
                            {{ $t('landing.button2') }} <i class="fa-solid fa-chevron-right"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section>
        <div class="container py-5">
            <div class="row">
                <div
                    class="col-md-6 col-12 d-flex flex-column justify-content-center"
                >
                    <h1 class="text-white">{{ $t('landing.sections.0.title') }}</h1>
                    <h5 class="text-white mt-3">{{ $t('landing.sections.0.subtitle') }}</h5>
                </div>
                <div class="col-md-6 col-12">
                    <video
                        src="../../assets/videos/landing/v1.mp4"
                        autoplay
                        loop
                        muted
                        class="w-100"
                    ></video>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row flex-row-reverse">
                <div
                    class="col-md-6 col-12 d-flex flex-column justify-content-center"
                >
                    <h1 class="text-white">{{ $t('landing.sections.1.title') }}</h1>
                    <h5 class="text-white mt-3">{{ $t('landing.sections.1.subtitle') }}</h5>
                </div>
                <div class="col-md-6 col-12">
                    <video
                        src="../../assets/videos/landing/v2.mp4"
                        autoplay
                        loop
                        muted
                        class="w-100"
                    ></video>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row">
                <div
                    class="col-md-6 col-12 d-flex flex-column justify-content-center"
                >
                    <h1 class="text-white">{{ $t('landing.sections.2.title') }}</h1>
                    <h5 class="text-white mt-3">{{ $t('landing.sections.2.subtitle') }}</h5>
                </div>
                <div class="col-md-6 col-12">
                    <video
                        src="../../assets/videos/landing/v3.mp4"
                        autoplay
                        loop
                        muted
                        class="w-100"
                    ></video>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row flex-row-reverse">
                <div
                    class="col-md-6 col-12 d-flex flex-column justify-content-center"
                >
                    <h1 class="text-white">{{ $t('landing.sections.3.title') }}</h1>
                    <h5 class="text-white mt-3">{{ $t('landing.sections.3.subtitle') }}</h5>
                </div>
                <div class="col-md-6 col-12">
                    <img
                        src="../../assets/videos/landing/v4.png"
                        alt="v4"
                        class="img-fluid"
                    />
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="text-white text-center">{{ $t('landing.faqs') }}</h1>
                </div>
                <div class="col-12 mt-4">
                    <details class="mb-2" v-for="i in 6">
                        <summary class="d-flex justify-content-between align-items-center faq">
                            <span>{{ $t('landing.faqs_data.' + (i-1) + '.question' ) }}</span>
                        </summary>
                        <p class="faq px-4 py-3">{{ $t('landing.faqs_data.' + (i-1) + '.answer' ) }}</p>
                    </details>
                </div>
                <h5 class="col-12 text-white text-center mt-4">
                    {{ $t('landing.subtitle2') }}
                </h5>
                <div class="col-md-8 col-12 row justify-content-center">
                    <div class="col-lg-9 col-12 mt-3">
                        <input
                            class="form-control fs-4 p-3 text-white"
                            v-model="email"
                            type="email"
                            :placeholder="$t('landing.input')"
                        />
                    </div>
                    <router-link :to="{ name: 'signup', query: { email: email } }" class="btn btn-danger col-lg-3 col-8 fs-4 mb-0 mt-3 d-flex justify-content-center align-items-center">
                        {{ $t('landing.button2') }} <i class="fa-solid fa-chevron-right"></i>
                    </router-link>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a :href="$t('landing.footers.0.link')" class="text-light text-decoration-underline fs-5">{{ $t('landing.footers.0.title') }}</a>
                </div>
                <div class="col-md-4 col-6" v-for="n in 15">
                    <a :href="$t('landing.footers.' + n + '.link')" class="text-light text-decoration-underline text-sm mt-3">{{ $t('landing.footers.' + n + '.title') }}</a>
                </div>
                <div class="col-md-2 col-6 mt-4 d-flex flex-column">
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
                    <p class="text-light text-sm mt-4">Netflex Việt Nam</p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import Navbar from "../../components/navbars/Landing.vue";
import ArgonInput from "../../components/ArgonInput.vue";
import ArgonButton from "../../components/ArgonButton.vue";
import {mapMutations} from "vuex";

export default {
    name: "Landing Page",
    components: {
        Navbar,
        ArgonInput,
        ArgonButton,
    },
    data() {
        return {
            email: "",
            language: "en",
        };
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
        ...mapMutations({
            toggleDefaultLayout: "config/toggleDefaultLayout",
        }),
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        },
    },
};
</script>
<style scoped>
.page-header {
    background-image: url("../../assets/img/background.jpg");
}

.mask {
    background-color: rgba(0, 0, 0, 0.6);
}

input {
    background-color: rgba(0, 0, 0, 0.6);
}

input:focus {
    background-color: rgba(0, 0, 0, 0.6);
    border: 2px solid #f44336;
    box-shadow: 0 0 0 0.3rem rgba(255, 255, 255, 0.5);
}

section, footer {
    background-color: #000000;
    border-top: 10px solid rgba(255, 255, 255, 0.2);
}

summary {
    display: block;
    padding: 0 1.5rem;
    margin-bottom: 0.1rem;
}

summary::after {
    display: inline-block;
    transition: 0.2s;
    content: "\2b";
    font-size: 3.5rem;
}

details[open] summary::after {
    transform: rotate(45deg);
}

.faq {
    background-color: rgba(45, 45, 45, 1);
    color: white;
    font-size: 1.5rem;
    white-space: pre-line;
}
</style>
