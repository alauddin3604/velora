<script setup lang="ts">
import {
  Empty,
  EmptyDescription,
  EmptyHeader,
  EmptyMedia,
  EmptyTitle
} from '@/components/ui/empty'
import { Spinner } from '@/components/ui/spinner'
</script>

<template>
  <Empty class="w-full">
    <EmptyHeader>
      <EmptyMedia variant="icon">
        <Spinner />
      </EmptyMedia>
      <EmptyTitle>Loading...</EmptyTitle>
      <EmptyDescription>
        Please wait while we process your request. Do not refresh the page.
      </EmptyDescription>
    </EmptyHeader>
  </Empty>
</template>
