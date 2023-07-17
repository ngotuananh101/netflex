import client from "../client";

export default {
    getProfiles,
    addProfile
}

async function getProfiles() {
    try {
        return await client.get("/profile");
    } catch (error) {
        throw error;
    }
}

async function addProfile(profile) {
    try {
        return await client.post("/profile", profile);
    } catch (error) {
        throw error;
    }
}
