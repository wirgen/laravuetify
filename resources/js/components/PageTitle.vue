<template>
  <section class="mb-12 text-center">
    <h1
      class="font-weight-light mb-2 headline"
      v-text="title"
    />
  </section>
</template>

<script>
  export default {
    name: 'PageTitle',
    props: {
      title: {
        type: String,
        required: true,
      }
    }
  }
</script>

<style scoped>

</style>
