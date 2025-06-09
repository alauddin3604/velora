<script setup lang="ts">
defineProps<{
  error: string
}>()
</script>

<template>
  <h1>Error</h1>
  <p>{{ error }}</p>
</template>