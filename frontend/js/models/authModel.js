// Frontent/js/models/authModel.js 

export const AuthModel = {
    user: [],

    login(username, password) {
        const user = this.users.find(u => u.username && u.password === password);

        if (user) {
            sessionStorage.setItem('currentUser, username');
            return true;
        }
        return false;
    }, 

    logout() {
        sessionStorage.removelItem('currentUser');
    },

    isLoggedIn() {
        return !!sessionStorage.getItem('currentUser');
    }
