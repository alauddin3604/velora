<script setup lang="ts">
import SubmitButton from '@/components/SubmitButton.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Field, FieldDescription, FieldGroup, FieldLabel } from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { cn } from "@/lib/utils"
import { Form, Head, Link } from '@inertiajs/vue3'
import { Luggage } from 'lucide-vue-next'
import type { HTMLAttributes } from "vue"

defineOptions({
  layout: AuthLayout
})

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <Head>
    <title>Login</title>
  </Head>
  <a href="#" class="flex items-center gap-2 self-center font-medium">
    <div class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-md">
      <Luggage class="size-4" />
    </div>
    Velora
  </a>
  <div :class="cn('flex flex-col gap-6', props.class)">
    <Card>
      <CardHeader class="text-center">
        <CardTitle class="text-xl">
          Welcome back
        </CardTitle>
        <CardDescription>
          Login to Velora to manage your trips itinerary!
        </CardDescription>
      </CardHeader>
      <CardContent>
        <Form action="login" method="POST" #default="{ processing, clearErrors }">
          <FieldGroup>
            <Field>
              <FieldLabel for="email">Email</FieldLabel>
              <Input type="email" id="email" name="email" autocomplete="username" />
            </Field>
            <Field>
              <div class="flex items-center">
                <FieldLabel for="password">
                  Password
                </FieldLabel>
                <Link href="forgot-password" class="ml-auto text-sm underline-offset-4 hover:underline">
                  Forgot your password?
                </Link>
              </div>
              <Input id="password" type="password" name="password" autocomplete="current-password" required />
            </Field>
            <Field>
              <SubmitButton :processing="processing" :clear-errors="clearErrors" label="Login" /> 
              <FieldDescription class="text-center">
                Don't have an account?
                <Link href="signup">
                  Sign up
                </Link>
              </FieldDescription>
            </Field>
          </FieldGroup>
        </Form>
      </CardContent>
    </Card>
  </div>
</template>