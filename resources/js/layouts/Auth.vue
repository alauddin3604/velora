<script setup lang="ts">
import Master from './Master.vue'
</script>

<template>
  <Master>
    <div class="flex h-screen w-full items-center justify-center px-4 py-8">
      <slot />
    </div>
  </Master>
</template>