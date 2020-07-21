<template>
  <v-list-group
    v-if="item.children !== undefined && item.children.length > 0"
    :group="path"
    :sub-group="depth > 0"
    prepend-icon=""
  >
    <template #activator>
      <v-list-item-title>{{ item.meta.title }}</v-list-item-title>
    </template>

    <template #appendIcon>
      <v-icon>{{ mdiChevronDown }}</v-icon>
    </template>

    <core-menu-item
      v-for="subitem in item.children"
      :key="subitem.path"
      :item="subitem"
      :path="[path, subitem.path].join('/')"
      :depth="depth+1"
    />
  </v-list-group>
  <v-list-item
    v-else-if="item.name !== undefined"
    :to="{ name: item.name }"
  >
    <v-list-item-title>{{ item.meta.title }}</v-list-item-title>
  </v-list-item>
  <v-list-item
    v-else-if="item.redirect !== undefined"
    :to="item.redirect"
  >
    <v-list-item-title>{{ item.meta.title }}</v-list-item-title>
  </v-list-item>
</template>

<script>
  import { mdiChevronDown } from '@mdi/js'

  export default {
    name: 'CoreMenuItem',
    props: {
      item: {
        type: Object,
        required: true,
      },
      path: {
        type: String,
        required: true,
      },
      depth: {
        type: Number,
        required: true,
      },
    },
    data () {
      return {
        mdiChevronDown
      }
    }
  }
</script>

<style scoped>

</style>
