import axios from 'axios';

const api = axios.create({
    baseURL: 'https://manaeventbn.duckdns.org', // your Laravel API origin
    withCredentials: true, // IMPORTANT for Sanctum cookies
});

// Get CSRF cookie before login or any auth request
export async function getCsrf() {
    await api.get('/sanctum/csrf-cookie');
}

// Example login request
export async function login(payload) {
    await getCsrf(); // get cookie first
    return api.post('/login', payload);
}

// Example: fetch admin profile after login
export async function getAdmin() {
    return api.get('/api/admin/me');
}

export default api;
