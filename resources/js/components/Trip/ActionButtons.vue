<script setup lang="ts">
import { Trip } from '@/types/trip.type'
import { Button } from '../ui/button'
import { Eye, Pencil } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

defineProps<{
  trip: Trip
}>()
</script>

<template>
  <div class="flex gap-2">
    <Button variant="default" as-child>
      <Link :href="route('trips.show', trip.id)">
        <Eye />
      </Link>
    </Button>
    <Button variant="secondary" as-child>
      <Link>
        <Pencil />
      </Link>
    </Button>
  </div>
</template>
