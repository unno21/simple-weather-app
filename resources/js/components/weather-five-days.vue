<template>
    <div class="pt-5">
        <div class="weather-five-days">
            <div v-for="forecast in forecast_options" class="weather-content">
                <span class="weather-day">{{ forecast.date.day }}</span>
                <div class="d-flex justify-content-center">
                    <picture class="weather-icon">
                        <img :src="forecast.weather.icon" alt="">
                    </picture>
                </div>
                <span class="weather-temp">{{ forecast.temperature.celsius }} °c</span>
            </div>
        </div>
    </div>
</template>

<script>

import { mapState } from 'vuex';

export default {
    name: "weather-five-days",
    computed: {
        ...mapState({
            current_forecast: state => state.weather.data.current_forecast,
            five_days_forecast: state => state.weather.data.five_days_forecast,
        }),
        forecast_options() {
            if (this.five_days_forecast.length > 0 && this.current_forecast.date !== undefined) {
                let dates = [];
                let five_day_forecast = [];
                this.five_days_forecast.forEach(forecast => {
                    if (!dates.includes(forecast.date.text) && forecast.date.time === this.current_forecast.date.time) {
                        five_day_forecast.push(forecast);
                        dates.push(forecast.date.text);
                    }
                });
                return five_day_forecast;
            }
            return [];
        }
    },
}
</script>

<style scoped>

</style>
