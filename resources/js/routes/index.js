import { createRouter, createWebHistory } from "vue-router";
import store from "../stores";
import LandingRoutes from "./modules/landing";
import AuthRoutes from "./modules/auth";
import HomeRoutes from "./modules/home";

const routes = [
    ...LandingRoutes,
    ...AuthRoutes,
    ...HomeRoutes
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const { access_token, user } = store.state.auth;
    const { requiresAuth, isGuest } = to.meta;

    // Kiểm tra trang yêu cầu đăng nhập mà người dùng chưa đăng nhập
    console.log(requiresAuth, access_token);
    if (requiresAuth && !access_token) {
        return next({ name: "login" });
    }

    // Kiểm tra trang khách mà người dùng đã đăng nhập
    if (isGuest && access_token) {
        return next({ name: "home" });
    }

    // Kiểm tra email xác minh
    if (user && !user.email_verified_at) {
        return next({ name: "verify" });
    }

    // Kiểm tra nếu người dùng đăng nhập và truy cập trang gửi hoặc xác minh
    if ((to.name === "sent" || to.name === "verify") && access_token) {
        return next({ name: "home" });
    }

    // Kiểm tra truy cập trang và vai trò người dùng
    if (to.meta.access && !to.meta.access.includes(user.role)) {
        return next({ name: "home" });
    }

    // Kiểm tra trường hợp ngoại lệ khi truy cập vào trang profile và chưa có thông tin profile người dùng
    if (!to.name.includes('profile') && user && !user.profile) {
        return next({ name: "select profile" });
    }

    // Trường hợp không thỏa mãn bất kỳ điều kiện kiểm tra nào, cho phép đi tiếp
    next();
});

export default router;
