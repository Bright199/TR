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
      unreadMessageCount: 0,
      priceRange: {
        minPrice: '',
        maxPrice:''
      },
      TeacherLanguage:'',
      TeacherCountry:'',
      showTeachersComponent: 0,

    }
  },
  actions: {
    TeachersByPrice (context,payload) {
      setTimeout(() => {
       context.commit('TeachersByPrice',payload)
      }, 500)
    }
  },
  mutations: {
    TeachersByPrice(state, payload) {
      state.priceRange.minPrice = payload.minPrice
      state.priceRange.maxPrice = payload.maxPrice
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 4
       }, 500)
    },
    getTeachersByLanguage(state, payload) {
      state.TeacherLanguage = payload.language
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 2
       }, 500)
    },
    getTeachersByCountry(state, payload) {
      state.TeacherCountry = payload.country
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 3
       }, 500)
    },
    ActivateOtherTeacherDiv(state) {
      state.showTeachersComponent = 1
    },
    ActivateOurTeacherDiv(state) {
      state.showTeachersComponent = 0
    },
    TeacherStudentChats(state, payload) {
      state.TeacherStudentChats = payload
      state.openSingleModal = true
      state.openModal = false
    },
    teacherId(state, payload) {
      state.teacherId = payload
    },
    SingleMessageModalClose(state) {
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
      state.FavoriteCount++
    },
    subtrFavoriteCount(state, payload) {
      state.FavoriteCount--
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