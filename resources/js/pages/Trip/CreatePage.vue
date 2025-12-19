<script setup lang="ts">
import DatePicker from '@/components/DatePicker.vue'
import SubmitButton from '@/components/SubmitButton.vue'
import { Button } from '@/components/ui/button'
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import {
  Field,
  FieldError,
  FieldGroup,
  FieldLabel,
  FieldSet,
} from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Form, Head, Link } from '@inertiajs/vue3'
import { ref, useTemplateRef } from 'vue'

const breadcrumbs = ref<DashboardBreadcrumb[]>([
  {
    label: 'Trip',
    url: route('trips.index'),
  },
  {
    label: 'Create a Trip',
    url: 'trips/create',
  },
])

const startDate = useTemplateRef('start-date')
const endDate = useTemplateRef('end-date')
</script>

<template>
  <DashboardLayout :breadcrumbs="breadcrumbs">

    <Head title="Create Trip" />
    <Card class="w-full max-w-lg mx-auto">
      <CardHeader>
        <CardTitle>Create your new trip!</CardTitle>
      </CardHeader>
      <CardContent>
        <div class="w-full max-w-md">
          <Form action="/trips" method="post" #default="{
            errors,
            clearErrors,
            processing,
          }">
            <FieldSet>
              <FieldGroup>
                <Field :data-invalid="errors.title ? true : false">
                  <FieldLabel for="title">Title</FieldLabel>
                  <Input id="title" type="text" name="title" placeholder="Penang Here We Come!"
                    :aria-invalid="errors.title ? true : false" @update:model-value="clearErrors('title')" />
                  <FieldError v-if="errors.title">{{ errors.title }}</FieldError>
                </Field>
                <Field :data-invalid="errors.description ? true : false">
                  <FieldLabel for="description">
                    Description
                  </FieldLabel>
                  <Textarea id="description" name="description" placeholder="The trip's description" :rows="4" />
                </Field>
                <div class="grid grid-cols-2 gap-4">
                  <Field :data-invalid="errors.start_date ? true : false">
                    <FieldLabel for="start_date">Start Date</FieldLabel>
                    <Input type="hidden" name="start_date" :value="startDate?.date" />
                    <DatePicker ref="start-date" />
                    <FieldError v-if="errors.start_date">{{ errors.start_date }}</FieldError>
                  </Field>
                  <Field :data-invalid="errors.end_date ? true : false">
                    <FieldLabel for="end_date">End Date</FieldLabel>
                    <Input type="hidden" name="end_date" :value="endDate?.date" />
                    <DatePicker ref="end-date" />
                    <FieldError v-if="errors.end_date">{{ errors.end_date }}</FieldError>
                  </Field>
                </div>
                <Field orientation="horizontal" class="flex justify-end">
                  <SubmitButton :processing="processing" label="Create" :clearErrors="clearErrors" />
                  <Button variant="secondary" as-child>
                    <Link :href="route('trips.index')">Cancel</Link>
                  </Button>
                </Field>
              </FieldGroup>
            </FieldSet>
          </Form>
        </div>
      </CardContent>
    </Card>
  </DashboardLayout>
</template>
