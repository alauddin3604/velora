<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Trip } from '@/types/trip.type'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps<{ trip: Trip }>()

const breadcrumbs = ref<DashboardBreadcrumb[]>([
  {
    label: 'Trips',
    url: route('trips.index'),
  },
  {
    label: props.trip.title,
    url: route('trips.show', props.trip.id),
  },
])
</script>

<template>
  <DashboardLayout :breadcrumbs="breadcrumbs">
    <Head :title="'Trip - ' + trip.title" />
    <div>
      <h1>{{ trip.title }}</h1>
    </div>
  </DashboardLayout>
</template>