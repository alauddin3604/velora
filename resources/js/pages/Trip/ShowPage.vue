<script setup lang="ts">
import InviteUserDialog from '@/components/Trip/InviteUserDialog.vue'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Trip } from '@/types/trip.type'
import User from '@/types/user.type'
import { Head, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const page = usePage()

const props = defineProps<{
  trip: Trip
  users: User[]
}>()

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
    <div class="flex justify-between">
      <h1 class="text-2xl font-bold mb-5">{{ trip.title }}</h1>
      <div>
        <InviteUserDialog
        v-if="page.props.auth.id === trip.user_id"
        :users="users"
        :trip="trip"
      />
      </div>
    </div>
  </DashboardLayout>
</template>
