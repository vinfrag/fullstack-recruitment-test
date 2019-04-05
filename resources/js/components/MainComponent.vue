<template>
    <div>
        <header class="mb-5 box-shadow">
            <div class="mb-5">
                <h1 class="display-3 text-center"><img src="https://www.medoucine.com/images/logos/logo.svg" width="350"/></h1>
            </div>
            <search-component></search-component>
        </header>
        
        <div class="mb-5">
            <result-component></result-component>
        </div>    

        <footer class="mt-5">
            <links-component></links-component>
        </footer>
    </div>
</template>

<script>

export default {
    mounted() {
        console.log('mounted')
    },
}
</script>
