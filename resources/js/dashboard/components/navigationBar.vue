<template>
    <div class="fixed z-50 h-full lg:relative" :class="{'w-full' :drawerActive}">
        <div class="drawer lg:hidden">
            <button class="drawer__button" @click="showDrawer()">
                <div class="menu-icon"></div>
                <div class="menu-icon"></div>
                <div class="menu-icon"></div>
            </button>
        </div>
        <div class="navbar__container overflow-hidden" :class="{'active' : drawerActive}">
            <div class="navbar--links">
                <button @click="redirectPage('/', $event)" class="nav-links" >HOME</button>
                <button @click="redirectPage('/fight', $event)" class="nav-links" >DASHBOARD</button>
                <button @click="redirectPage('/betting', $event)" class="nav-links" >PLACE BET</button>
                <button @click="redirectPage('/', $event)" class="nav-links" >SCAN</button>
            </div>
            <div class="navbar--logo 2xl:pl-24 relative">
                <img class="w-1/2 lg:w-auto lg:h-20" src="/img/cockfight-logo.png" alt="">
                <div class="logo--text absolute bottom-5 w-max lg:bottom-3">
                    <p class="">Sabong App</p>
                </div>
            </div>
            <div class="navbar--user">
                <button @click="redirectPage('/register', $event)" class="navbar--register nav-links block">register</button>
                <a href="/api/user/logout" class="navbar--logout blocked w-full">logout <span class="icon ic-logout"></span></a>
            </div>
            <button class="close__button" @click="showDrawer()"> <span class="lg:icon ic-close"></span> </button>
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
    methods: {
        /**
         * showDrawer
         */
        showDrawer : function() {
            this.drawerActive = !this.drawerActive;
        },

        /**
         * redirectPage
         * @param string sRoute
         */
        redirectPage : function(sRoute, oElement) {
            if (this.$route.fullPath !== sRoute) {
                this.removeSelectedClass();
                this.$router.push(sRoute);
                this.showDrawer();
                oElement.target.classList.add('font-bold');
            }
        },
        
        /**
         * removeSelectedClass
         */
        removeSelectedClass: function() {
            let oNavButtons = this.$el.querySelectorAll('.nav-links');
            oNavButtons.forEach((oElement) => {
                oElement.classList.remove('font-bold');
            })
        }
    }
}
</script>
<style scoped>
.navbar__container {
    @apply h-full lg:h-24 absolute top-0 -left-3/4 z-40 lg:left-0 lg:relative w-2/3 md:w-1/2 bg-black-dark lg:w-full flex flex-col lg:flex-row text-2xl uppercase lg:px-8 lg:items-center drop-shadow-lg transition-all duration-200 ease-in-out;
}
.navbar__container.active{
    @apply left-0;
}
.navbar--logo {
    @apply mx-auto flex items-center flex-col lg:order-2 order-1 w-full lg:w-auto py-5 border-b-2 border-gray-500 lg:border-0 lg:h-auto text-center;
}
.navbar--links {
    @apply lg:order-1 order-2;
}
.navbar--links .nav-links {
    @apply lg:mr-4 relative flex w-full lg:w-auto lg:inline lg:flex-row py-2 pl-4 lg:pl-0 lg:border-0 border-b-2 border-gray-high hover:bg-black-low;
}
.navbar--links .nav-links::after {
    content: '';
    @apply absolute bottom-0 h-0.5 left-0 w-0 bg-white origin-bottom-right transition-all duration-200 ease-in-out ;
}
.navbar--links .nav-links:hover::after {
    @apply lg:w-full;
}
.navbar--user {
    @apply order-3 ml-auto mt-auto lg:mt-0 w-full lg:w-max lg:flex lg:items-center flex flex-col lg:flex-row; 
}
.navbar--register {
    @apply mr-4 w-full pl-4 lg:pl-0 py-3 uppercase  text-left border-t-2 lg:border-t-0 hover:brightness-75;
}
.navbar--logout {
    @apply drop-shadow-lg border-t-2 py-3 pl-4 lg:p-0 lg:pl-0 w-full lg:w-auto text-left uppercase lg:border-t-0 shrink-0 hover:brightness-75;
}
.ic-logout {
    background: url('/img/ic-logout.svg') no-repeat center;
    background-size: contain;
    width: 2rem;
    height: 2rem;
    margin-left: 8px
}
.drawer__button {
    @apply h-max ml-2 mt-5;
}
.ic-close::before,
.ic-close::after {
    top: 10px;
    right: 20px;
    @apply lg:hidden
}
.menu-icon {
    @apply w-8 h-1 bg-white mb-2 transition-all duration-100 ease-in-out;
}
.drawer--backdrop {
    @apply h-full absolute left-0 top-0 lg:hidden bg-black bg-opacity-60 z-30
}
.logo--text p{
    -webkit-text-stroke: 1px #3E403E;
    @apply font-bold drop-shadow-lg;
}
</style>