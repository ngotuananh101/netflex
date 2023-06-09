import client from "./client";

export default {
    register,
    resend,
    verify,
    login,
    logout,
    forgot,
    reset
}

async function register(data) {
    try {
        return await client.post("/auth/register", data);
    } catch (error) {
        throw error;
    }
}

async function resend(email) {
    try {
        return await client.post("/auth/resend", { email });
    } catch (error) {
        throw error;
    }
}

async function verify(id, hash, expires, signature) {
    try {
        return await client.post(`/auth/verify/${id}/${hash}?expires=${expires}&signature=${signature}`);
    } catch (error) {
        throw error;
    }
}

async function login(data) {
    try {
        return await client.post("/auth/login", data);
    } catch (error) {
        throw error;
    }
}

async function logout() {
    try {
        return await client.post("/auth/logout");
    } catch (error) {
        throw error;
    }
}

async function forgot(data) {
    try {
        return await client.post("/auth/forgot", data);
    } catch (error) {
        throw error;
    }
}

async function reset(data) {
    try {
        return await client.post("/auth/reset", data);
    } catch (error) {
        throw error;
    }
}
