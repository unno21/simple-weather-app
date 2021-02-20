<template>
    <div class="container py-4">
        <div class="p-2 py-3 p-lg-5 card">

            <div class="container mb-3">
                <h1 class="text-center text-uppercase font-weight-700 mb-4">Japan Weather</h1>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <label class="form-input-label text-uppercase">Select a city</label>
                        <b-form-select v-model="selectedCity" :options="citiesOptions"/>
                    </div>
                </div>
            </div>
            <hr>
            <weather-today></weather-today>
            <hr>
            <weather-five-days></weather-five-days>
            <hr>
            <venue></venue>

        </div>
    </div>
</template>

<script>

import { mapState, mapActions } from 'vuex';

export default {
    name: "app",
    data() {
        return {
            selectedCity: null,
        };
    },
    computed: {
        ...mapState({
            cities: state => state.location.data.cities,
            country_code: state => state.location.data.country_code,
        }),
        citiesOptions() {
            return this.cities.map(city => {
                return {
                    value: city, text: city,
                }
            });
        }
    },
    watch:{
        selectedCity(newCity) {
            this.fetchCurrentForecast({ city: newCity, country_code: this.country_code });
            this.fetchFiveDaysForecast({ city: newCity, country_code: this.country_code });
            this.fetchLocationData(newCity);
        },
        cities(newValue, oldValue) {
            if (newValue.length > 0 && oldValue.length === 0) {
                this.selectedCity = newValue[0];
            }
        }
    },
    methods: {
        ...mapActions([
            'fetchLocations',
            'fetchLocationData',
            'fetchCurrentForecast',
            'fetchFiveDaysForecast',
        ]),
    },
    mounted() {
        this.fetchLocations();
    }
}
</script>

<style scoped>

</style>
