import Bowser from "bowser";

export default {
    getDevice,
    getIp
}

function getDevice() {
    const parser = Bowser.getParser(window.navigator.userAgent);
    let os = parser.getOSName();
    if (parser.getOSVersion()) {os += ' ' + parser.getOSVersion()}
    return parser.getBrowserName() + ' ' + parser.getBrowserVersion() + ' on ' + os;
}

async function getIp() {
    try {
        const response = await fetch('https://api.ipify.org?format=json');
        const data = await response.json();
        return data.ip;
    } catch (error) {
        throw error;
    }
}
