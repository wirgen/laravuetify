<template>
  <v-main class="grey lighten-3">
    <router-view />

    <core-footer />
  </v-main>
</template>

<script>
  import CoreFooter from './CoreFooter'

  export default {
    name: 'CoreView',
    components: { CoreFooter }
  }
</script>

<style scoped>

</style>
