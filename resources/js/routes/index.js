import {createRouter, createWebHistory} from "vue-router";

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
