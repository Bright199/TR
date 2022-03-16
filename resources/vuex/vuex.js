import { createStore } from "vuex";

const store = createStore({
  state() {
    return {
      loggedUser: '',
      profileImageUrl: '',
      FavoriteCount: 0
    }
  },
  mutations: {
    userDetails(state, obtainedUser) {
      state.loggedUser = obtainedUser
      // state.isAuthenticated = true
    },
    profileImage(state, profileImage) {
      state.profileImageUrl = profileImage
    },
    setFavoriteCount(state, payload) {
      state.FavoriteCount = payload
    },
    addFavoriteCount(state, payload) {
      state.FavoriteCount ++
    },
    subtrFavoriteCount(state, payload) {
      state.FavoriteCount --
    }
  },
  
})

export default store;