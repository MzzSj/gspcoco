import moment from 'moment';

function getDateString (date) {
  return moment(date).format('YYYY-MM-DD')
}

export default {
  namespaced: true,

  state: () => ({
    params: {
      id: null,
      tag: null,
      search: null,
      recurring: null,
      dates: moment().toDate(),
      locationId: null,
      providers: null,
    }
  }),

  getters: {
    getTag (state) {
      return state.params.tag
    },

    getSearch (state) {
      return state.params.search
    },

    getLocationIdParam (state) {
      return state.params.locationId
    },

    getDates (state) {
      return state.params.dates
    },

    getEventParams (state) {
      return {
        dates: [getDateString(state.params.dates)],
        id: state.params.id,
        search: state.params.search,
        locationId: state.params.locationId,
        tag: state.params.tag,
        recurring: state.params.recurring,
        providers: state.params.providers
      }
    },

    getAllData (state) {
      return {
        dates: state.params.dates,
        id: state.params.id,
        search: state.params.search,
        locationId: state.params.locationId,
        tag: state.params.tag,
        recurring: state.params.recurring,
        providers: state.params.providers
      }
    }
  },

  mutations: {
    setTag (state, payload) {
      state.params.tag = payload ? payload : null
    },

    setLocationIdParam (state, payload) {
      state.params.locationId = payload ? payload : null
    },

    setId (state, payload) {
      state.params.id = payload
    },

    // * Params for Events
    // ! needs to change name of function
    setParams (state, payload) {
      if (payload.eventId) {
        state.params.id = payload.eventId
      }

      if (payload.eventTag) {
        state.params.tag = payload.eventTag
      }

      if (payload.eventRecurring) {
        state.params.recurring = payload.eventRecurring
      }
    },

    setSearch (state, payload) {
      state.params.search = payload ? payload : null
    },

    setDates (state, payload) {
      state.params.dates = payload
    },

    setAllData (state, payload) {
      state.params = {
        dates: payload.dates,
        id: payload.id ? parseInt(payload.id) : null,
        search: payload.search,
        locationId: payload.locationId ? parseInt(payload.locationId) : null,
        tag: payload.tag,
        recurring: payload.recurring,
        providers: payload.providers
      }
    }
  },

  actions: {}
}