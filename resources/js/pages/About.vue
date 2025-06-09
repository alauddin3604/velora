<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const greeting = ref('Welcome to Your Vue.js + TypeScript App');

</script>

<template>
  <h1>About</h1>
  <Link href="/">Home</Link>
</template>