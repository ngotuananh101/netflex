<template>
    <nav class="navbar navbar-expand-lg top-0 z-index-3 position-absolute mt-4 start-0 end-0 shadow-none">
        <div class="container ps-2 pe-0">
            <a class="navbar-brand" href="#">
                <img src="../../assets/img/logos/logo.png" alt="logo" class="img-fluid" style="height: 3rem;"/>
            </a>
            <button class="shadow-none navbar-toggler ms-2 text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="mt-2 navbar-toggler-icon">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div id="navigation" class="pt-3 pb-2 collapse navbar-collapse w-100 py-lg-0 justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item mx-sm-3">
                        <select
                            id="choices-language"
                            class="form-control w-100 px-4 fs-6 text-white"
                            name="choices-language"
                            style="max-height: 100%;"
                            @change="changeLanguage"
                            v-model="language"
                        >
                            <option value="vi" data-select-text="Tiếng Việt">Tiếng Việt</option>
                            <option value="en" data-select-text="English">English</option>
                        </select>
                    </li>
                    <li class="nav-item mx-sm-3 mx-md-0 mt-sm-3 mt-md-0">
                        <router-link :to="{name:'login'}" class="mb-0 btn bg-danger text-white float-end w-100">
                            {{ $t('landing.button') }}
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import Choices from "choices.js";

export default {
    name: "Navbar",
    data() {
        return {
            language: 'en',
        };
    },
    mounted() {
        this.language = this.$root.language;
    },
    methods: {
        changeLanguage(e) {
            this.$root.changeLanguage(e.target.value);
        },
    }
};
</script>

<style>
.navbar-toggler .navbar-toggler-icon .navbar-toggler-bar {
    background-color: #fff;
    height: 2px;
    width: 30px;
}

.collapse.show {
    background-color: #fff;
    border-radius: 10px;
}

#choices-language {
    background-color: rgba(0, 0, 0, 0.6);
    background-image: url(https://coothead.co.uk/images/world.png);
    background-repeat: no-repeat;
    background-size: 1rem auto;
    background-position: 1rem center;
    padding-left: 2.5rem !important;
}
</style>
