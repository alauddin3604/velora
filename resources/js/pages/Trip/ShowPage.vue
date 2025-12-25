<script setup lang="ts">
import InviteUserDialog from '@/components/Trip/InviteUserDialog.vue'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { PageProps } from '@/types/inertia-props.type'
import { Trip } from '@/types/trip.type'
import User from '@/types/user.type'
import { Head, usePage } from '@inertiajs/vue3'

const authId = usePage<PageProps>().props.auth.id

defineProps<{
  trip: Trip
  users: User[]
}>()

defineOptions({
  layout: DashboardLayout
})
</script>

<template>
  <div>
    <Head :title="'Trip - ' + trip.title" />
    <div class="flex justify-between">
      <h1 class="text-2xl font-bold mb-5">{{ trip.title }}</h1>
      <div>
        <InviteUserDialog
          v-if="authId === trip.user_id"
          :users="users"
          :trip="trip"
        />
      </div>
    </div>
    
    <div class="mt-10">
      <p>Descriptions: {{ trip.description || 'Not specified' }}</p>
      <p>Start Date: {{ trip.start_date || 'Not specified' }}</p>
      <p>End Date: {{ trip.end_date || 'Not specified' }}</p>
    </div>
  </div>
</template>
