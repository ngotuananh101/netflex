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
    name: "SignUp Navbar",
};
</script>

<style>
a:hover {
    text-decoration: underline;
}
</style>
