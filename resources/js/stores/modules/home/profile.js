import profileService from '../../../services/home/profile.services';
import authService from "../../../services/auth.service";

export default {
    namespaced: true,
    state: {
        profiles: [],
        status: null
    },
    getters: {
        profile(state) {
            return state.profiles;
        }
    },
    mutations: {
        request(state) {
            state.status = "loading";
        },
        getProfileSuccess(state, profiles) {
            state.status = "success";
            state.profiles = profiles;
        },
        error(state, error = null) {
            state.status = "error";
        }
    },
    actions: {
        async getProfiles({ commit }) {
            commit("request");
            try {
                let profiles = await profileService.getProfiles();
                commit("getProfileSuccess", profiles.data.data);
            } catch (error) {
                commit("error", error);
            }
        }
    }
}
