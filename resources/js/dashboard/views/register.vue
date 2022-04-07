<template>
    <div>
        <div class="register__form text-center mx-auto">
            <div class="form__field__container flex flex-col gap-5">
                <h1 class="mb-8">REGISTER</h1>
                <div class="form__field">
                    <label class="block">
                        USERNAME
                    </label>
                    <input v-model.trim="oCredentials.username" type="text" maxlength="16" class="username__input" autocomplete="false">
                    <div class="input--tooltip">
                        <p>Minimum 3 chars.</p>
                    </div>
                </div>
                <div class="form__field">
                    <label class="block">
                        PASSWORD
                    </label>
                    <input v-model.trim="oCredentials.password" type="password" class="tracking-3" autocomplete="false">
                    <div class="input--tooltip">
                        <p>Minimum 6 chars.</p>
                        <p>Maximum 10 chars.</p>
                    </div>
                </div>
                <div class="form__field">
                    <label class="block">
                        CONFIRM PASSWORD
                    </label>
                    <input v-model.trim="sConfirmPassword" type="password" class="tracking-3" autocomplete="false">
                </div>
                <button @click="register()" class="button--primary w-28 text-center rounded h-10 mx-auto">Register</button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'register',
    data() {
        return {
            oCredentials : {
                username : '',
                password : ''
            },
            sConfirmPassword : ''
        }
    },
    methods : {
        ...mapActions('oUser', ['createUser']),
        
        /**
         * register
         */
        register() {
            let bValidated = this.validateCredentials();
            if (bValidated === true) {
                this.createUser(this.oCredentials);
                this.oCredentials.username = '';
                this.oCredentials.password = '';
                this.sConfirmPassword = '';
            }
        },

        /**
         * validateCredentials
         * @return bool
         */
        validateCredentials() {
            if (this.oCredentials.username.length < 3) {
                alert('Username is not valid, minimum character is 3.');
                return false;
            }

            if (this.oCredentials.password.length < 6 || this.oCredentials.password.length > 9) {
                alert('Password character must not be less than 6 and greater than 10.');
                return false;
            }

            if (this.oCredentials.password !== this.sConfirmPassword) {
                alert('Password is not the same.');
                return false
            }

            return true;
        }
    }
}
</script>
<style scoped>
.form__field__container {
    @apply pt-20;
}
label {
    @apply text-2xl 
}
input {
    @apply h-9 max-w-md  rounded text-black font-medium focus:outline-none focus:ring focus:border-cyan-400 px-2 text-2xl 
}
.form__field {
    @apply relative z-20 w-max mx-auto text-left;
}
.input--tooltip {
    @apply lg:absolute z-20 -right-40 top-[1.70rem] w-36;
}
</style>