<template>
    <nav class="navbar navbar-expand-lg top-0 z-index-3 mt-2 start-0 end-0 shadow-none ps-0">
        <div class="container-fluid ps-0 pe-0">
            <router-link :to="{name: 'landing'}" class="navbar-brand">
                <img src="../../assets/img/logos/logo.png" alt="logo" class="img-fluid" style="height: 3rem;"/>
            </router-link>
            <router-link :to="{name: 'login'}" v-if="this.$route.name === 'forgot-password'" class="navbar-brand fs-4 text-white fw-bold">
                {{ $t('landing.button') }}
            </router-link>
        </div>
    </nav>
</template>

<script>
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
</style>
