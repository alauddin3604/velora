export interface Itinerary {
  id: number
  trip_id: number
  title: string
  description: string | null
  location: string | null
  start_time: string | null
  end_time: string | null
  day_number: number | null
  order: number | null
  type: string
}
