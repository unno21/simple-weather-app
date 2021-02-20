import Vuex from 'vuex'
import Vue from 'vue'

import weather from './modules/weather';
import location from './modules/location';

Vue.use(Vuex)

export default new Vuex.Store({
   modules: {
      weather,
      location,
   }
})
