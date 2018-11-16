// initial state


import axios from "axios";

const state = {
  allUsersList: [],
  selecteSpecialistData:{},
};


/**
 * ----- GETTERS -----
 **/

const getters = {

  getAllUsers: (state) => {
    return state.allUsersList;
  },
  getSelecteSpecialist: (state) => {
    return state.selecteSpecialistData;
  },

};


/**
 * ----- ACTIONS -----
 **/

const actions = {

  allUsersList({commit}) {
    let  headers = {
      'Content-Type': 'application/x-www-form-urlencode',
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Headers': '*'


    };
    axios
      .post('https://app.causeffect.nl/public/api/list_of_the_user.php', headers)
      .then(function (response) {
          commit('allUsersListMut', response.data);

      });
  },
  selecteSpecialist ({commit, state}, index) {
    let list = state.allUsersList;
    for(let i = 0; i<list.length; i++) {
      if(list[i].id === index){
        commit('selecteSpecialistMut', list[i]);
        break
      }
    }
  }
};


/**
 * ----- MUTATIONS -----
 * */

const mutations = {
  allUsersListMut (state, value) {
    state.allUsersList = state.allUsersList.concat(value)
  },
  selecteSpecialistMut(state,value) {
    state.selecteSpecialistData = {...value};
  }

};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
