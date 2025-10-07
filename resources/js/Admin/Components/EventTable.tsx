import React, { useState } from 'react'
import {
  EyeIcon,
  CheckIcon,
  XIcon,
  EditIcon,
  TrashIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  SearchIcon,
} from 'lucide-react'
export interface Event {
  id: string
  title: string
  submitterName: string
  submitterEmail: string
  eventDate: string
  status: 'pending' | 'approved' | 'rejected' | 'published'
  description?: string
  location?: string
  category?: string
  posterUrl?: string
}
interface EventTableProps {
  events: Event[]
  onView: (event: Event) => void
  onApprove: (id: string) => void
  onReject: (id: string) => void
  onEdit: (event: Event) => void
  onDelete: (id: string) => void
}
const EventTable = ({
  events,
  onView,
  onApprove,
  onReject,
  onEdit,
  onDelete,
}: EventTableProps) => {
  const [searchTerm, setSearchTerm] = useState('')
  const [currentPage, setCurrentPage] = useState(1)
  const eventsPerPage = 10
  // Filter events based on search term
  const filteredEvents = events.filter(
    (event) =>
      event.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
      event.submitterName.toLowerCase().includes(searchTerm.toLowerCase()) ||
      event.submitterEmail.toLowerCase().includes(searchTerm.toLowerCase()),
  )
  // Calculate pagination
  const indexOfLastEvent = currentPage * eventsPerPage
  const indexOfFirstEvent = indexOfLastEvent - eventsPerPage
  const currentEvents = filteredEvents.slice(
    indexOfFirstEvent,
    indexOfLastEvent,
  )
  const totalPages = Math.ceil(filteredEvents.length / eventsPerPage)
  // Status badge component
  const StatusBadge = ({ status }: { status: Event['status'] }) => {
    const statusStyles = {
      pending: 'bg-yellow-100 text-yellow-800',
      approved: 'bg-green-100 text-green-800',
      rejected: 'bg-red-100 text-red-800',
      published: 'bg-blue-100 text-blue-800',
    }
    return (
      <span
        className={`px-2 py-1 text-xs font-medium rounded-full ${statusStyles[status]}`}
      >
        {status.charAt(0).toUpperCase() + status.slice(1)}
      </span>
    )
  }
  return (
    <div className="bg-white rounded-lg shadow overflow-hidden">
      {/* Search and filters */}
      <div className="p-4 border-b flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div className="relative">
          <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <SearchIcon size={18} className="text-gray-400" />
          </div>
          <input
            type="text"
            className="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Search events..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
        </div>
      </div>
      {/* Table */}
      <div className="overflow-x-auto">
        <table className="min-w-full divide-y divide-gray-200">
          <thead className="bg-gray-50">
            <tr>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Event
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Submitter
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Date
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Status
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Actions
              </th>
            </tr>
          </thead>
          <tbody className="bg-white divide-y divide-gray-200">
            {currentEvents.length > 0 ? (
              currentEvents.map((event) => (
                <tr key={event.id} className="hover:bg-gray-50">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm font-medium text-gray-900">
                      {event.title}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">
                      {event.submitterName}
                    </div>
                    <div className="text-sm text-gray-500">
                      {event.submitterEmail}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">
                      {new Date(event.eventDate).toLocaleDateString()}
                    </div>
                    <div className="text-sm text-gray-500">
                      {new Date(event.eventDate).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                      })}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <StatusBadge status={event.status} />
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      onClick={() => onView(event)}
                      className="text-blue-600 hover:text-blue-900 mr-3"
                      title="View details"
                    >
                      <EyeIcon size={18} />
                    </button>
                    {event.status === 'pending' && (
                      <>
                        <button
                          onClick={() => onApprove(event.id)}
                          className="text-green-600 hover:text-green-900 mr-3"
                          title="Approve"
                        >
                          <CheckIcon size={18} />
                        </button>
                        <button
                          onClick={() => onReject(event.id)}
                          className="text-red-600 hover:text-red-900 mr-3"
                          title="Reject"
                        >
                          <XIcon size={18} />
                        </button>
                      </>
                    )}
                    <button
                      onClick={() => onEdit(event)}
                      className="text-gray-600 hover:text-gray-900 mr-3"
                      title="Edit"
                    >
                      <EditIcon size={18} />
                    </button>
                    <button
                      onClick={() => onDelete(event.id)}
                      className="text-red-600 hover:text-red-900"
                      title="Delete"
                    >
                      <TrashIcon size={18} />
                    </button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td
                  colSpan={5}
                  className="px-6 py-4 text-center text-sm text-gray-500"
                >
                  No events found
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      {/* Pagination */}
      {filteredEvents.length > 0 && (
        <div className="px-4 py-3 border-t border-gray-200 sm:px-6 flex items-center justify-between">
          <div className="hidden sm:block">
            <p className="text-sm text-gray-700">
              Showing{' '}
              <span className="font-medium">{indexOfFirstEvent + 1}</span> to{' '}
              <span className="font-medium">
                {Math.min(indexOfLastEvent, filteredEvents.length)}
              </span>{' '}
              of <span className="font-medium">{filteredEvents.length}</span>{' '}
              events
            </p>
          </div>
          <div className="flex-1 flex justify-between sm:justify-end">
            <button
              onClick={() => setCurrentPage(currentPage - 1)}
              disabled={currentPage === 1}
              className={`relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md ${currentPage === 1 ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'} mr-3`}
            >
              <ChevronLeftIcon size={16} className="mr-1" />
              Previous
            </button>
            <button
              onClick={() => setCurrentPage(currentPage + 1)}
              disabled={currentPage === totalPages}
              className={`relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md ${currentPage === totalPages ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50'}`}
            >
              Next
              <ChevronRightIcon size={16} className="ml-1" />
            </button>
          </div>
        </div>
      )}
    </div>
  )
}
export default EventTable
