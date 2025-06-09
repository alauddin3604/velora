<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { FormControl, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import Auth from '@/layouts/Auth.vue'
import { Head, router } from '@inertiajs/vue3'
import { toTypedSchema } from '@vee-validate/zod'
import { useForm } from 'vee-validate'
import { ref } from 'vue'
import { z } from 'zod'

defineOptions({
  layout: Auth
})

const isProcessing = ref(false)

const form = useForm({
  validationSchema: toTypedSchema(z.object({
    email: z.string().email(),
    password: z.string().min(8, 'Password must be at least 8 characters.'),
  })),
})

const formSubmit = form.handleSubmit((values) => {
  isProcessing.value = true

  router.post(route('auth.login'), values, {
    onError: (error) => form.setErrors(error),
    onSuccess: () => form.resetField('password'),
    onFinish: () => {
      form.resetField('password')
      isProcessing.value = false
    },
  })
})
</script>

<template>
  <Head>
    <title>Login</title>
  </Head>
  <Card class="w-full mx-auto max-w-sm">
    <CardHeader>
      <CardTitle class="text-2xl">
        Login
      </CardTitle>
      <CardDescription>
        Enter your email below to login to your account
      </CardDescription>
      {{ form.values }}
    </CardHeader>
    <CardContent>
      <div class="grid gap-4">
        <div class="grid gap-2">
          <form class="space-y-6" @submit.prevent="formSubmit">
            <FormField v-slot="{ componentField }" name="email" :validate-on-model-update="false">
              <FormItem>
                <FormLabel>Email</FormLabel>
                <FormControl>
                  <Input v-bind="componentField" autocomplete="username" />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>
            <FormField v-slot="{ componentField }" name="password" :validate-on-model-update="form.isFieldDirty">
              <FormItem>
                <FormLabel>Password</FormLabel>
                <FormControl>
                  <Input type="password" v-bind="componentField" autocomplete="current-password" />
                </FormControl>
                <FormMessage />
              </FormItem>
            </FormField>
            <Button type="submit" class="w-full" :disabled="isProcessing">
              Login
            </Button>
          </form>
        </div>
      </div>
    </CardContent>
  </Card>
</template>