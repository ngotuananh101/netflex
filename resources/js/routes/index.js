import {createRouter, createWebHistory} from "vue-router";
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
    const {access_token, user} = store.state.auth;
    const {requiresAuth, isGuest} = to.meta;
    // Kiểm tra xem route hiện tại có yêu cầu login hay không
    if (requiresAuth) {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!access_token) {
            return next({name: 'login'});
        }
        // kiểm tra xem người dùng đã xác thực email hay chưa
        else if (!user.email_verified_at) {
            // Nếu chưa xác thực và route hiện tại khác route xác thực email thì chuyển hướng đến route xác thực email
            if (to.name !== 'sent' && to.name !== 'verify') {
                return next({name: 'sent'});
            }
            return next();
        } else if (user.email_verified_at && (to.name === 'sent' || to.name === 'verify')) {
            // Nếu đã xác thực và route hiện tại là route xác thực email thì chuyển hướng đến route home
            return next({name: 'home'});
        } else {
            // Kiểm tra xem người dùng có quyền truy cập route hiện tại hay không
            if (to.meta.roles && !to.meta.roles.includes(user.role)) {
                // Nếu không có quyền truy cập thì chuyển hướng đến route home
                return next({name: 'home'});
            }
            // Nếu người dùng truy cập trang home và chưa chọn profile thì chuyển hướng đến route chọn profile
            if (to.name === 'home dashboard' && !user.profile) {
                return next({name: 'select profile'});
            }
            return next();
        }
    } else if (isGuest) {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (access_token) {
            return next({name: 'home'});
        }
        // Nếu chưa đăng nhập thì cho phép truy cập
        return next();
    }
});

export default router;
