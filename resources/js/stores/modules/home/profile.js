import profileService from '../../../services/home/profile.services';
import authService from "../../../services/auth.service";

export default {
    namespaced: true,
    state: {
        profiles: [],
        images: [],
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
        getProfileSuccess(state,{profiles, images}) {
            state.status = "success";
            state.profiles = profiles;
            state.images = images;
        },
        addProfileSuccess(state, profiles) {
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
                commit("getProfileSuccess", {profiles: profiles.data.data, images: profiles.data.images});
            } catch (error) {
                commit("error", error);
            }
        },
        async addProfile({ commit }, profile) {
            commit("request");
            try {
                let response = await profileService.addProfile(profile);
                commit("addProfileSuccess", response.data.data);
            } catch (error) {
                commit("error", error);
            }
        }
    }
}
