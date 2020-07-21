<template>
  <v-app-bar
    id="app-bar"
    absolute
    app
    color="transparent"
    flat
    height="75"
  >
    <v-btn
      ref="btnDrawer"
      class="mr-3 white"
      elevation="1"
      fab
      small
      @click="setDrawer(!drawer)"
    >
      <v-icon v-if="drawer">
        {{ mdiDotsVertical }}
      </v-icon>

      <v-icon v-else>
        {{ mdiViewQuilt }}
      </v-icon>
    </v-btn>

    <v-toolbar-title
      class="hidden-sm-and-down font-weight-light"
    >
      <v-breadcrumbs
        :items="crumbs"
        large
      />
    </v-toolbar-title>

    <v-spacer />

    <v-btn
      class="ml-2"
      min-width="0"
      text
      to="/"
    >
      <v-icon>{{ mdiViewDashboard }}</v-icon>
    </v-btn>

    <v-menu
      bottom
      right
      offset-y
    >
      <template #activator="{ attrs, on }">
        <v-btn
          class="ml-2"
          min-width="0"
          text
          v-bind="attrs"
          v-on="on"
        >
          <v-icon>{{ mdiAccount }}</v-icon>
        </v-btn>
      </template>
      <v-list width="140">
        <v-list-item
          :to="{ name: 'UserList' }"
        >
          <v-list-item-title>Users</v-list-item-title>
        </v-list-item>

        <v-divider />

        <v-list-item
          @click="handleLogout"
        >
          <v-list-item-title>Exit</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
  import { logout } from '@/api/auth'
  import { removeToken } from '@/utils/auth'
  import { mdiAccount, mdiDotsVertical, mdiViewDashboard, mdiViewQuilt } from '@mdi/js'

  export default {
    name: 'CoreAppBar',
    props: {
      drawer: {
        type: Boolean,
        required: true,
      }
    },
    emits: ['update-drawer'],
    data () {
      return {
        mdiViewQuilt,
        mdiDotsVertical,
        mdiViewDashboard,
        mdiAccount,
      }
    },
    computed: {
      crumbs: function () {
        const pathArray = this.$route.path.split('/')
        pathArray.shift()
        if (pathArray[0] === 'dashboard') {
          pathArray.shift()
        }

        return pathArray.reduce((breadcrumbArray, path, idx) => {
          if (path !== undefined) {
            breadcrumbArray.push({
              to: breadcrumbArray[idx].to === '/dashboard'
                ? '/' + path
                : breadcrumbArray[idx].to + '/' + path,
              text: this.$route.matched[idx + 1].meta.title,
              exact: true,
            })
          }

          return breadcrumbArray
        }, [{
          to: '/dashboard',
          text: 'Dashboard',
          exact: true,
        }])
      }
    },
    methods: {
      setDrawer (drawer) {
        this.$refs['btnDrawer'].$el.blur()
        this.$emit('update-drawer', drawer)
      },
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
