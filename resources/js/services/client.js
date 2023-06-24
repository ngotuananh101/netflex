import Cookies from "js-cookie";

/**
 * Axios Custom Client
 * @type {AxiosInstance}
 */
const client = axios.create({
    baseURL: "/api",
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
});

/**
 * Request Interceptor
 * @param config
 * @returns {*}
 * @private
 * @todo Add token to request header
 */
const _requestInterceptor = (config) => {
    if(Cookies.get("access_token")) {
        config.headers['Authorization'] = 'Bearer ' + Cookies.get("access_token");
    }
    // set language
    config.headers['Accept-Language'] = localStorage.getItem("language") || "en";
    return config;
}

/**
 * Response Interceptor
 * @param response
 * @returns {*}
 * @private
 * @todo Add token to session storage
 */
const _responseInterceptor = (response) => {
    // if response have access_token then set it to Cookies
    if(response.data.access_token) {
        if (response.data.remember_me) {
            Cookies.set("access_token", response.data.access_token, { expires: 30 });
        } else {
            Cookies.set("access_token", response.data.access_token);
        }

        // if response have user then set it to localStorage
        if(response.data.user) {
            localStorage.setItem("user", JSON.stringify(response.data.user));
        }
    }
    return response;
}

/**
 * Error Interceptor
 * @param error
 * @returns {Promise<never>}
 * @private
 * @todo Handle errors
 * @todo Refresh token
 * @todo Retry request
 */
const _errorInterceptor = (error) => {
    // if code is 401 and response have access_token
    if(error.response.status === 401 && error.response.data.access_token) {
        Cookies.set("access_token", error.response.data.access_token);
        return client.request(error.config);
    } else if(error.response.status === 401 && !error.response.data.access_token && location.pathname !== "/auth/logout") {
        Cookies.remove("access_token");
        localStorage.removeItem("user");
        location.href = "/auth/login";
    }
    return Promise.reject(error);
}

/**
 * Add request interceptor
 * @type {AxiosInstance}
 * @private
 * @todo Add token to request header
 * @todo Add request interceptor
 * @todo Add response interceptor
 * @todo Add error interceptor
 */
client.interceptors.request.use(_requestInterceptor);
client.interceptors.response.use(_responseInterceptor, _errorInterceptor);

export default client;
