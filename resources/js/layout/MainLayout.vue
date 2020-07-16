<template>
  <div>
    <core-app-bar />

    <core-drawer />

    <core-view />
  </div>
</template>

<script>
  import CoreAppBar from './components/CoreAppBar'
  import CoreDrawer from './components/CoreDrawer'
  import CoreView from './components/CoreView'

  export default {
    name: 'MainLayout',
    components: { CoreAppBar, CoreDrawer, CoreView }
  }
</script>

<style scoped>

</style>
