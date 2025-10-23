import React, { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import AdminStats from '../Components/AdminStats'
// Keep the import (in case other parts rely on it), but we won't use it here for state typing.
import type { Event as EventRow } from '../Components/EventTable'

import {
  CalendarPlusIcon,
  UsersIcon,
  EyeIcon,
  CheckIcon,
  XIcon,
} from 'lucide-react'

// ---- Local type for this dashboard (matches what the modal/list expects) ----
type ModalEvent = {
  id: string
  title: string
  submitterName?: string
  submitterEmail?: string
  eventDate?: string // ISO string
  status: 'pending' | 'approved' | 'rejected' | 'published' | string
  description?: string
  location?: string
  category?: string
  // allow extra fields without TS errors
  [key: string]: any
}

const Dashboard = () => {
  const [stats, setStats] = useState({
    totalSubmissions: 0,
    pendingApprovals: 0,
    publishedEvents: 0,
    registeredUsers: 0,
  })
  const [recentEvents, setRecentEvents] = useState<ModalEvent[]>([])
  const [selectedEvent, setSelectedEvent] = useState<ModalEvent | null>(null)
  const [showEventModal, setShowEventModal] = useState(false)

  useEffect(() => {
    // Fetch real stats + recent submissions from Laravel
    fetch('/admin/dashboard/stats')
      .then((res) => res.json())
      .then((data) => {
        setStats({
          totalSubmissions: Number(data?.totalSubmissions ?? 0),
          pendingApprovals: Number(data?.pendingApprovals ?? 0),
          publishedEvents: Number(data?.publishedEvents ?? 0),
          registeredUsers: Number(data?.registeredUsers ?? 0),
        })

        // Normalize backend rows to the fields your UI expects
        const normalized: ModalEvent[] = (data?.recentSubmissions ?? []).map((e: any) => ({
  id: String(e.id),
  // 🩵 match your SQLite table fields
  title: e.event_name ?? 'Untitled',
  submitterName: e.name ?? 'Unknown',
  submitterEmail: e.email ?? '',
  eventDate: e.start_time ?? e.created_at ?? null,
  status: e.status ?? 'pending',
  description: e.description ?? '',
  location: e.location ?? 'Not specified',
  category: e.category ?? 'General',
  ...e,
}))

        setRecentEvents(normalized)
      })
      .catch((err) => console.error('Dashboard fetch error:', err))
  }, [])

  const handleViewEvent = (event: ModalEvent) => {
    setSelectedEvent(event)
    setShowEventModal(true)
  }

  // small helpers to avoid runtime errors if date is missing
  const fmtDate = (iso?: string) => {
    if (!iso) return '—'
    const d = new Date(iso)
    return isNaN(d.getTime()) ? '—' : d.toLocaleDateString()
  }
  const fmtTime = (iso?: string) => {
    if (!iso) return '—'
    const d = new Date(iso)
    return isNaN(d.getTime())
      ? '—'
      : d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
  }

  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
        <p className="mt-1 text-sm text-gray-600">
          Overview of event submissions and system statistics
        </p>
      </div>

      {/* Stats Cards (live) */}
      <AdminStats
        totalSubmissions={stats.totalSubmissions}
        pendingApprovals={stats.pendingApprovals}
        publishedEvents={stats.publishedEvents}
        registeredUsers={stats.registeredUsers}
      />

      {/* Quick Actions */}
      <div className="mt-8 mb-6">
        <h2 className="text-lg font-medium text-gray-900">Quick Actions</h2>
        <div className="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <Link
            to="/admin/publish"
            className="bg-white overflow-hidden shadow rounded-lg p-6 hover:bg-blue-50 transition-colors"
          >
            <div className="flex items-center">
              <div className="flex-shrink-0 bg-blue-100 rounded-md p-3">
                <CalendarPlusIcon className="h-6 w-6 text-blue-600" />
              </div>
              <div className="ml-4">
                <h3 className="text-base font-medium text-gray-900">
                  Add Event
                </h3>
                <p className="mt-1 text-sm text-gray-500">
                  Publish a new event manually
                </p>
              </div>
            </div>
          </Link>

          <Link
            to="/admin/submissions"
            className="bg-white overflow-hidden shadow rounded-lg p-6 hover:bg-yellow-50 transition-colors"
          >
            <div className="flex items-center">
              <div className="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                <EyeIcon className="h-6 w-6 text-yellow-600" />
              </div>
              <div className="ml-4">
                <h3 className="text-base font-medium text-gray-900">
                  Review Submissions
                </h3>
                <p className="mt-1 text-sm text-gray-500">
                  {stats.pendingApprovals} events pending review
                </p>
              </div>
            </div>
          </Link>

          <Link
            to="/admin/users"
            className="bg-white overflow-hidden shadow rounded-lg p-6 hover:bg-purple-50 transition-colors"
          >
            <div className="flex items-center">
              <div className="flex-shrink-0 bg-purple-100 rounded-md p-3">
                <UsersIcon className="h-6 w-6 text-purple-600" />
              </div>
              <div className="ml-4">
                <h3 className="text-base font-medium text-gray-900">
                  Manage Users
                </h3>
                <p className="mt-1 text-sm text-gray-500">
                  {stats.registeredUsers} registered users
                </p>
              </div>
            </div>
          </Link>
        </div>
      </div>

      {/* Recent Submissions (live) */}
      <div className="mt-8">
        <h2 className="text-lg font-medium text-gray-900 mb-4">
          Recent Event Submissions
        </h2>
        <div className="bg-white shadow overflow-hidden sm:rounded-md">
          <ul className="divide-y divide-gray-200">
            {recentEvents.map((event) => (
              <li key={event.id}>
                <div className="px-4 py-4 sm:px-6 hover:bg-gray-50">
                  <div className="flex items-center justify-between">
                    <div className="flex items-center">
                      <p className="text-sm font-medium text-blue-600 truncate">
                         <Link to={`/admin/submissions?id=${event.id}`}>{event.title}</Link>
                      </p>
                      <div className="ml-2 flex-shrink-0">
                        {event.status === 'pending' && (
                          <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                          </span>
                        )}
                        {event.status === 'approved' && (
                          <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Approved
                          </span>
                        )}
                        {event.status === 'rejected' && (
                          <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Rejected
                          </span>
                        )}
                        {event.status === 'published' && (
                          <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Published
                          </span>
                        )}
                      </div>
                    </div>
                    <div className="ml-2 flex-shrink-0 flex">
                      <button
                        onClick={() => handleViewEvent(event)}
                        className="mr-2 p-1 rounded-full text-gray-500 hover:text-blue-600 hover:bg-blue-50"
                      >
                        <EyeIcon className="h-5 w-5" />
                      </button>
                      {event.status === 'pending' && (
                        <>
                          <button className="mr-2 p-1 rounded-full text-gray-500 hover:text-green-600 hover:bg-green-50">
                            <CheckIcon className="h-5 w-5" />
                          </button>
                          <button className="p-1 rounded-full text-gray-500 hover:text-red-600 hover:bg-red-50">
                            <XIcon className="h-5 w-5" />
                          </button>
                        </>
                      )}
                    </div>
                  </div>
                  <div className="mt-2 sm:flex sm:justify-between">
                    <div className="sm:flex">
                      <p className="flex items-center text-sm text-gray-500">
                        Submitted by {event.submitterName || 'Unknown'}
                      </p>
                    </div>
                    <div className="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                      <p>
                        {fmtDate(event.eventDate)} at {fmtTime(event.eventDate)}
                      </p>
                    </div>
                  </div>
                </div>
              </li>
            ))}
          </ul>
          <div className="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
            <div className="flex justify-center">
              <Link
                to="/admin/submissions"
                className="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
              >
                View all submissions
              </Link>
            </div>
          </div>
        </div>
      </div>

      {/* Event Detail Modal */}
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
                      {selectedEvent.title}
                    </h3>

                    <div className="mt-4">
                      <p className="text-sm text-gray-500 mb-2">
                        <strong>Submitter:</strong>{' '}
                        {selectedEvent.submitterName || 'Unknown'} (
                        {selectedEvent.submitterEmail || '—'})
                      </p>

                      <p className="text-sm text-gray-500 mb-2">
                        <strong>Date:</strong>{' '}
                        {fmtDate(selectedEvent.eventDate)} at{' '}
                        {fmtTime(selectedEvent.eventDate)}
                      </p>

                      <p className="text-sm text-gray-500 mb-2">
                        <strong>Location:</strong>{' '}
                        {selectedEvent.location || 'Not specified'}
                      </p>

                      <p className="text-sm text-gray-500 mb-2">
                        <strong>Category:</strong>{' '}
                        {selectedEvent.category || 'General'}
                      </p>

                      <p className="text-sm text-gray-500 mb-2">
                        <strong>Status:</strong>{' '}
                        <span
                          className={`px-2 py-1 text-xs font-medium rounded-full 
                          ${
                            selectedEvent.status === 'pending'
                              ? 'bg-yellow-100 text-yellow-800'
                              : selectedEvent.status === 'approved'
                              ? 'bg-green-100 text-green-800'
                              : selectedEvent.status === 'rejected'
                              ? 'bg-red-100 text-red-800'
                              : 'bg-blue-100 text-blue-800'
                          }`}
                        >
                          {selectedEvent.status
                            .charAt(0)
                            .toUpperCase() + selectedEvent.status.slice(1)}
                        </span>
                      </p>

                      <div className="mt-4">
                        <p className="text-sm text-gray-500 mb-1">
                          <strong>Description:</strong>
                        </p>
                        <p className="text-sm text-gray-700">
                          {selectedEvent.description || '—'}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                  type="button"
                  className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={() => setShowEventModal(false)}
                >
                  Close
                </button>

                {selectedEvent.status === 'pending' && (
                  <>
                    <button
                      type="button"
                      className="mt-3 sm:mt-0 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                      Approve
                    </button>

                    <button
                      type="button"
                      className="mt-3 sm:mt-0 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                    >
                      Reject
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

export default Dashboard
