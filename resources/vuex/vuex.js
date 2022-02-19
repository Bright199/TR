import { createStore } from "vuex";

const store = createStore({
    state () {
      return {
        count: 0,
        loggedUser:''
      }
    },
    mutations: {
      increment (state) {
        state.count++
      },
      userDetails (state, obtainedUser) {
        state.loggedUser = obtainedUser
      }
    }
  })

  export default store;