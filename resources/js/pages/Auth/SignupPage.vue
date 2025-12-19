<script setup lang="ts">
import SubmitButton from '@/components/SubmitButton.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Field, FieldDescription, FieldError, FieldGroup, FieldLabel } from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { cn } from '@/lib/utils'
import { Form, Head, Link } from '@inertiajs/vue3'
import { Luggage } from 'lucide-vue-next'
import { HTMLAttributes } from 'vue'

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <Head>
    <title>Sign Up</title>
  </Head>
  <AuthLayout>
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
          Signup Now
        </CardTitle>
        <CardDescription>
          Signup to Velora to manage your trips itinerary!
        </CardDescription>
      </CardHeader>
      <CardContent>
        <Form action="signup" method="POST" #default="{ processing, errors, clearErrors }">
          <FieldGroup>
            <Field :data-invalid="errors.name ? true : undefined">
              <FieldLabel for="name">Name</FieldLabel>
              <Input type="text" id="name" name="name" autocomplete="name" :aria-invalid="errors.name ? true : undefined" @update:model-value="clearErrors('name')" />
              <FieldError v-if="errors.name">
                {{ errors.name }}
              </FieldError>
            </Field>
            <Field :data-invalid="errors.email ? true : undefined">
              <FieldLabel for="email">Email</FieldLabel>
              <Input type="email" id="email" name="email" autocomplete="username" :aria-invalid="errors.email ? true : undefined" @update:model-value="clearErrors('email')" />
              <FieldError v-if="errors.email">
                {{ errors.email }}
              </FieldError>
            </Field>
            <Field :data-invalid="errors.password ? true : undefined">
              <FieldLabel for="password">Password</FieldLabel>
              <Input type="password" id="password" name="password" autocomplete="new-password" :aria-invalid="errors.password ? true : undefined" @update:model-value="clearErrors('password')" />
              <FieldError v-if="errors.password">
                {{ errors.password }}
              </FieldError>
            </Field>
            <Field :data-invalid="errors.password_confirmation ? true : undefined">
              <FieldLabel for="password_confirmation">Confirm Password</FieldLabel>
              <Input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" :aria-invalid="errors.password_confirmation ? true : undefined" @update:model-value="clearErrors('password_confirmation')" />
              <FieldError v-if="errors.password_confirmation">
                {{ errors.password_confirmation }}
              </FieldError>
            </Field>
            <Field>
              <SubmitButton :processing="processing" :clear-errors="clearErrors" label="Sign Up" />
              <FieldDescription class="text-center">
                Already have an account?
                <Link href="login">
                  Login
                </Link>
              </FieldDescription>
            </Field>
          </FieldGroup>
        </Form>
      </CardContent>
      </Card>
    </div>
  </AuthLayout>
</template>
