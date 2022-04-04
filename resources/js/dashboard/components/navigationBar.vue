<template>
    <div>
        <div class="drawer lg:hidden">
            <button class="drawer__button" @click="showDrawer()">
                <div class="menu-icon"></div>
                <div class="menu-icon"></div>
                <div class="menu-icon"></div>
            </button>
        </div>
        <div class="navbar__container" :class="{'active' : drawerActive}">
            <div class="navbar--links">
                <a class="nav-links" href="">HOME</a>
                <a class="nav-links" href="">Dashboard</a>
                <a class="nav-links" href="">Place Bet</a>
                <a class="nav-links" href="">Scan</a>
            </div>
            <div class="navbar--logo"></div>
            <a href="" class="navbar--logout">logout <span class="icon ic-logout"></span></a>
            <div class=" lg:icon ic-close cursor-pointer" @click="showDrawer()"></div>
        </div>
        <div class="drawer--backdrop" :class="{'w-full': drawerActive}" @click="showDrawer()"></div>
    </div>
</template>
<script>
export default {
    name: 'home',
    data() {
        return {
            drawerActive : false,
        }
    },
    computed: {

    },
    methods: {
            showDrawer : function() {
            this.drawerActive = !this.drawerActive;
        }
    },
}
</script>
<style scoped>
.navbar__container {
    @apply h-full lg:h-24 absolute top-0 -left-2/3 z-40 lg:left-0 lg:relative w-2/3 md:w-1/2 bg-black-dark lg:w-full flex flex-col lg:flex-row text-2xl uppercase lg:px-8 lg:items-center drop-shadow-lg transition-all duration-200 ease-in-out;
}
.navbar__container.active{
    @apply left-0;
}
.navbar--logo {
    @apply mx-auto order-1 h-[161px] w-full border-b-2 border-gray-500 lg:hidden;
}
.navbar--links {
    @apply order-2;
}
.navbar--links .nav-links {
    @apply lg:mr-4 relative flex lg:inline lg:flex-row py-2 pl-4 lg:pl-0 lg:border-0 border-b-2 border-gray-high;
}
.navbar--links .nav-links::after {
    content: '';
    @apply absolute bottom-0 h-0.5 left-0 w-0 bg-white origin-bottom-right transition-all duration-200 ease-in-out ;
}
.navbar--links .nav-links:hover::after {
    @apply lg:w-full;
}
.navbar--logout {
    @apply lg:ml-auto transition-all duration-150 ease-in-out order-3 mt-auto lg:mt-0 py-3 drop-shadow-lg pl-4 lg:pl-0;
}
.ic-logout {
    background: url('/img/ic-logout.svg') no-repeat center;
    background-size: contain;
    width: 2rem;
    height: 2rem;
    margin-left: 8px
}
.navbar--logout:hover {
    @apply brightness-75;
}
.drawer__button {
    @apply h-max ml-5 mt-5;
}
.drawer__button:hover .menu-icon {
    @apply bg-slate-300;
}
.menu-icon {
    @apply w-8 h-1 bg-white mb-2 transition-all duration-100 ease-in-out;
}
.drawer--backdrop {
    @apply h-full absolute left-0 top-0 lg:hidden bg-black bg-opacity-60 z-30
}
</style>