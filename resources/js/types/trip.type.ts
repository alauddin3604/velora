import type { Itinerary } from './itinerary.type'

export interface Trip {
  id: number
  user_id: number
  title: string
  description: string | null
  start_date: string
  end_date: string
  status: string
  can_edit_itinerary?: boolean
  itineraries?: Itinerary[]
}
