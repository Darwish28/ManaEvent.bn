import React, { useState } from 'react'
import EventTable, { Event } from '../Components/EventTable'

// Mock data for events
const mockEvents: Event[] = [
  {
    id: '1',
    title: 'Tech Conference 2023',
    submitterName: 'John Doe',
    submitterEmail: 'john@example.com',
    eventDate: '2023-11-15T09:00:00',
    status: 'pending',
    description:
      'Annual tech conference featuring the latest technologies and innovations.',
    location: 'San Francisco Convention Center',
    category: 'Technology',
  },
  {
    id: '2',
    title: 'Art Exhibition: Modern Masters',
    submitterName: 'Jane Smith',
    submitterEmail: 'jane@example.com',
    eventDate: '2023-11-20T10:00:00',
    status: 'approved',
    description: 'Exhibition showcasing works from contemporary artists.',
    location: 'Downtown Art Gallery',
    category: 'Art',
  },
  {
    id: '3',
    title: 'Community Cleanup Day',
    submitterName: 'Robert Johnson',
    submitterEmail: 'robert@example.com',
    eventDate: '2023-11-25T08:00:00',
    status: 'published',
    description: 'Volunteer event to clean up local parks and streets.',
    location: 'Riverside Park',
    category: 'Community',
  },
  {
    id: '4',
    title: 'Charity Gala Dinner',
    submitterName: 'Emily Wilson',
    submitterEmail: 'emily@example.com',
    eventDate: '2023-12-01T18:30:00',
    status: 'pending',
    description: "Annual fundraising dinner for local children's hospital.",
    location: 'Grand Hotel Ballroom',
    category: 'Charity',
  },
  {
    id: '5',
    title: 'Winter Music Festival',
    submitterName: 'Michael Brown',
    submitterEmail: 'michael@example.com',
    eventDate: '2023-12-10T16:00:00',
    status: 'rejected',
    description: 'Outdoor music festival featuring local bands.',
    location: 'City Park Amphitheater',
    category: 'Music',
  },
  {
    id: '6',
    title: 'Business Networking Lunch',
    submitterName: 'Sarah Johnson',
    submitterEmail: 'sarah@example.com',
    eventDate: '2023-12-05T12:30:00',
    status: 'pending',
    description: 'Monthly networking event for local business professionals.',
    location: 'Downtown Business Center',
    category: 'Business',
  },
  {
    id: '7',
    title: 'Photography Workshop',
    submitterName: 'David Lee',
    submitterEmail: 'david@example.com',
    eventDate: '2023-12-08T14:00:00',
    status: 'approved',
    description:
      'Hands-on workshop for beginner and intermediate photographers.',
    location: 'Community Arts Center',
    category: 'Education',
  },
  {
    id: '8',
    title: 'Yoga in the Park',
    submitterName: 'Lisa Chen',
    submitterEmail: 'lisa@example.com',
    eventDate: '2023-12-12T08:00:00',
    status: 'published',
    description: 'Free community yoga session for all experience levels.',
    location: 'Central Park',
    category: 'Fitness',
  },
  {
    id: '9',
    title: 'Holiday Craft Fair',
    submitterName: 'Jennifer Adams',
    submitterEmail: 'jennifer@example.com',
    eventDate: '2023-12-15T10:00:00',
    status: 'pending',
    description:
      'Annual fair featuring handmade crafts and gifts from local artisans.',
    location: 'Community Center',
    category: 'Shopping',
  },
  {
    id: '10',
    title: 'Film Festival',
    submitterName: 'Mark Wilson',
    submitterEmail: 'mark@example.com',
    eventDate: '2023-12-18T18:00:00',
    status: 'approved',
    description: 'Showcasing independent films from around the world.',
    location: 'City Cinema',
    category: 'Entertainment',
  },
  {
    id: '11',
    title: 'Science Fair for Kids',
    submitterName: 'Amanda Torres',
    submitterEmail: 'amanda@example.com',
    eventDate: '2023-12-20T09:00:00',
    status: 'pending',
    description:
      'Interactive science exhibits and demonstrations for children aged 5-12.',
    location: 'Science Museum',
    category: 'Education',
  },
  {
    id: '12',
    title: "New Year's Eve Gala",
    submitterName: 'Richard Brown',
    submitterEmail: 'richard@example.com',
    eventDate: '2023-12-31T20:00:00',
    status: 'approved',
    description:
      'Elegant celebration with dinner, dancing, and midnight champagne toast.',
    location: 'Grand Ballroom',
    category: 'Holiday',
  },
]
const EventSubmissions = () => {
  const [events, setEvents] = useState<Event[]>(mockEvents)
  const [selectedEvent, setSelectedEvent] = useState<Event | null>(null)
  const [showEventModal, setShowEventModal] = useState(false)
  const [modalMode, setModalMode] = useState<'view' | 'edit'>('view')
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
  const handleApproveEvent = (id: string) => {
    setEvents(
      events.map((event) =>
        event.id === id
          ? {
              ...event,
              status: 'approved',
            }
          : event,
      ),
    )
  }
  const handleRejectEvent = (id: string) => {
    setEvents(
      events.map((event) =>
        event.id === id
          ? {
              ...event,
              status: 'rejected',
            }
          : event,
      ),
    )
  }
  const handleDeleteEvent = (id: string) => {
    if (window.confirm('Are you sure you want to delete this event?')) {
      setEvents(events.filter((event) => event.id !== id))
    }
  }
  const handleSaveEvent = (updatedEvent: Event) => {
    setEvents(
      events.map((event) =>
        event.id === updatedEvent.id ? updatedEvent : event,
      ),
    )
    setShowEventModal(false)
  }
  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Event Submissions</h1>
        <p className="mt-1 text-sm text-gray-600">
          Manage and review all user-submitted events
        </p>
      </div>
      <EventTable
        events={events}
        onView={handleViewEvent}
        onApprove={handleApproveEvent}
        onReject={handleRejectEvent}
        onEdit={handleEditEvent}
        onDelete={handleDeleteEvent}
      />
      {/* Event Detail/Edit Modal */}
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
                        ? selectedEvent.title
                        : 'Edit Event'}
                    </h3>
                    {modalMode === 'view' ? (
                      <div className="mt-4">
                        <p className="text-sm text-gray-500 mb-2">
                          <strong>Submitter:</strong>{' '}
                          {selectedEvent.submitterName} (
                          {selectedEvent.submitterEmail})
                        </p>
                        <p className="text-sm text-gray-500 mb-2">
                          <strong>Date:</strong>{' '}
                          {new Date(
                            selectedEvent.eventDate,
                          ).toLocaleDateString()}{' '}
                          at{' '}
                          {new Date(selectedEvent.eventDate).toLocaleTimeString(
                            [],
                            {
                              hour: '2-digit',
                              minute: '2-digit',
                            },
                          )}
                        </p>
                        <p className="text-sm text-gray-500 mb-2">
                          <strong>Location:</strong> {selectedEvent.location}
                        </p>
                        <p className="text-sm text-gray-500 mb-2">
                          <strong>Category:</strong> {selectedEvent.category}
                        </p>
                        <p className="text-sm text-gray-500 mb-2">
                          <strong>Status:</strong>{' '}
                          <span
                            className={`px-2 py-1 text-xs font-medium rounded-full 
                            ${selectedEvent.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : selectedEvent.status === 'approved' ? 'bg-green-100 text-green-800' : selectedEvent.status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'}`}
                          >
                            {selectedEvent.status.charAt(0).toUpperCase() +
                              selectedEvent.status.slice(1)}
                          </span>
                        </p>
                        <div className="mt-4">
                          <p className="text-sm text-gray-500 mb-1">
                            <strong>Description:</strong>
                          </p>
                          <p className="text-sm text-gray-700">
                            {selectedEvent.description}
                          </p>
                        </div>
                      </div>
                    ) : (
                      <div className="mt-4">
                        <form className="space-y-4">
                          <div>
                            <label
                              htmlFor="title"
                              className="block text-sm font-medium text-gray-700"
                            >
                              Title
                            </label>
                            <input
                              type="text"
                              id="title"
                              className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              defaultValue={selectedEvent.title}
                            />
                          </div>
                          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                              <label
                                htmlFor="date"
                                className="block text-sm font-medium text-gray-700"
                              >
                                Date
                              </label>
                              <input
                                type="date"
                                id="date"
                                className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                defaultValue={
                                  selectedEvent.eventDate.split('T')[0]
                                }
                              />
                            </div>
                            <div>
                              <label
                                htmlFor="time"
                                className="block text-sm font-medium text-gray-700"
                              >
                                Time
                              </label>
                              <input
                                type="time"
                                id="time"
                                className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                defaultValue={selectedEvent.eventDate
                                  .split('T')[1]
                                  .substring(0, 5)}
                              />
                            </div>
                          </div>
                          <div>
                            <label
                              htmlFor="location"
                              className="block text-sm font-medium text-gray-700"
                            >
                              Location
                            </label>
                            <input
                              type="text"
                              id="location"
                              className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              defaultValue={selectedEvent.location}
                            />
                          </div>
                          <div>
                            <label
                              htmlFor="category"
                              className="block text-sm font-medium text-gray-700"
                            >
                              Category
                            </label>
                            <input
                              type="text"
                              id="category"
                              className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              defaultValue={selectedEvent.category}
                            />
                          </div>
                          <div>
                            <label
                              htmlFor="status"
                              className="block text-sm font-medium text-gray-700"
                            >
                              Status
                            </label>
                            <select
                              id="status"
                              className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              defaultValue={selectedEvent.status}
                            >
                              <option value="pending">Pending</option>
                              <option value="approved">Approved</option>
                              <option value="rejected">Rejected</option>
                              <option value="published">Published</option>
                            </select>
                          </div>
                          <div>
                            <label
                              htmlFor="description"
                              className="block text-sm font-medium text-gray-700"
                            >
                              Description
                            </label>
                            <textarea
                              id="description"
                              rows={4}
                              className="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              defaultValue={selectedEvent.description}
                            ></textarea>
                          </div>
                        </form>
                      </div>
                    )}
                  </div>
                </div>
              </div>
              <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                {modalMode === 'view' ? (
                  <>
                    <button
                      type="button"
                      className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => setShowEventModal(false)}
                    >
                      Close
                    </button>
                    <button
                      type="button"
                      className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => setModalMode('edit')}
                    >
                      Edit
                    </button>
                    {selectedEvent.status === 'pending' && (
                      <>
                        <button
                          type="button"
                          className="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                          onClick={() => {
                            handleApproveEvent(selectedEvent.id)
                            setShowEventModal(false)
                          }}
                        >
                          Approve
                        </button>
                        <button
                          type="button"
                          className="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
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
                      className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                      onClick={() => handleSaveEvent(selectedEvent)}
                    >
                      Save Changes
                    </button>
                    <button
                      type="button"
                      className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
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
