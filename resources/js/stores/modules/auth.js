import authService from "../../services/auth.service";
import Cookies from "js-cookie";
export default {
    namespaced: true,
    state: {
        user: JSON.parse(localStorage.getItem("user")) || null,
        access_token: Cookies.get("access_token") || null,
        status: null
    },
    getters: {
        user(state) {
            return state.user;
        },
        token(state) {
            return state.access_token;
        },
        status(state) {
            return state.status;
        }
    },
    mutations: {
        request(state) {
            state.status = "loading";
        },
        registerSuccess(state,user_data) {
            state.status = "success";
            state.user = user_data.user;
            state.access_token = user_data.access_token;
            localStorage.setItem("user", JSON.stringify(user_data.user));
            Cookies.set("access_token", user_data.access_token, { expires: 1 });
        },
        resendSuccess(state) {
            state.status = "success";
        },
        verifySuccess(state) {
            state.status = "success";
            state.user.email_verified_at = new Date();
            localStorage.setItem("user", JSON.stringify(state.user));
        },
        loginSuccess(state, user_data) {
            state.status = "success";
            state.user = user_data.user;
            state.access_token = user_data.access_token;
            localStorage.setItem("user", JSON.stringify(user_data.user));
            Cookies.set("access_token", user_data.access_token, { expires: 1 });
        },
        removeData(state) {
            state.status = null;
            state.user = null;
            state.access_token = null;
            localStorage.removeItem("user");
            Cookies.remove("access_token");
        },
        error(state, error = null) {
            state.status = "error";
        }
    },
    actions: {
        async register({ commit }, data) {
            commit("request");
            try {
                let response = await authService.register(data);
                commit("registerSuccess", response.data);
            } catch (error) {
                commit("error", error);
            }
        },
        async resend({commit}, email){
            commit("request");
            try {
                await authService.resend(email);
                commit("resendSuccess");
            } catch (error) {
                commit("error", error);
            }
        },
        async verify({commit}, {id, hash, expires, signature}){
            commit("request");
            try {
                await authService.verify(id, hash, expires, signature);
                commit("verifySuccess");
            } catch (error) {
                commit("error", error);
            }
        },
        async login({ commit }, data) {
            commit("request");
            try {
                let response = await authService.login(data);
                commit("loginSuccess", response.data);
            } catch (error) {
                commit("error", error);
            }
        },
        async logout({ commit }) {
            commit("request");
            try {
                await authService.logout();
                commit("error");
            } catch (error) {
                commit("error", error);
            }
        }
    }
}
