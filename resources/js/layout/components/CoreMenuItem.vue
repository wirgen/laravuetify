<template>
  <li>
    <router-link
      v-if="item.name !== undefined"
      :to="{ name: item.name }"
    >
      {{ item.meta.title }}
    </router-link>
    <router-link
      v-else-if="item.redirect !== undefined"
      :to="item.redirect"
    >
      {{ item.meta.title }}
    </router-link>
    <span v-else>{{ item.meta.title }}</span>
    <ul v-if="item.children !== undefined && item.children.length > 0">
      <core-menu-item
        v-for="subitem in item.children"
        :key="subitem.path"
        :item="subitem"
      />
    </ul>
  </li>
</template>

<script>
  export default {
    name: 'CoreMenuItem',
    props: {
      item: {
        type: Object,
        required: true,
      }
    },
  }
</script>

<style scoped>

</style>
