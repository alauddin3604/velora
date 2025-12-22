import { Trip } from '@/types/trip.type'
import type { ColumnDef } from '@tanstack/vue-table'
import { h } from 'vue'
import ShowButton from './ActionButtons.vue'

export const columns: ColumnDef<Trip>[] = [
  {
    accessorKey: 'id',
    header: () => h('div', { class: 'text-center' }, '#'),
    cell: ({ row }) => {
      return h('div', { class: 'text-center' }, row.index + 1);
    },
    size: 50, 
    enableSorting: false,
  },
  {
    accessorKey: 'title',
    header: 'Title',
  },
  {
    accessorKey: 'start_date',
    header: 'Start Date'
  },
  {
    accessorKey: 'end_date',
    header: 'End Date'
  },
  {
    accessorKey: 'status',
    header: 'Status',
  },
  {
    accessorKey: 'actions',
    header: () => h('div', { class: 'text-center' }, 'Actions'),
    cell: ({ row }) => {
      const trip = row.original

      return h('div', { class: 'flex justify-center' }, h(ShowButton, { trip}))
    }
  }
]
