import React, { useState, useEffect } from 'react'
import axios from 'axios'
import EventTable, { Event } from '../Components/EventTable'

const EventSubmissions = () => {
  const [events, setEvents] = useState<Event[]>([])
  const [selectedEvent, setSelectedEvent] = useState<Event | null>(null)
  const [showEventModal, setShowEventModal] = useState(false)
  const [modalMode, setModalMode] = useState<'view' | 'edit'>('view')
  const [loading, setLoading] = useState(true)

  // ✅ Fetch events from Laravel backend
  useEffect(() => {
    axios
      .get('/admin/event-submissions')
      .then((res) => {
        setEvents(res.data)
      })
      .catch((err) => {
        console.error('❌ Failed to fetch events:', err)
      })
      .finally(() => setLoading(false))
  }, [])

  // ✅ CRUD functions
  const handleViewEvent = (event: Event) => {
    setSelectedEvent(event)
    setModalMode('view')
    setShowEventModal(true)
  }

  const handleEditEvent = (event: Event) => {
    setSelectedEvent(event)
    setModalMode('edit')
    setShowEventModal(true)
  }

  const handleApproveEvent = async (id: number) => {
    try {
      await axios.put(`/admin/event-submissions/${id}`, { status: 'approved' })
      setEvents(events.map((e) => (e.id === id ? { ...e, status: 'approved' } : e)))
    } catch (err) {
      console.error('❌ Approve failed:', err)
    }
  }

  const handleRejectEvent = async (id: number) => {
    try {
      await axios.put(`/admin/event-submissions/${id}`, { status: 'rejected' })
      setEvents(events.map((e) => (e.id === id ? { ...e, status: 'rejected' } : e)))
    } catch (err) {
      console.error('❌ Reject failed:', err)
    }
  }

  const handleDeleteEvent = async (id: number) => {
    if (window.confirm('Are you sure you want to delete this event?')) {
      try {
        await axios.delete(`/admin/event-submissions/${id}`)
        setEvents(events.filter((e) => e.id !== id))
      } catch (err) {
        console.error('❌ Delete failed:', err)
      }
    }
  }

  const handleSaveEvent = async (updatedEvent: Event) => {
    try {
      await axios.put(`/admin/event-submissions/${updatedEvent.id}`, updatedEvent)
      setEvents(events.map((e) => (e.id === updatedEvent.id ? updatedEvent : e)))
      setShowEventModal(false)
    } catch (err) {
      console.error('❌ Save failed:', err)
    }
  }

  // ✅ Loading state
  if (loading) {
    return (
      <div className="p-6 text-center text-gray-500">
        Loading event submissions...
      </div>
    )
  }

  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Event Submissions</h1>
        <p className="mt-1 text-sm text-gray-600">
          Manage and review all user-submitted events
        </p>
      </div>

      {/* ✅ Table displaying data */}
      <EventTable
        events={events}
        onView={handleViewEvent}
        onApprove={handleApproveEvent}
        onReject={handleRejectEvent}
        onEdit={handleEditEvent}
        onDelete={handleDeleteEvent}
      />

      {/* ✅ Modal section */}
      {showEventModal && selectedEvent && (
        <div className="fixed inset-0 overflow-y-auto z-50">
          <div className="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
              className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
              onClick={() => setShowEventModal(false)}
            ></div>

            <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
              <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start">
                  <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 className="text-lg leading-6 font-medium text-gray-900">
                      {modalMode === 'view'
                        ? selectedEvent.event_name
                        : 'Edit Event'}
                    </h3>

                    {/* ✅ View Mode */}
                    {modalMode === 'view' ? (
                      <div className="mt-4 text-sm text-gray-700 space-y-2">
                        <p>
                          <strong>Submitter:</strong> {selectedEvent.name} (
                          {selectedEvent.email})
                        </p>
                        <p>
                          <strong>Phone:</strong> {selectedEvent.phone}
                        </p>
                        <p>
                          <strong>Location:</strong> {selectedEvent.location}
                        </p>
                        <p>
                          <strong>Status:</strong> {selectedEvent.status}
                        </p>
                        <p>
                          <strong>Description:</strong>{' '}
                          {selectedEvent.description}
                        </p>
                      </div>
                    ) : (
                      /* ✅ Edit Mode */
                      <form className="mt-4 space-y-3">
                        <div>
                          <label className="block text-sm font-medium text-gray-700">
                            Event Name
                          </label>
                          <input
                            type="text"
                            value={selectedEvent.event_name}
                            onChange={(e) =>
                              setSelectedEvent({
                                ...selectedEvent,
                                event_name: e.target.value,
                              })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>

                        <div>
                          <label className="block text-sm font-medium text-gray-700">
                            Location
                          </label>
                          <input
                            type="text"
                            value={selectedEvent.location ?? ''}
                            onChange={(e) =>
                              setSelectedEvent({
                                ...selectedEvent,
                                location: e.target.value,
                              })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>

                        <div>
                          <label className="block text-sm font-medium text-gray-700">
                            Description
                          </label>
                          <textarea
                            rows={4}
                            value={selectedEvent.description ?? ''}
                            onChange={(e) =>
                              setSelectedEvent({
                                ...selectedEvent,
                                description: e.target.value,
                              })
                            }
                            className="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3"
                          />
                        </div>
                      </form>
                    )}
                  </div>
                </div>
              </div>

              {/* ✅ Modal buttons */}
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
                      onClick={() => handleSaveEvent(selectedEvent!)}
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
