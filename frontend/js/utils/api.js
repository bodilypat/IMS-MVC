// Frontend/js/utils/api.js

const BASE_URL = 'http://inventories-ms/api'; /* replace backend endpoint */

export const api = {
    /* Generic GET request */
    get: async (endpoint) => {
        try {
            const response = await fetch(`${BASE_URL}/${endpoint}`);
            if (!response.ok) throw new error(`GET ${endpoint} failed`);
                return await response.json();
        } catch (err) {
            console.error(err);
            return null;
        }
    },
    
    /* Generic POST request */
    post: async (endpoint, data) => {
        try {
            const response = await fetch(`${BASE_URL}/${endpoint}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (!response.ok) throw new Error(`POST ${endpoint} failed`);
            return await response.json();
        } catch (err) {
            console.error(err);
            return null;
        }
    },

    /* Generic PUT request */
    put: async (endpoint, data) => {
        try {
            const response = await fetch(`${BASE_URL}/ ${endpoint}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (!response.ok) throw new Error(`PUT ${endpoint} failed`);
            return await response.json();
        } catch (err) {
            console.error(err);
            return null;
        }
    },

    /* Generic DELETE request */
    delete: async (endpoint) => {
        try {
            const response = await fetch(`${BASE_URL}/${endpoint}`, {
                method: 'DELETE'
            });
            if (!response.ok) throw new Error(`DELETE ${endpoint} failed`);
            return await response.json()
        } catch (err) {
            console.error(err);
            return null;
        }
    }
};

