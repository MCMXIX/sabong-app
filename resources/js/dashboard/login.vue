<template>
    <div>
        <div class="login__form text-center mx-auto">
            <div class="form__field__container flex flex-col gap-5">
                <h1 class="mb-8 uppercase">login</h1>
                <div class="form__field">
                    <label class="block">
                        USERNAME
                    </label>
                    <input v-model="oUserCredential.username" type="text" maxlength="16" class="username__input" autocomplete="false">
                </div>
                <div class="form__field">
                    <label class="block">
                        PASSWORD
                    </label>
                    <input v-model="oUserCredential.password" type="password" class="tracking-3" autocomplete="false">
                    <p class="text-red-high mt-2" :class="{'opacity-0': bLoginError}"> {{sLoginErrorMessage}} </p>
                </div>
                <button @click="loginUser" class="button--primary w-28 text-center rounded h-10 mx-auto">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'login',
    data() {
        return {
            oUserCredential : {
                username : '',
                password : ''
            }
        }
    },
    computed: {
        ...mapGetters('oUser', ['bLoginError', 'sLoginErrorMessage'])
    },
    methods : {
        ...mapActions('oUser', ['login']),

        /**
         * loginUser
         * @return false
         */
        loginUser() {
            if (this.oUserCredential.username.trim() === '' || this.oUserCredential.password.trim() === '') {
                alert('Please input Username and password.');
                return false;
            }

            this.login(this.oUserCredential);
        }
    }
}
</script>

<style scoped>
.form__field__container {
    @apply pt-20;
}
label {
    @apply text-2xl;
}
input {
    @apply h-9 max-w-md  rounded text-black font-medium focus:outline-none focus:ring focus:border-cyan-400 px-2 text-2xl;
}
</style>