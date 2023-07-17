import { createStore } from "vuex";
import config from "./modules/config";
import auth from "./modules/auth";
import homeProfile from "./modules/home/profile";

export default createStore({
    modules: {
        config,
        auth,
        homeProfile
    }
});
