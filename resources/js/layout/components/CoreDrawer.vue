<template>
  <div>
    <ul class="main-menu">
      <core-menu-item
        v-for="item in items"
        :key="item.path"
        :item="item"
      />
    </ul>
  </div>
</template>

<script>
  import CoreMenuItem from '@/layout/components/CoreMenuItem'
  import { routes } from '@/routes'

  export default {
    name: 'CoreDrawer',
    components: { CoreMenuItem },
    computed: {
      items () {
        return routes
      }
    }
  }
</script>

<style scoped>

</style>
