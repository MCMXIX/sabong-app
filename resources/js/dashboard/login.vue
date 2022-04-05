<template>
    <div>
        <div class="login__form text-center mx-auto">
            <div class="form__field__container flex flex-col gap-5">
                <h1 class="mb-8 uppercase">login</h1>
                <div class="form__field">
                    <label class="block">
                        USERNAME
                    </label>
                    <input type="text" maxlength="16" class="username__input" autocomplete="false">
                </div>
                <div class="form__field">
                    <label class="block">
                        PASSWORD
                    </label>
                    <input type="password" class="tracking-3" autocomplete="false">
                    <p class="text-red-high mt-2" :class="{'opacity-0': loginFailed}">Invalid Username or Password</p>
                </div>
                <button class="button--primary w-28 text-center rounded h-10 mx-auto">Login</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'login',
    data() {
        return {
            loginFailed : true,
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