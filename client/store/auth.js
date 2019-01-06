export const getters = {
    authenticated(state) {
        return state.loggedIn;
    },
    user(state) {
        return state.user;
    }
};

export const state = () => ({
    busy: false,
    loggedIn: false,
    strategy: "local",
    user:false
});