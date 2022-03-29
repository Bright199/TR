import { createStore } from "vuex";

const store = createStore({
  state() {
    return {
      loggedUser: '',
      profileImageUrl: '',
      FavoriteCount: 0,
      openModal: false,
      TeacherStudentChats: '',
      openSingleModal: false,
      teacherId: '',
      unreadMessageCount: 0
    }
  },
  mutations: {

    TeacherStudentChats(state, payload) {
      state.TeacherStudentChats = payload
      state.openSingleModal = true
      state.openModal = false
    },
    teacherId(state, payload) {
      state.teacherId = payload
    },
    SingleMessageModalClose(state)
    {
      state.openSingleModal = false
      state.openModal = true
    },

    MessageModalPopup(state) {
      state.openModal = true
    },
    MessageModalClose(state) {
      state.openModal = false
    },
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
    },
    unreadMessageCount(state, payload) {
      state.unreadMessageCount = payload
    },
    reduceUnreadMessagesCount(state, payload) {
      state.unreadMessageCount -= payload
    }
  },
  
})

export default store;