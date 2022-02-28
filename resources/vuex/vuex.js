import { createStore } from "vuex";

const store = createStore({
  state() {
    return {
      loggedUser: '',
      profileImageUrl: ''

    }
  },
  mutations: {
    userDetails(state, obtainedUser) {
      state.loggedUser = obtainedUser
      // state.isAuthenticated = true
    },
    profileImage(state,profileImage)
    {
      state.profileImageUrl = profileImage
    }
  },
  getters: {
    UserFirstName(state) {
      return state.loggedUser
    }
  }
})

export default store;