<script setup lang="ts">
import SectionCards from '@/components/Dashboard/SectionCards.vue'
import Dashboard from '@/layouts/DashboardLayout.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps<{
  trips_count: number
}>()

const breadcrumbs = ref<DashboardBreadcrumb[]>([
  {
    label: 'Dashboard',
    url: route('dashboard'),
  },
])
</script>

<template>
  <Dashboard :breadcrumbs="breadcrumbs">
    <Head title="Home Page" />
    <SectionCards :trips-count="trips_count"/>
  </Dashboard>
</template>