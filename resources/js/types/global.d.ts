import { PageProps as InertiaPageProps } from '@inertiajs/core'
import { AxiosInstance } from 'axios'
import ziggyRoute, { Config as ZiggyConfig } from 'ziggy-js'
import { PageProps as AppPageProps } from './'

declare global {
  interface Window {
    axios: AxiosInstance
  }

  var route: typeof ziggyRoute
  var Ziggy: ZiggyConfig
}

declare module 'vue' {
  interface ComponentCustomProperties {
    route: typeof ziggyRoute
  }
}

declare module '@inertiajs/core' {
  interface PageProps extends InertiaPageProps, AppPageProps {
    errors?: {
      [key: string]: string
    }
    flash?: {
      error?: string
      info?: string
      success?: string
      [key: string]: any
    }
    auth: {
      id: number
      user: {
        id: number
        name: string
        email: string
      }
    }
  }
}