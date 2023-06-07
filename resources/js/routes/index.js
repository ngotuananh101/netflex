import {createRouter, createWebHistory} from "vue-router";
import store from "../stores";

import LandingRoutes from "./modules/landing";
import AuthRoutes from "./modules/auth";
import HomeRoutes from "./modules/home";

const routes = [
    ...LandingRoutes,
    ...AuthRoutes,
    ...HomeRoutes,
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

router.beforeEach((to, from, next) => {
    console.log(store.state.auth.access_token ? "Logged in" : "Not logged in");
    console.log(to.meta.requiresAuth ? "Requires auth" : "Does not require auth");
    console.log(to.meta.isGuest ? "Requires guest" : "Does not require guest");
    // Not logged in and require auth
    if (to.meta.requiresAuth && !store.state.auth.access_token) {
        next({name: "login"});
    }
    // Logged in
    else if (store.state.auth.access_token) {
        if (to.name === 'logout' || to.name === 'login') {
            // if logged in and go to login page or logout page
            // then remove access_token and user from store
            store.commit("auth/removeData");
            next();
        } else if (to.meta.isGuest) {
            next({name: "home"});
        } else if ((store.state.auth.user.email_verified_at === null || store.state.auth.user.email_verified_at === undefined)) {
            if (to.name !== "verify" && to.name !== "sent") {
                next({name: "sent"});
            } else {
                next();
            }
        } else if (to.name === "sent" || to.name === "verify") {
            next({name: "home"});
        } else {
            next();
        }
    } else {
        next();
    }
});
