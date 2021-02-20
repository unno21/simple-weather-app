<template>
    <div class="mt-3">
        <div class="text-center">
            <p class="text-24 mb-2">{{ location_name }}</p>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4">
                <div>
                    <div class="d-flex justify-content-center">
                        <img class="weather-icon weather-icon-main w-50" :src="forecast_icon" :alt="weather_description">
                    </div>
                    <p class="text-20 text-center text-capitalize mb-2">{{ weather_description }}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-center h-100 align-items-center">
                    <span class="current-temperature text-primary">{{ celsius }} °c</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="text-20">
                        <p class="mb-2">{{ forecast_date }}</p>
                        <p class="mb-2">Wind</p>
                        <div class="pl-4">
                            <ul class="list-unstyled">
                                <li><span class="text-gray">Degree:</span> {{ wind.degree }}</li>
                                <li><span class="text-gray">Speed:</span> {{ wind.speed }} km/h</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapState } from 'vuex';

export default {
    name: "weather-today",
    computed: {
        ...mapState({
            current_forecast: state => state.weather.data.current_forecast,
            current_location_data: state => state.location.data.current_location_data,
        }),
        location_name() {
            if (this.current_location_data.location !== undefined) {
                return this.current_location_data.location.name;
            }
            return '';
        },
        weather_description() {
            if (this.current_forecast.weather !== undefined) {
                return this.current_forecast.weather.description;
            }
            return '';
        },
        forecast_date() {
            if (this.current_forecast.date !== undefined) {
                return `${this.current_forecast.date.day}, ${this.current_forecast.date.time}`;
            }
            return '';
        },
        forecast_icon() {
            if (this.current_forecast.weather !== undefined) {
                return this.current_forecast.weather.icon;
            }
            return 'https://i.stack.imgur.com/y9DpT.jpg';
        },
        wind() {
            if (this.current_forecast.wind !== undefined) {
                return {
                    degree: this.current_forecast.wind.degree,
                    speed: this.current_forecast.wind.speed,
                }
            }

            return {
                degree: 0,
                speed: 0,
            }
        },
        celsius() {
            if (this.current_forecast.temperature !== undefined) {
                return this.current_forecast.temperature.celsius;
            }
            return 0;
        }
    },

}
</script>

<style scoped>

</style>
