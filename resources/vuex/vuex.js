import { createStore } from "vuex";

const store = createStore({
  state() {
    return {
      loggedUser: '',
      isAuthenticated: false

    }
  },
  mutations: {
    userDetails(state, obtainedUser) {
      state.loggedUser = obtainedUser
      // state.isAuthenticated = true
    }
  },
  getters: {
    UserFirstName(state) {
      return state.loggedUser
    }
  }
})

export default store;