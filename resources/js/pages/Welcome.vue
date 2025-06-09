<script setup lang="ts">
import Dashboard from '@/layouts/Dashboard.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const greeting = ref('Welcome to Your Vue.js + TypeScript App');

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
    <h1>{{ greeting }}</h1>
  </Dashboard>
</template>