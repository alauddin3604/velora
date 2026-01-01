<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/vue3'


</script>

<template>
  <div>
    <h1>Welcome to Velora</h1>
    <Button as-child>
      <Link :href="route('home')">Get Started</Link>
    </Button>
  </div>
</template>
