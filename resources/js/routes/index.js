import {createRouter, createWebHistory} from "vue-router";
import store from "../stores";

import LandingRoutes from "./modules/landing";
import AuthRoutes from "./modules/auth";

const routes = [
    ...LandingRoutes,
    ...AuthRoutes,
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

router.beforeEach((to, from, next) => {
    console.log(store.state.auth.token ? "Logged in" : "Not logged in");
    console.log(to.meta.requiresAuth ? "Requires auth" : "Does not require auth");
    console.log(to.meta.isGuest ? "Requires guest" : "Does not require guest");
    // Not logged in and require auth
    if (to.meta.requiresAuth && !store.state.auth.token) {
        next({ name: "login" });
    }
    // Logged in
    else if (store.state.auth.token) {
        if (to.meta.isGuest){
            next({ name: "home" });
        } else if((store.state.auth.user.email_verified_at === null || store.state.auth.user.email_verified_at === undefined)){
            if(to.name !== "verify" && to.name !== "sent"){
                next({ name: "sent" });
            } else {
                next();
            }
        } else if (to.name === "sent" || to.name === "verify"){
            next({ name: "home" });
        } else {
            next();
        }
    } else {
        next();
    }
});
