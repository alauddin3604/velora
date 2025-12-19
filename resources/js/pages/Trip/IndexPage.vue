<script setup lang="ts">
import NavPagination from '@/components/NavPagination.vue'
import Button from '@/components/ui/button/Button.vue'
import { Input } from '@/components/ui/input'
import { Item, ItemContent, ItemDescription, ItemGroup, ItemHeader, ItemTitle } from '@/components/ui/item'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Paginated } from '@/types/paginated.type'
import { Trip } from '@/types/trip.type'
import { Form, Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps<{
  trips: Paginated<Trip>
  search?: string
}>()

const breadcrumbs = ref<DashboardBreadcrumb[]>([
  {
    label: 'Trip',
    url: 'trips',
  },
])

const search = ref(props.search)

</script>

<template>
  <DashboardLayout :breadcrumbs="breadcrumbs">
    <Head title="Trip List" />
    <div class="flex justify-between">
      <div class="flex w-full max-w-sm items-center space-x-2">
        <Form class="flex gap-3">
          <Input type="search" name="search" v-model="search" placeholder="Search" />
          <Button type="submit">
            Search
          </Button>
        </Form>
      </div>
      <Button as-child>
        <Link :href="route('trips.create')">Create a Trip</Link>
      </Button>
    </div>
    <div class="flex w-full max-w-xl flex-col gap-6">
    <ItemGroup class="grid grid-cols-3 gap-4">
      <Item
        v-for="trip in trips.data"
        :key="trip.id"
        variant="outline"
        as-child
        role="listitem"
        @click="router.visit(route('trips.show', trip.id))"
      >
        <a href="#">
          <ItemHeader>
            <img src="https://imageio.forbes.com/specials-images/imageserve//62bdd4a21a6dc599d18bca9b/0x0.jpg?format=jpg&height=900&width=1600&fit=bounds" width="128"
              height="128"
              class="aspect-square w-full rounded-sm object-cover grayscale"
            />
          </ItemHeader>
          <ItemContent>
            <ItemTitle>{{ trip.title }}</ItemTitle>
            <ItemDescription>{{ trip.description }}</ItemDescription>
          </ItemContent>
        </a>
      </Item>
    </ItemGroup>
  </div>
    <NavPagination :paginated="trips" />
  </DashboardLayout>
</template>
