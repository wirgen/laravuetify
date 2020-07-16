<template>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
      <tr
        v-for="user in users"
        :key="user.id"
      >
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
  import UserResource from '@/api/user'

  const userResource = new UserResource()

  export default {
    name: 'UserList',
    data () {
      return {
        users: [],
      }
    },
    created () {
      userResource.list()
        .then(response => {
          this.users = response.data
        })
    }
  }
</script>

<style scoped>

</style>
