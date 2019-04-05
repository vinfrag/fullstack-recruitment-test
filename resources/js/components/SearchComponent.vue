<template>
    <div class="container">
        <form @submit.prevent="submitForm" @change="errors.remove($event.target.name)">
            <div class="row">
                <div class="form-group col col-12 col-md-6 col-lg-4 pr-1 pl-0">
                    <select class="form-control" :class="{ 'is-invalid': errors.has('city') }" name="city" id="city" v-model="citySelected" required>
                        <option v-for="option in cityOptions" :value="option.value" v-text="option.text"></option>
                    </select>
                    <small class="invalid-feedback" v-show="errors.has('city')">
                        {{ errors.get('city') }}
                    </small>
                </div>

                <div class="form-group col col-12 col-md-6 col-lg-4 pr-0 pl-0">
                    <select class="form-control" :class="{ 'is-invalid': errors.has('practice') }" name="practice" id="practice" v-model="practiceSelected" required>
                        <option v-for="option in practiceOptions" :value="option.value" v-text="option.text"></option>
                    </select>
                    <small class="invalid-feedback" v-show="errors.has('practice')">
                        {{ errors.get('practice') }}
                    </small>
                </div>

                <div class="form-group col col-12 col-lg-4 ">
                    <button type="submit" class="btn btn-primary w-100">GO !</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
class Errors {
    constructor() {
        this.items = {};
    }

    has(field) {
        return this.items.hasOwnProperty(field);
    }

    get(field) {
        if (this.items[field]) {
            return this.items[field];
        }
    }

    set(errors) {
        this.items = errors;
    }

    push(error) {
        this.items[error.field] = error.msg;
    }

    remove(field) {
        delete this.items[field];
    }
}

export default {
    methods: {
        submitForm () {
            if(this.citySelected == -1)
            {
                this.errors.push({ field: 'city', msg: 'Ce champ est invalide.'} );
            }

            if(this.practiceSelected == -1)
            {
                this.errors.push({ field: 'practice', msg: 'Ce champ est invalide.'} );
            }
            this.$forceUpdate();
            
            if(this.citySelected != -1 && this.practiceSelected != -1)
            {
                this.getTherapists(this.citySelected, this.practiceSelected);
            }
        },

        getTherapists (city, practice) {
            this.$http
                .get("/api/therapists/" + city + "/" + practice)
                .then(response => Event.fire('search-applied', response.data))
                .catch('Error catch during the process !');
        },

        compare(a,b) {
             if(a.text > b.text)
                    return -1;
                else if( a.text < b.text )
                    return 1;
                return 0;
        },

        populateCities(response) {            
            let cities =  Object.keys(response.data).map((key, index) => {
                    var text = response.data[key];
                    var value = text.toLowerCase()
                    return { value: value, text: text};
                })

            console.log(cities);
            let rdata = [cities];
            rdata = rdata.sort((a,b) => compare(a,b)) 
            console.log(rdata.reverse())

            this.cityOptions = this.cityOptions.concat(cities).sort((a,b) => b.value > a.value);
            Event.fire('cities-loaded', cities);
        },

        populatePractices(response) {
            let practices =  Object.keys(response.data).map(function(key, index) {
                    var practice = response.data[key];
                    return { value: practice['value'], text: practice['text']};
                })

            this.practiceOptions = this.practiceOptions.concat(practices);
        },

        loadCities() {
            this.$http
                .get("/api/cities")
                .then(this.populateCities);
        },

        loadPractices() {
            this.$http
                .get("/api/practices")
                .then(this.populatePractices);
        },        
    },

    data () {
        return {
            citySelected: '-1',
            cityOptions: [
                { value: '-1', text: '-- Choisir la ville' }
            ],

            practiceSelected : '-1',
            practiceOptions : [
                { value: '-1', text: "-- Choisir l'activité" }
            ],

            results : {},

            errors: new Errors(),
        }
    },

    mounted() {
        this.loadCities();
        this.loadPractices();

        Event.listen('click-on-practice', data => {
            this.getTherapists(data.city, data.practice);
            this.citySelected = data.city;
            this.practiceSelected = data.practice;
        });
    },

    computed: {
        sortedCities (){
            var compare = function (a,b) { 
                if(a.value > b.value)
                    return -1;
                else if( a.value < b.value )
                    return 1;
                return 0;
            }

            return [ this.cityOptions ].sort(compare);
        }
    }
}
</script>

