import { createStore } from "vuex";

const store = createStore({
  state() {
    return {
      // Student states
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
        maxPrice: ''
      },
      TeacherLanguage: '',
      TeacherCountry: '',
      TeacherName: '',
      showTeachersComponent: 0,
      showBookPaidLessonComponent: false,
      // end of student states

      // teacher states
      showTeacherRegistrationFormComponent: 0,
      selectedDayIndex: 0
      // end of teacher state
    }
  },

  mutations: {
    // Student Mutations
    buyHours(state) {
      state.showBookPaidLessonComponent = true
    },
    closeBookPaidLessonComponent(state) {
      state.showBookPaidLessonComponent = false
    },
    TeachersByPrice(state, payload) {
      state.priceRange.minPrice = payload.minPrice
      state.priceRange.maxPrice = payload.maxPrice
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 4
      }, 500)
    },
    setPrice(state, payload) {
      state.priceRange.minPrice = payload.minPrice
      state.priceRange.maxPrice = payload.maxPrice
    },
    getTeachersByLanguage(state, payload) {
      state.TeacherLanguage = payload.language
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 2
      }, 500)
    },
    setLanguage(state, payload) {
      state.TeacherLanguage = payload.language
    },
    setCountry(state, payload) {
      state.TeacherCountry = payload.country
    },
    getTeachersByCountry(state, payload) {
      state.TeacherCountry = payload.country
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 3
      }, 500)
    },
    getTeachersByName(state, payload) {
      state.TeacherName = payload.name
      state.showTeachersComponent = 0
      setTimeout(() => {
        state.showTeachersComponent = 5
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
    },
    // end of student mutations



    // teacher mutations

    setDescriptionComponent(state) {
      state.showTeacherRegistrationFormComponent = 1
    },
    setAboutComponent(state) {
      state.showTeacherRegistrationFormComponent = 0
    },
    setQualificationComponent(state) {
      state.showTeacherRegistrationFormComponent = 2
    },
    setVideoComponent(state) {
      state.showTeacherRegistrationFormComponent = 3
    },
    setAvailabilityComponent(state) {
      state.showTeacherRegistrationFormComponent = 4
    },

    setDayIndex(state, payload){
      state.selectedDayIndex = payload.dayIndex
  },


    // end of teacher mutations

  },

})

export default store;