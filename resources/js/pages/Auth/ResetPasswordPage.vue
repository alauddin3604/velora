<script setup lang="ts">
import SubmitButton from '@/components/SubmitButton.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Field, FieldGroup, FieldLabel } from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { cn } from '@/lib/utils'
import { Form } from '@inertiajs/vue3'
import { computed, HTMLAttributes } from 'vue'

const props = defineProps<{
  token: string
  class?: HTMLAttributes['class']
}>()

const email = computed(() => {
  const queryString = window.location.search;

  const urlParams = new URLSearchParams(queryString);

  return urlParams.get('email');
});
</script>

<template>
  <AuthLayout>
    <div :class="cn('flex flex-col gap-6', props.class)">
    <Card>
      <CardHeader class="text-center">
        <CardTitle class="text-xl">
          Reset Password
        </CardTitle>
        <CardDescription>
          Reset your password
        </CardDescription>
      </CardHeader>
      <CardContent>
        <Form
          action="/reset-password"
          method="POST"
          #default="{ processing, clearErrors }"
          :transform="data => ({ ...data, token: props.token, email })"
        >
          <FieldGroup>
            <Field>
              <FieldLabel for="password">
                Password
              </FieldLabel>
              <Input id="password" type="password" name="password" autocomplete="current-password" required />
            </Field>
            <Field>
              <FieldLabel for="password_confirmation">
                Confirm Password
              </FieldLabel>
              <Input id="password_confirmation" type="password" name="password_confirmation" autocomplete="current-password" required />
            </Field>
            <Field>
              <SubmitButton :processing="processing" :clear-errors="clearErrors" label="Reset Password" /> 
            </Field>
          </FieldGroup>
        </Form>
      </CardContent>
    </Card>
  </div>
  </AuthLayout>
</template>