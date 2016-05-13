<template v-for="log in logs">
  <template v-for="value in log">
    <div>
      {{ $key }} : {{ value }}
    </div>
  </template>
</template>
<script>
  module.exports = {

    props: ['logs'],

    mixins: ['./../mixins/mixins.js']
  }
</script>
