<template>
  <div>
    <router-view />

    <core-footer />
  </div>
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
