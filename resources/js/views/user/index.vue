<template>
  <v-container
    id="users"
    class="px-6"
    fluid
    tag="section"
  >
    <page-title title="Users" />

    <v-card>
      <v-card-title>List of users</v-card-title>

      <v-sheet>
        <v-data-table
          :headers="headers"
          :items="users"
        />
      </v-sheet>
    </v-card>
  </v-container>
</template>

<script>
  import UserResource from '@/api/user'
  import PageTitle from '@/components/PageTitle'

  const userResource = new UserResource()

  export default {
    name: 'UserList',
    components: { PageTitle },
    data () {
      return {
        users: [],
        headers: [
          {
            text: 'ID',
            value: 'id',
          },
          {
            text: 'Name',
            value: 'name',
          },
          {
            text: 'Email',
            value: 'email',
          },
        ],
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
