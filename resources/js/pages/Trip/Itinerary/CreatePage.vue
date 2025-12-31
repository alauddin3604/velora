<script setup lang="ts">
import SubmitButton from '@/components/SubmitButton.vue'
import { Button } from '@/components/ui/button'
import { Field, FieldError, FieldGroup, FieldLabel, FieldSet } from '@/components/ui/field'
import { Input } from '@/components/ui/input'
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import DashboardLayout from '@/layouts/DashboardLayout.vue'
import { FormDataConvertible } from '@inertiajs/core'
import { Form, Link } from '@inertiajs/vue3'

defineOptions({
  layout: DashboardLayout,
})

const tripId = route().params.trip

const formData = (data: Record<string, FormDataConvertible>) => ({
  ...data,
  description: data.description ? data.description.toString().trim() : null,
  location: data.location ? data.location.toString().trim() : null,
  start_time: data.start_time ? data.start_time : null,
  end_time: data.end_time ? data.end_time : null,
  day_number: data.day_number !== '' ? Number.parseInt(String(data.day_number), 10) : null,
  order: data.order !== '' ? Number.parseInt(String(data.order), 10) : null,
})
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold">Create Itinerary</h1>
    <p class="text-muted-foreground text-sm">
      Plan your days and activities for this trip.
    </p>
  </div>
  <div class="w-full max-w-md mx-auto">
    <Form
      :action="route('trips.itineraries.store', { trip: tripId })"
      method="post"
      :transform="data => formData(data)"
      #default="{
        clearErrors,
        errors,
        processing,
      }"
    >
      <FieldSet>
        <FieldGroup>
          <Field :data-invalid="!!errors.title">
            <FieldLabel for="title">Title</FieldLabel>
            <Input
              id="title"
              type="text"
              name="title"
              placeholder="E.g. Check-in at hotel"
              :aria-invalid="!!errors.title"
              @blur="clearErrors('title')"
            />
            <FieldError v-if="errors.title">
              {{ errors.title }}
            </FieldError>
          </Field>

          <Field :data-invalid="!!errors.type">
            <FieldLabel for="type">Type</FieldLabel>
            <Select
              id="type"
              name="type"
              :aria-invalid="!!errors.type"
            >
              <SelectTrigger>
                <SelectValue placeholder="Select type" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectItem value="activity">Activity</SelectItem>
                  <SelectItem value="accommodation">Accommodation</SelectItem>
                  <SelectItem value="transportation">Transportation</SelectItem>
                  <SelectItem value="meal">Meal</SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            <FieldError v-if="errors.type">
              {{ errors.type }}
            </FieldError>
          </Field>

          <Field :data-invalid="!!errors.budget_estimation">
            <FieldLabel for="budget_estimation">
              Budget estimation
            </FieldLabel>
            <Input id="budget_estimation" name="budget_estimation" type="number" min="0"
              placeholder="0" :aria-invalid="!!errors.budget_estimation" />
            <FieldError v-if="errors.budget_estimation">
              {{ errors.budget_estimation }}
            </FieldError>
          </Field>

          <div class="grid grid-cols-2 gap-4">
            <Field :data-invalid="!!errors.day_number">
              <FieldLabel for="day_number">Day</FieldLabel>
              <Input id="day_number" name="day_number" type="number" min="1" placeholder="1" :aria-invalid="!!errors.day_number" />
              <FieldError v-if="errors.day_number">{{ errors.day_number }}</FieldError>
            </Field>

            <Field :data-invalid="!!errors.order">
              <FieldLabel for="order">Order</FieldLabel>
              <Input id="order" name="order" type="number" min="0" placeholder="0" :aria-invalid="!!errors.order" />
              <FieldError v-if="errors.order">{{ errors.order }}</FieldError>
            </Field>
          </div>

          <Field :data-invalid="!!errors.location">
            <FieldLabel for="location">Location</FieldLabel>
            <Input id="location" name="location" type="text" placeholder="E.g. George Town" :aria-invalid="!!errors.location" />
            <FieldError v-if="errors.location">{{ errors.location }}</FieldError>
          </Field>

          <div class="grid grid-cols-2 gap-4">
            <Field :data-invalid="!!errors.start_time">
              <FieldLabel for="start_time">Start time</FieldLabel>
              <Input id="start_time" name="start_time" type="time" :aria-invalid="!!errors.start_time" />
              <FieldError v-if="errors.start_time">{{ errors.start_time }}</FieldError>
            </Field>
            <Field :data-invalid="!!errors.end_time">
              <FieldLabel for="end_time">End time</FieldLabel>
              <Input id="end_time" name="end_time" type="time" :aria-invalid="!!errors.end_time" />
              <FieldError v-if="errors.end_time">{{ errors.end_time }}</FieldError>
            </Field>
          </div>

          <Field :data-invalid="!!errors.description">
            <FieldLabel for="description">Description</FieldLabel>
            <Textarea id="description" name="description" :rows="4"
              placeholder="Optional notes, links, booking info..." :aria-invalid="!!errors.description" />
            <FieldError v-if="errors.description">{{ errors.description }}</FieldError>
          </Field>

          <Field orientation="horizontal" class="flex justify-end">
            <SubmitButton
              :processing="processing"
              :clear-errors="clearErrors"
              label="Create"
            />
            <Button variant="outline" type="button" as-child>
              <Link :href="route('trips.show', tripId)">
                Cancel
              </Link>
            </Button>
          </Field>
        </FieldGroup>
      </FieldSet>
    </Form>
  </div>
</template>