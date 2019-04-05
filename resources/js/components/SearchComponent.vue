<template>
    <div class="container">
        <form @submit.prevent="submitForm">
            <div class="row">
                <div class="form-group col col-12 col-md-6 col-lg-4">
                    <select class="form-control" name="city" id="" v-model="city">
                        <option value="-1">-- Sélectionner la ville</option>
                        <option v-for="c in cities" v-text="c"></option>
                    </select>
                </div>

                <div class="form-group col col-12 col-md-6 col-lg-4">
                    <select class="form-control" name="city" id="" v-model="category">
                        <option value="-1">-- Sélectionner la catégorie</option>
                        <option v-for="cat in categories" v-text="cat"></option>
                    </select>
                </div>

                <div class="form-group col col-12 col-lg-4">
                    <button type="submit" class="btn btn-primary w-100">GO !</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
class Select {
    constructor (content) {
        this.value = '-1';
        this.content = content;
    } 
}

export default {

    data () {
        return {
            city: new Select('-- Choisir la ville'),
            category: new Select('-- Choisir la catégorie'),

            cities: [ 'Paris', 'Amiens', 'Rouen', 'Reims' ],
            categories: [ 'Hypsnose', 'Sophrologie' ],
        }
    },

    mounted() {
        console.log('mounted')
    },

    methods: {
        submitForm () {
            alert("hello");
            console.log(this.$data);
        }
    }
}
</script>

