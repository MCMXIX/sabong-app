<template>
    <div>
        <nav-bar/>
        <div class="content__container">
            <router-view />
        </div>
    </div>
</template>
<script>
import NavBar from './components/navigationBar.vue'
export default {
    name: 'dashboard',
    components: { 
        NavBar,
    },
    data() {
        return {
        }
    },
    computed: {

    },  
}
</script>
<style scoped>
.content__container {
    min-height: -webkit-fill-available;
    @apply lg:h-full flex flex-col max-w-[1280px] lg:bg-black-dark mx-auto lg:shadow-lg;
}
</style>