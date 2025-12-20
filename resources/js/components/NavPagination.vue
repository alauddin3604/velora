<script setup lang="ts">
import { Paginated } from '@/types/paginated.type'
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationFirst,
  PaginationItem,
  PaginationLast,
  PaginationNext,
  PaginationPrevious,
} from './ui/pagination'
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from './ui/select'

const props = defineProps<{
  type: 'row' | 'item'
  paginated: Paginated<unknown>
}>()

const perPage = ref(props.paginated.meta.per_page?.toString())

const changePerPage = (value: unknown) => {
  if (typeof value === 'string') {
    router.visit(route('trips.index', {
      perPage: value,
    }))
  }
}

const changePage = (page: number) => {
  const currentRoute = route().current()

  if (currentRoute) {
    router.visit(route(currentRoute, {
      page,
      perPage: props.paginated.meta.per_page,
    }))
  }
}
</script>

<template>
  <div class="w-full flex items-center justify-between">
    <div class="w-1/3 flex items-center justify-start gap-2">
      <div>
        <p class="text-sm text-muted-foreground"><span class="capitalize">{{ type }}</span>s per page</p>
      </div>
      <Select v-model:model-value="perPage" @update:model-value="changePerPage">
        <SelectTrigger class="w-[90px]">
          <SelectValue placeholder="Select a row per page" />
        </SelectTrigger>
        <SelectContent>
          <SelectGroup>
            <SelectItem value="1">1</SelectItem>
            <SelectItem value="10">10</SelectItem>
            <SelectItem value="25">25</SelectItem>
            <SelectItem value="50">50</SelectItem>
            <SelectItem value="100">100</SelectItem>
          </SelectGroup>
        </SelectContent>
      </Select>
    </div>
    <div class="w-1/3 mx-auto">
      <p class="text-center text-sm text-muted-foreground">
        Showing {{ paginated.meta.from }} to {{ paginated.meta.to }} of {{ paginated.meta.total }}
      </p>
    </div>
    <div class="flex flex-col gap-6 ml-auto">
      <Pagination v-model:page="paginated.meta.current_page" :items-per-page="paginated.meta.per_page"
        :total="paginated.meta.total" :default-page="1" @update:page="changePage">
        <PaginationContent v-slot="{ items }">
          <PaginationFirst />
          <PaginationPrevious />
          <template v-for="(item, index) in items" :key="index">
            <PaginationItem v-if="item.type === 'page'" :value="item.value" 
              :is-active="item.value === paginated.meta.current_page">
              {{ item.value }}
            </PaginationItem>
            <PaginationEllipsis v-else :key="index" :index="index" />
          </template>
          <PaginationNext />
          <PaginationLast />
        </PaginationContent>
      </Pagination>
    </div>
  </div>
</template>