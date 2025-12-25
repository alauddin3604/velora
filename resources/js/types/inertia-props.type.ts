import { PageProps as InertiaPageProps } from '@inertiajs/core'
import User from './user.type'
import { DashboardBreadcrumb } from './dashboard-breadcrumb'

export interface PageProps extends InertiaPageProps {
  errors?: Record<string, string>
  flash?: {
    error?: string
    info?: string
    success?: string
    [key: string]: unknown
  }
  auth: {
    id: number
    user: User
  }
  breadcrumbs?: DashboardBreadcrumb[]
}