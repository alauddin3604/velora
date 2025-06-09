<script setup lang="ts">
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
} from '@/components/ui/card'
import {
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import Dashboard from '@/layouts/Dashboard.vue'
import { router, usePage } from '@inertiajs/vue3'
import { toTypedSchema } from '@vee-validate/zod'
import { useForm } from 'vee-validate'
import { ref } from 'vue'
import z from 'zod'

const user = usePage().props.auth.user

const breadcrumbs = ref([
  {
    label: 'Profile',
    url: route('profile.edit'),
  },
])

const isProcessing = ref(false)

const validationSchema = toTypedSchema(z.object({
  name: z.string(),
  email: z.string().email(),
}))

const form = useForm({
  validationSchema: validationSchema,
  initialValues: {
    name: user.name,
    email: user.email,
  },
})

const formSubmit = form.handleSubmit((values) => {
  isProcessing.value = true

  router.put(route('profile.update'), values, {
    onError: (errors) => form.setErrors(errors),
    onFinish: () => {
      isProcessing.value = false
    },
    onSuccess: () => isProcessing.value = false
  })
})
</script>

<template>
  <Dashboard :breadcrumbs="breadcrumbs">
    <h1 class="text-2xl font-bold mb-5">Profile</h1>
    <Card class="w-1/2">
      <CardContent>
        <form class=" space-y-6 " @submit.prevent="formSubmit">
          <FormField v-slot="{ componentField }" name="name">
            <FormItem>
              <FormLabel>
                Name
              </FormLabel>
              <FormControl>
                <Input v-bind="componentField" />
                <FormMessage />
              </FormControl>
            </FormItem>
          </FormField>
          <FormField v-slot="{ componentField }" name="email">
            <FormItem>
              <FormLabel>
                Email
              </FormLabel>
              <FormControl>
                <Input v-bind="componentField" />
                <FormMessage />
              </FormControl>
            </FormItem>
          </FormField>
          <Button type="submit" :disabled="isProcessing">
            {{ isProcessing ? 'Updating...' : 'Update' }}
          </Button>
        </form>
      </CardContent>
    </Card>
  </Dashboard>
</template>