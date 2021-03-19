import Vue from 'vue'
import Vuex from 'vuex'
import Task from '../services/task.service'
import Type from '../services/type.service'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    tasks: [],
    typesTask: [],
    load: {
      task: true,
      type: true
    }
  },
  actions: {
    /*
    login({ commit }, user) {
      return AuthService.login(user).then(user => {
        commit('loginSuccess', user);
        return Promise.resolve(user);
      }, error => {
        commit('loginFailure');
        return Promise.reject(error);
      });
    },*/
    getTask({ commit }) {
      Task.get().then(task => {
        commit('syncTask', task);
      })
    },
    createTask({ dispatch }, data) {
      Task.create(data).then(() => {
        dispatch('getTask');
      })
    },
    editeTask({ dispatch }, data) {
      Task.edit(data).then(() => {
        dispatch('getTask');
      })
    },
    statusTask({ dispatch }, data) {
      Task.alterStatus(data).then(() => {
        dispatch('getTask');
      })
    },
    deleteTask({ dispatch }, id) {
      Task.remove(id).then(() => {
        dispatch('getTask');
      })
    },
    //Actions for Types
    getType({ commit }) {
      Type.get().then(type => {
        commit('syncType', type);
      })
    },
    createType({ dispatch }, title) {
      Type.create(title).then(() => {
        dispatch('getType');
      })
    },
    editType({ dispatch }, data) {
      Type.edit(data).then(() => {
        dispatch('getType');
      })
    },
    deleteType({ dispatch }, id) {
      Type.remove(id).then(() => {
        dispatch('getType');
      })
    },
  },
  mutations: {
    syncTask(state, tasks) {
      state.tasks = tasks;
      state.load.task = false;
    },
    syncType(state, types) {
      state.typesTask = types;
      state.load.type = false;
    },
  },
})