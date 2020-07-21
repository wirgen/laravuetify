<template>
  <v-navigation-drawer
    id="navigation-drawer"
    v-model="opened"
    :dark="true"
    mobile-breakpoint="960"
    app
    width="260"
    v-bind="$attrs"
  >
    <v-divider class="mb-1" />

    <v-list
      nav
    >
      <v-list-item>
        <v-list-item-avatar
          class="align-self-center"
          color="white"
          contain
        >
          <v-img
            src="#"
            max-height="30"
          />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title class="text-h6 font-weight-light">
            LaraVuetify
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-divider class="mb-2" />

    <v-list
      nav
    >
      <core-menu-item
        v-for="item in items"
        :key="item.path"
        :item="item"
        :path="item.path"
        :depth="0"
      />
    </v-list>
  </v-navigation-drawer>
</template>

<script>
  import CoreMenuItem from '@/layout/components/CoreMenuItem'
  import { routes } from '@/routes'

  export default {
    name: 'CoreDrawer',
    components: { CoreMenuItem },
    props: {
      drawer: {
        type: Boolean,
        required: true,
      }
    },
    data () {
      return {
        opened: true,
      }
    },
    computed: {
      items () {
        return routes
      }
    },
    watch: {
      drawer: function () {
        this.opened = this.drawer
      }
    },
  }
</script>

<style scoped>

</style>
