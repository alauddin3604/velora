<script setup lang="ts">
import { Input } from './ui/input'
import { Label } from './ui/label'
import { watch, ref } from 'vue'

const props = defineProps<{
  id: string
  label: string
  modelValue: string
  type?: string
  error?: string
  autocomplete?: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const localValue = ref(props.modelValue)

watch(() => props.modelValue, (newVal) => {
  if (newVal !== localValue.value) {
    localValue.value = newVal
  }
})

watch(localValue, (newVal) => {
  emit('update:modelValue', newVal)
})
</script>

<template>
  <div class="space-y-1">
    <Label :for="id" :class="error ? 'text-destructive' : ''">{{ label }}</Label>
    <Input
      :id="id"
      v-model="localValue"
      :type="type ?? 'text'"
      :class="[
        'transition-colors',
        error ? 'border-destructive ring-0.5 ring-destructive' : ''
      ]"
      :autocomplete="autocomplete"
    />
    <p v-if="error" class="text-sm text-destructive mt-1">{{ error }}</p>
  </div>
</template>
