<template>
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-6 p-2" v-for="therapist in therapists">
                <div class="card" >
                    <div class="card-body">
                        <img src='https://via.placeholder.com/100.png/' class='float-left mr-3 h-100'>
                        <h4 class="card-title mb-0">{{ therapist.name }}</h4>
                        <h5 class="card-text city text-secondary">{{ therapist.city }}</h5>
                        <p class="card-text"><span v-text="therapist.practices.join(', ')"></span></p>
                        <a href='#'>Je prend un rendez-vous !</a>
                    </div>
                </div>
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
            therapists: {}
        }
    },

    mounted() { 
        Event.listen('search-applied', data => { 
            this.therapists = data;
        });
    },
}
</script>

