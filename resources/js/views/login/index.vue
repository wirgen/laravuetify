<template>
  <div>
    <h4>Login</h4>
    <form :model="loginForm">
      <label for="email">E-Mail</label>
      <div>
        <input
          id="email"
          v-model="loginForm.email"
          type="email"
          required
          autofocus
        >
      </div>
      <label for="password">Password</label>
      <div>
        <input
          id="password"
          v-model="loginForm.password"
          type="password"
          required
        >
      </div>
      <button
        type="submit"
        @click="handleLogin"
      >
        Login
      </button>
    </form>
  </div>
</template>

<script>
  import { login } from '@/api/auth'

  export default {
    name: 'Login',
    data () {
      return {
        loginForm: {
          email: 'admin@example.com',
          password: '00000000',
        },
        redirect: undefined,
      }
    },
    watch: {
      $route: {
        handler: function (route) {
          this.redirect = route.query && route.query.redirect
        },
        immediate: true,
      },
    },
    methods: {
      handleLogin (e) {
        e.preventDefault()
        login({
          email: this.loginForm.email.trim(),
          password: this.loginForm.password
        })
          .then(() => {
            this.$router.push({ path: this.redirect || '/' })
          })
      }
    }
  }
</script>

<style scoped>

</style>
