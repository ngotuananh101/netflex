import authService from "../../services/auth.service";
export default {
    namespaced: true,
    state: {
        user: null,
        token: null,
        status: null
    },
    getters: {
        user(state) {
            return state.user;
        },
        token(state) {
            return state.token;
        },
        status(state) {
            return state.status;
        }
    },
    mutations: {
        request(state) {
            state.status = "loading";
        },
        registerSuccess(state) {
            state.status = "success";
        },
        error(state) {
            state.status = "error";
        }
    },
    actions: {
        async register({ commit }, data) {
            commit("request");
            try {
                const response = await authService.register(data);
                commit("registerSuccess");
            } catch (error) {
                commit("error");
            }
        }
    }
}
