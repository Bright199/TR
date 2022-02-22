import { createStore } from "vuex";

const store = createStore({
    state () {
      return {
        loggedUser:''
      }
    },
    mutations: {
      userDetails (state, obtainedUser) {
        state.loggedUser = obtainedUser
      }
    },
    getters:{
      UserFirstName(state){
        return state.loggedUser
      }
    }
  })

  export default store;