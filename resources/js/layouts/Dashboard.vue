<script setup lang="ts">
import AppSidebar from '@/components/AppSidebar.vue'
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from '@/components/ui/breadcrumb'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Separator } from '@/components/ui/separator'
import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from '@/components/ui/sidebar'
import { DashboardBreadcrumb } from '@/types/dashboard-breadcrumb'
import { Icon } from '@iconify/vue'
import { useColorMode } from '@vueuse/core'
import Master from './Master.vue'

withDefaults(defineProps<{
  breadcrumbs?: DashboardBreadcrumb[]
}>(), {
  breadcrumbs: () => []
})

const mode = useColorMode()
</script>

<template>
  <Master>
    <SidebarProvider>
      <AppSidebar />
      <SidebarInset>
        <header
          class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12">
          <div class="flex items-center gap-2 px-4">
            <SidebarTrigger class="-ml-1" />
            <Separator orientation="vertical" class="mr-2 h-4" />
            <Breadcrumb v-if="breadcrumbs && breadcrumbs.length">
              <BreadcrumbList>
                <template v-for="(breadcrumb, index) in breadcrumbs" :key="breadcrumb.label">
                  <BreadcrumbItem :class="index !== breadcrumbs.length - 1 ? 'hidden md:block' : ''">
                    <template v-if="index === breadcrumbs.length - 1">
                      <BreadcrumbPage>{{ breadcrumb.label }}</BreadcrumbPage>
                    </template>
                    <template v-else>
                      <BreadcrumbLink href="#">{{ breadcrumb.label }}</BreadcrumbLink>
                    </template>
                  </BreadcrumbItem>
                  <BreadcrumbSeparator v-if="index < breadcrumbs.length - 1" class="hidden md:block" />
                </template>
              </BreadcrumbList>
            </Breadcrumb>
          </div>
          <div class="flex items-center ml-auto mx-5">
            <DropdownMenu>
              <DropdownMenuTrigger as-child>
                <Button variant="outline">
                  <Icon icon="radix-icons:moon"
                    class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
                  <Icon icon="radix-icons:sun"
                    class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
                  <span class="sr-only">Toggle theme</span>
                </Button>
              </DropdownMenuTrigger>
              <DropdownMenuContent align="end">
                <DropdownMenuItem @click="mode = 'light'">
                  Light
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'dark'">
                  Dark
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'auto'">
                  System
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </div>
        </header>
        <main class="px-4">
          <slot></slot>
        </main>
      </SidebarInset>
    </SidebarProvider>
  </Master>
</template>
