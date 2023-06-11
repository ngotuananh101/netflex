import client from "../client";

export default {
    getProfiles
}

async function getProfiles() {
    try {
        return await client.get("/profile");
    } catch (error) {
        throw error;
    }
}
