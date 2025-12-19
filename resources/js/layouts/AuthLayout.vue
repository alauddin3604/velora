<script setup lang="ts">
import MasterLayout from './MasterLayout.vue'
</script>

<template>
  <MasterLayout>
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
      <div class="flex w-full max-w-sm flex-col gap-6">
        <slot></slot>
      </div>
    </div>
  </MasterLayout>
</template>