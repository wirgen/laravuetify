<template>
  <div>
    <h1>Demo App</h1>
    <ul class="top-menu">
      <li>
        <router-link :to="{ name: 'Dashboard' }">
          Dashboard
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'Item' }">
          Item
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'OtherItem' }">
          Other item
        </router-link>
      </li>
    </ul>
    <ul class="user-menu">
      <li>
        <router-link :to="{ name: 'UserList' }">
          Users
        </router-link>
      </li>
      <li>
        <a
          href="#"
          @click="handleLogout"
        >Exit</a>
      </li>
    </ul>
  </div>
</template>

<script>
  import { logout } from '@/api/auth'
  import { removeToken } from '@/utils/auth'

  export default {
    name: 'CoreAppBar',
    methods: {
      handleLogout () {
        logout().then(() => {
          removeToken()
          this.$router.push({ name: 'Login' })
        })
      }
    }
  }
</script>

<style scoped>

</style>
