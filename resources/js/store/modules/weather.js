const state = {
    url: {
        fetch_current_forecast: '/api/weather/current',
        fetch_five_days_forecast: '/api/weather/five-days',
    },
    data: {
        current_forecast: {},
        five_days_forecast: [],
    }
};

const getters = {

};

const actions = {
    async fetchCurrentForecast({state, commit}, params) {
        const response = await axios.get(state.url.fetch_current_forecast, { params });
        commit('setCurrentForecast', response.data.data || {});
    },
    async fetchFiveDaysForecast({state, commit}, params) {
        const response = await axios.get(state.url.fetch_five_days_forecast, { params });
        commit('setFiveDaysForecast', response.data.data || []);
    }
};

const mutations = {
    setCurrentForecast(state, current_forecast) {
        state.data.current_forecast = current_forecast;
    },
    setFiveDaysForecast(state, five_days_forecast) {
        state.data.five_days_forecast = five_days_forecast;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
