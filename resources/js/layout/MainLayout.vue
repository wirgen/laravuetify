<template>
  <v-app>
    <core-app-bar
      :drawer="drawer"
      @update-drawer="setDrawer"
    />

    <core-drawer :drawer="drawer" />

    <core-view />
  </v-app>
</template>

<script>
  import CoreAppBar from './components/CoreAppBar'
  import CoreDrawer from './components/CoreDrawer'
  import CoreView from './components/CoreView'

  export default {
    name: 'MainLayout',
    components: { CoreAppBar, CoreDrawer, CoreView },
    data () {
      return {
        drawer: true,
      }
    },
    methods: {
      setDrawer (drawer) {
        this.drawer = drawer
      }
    }
  }
</script>

<style scoped>

</style>
