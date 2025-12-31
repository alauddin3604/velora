<script setup lang="ts">
import InviteUserDialog from '@/components/Trip/InviteUserDialog.vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Empty, EmptyContent, EmptyDescription, EmptyHeader, EmptyMedia, EmptyTitle } from '@/components/ui/empty'
import { Item, ItemContent, ItemDescription, ItemGroup, ItemMedia, ItemSeparator, ItemTitle } from '@/components/ui/item'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { PageProps } from '@/types/inertia-props.type'
import { Trip } from '@/types/trip.type'
import User from '@/types/user.type'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { Bed, CalendarDays, MapPin, NotebookPen, Plus, Utensils } from 'lucide-vue-next'
import { computed } from 'vue'

const authId = usePage<PageProps>().props.auth.id

const props = defineProps<{
  trip: Trip
  users: User[]
}>()


const sortedItineraries = computed(() => {
  const items = [...(props.trip.itineraries ?? [])]

  return items.sort((a, b) => {
    const dayA = a.day_number ?? 9999
    const dayB = b.day_number ?? 9999
    if (dayA !== dayB) return dayA - dayB

    const orderA = a.order ?? 9999
    const orderB = b.order ?? 9999
    if (orderA !== orderB) return orderA - orderB

    const startA = a.start_time ?? ''
    const startB = b.start_time ?? ''
    if (startA !== startB) return startA.localeCompare(startB)

    return a.title.localeCompare(b.title)
  })
})

defineOptions({
  layout: DashboardLayout
})
</script>

<template>
  <div class="flex flex-col gap-6">
    <Head :title="'Trip - ' + trip.title" />

    <div class="flex items-start justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold">{{ trip.title }}</h1>
        <p class="text-muted-foreground text-sm">
          Plan your days and activities for this trip.
        </p>
      </div>
      <div class="flex items-center gap-2">
        <InviteUserDialog
          v-if="authId === trip.user_id"
          :users="users"
          :trip="trip"
        />

        <Button type="button" as-child>
          <Link :href="route('trips.itineraries.create', trip.id)">
            <Plus class="size-4" />
            Add itinerary
          </Link>
        </Button>
      </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
      <Card class="md:col-span-1">
        <CardHeader>
          <CardTitle>Trip details</CardTitle>
          <CardDescription>Dates and description</CardDescription>
        </CardHeader>
        <CardContent class="space-y-3 text-sm">
          <div class="flex items-center gap-2 text-muted-foreground">
            <CalendarDays class="size-4" />
            <span>{{ trip.start_date || 'Not specified' }} - {{ trip.end_date || 'Not specified' }}</span>
          </div>
          <p class="text-foreground">
            {{ trip.description || 'Not specified' }}
          </p>
        </CardContent>
      </Card>

      <Card class="md:col-span-2">
        <CardHeader>
          <CardTitle>Itinerary</CardTitle>
          <CardDescription>
            {{ sortedItineraries.length }} item(s)
          </CardDescription>
        </CardHeader>
        <CardContent>
          <template v-if="sortedItineraries.length === 0">
            <Empty class="from-muted/50 to-background h-full bg-linear-to-b from-30%">
              <EmptyHeader>
                <EmptyMedia variant="icon">
                  <NotebookPen />
                </EmptyMedia>
                <EmptyTitle>No itinerary yet</EmptyTitle>
                <EmptyDescription>
                  Add your first itinerary item to start planning.
                </EmptyDescription>
              </EmptyHeader>
              <EmptyContent>
                <Button variant="outline" size="sm" type="button" as-child>
                  <Link :href="route('trips.itineraries.create', trip.id)">
                    <Plus class="size-4" />
                    Add itinerary
                  </Link>
                </Button>
              </EmptyContent>
            </Empty>
          </template>

          <template v-else>
            <ItemGroup>
              <template v-for="(itinerary, index) in sortedItineraries" :key="itinerary.id">
                <Item>
                  <ItemMedia variant="icon">
                    <Utensils v-if="itinerary.type === 'meal'" />
                    <Bed v-else-if="itinerary.type === 'accommodation'" />
                    <MapPin v-else-if="itinerary.location" />
                    <NotebookPen v-else />
                  </ItemMedia>
                  <ItemContent>
                    <ItemTitle>
                      <span class="mr-2" v-if="itinerary.day_number">Day {{ itinerary.day_number }}</span>
                      {{ itinerary.title }}
                    </ItemTitle>
                    <ItemDescription>
                      <span class="text-muted-foreground" v-if="itinerary.start_time || itinerary.end_time">
                        {{ itinerary.start_time || '' }}<span v-if="itinerary.end_time"> - {{ itinerary.end_time }}</span>
                      </span>
                      <span v-if="itinerary.location" class="text-muted-foreground">
                        <span v-if="itinerary.start_time || itinerary.end_time"> · </span>
                        {{ itinerary.location }}
                      </span>
                      <span v-if="itinerary.description" class="block mt-1">
                        {{ itinerary.description }}
                      </span>
                    </ItemDescription>
                  </ItemContent>
                </Item>
                <ItemSeparator v-if="index !== sortedItineraries.length - 1" />
              </template>
            </ItemGroup>
          </template>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
