<template>
    <div class="pt-5">
        <p class="text-center text-uppercase text-24 mb-4">Historical Sites</p>
        <div class="venue">
            <div v-for="venue in venue_options" class="venue-card">
                <div class="venue-img mb-3">
                    <img :src="venue.image" alt="" class="w-100">
                </div>
                <div class="description">
                    <p class="text-20 mb-1">{{ venue.name }}</p>
                    <p>{{ venue.address }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import {mapActions, mapState} from 'vuex';

export default {
    name: "venue",
    computed: {
        ...mapState({
            current_location_data: state => state.location.data.current_location_data,
        }),
        venue_options() {
            if (this.current_location_data.historical_sites !== undefined && this.current_location_data.historical_sites.length > 0) {
                return this.current_location_data.historical_sites.map(site => {
                    if (site.image === undefined) {
                        site.image = '';
                    }
                    return site;
                });
            }
            return [];
        },
    },
    watch: {
        async current_location_data() {
            if (this.current_location_data.historical_sites.every(site => site.image !== '')) {
                let historical_sites = JSON.parse(JSON.stringify(this.current_location_data.historical_sites));
                for (let i = 0; i < historical_sites.length; i++) {
                    historical_sites[i].image = await this.fetchVenueImage(historical_sites[i].id) || 'https://i.stack.imgur.com/y9DpT.jpg';
                }

                this.current_location_data.historical_sites = historical_sites;
            }
        }
    },
    methods: {
        ...mapActions([
            'fetchVenueImage',
        ]),
    },

}
</script>

<style scoped>

</style>
