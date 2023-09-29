export default {
  namespaced: true,

  state: () => ({
    preselected: {},
  }),

  getters: {
    getShortcodeParams (state) {
      return state.preselected
    }
  },

  mutations: {
    setShortcodeParams (state, payload) {
      state.preselected = payload
    },
  },

  actions: {}
}