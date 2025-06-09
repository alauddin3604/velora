<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

defineProps<{
  count: number
}>()
</script>

<template>
  <h1>{{ count }}</h1>
  <Link href="/">Home</Link>
</template>