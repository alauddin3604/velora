<script setup lang="ts">
import SubmitButton from '@/components/SubmitButton.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Field, FieldDescription, FieldGroup, FieldLabel } from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import AuthLayout from '@/layouts/AuthLayout.vue'
import { cn } from '@/lib/utils'
import { Form, Head, Link } from '@inertiajs/vue3'
import { HTMLAttributes } from 'vue'

const props = defineProps<{
  class?: HTMLAttributes["class"]
}>()
</script>

<template>
  <AuthLayout>
    <Head>
      <title>Reset Password</title>
    </Head>
    <div :class="cn('flex flex-col gap-6', props.class)">
      <Card>
        <CardHeader class="text-center">
          <CardTitle class="text-xl">
            Reset Password
          </CardTitle>
          <CardDescription>
            Enter your email address and we'll send you a link to reset your password.
          </CardDescription>
        </CardHeader>
        <CardContent>
          <Form action="forgot-password" method="POST" #default="{ processing, clearErrors }">
            <FieldGroup>
              <Field>
                <FieldLabel for="email">Email</FieldLabel>
                <Input type="email" id="email" name="email" autocomplete="username" />
              </Field>
              <Field>
                <SubmitButton :processing="processing" :clear-errors="clearErrors" label="Reset Password" />
                <FieldDescription class="text-center">
                  Go back to
                  <Link href="login">
                    login
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