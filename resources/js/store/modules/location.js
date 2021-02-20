const state = {
    url: {
        fetch_locations: '/api/locations',
        fetch_location_data: '/api/locations/data',
        fetch_location_image: '/api/locations/image',
    },
    data: {
        cities: [],
        country_code: 'JP',
        current_location_data: {},
    }
};

const getters = {

};

const actions = {
    async fetchLocations({state, commit}) {
        const response = (await axios.get(state.url.fetch_locations)).data;
        commit('setCitiesData', response.cities || []);
        commit('setCountryCode', response.country_code || 'JP');
    },
    async fetchLocationData({state, commit}, city) {
        const params = { city, country_code: state.data.country_code };
        const response = (await axios.get(state.url.fetch_location_data, {params})).data;
        commit('setCurrentLocationData', response.data || {});
    },
    async fetchVenueImage({state}, venue_id) {
        return (await axios.get(state.url.fetch_location_image, {params: {venue_id}})).data;
    }
};

const mutations = {
    setCitiesData(state, cities) {
        state.data.cities = cities;
    },
    setCountryCode(state, country_code) {
        state.data.country_code = country_code;
    },
    setCurrentLocationData(state, current_location_data) {
        state.data.current_location_data = current_location_data;
    }
};

export default {
  state,
  getters,
  actions,
  mutations,
};
