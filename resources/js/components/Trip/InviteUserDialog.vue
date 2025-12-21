<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Trip } from '@/types/trip.type'
import User from '@/types/user.type'
import { router, useForm } from '@inertiajs/vue3'
import debounce from 'lodash.debounce'
import { CheckIcon, Plus, X } from 'lucide-vue-next'
import { ref, watch } from 'vue'
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '../ui/select'
import { Input } from '../ui/input'
import { Item, ItemActions, ItemContent, ItemDescription, ItemGroup, ItemMedia, ItemSeparator, ItemTitle } from '../ui/item'
import { Avatar, AvatarFallback, AvatarImage } from '../ui/avatar'
import { useGetInitialName } from '@/composables/useGetInitialName'
import { Badge } from '../ui/badge'

const props = defineProps<{ users: User[], trip: Trip }>()

const { getInitialName } = useGetInitialName()

const search = ref('')
const selectedUsers = ref<User[]>([])

const searchUser = () => {
  router.visit(route('trips.show', { trip: props.trip.id, search_user: search.value }), {
    only: ['users'],
    preserveState: true,
    showProgress: false,
  })
}

const form = useForm({
  user_ids: [],
  role: 'viewer',
})

const toggleUser = (selectedUser: User) => {
  if (selectedUsers.value.includes(selectedUser)) {
    selectedUsers.value = selectedUsers.value.filter((user) => user.id !== selectedUser.id)
  } else {
    selectedUsers.value.push(selectedUser)
  }
}

const inviteUser = () => {
  form.transform((data) => ({
    ...data,
    user_ids: selectedUsers.value.map((user) => user.id),
  }))
    .post(route('trips.users.store', props.trip.id))
}

const debouncedSearchUser = debounce(searchUser, 500)

watch(search, debouncedSearchUser)
</script>

<template>
  <Dialog>
    <DialogTrigger>
      <Button variant="outline">Invite User</Button>
    </DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Invite User</DialogTitle>
        <DialogDescription>
          Invite user to join this trip
        </DialogDescription>
      </DialogHeader>
      <Input type="search" v-model="search" placeholder="Search user..." />
      <div class="flex gap-2">
        <Badge v-for="user in selectedUsers" :key="user.id" variant="secondary">
          {{ user.name }}
          <Button variant="ghost" size="icon-sm" @click="toggleUser(user)">
            <X />
          </Button>
        </Badge>
      </div>
      <div class="flex w-full flex-col gap-6">
        <ItemGroup>
          <template v-for="(user, index) in users" :key="user.id">
            <Item>
              <ItemMedia>
                <Avatar>
                  <AvatarImage :src="''" :alt="user.name" />
                  <AvatarFallback>
                    {{ getInitialName(user.name) }}
                  </AvatarFallback>
                </Avatar>
              </ItemMedia>
              <ItemContent>
                <ItemTitle>
                  {{ user.name }}
                </ItemTitle>
                <ItemDescription>
                  {{ user.email }}
                </ItemDescription>
              </ItemContent>
              <ItemActions>
                <Button variant="ghost" size="icon" class="rounded-full" @click="toggleUser(user)">
                  <CheckIcon v-if="selectedUsers.includes(user)" />
                  <Plus v-else />
                </Button>
              </ItemActions>
            </Item>
            <ItemSeparator v-if="index !== users.length - 1" />
          </template>
        </ItemGroup>
      </div>
      <DialogFooter class="sm:justify-between">
        <Select id="role" v-model="form.role" :aria-invalid="form.errors.role">
          <SelectTrigger class="w-[180px]">
            <SelectValue placeholder="Select role" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem value="viewer">
                Viewer
              </SelectItem>
              <SelectItem value="editor">
                Editor
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
        <Button type="button" @click="inviteUser">Invite</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>