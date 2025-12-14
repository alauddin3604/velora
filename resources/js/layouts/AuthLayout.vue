<script setup lang="ts">
import MasterLayout from './MasterLayout.vue'
</script>

<template>
  <MasterLayout>
    <div class="flex h-screen w-full items-center justify-center px-4 py-8">
      <slot />
    </div>
  </MasterLayout>
</template>