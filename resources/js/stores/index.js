import { createStore } from "vuex";
import config from "./modules/config";
import auth from "./modules/auth";

export default createStore({
    modules: {
        config,
        auth
    }
});
