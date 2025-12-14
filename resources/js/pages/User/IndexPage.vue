<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import User from '@/types/user.type'
import Dashboard from '@/layouts/DashboardLayout.vue'

defineProps<{
  users: User[]
}>()
</script>

<template>
  <Dashboard>
    <h1 class="text-2xl font-bold mb-5">Users</h1>
    <div v-for="user in users" :key="user.id">
      <Link :href="route('users.show', user.id)">
        {{ user.name }}
      </Link>
    </div>
  </Dashboard>
</template>
