<script setup lang="ts">
import { Toaster } from '@/components/ui/sonner'
import { usePage } from '@inertiajs/vue3'
import { onMounted, watch } from 'vue'
import { toast } from 'vue-sonner'
import 'vue-sonner/style.css'

const page = usePage()

onMounted(() => {
  if (page.props.flash?.error) {
    toast.error(page.props.flash.error)
  }

  if (page.props.flash?.info) {
    toast.info(page.props.flash.info)
  }

  if (page.props.flash?.success) {
    toast.success(page.props.flash.success)
  }

  if (page.props.flash?.warning) {
    toast.warning(page.props.flash.warning)
  }
})

watch(
  () => page.props.flash,
  (flash) => {
    if (flash?.error) {
      toast.error(flash.error)
    }

    if (flash?.info) {
      toast.info(flash.info)
    }

    if (flash?.success) {
      toast.success(flash.success)
    }

    if (flash?.warning) {
      toast.warning(flash.warning)
    } 
  },
  { immediate: false }
)
</script>

<template>
  <slot></slot>
  <Toaster close-button expand rich-colors />
</template>