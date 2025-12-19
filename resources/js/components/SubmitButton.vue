<script setup lang="ts">
import Button from './ui/button/Button.vue'
import { Spinner } from './ui/spinner'

withDefaults(defineProps<{
  /**
   * To disable and show loading spinner for form submitting.
   */
  processing: boolean
  /**
   * The label of the button.
   */
  label?: string
  /**
   * The Inertia.js clear errors function.
   */
  clearErrors: () => void
}>(), {
  label: 'Submit'
})

</script>

<template>
  <Button type="submit" :disabled="processing" @click="clearErrors()">
    <Spinner class="animate-spin" v-if="processing" />
    {{ label }}
  </Button>
</template>
