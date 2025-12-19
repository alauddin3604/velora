<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import Trip from '@/types/trip.type'
import { Head } from '@inertiajs/vue3'

defineProps<{ trip: Trip }>()
</script>

<template>
  <DashboardLayout>
    <Head :title="'Trip - ' + trip.title" />
    <div>
      <h1>{{ trip.title }}</h1>
    </div>
  </DashboardLayout>
</template>