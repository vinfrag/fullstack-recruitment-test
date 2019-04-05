<template>
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-6 col-lg-4" v-for="city in cities">
                <h5>{{ city.text }} </h5>
                <ul>
                    <li v-for="practice in practicesByCities[city.text]">
                        <a :href="'#'+practice.value" @click.prevent="firingEvent(city.value, practice.value)">{{ practice.text }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        
    },

    data () {
        return {
            cities: {},
            practicesByCities : {}
        }
    },

    mounted() { 
        Event.listen('cities-loaded', data => { 
            this.cities = data;
        });

        this.$http
                .get("/api/practices-by-cities")
                .then(response => this.practicesByCities = response.data);
    },

    methods: {
        firingEvent(city, practice) {
            Event.fire('click-on-practice', { 'practice': practice, 'city': city })
        }
    }


}
</script>

