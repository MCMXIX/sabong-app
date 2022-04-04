<template>
    <div>
        <nav-bar/>
        <router-view />
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
    }
}
</script>