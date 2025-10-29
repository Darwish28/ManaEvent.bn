import React, { useState, useEffect } from 'react'
import axios from 'axios'
import EventTable, { Event as BaseEvent } from '../Components/EventTable'
import { useLocation } from 'react-router-dom'

// Extend table's Event with optional media fields coming from backend
type AdminEvent = BaseEvent & {
  image_path?: string | string[] | null
  file_path?: string | string[] | null
}

const EventSubmissions = () => {
  const [events, setEvents] = useState<AdminEvent[]>([])
  const [filteredEvents, setFilteredEvents] = useState<AdminEvent[]>([])
  const [selectedEvent, setSelectedEvent] = useState<AdminEvent | null>(null)
  const [showEventModal, setShowEventModal] = useState(false)
  const [modalMode, setModalMode] = useState<'view' | 'edit'>('view')
  const [loading, setLoading] = useState(true)

  // Filters
  const [statusFilter, setStatusFilter] = useState('all')
  const [sortOrder, setSortOrder] = useState<'asc' | 'desc'>('desc')
  const [alphabetical, setAlphabetical] = useState<'az' | 'za'>('az')

  const location = useLocation()

  // Fetch events from Laravel backend
  useEffect(() => {
    axios
      .get<AdminEvent[]>('/admin/event-submissions')
      .then((res) => {
        setEvents(res.data)
        setFilteredEvents(res.data)
      })
      .catch((err) => {
        console.error('❌ Failed to fetch events:', err)
      })
      .finally(() => setLoading(false))
  }, [])

  // Scroll & highlight when URL has ?id=
  useEffect(() => {
    if (!filteredEvents.length) return
    const params = new URLSearchParams(location.search)
    const eventId = params.get('id')
    if (eventId) {
      setTimeout(() => {
        const element = document.getElementById(`event-${eventId}`)
        if (element) {
          element.scrollIntoView({ behavior: 'smooth', block: 'center' })
          element.classList.add('bg-blue-50', 'ring', 'ring-blue-400')
          setTimeout(() => {
            element.classList.remove('bg-blue-50', 'ring', 'ring-blue-400')
          }, 3000)
        }
      }, 500)
    }
  }, [location, filteredEvents])

  // Apply filters dynamically
  useEffect(() => {
    let data = [...events]

    if (statusFilter !== 'all') {
      data = data.filter((e) => e.status === statusFilter)
    }

    data.sort((a, b) => {
      const dateA = new Date(a.created_at || '').getTime()
      const dateB = new Date(b.created_at || '').getTime()
      return sortOrder === 'asc' ? dateA - dateB : dateB - dateA
    })

    data.sort((a, b) => {
      const nameA = a.event_name?.toLowerCase() || ''
      const nameB = b.event_name?.toLowerCase() || ''
      return alphabetical === 'az'
        ? nameA.localeCompare(nameB)
        : nameB.localeCompare(nameA)
    })

    setFilteredEvents(data)
  }, [statusFilter, sortOrder, alphabetical, events])

  // CRUD
  const handleViewEvent = (event: AdminEvent) => {
    setSelectedEvent(event)
    setModalMode('view')
    setShowEventModal(true)
  }

  const handleEditEvent = (event: AdminEvent) => {
    setSelectedEvent(event)
    setModalMode('edit')
    setShowEventModal(true)
  }

  const handleApproveEvent = async (id: number) => {
    try {
      await axios.put(`/admin/event-submissions/${id}`, { status: 'approved' })
      setEvents((prev) =>
        prev.map((e) => (e.id === id ? { ...e, status: 'approved' } : e)),
      )
    } catch (err) {
      console.error('❌ Approve failed:', err)
    }
  }

  const handleRejectEvent = async (id: number) => {
    try {
      await axios.put(`/admin/event-submissions/${id}`, { status: 'rejected' })
      setEvents((prev) =>
        prev.map((e) => (e.id === id ? { ...e, status: 'rejected' } : e)),
      )
    } catch (err) {
      console.error('❌ Reject failed:', err)
    }
  }

  const handleDeleteEvent = async (id: number) => {
    if (window.confirm('Are you sure you want to delete this event?')) {
      try {
        await axios.delete(`/admin/event-submissions/${id}`)
        setEvents((prev) => prev.filter((e) => e.id !== id))
      } catch (err) {
        console.error('❌ Delete failed:', err)
      }
    }
  }

  const handleSaveEvent = async (updatedEvent: AdminEvent) => {
    try {
      await axios.put(`/admin/event-submissions/${updatedEvent.id}`, updatedEvent)
      setEvents((prev) =>
        prev.map((e) => (e.id === updatedEvent.id ? updatedEvent : e)),
      )
      setShowEventModal(false)
    } catch (err) {
      console.error('❌ Save failed:', err)
    }
  }

  // Build image list for modal (supports image_path or file_path)
  const imageList: string[] = (() => {
    const raw =
      selectedEvent?.image_path != null && selectedEvent.image_path !== ''
        ? selectedEvent.image_path
        : selectedEvent?.file_path ?? null

    if (!raw) return []

    if (Array.isArray(raw)) return raw.filter(Boolean) as string[]

    // raw is a string
    try {
      const parsed = JSON.parse(raw)
      return Array.isArray(parsed) ? (parsed.filter(Boolean) as string[]) : [raw]
    } catch {
      return [raw]
    }
  })()

  if (loading) {
    return <div className="p-6 text-center text-gray-500">Loading event submissions...</div>
  }

  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Event Submissions</h1>
        <p className="mt-1 text-sm text-gray-600">Manage and review all user-submitted events</p>
      </div>

      {/* Filters */}
      <div className="flex flex-wrap gap-4 mb-4 items-center">
        <select
          value={statusFilter}
          onChange={(e) => setStatusFilter(e.target.value)}
          className="border border-gray-300 rounded-md p-2 text-sm"
        >
          <option value="all">All Statuses</option>
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="rejected">Rejected</option>
          <option value="published">Published</option>
        </select>

        <select
          value={sortOrder}
          onChange={(e) => setSortOrder(e.target.value as 'asc' | 'desc')}
          className="border border-gray-300 rounded-md p-2 text-sm"
        >
          <option value="desc">Newest First</option>
          <option value="asc">Oldest First</option>
        </select>

        <select
          value={alphabetical}
          onChange={(e) => setAlphabetical(e.target.value as 'az' | 'za')}
          className="border border-gray-300 rounded-md p-2 text-sm"
        >
          <option value="az">A–Z</option>
          <option value="za">Z–A</option>
        </select>
      </div>

      {/* Table */}
      <EventTable
        events={filteredEvents as unknown as BaseEvent[]}
        onView={handleViewEvent}
        onApprove={handleApproveEvent}
        onReject={handleRejectEvent}
        onEdit={handleEditEvent}
        onDelete={handleDeleteEvent}
      />

      {/* Modal */}
      {showEventModal && selectedEvent && (
        <div className="fixed inset-0 overflow-y-auto z-50">
          <div className="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
              className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
              onClick={() => setShowEventModal(false)}
            />
            <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
              <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start">
                  <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 className="text-lg leading-6 font-medium text-gray-900">
                      {modalMode === 'view' ? selectedEvent.event_name : 'Edit Event'}
                    </h3>

                    {modalMode === 'view' ? (
                      <div className="mt-4 text-sm text-gray-700 space-y-2">
                        <p>
                          <strong>Submitter:</strong> {selectedEvent.name} ({selectedEvent.email})
                        </p>
                        <p><strong>Phone:</strong> {selectedEvent.phone}</p>
                        <p><strong>Location:</strong> {selectedEvent.location}</p>
                        <p><strong>Status:</strong> {selectedEvent.status}</p>
                        <p><strong>Description:</strong> {selectedEvent.description}</p>

                        {imageList.length > 0 && (
                          <div className="grid grid-cols-2 gap-2 mt-3">
                            {imageList.map((img, i) => (
                              <img
                                key={i}
                                src={`/storage/${img}`}
                                alt={`event-${i}`}
                                className="rounded-lg shadow-md max-h-48 object-cover"
                              />
                            ))}
                          </div>
                        )}
                      </div>
                    ) : (
                      <form className="mt-4 space-y-3">
                        <div>
                          <label className="block text-sm font-medium text-gray-700">Event Name</label>
                          <input
                            type="text"
                            value={selectedEvent.event_name}
                            onChange={(e) =>
                              setSelectedEvent({ ...selectedEvent, event_name: e.target.value })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>
                        <div>
                          <label className="block text-sm font-medium text-gray-700">Location</label>
                          <input
                            type="text"
                            value={selectedEvent.location ?? ''}
                            onChange={(e) =>
                              setSelectedEvent({ ...selectedEvent, location: e.target.value })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>
                        <div>
                          <label className="block text-sm font-medium text-gray-700">Description</label>
                          <textarea
                            rows={4}
                            value={selectedEvent.description ?? ''}
                            onChange={(e) =>
                              setSelectedEvent({ ...selectedEvent, description: e.target.value })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>
                      </form>
                    )}
                  </div>
                </div>
              </div>

              <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                {modalMode === 'view' ? (
                  <>
                    <button
                      type="button"
                      className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => setShowEventModal(false)}
                    >
                      Close
                    </button>
                    <button
                      type="button"
                      className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-white border text-gray-700 hover:bg-gray-100 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => setModalMode('edit')}
                    >
                      Edit
                    </button>
                    {selectedEvent.status === 'pending' && (
                      <>
                        <button
                          type="button"
                          className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-green-600 text-white font-medium hover:bg-green-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                          onClick={() => {
                            handleApproveEvent(selectedEvent.id)
                            setShowEventModal(false)
                          }}
                        >
                          Approve
                        </button>
                        <button
                          type="button"
                          className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-red-600 text-white font-medium hover:bg-red-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                          onClick={() => {
                            handleRejectEvent(selectedEvent.id)
                            setShowEventModal(false)
                          }}
                        >
                          Reject
                        </button>
                      </>
                    )}
                  </>
                ) : (
                  <>
                    <button
                      type="button"
                      className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-blue-600 text-white font-medium hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => selectedEvent && handleSaveEvent(selectedEvent)}
                    >
                      Save Changes
                    </button>
                    <button
                      type="button"
                      className="w-full inline-flex justify-center rounded-md px-4 py-2 bg-white border text-gray-700 hover:bg-gray-100 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => setModalMode('view')}
                    >
                      Cancel
                    </button>
                  </>
                )}
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  )
}

export default EventSubmissions
