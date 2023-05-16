<template>
    <nav class="navbar navbar-expand-lg top-0 z-index-3 mt-2 start-0 end-0 shadow-none ps-0">
        <div class="container-fluid ps-0 pe-0">
            <router-link :to="{name: 'landing'}" class="navbar-brand">
                <img src="../../assets/img/logos/logo.png" alt="logo" class="img-fluid" style="height: 3rem;"/>
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
