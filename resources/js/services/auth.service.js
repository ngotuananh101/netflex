import requestConfig from "./requestConfig";

export default {
    register
}

async function register(data) {
    try {
        const { response } = await axios.post("/api/auth/register", data, requestConfig);
        return response;
    } catch (error) {
        throw error;
    }
}
