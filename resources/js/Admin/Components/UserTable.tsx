import React, { useState } from 'react'
import {
  EyeIcon,
  KeyIcon,
  TrashIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  SearchIcon,
} from 'lucide-react'
export interface User {
  id: string
  name: string
  email: string
  registeredDate: string
  lastLogin: string
  eventsSubmitted: number
  status: 'active' | 'inactive' | 'suspended'
}
interface UserTableProps {
  users: User[]
  onView: (user: User) => void
  onResetPassword: (id: string) => void
  onDelete: (id: string) => void
}
const UserTable = ({
  users,
  onView,
  onResetPassword,
  onDelete,
}: UserTableProps) => {
  const [searchTerm, setSearchTerm] = useState('')
  const [currentPage, setCurrentPage] = useState(1)
  const usersPerPage = 10
  // Filter users based on search term
  const filteredUsers = users.filter(
    (user) =>
      user.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      user.email.toLowerCase().includes(searchTerm.toLowerCase()),
  )
  // Calculate pagination
  const indexOfLastUser = currentPage * usersPerPage
  const indexOfFirstUser = indexOfLastUser - usersPerPage
  const currentUsers = filteredUsers.slice(indexOfFirstUser, indexOfLastUser)
  const totalPages = Math.ceil(filteredUsers.length / usersPerPage)
  // Status badge component
  const StatusBadge = ({ status }: { status: User['status'] }) => {
    const statusStyles = {
      active: 'bg-green-100 text-green-800',
      inactive: 'bg-gray-100 text-gray-800',
      suspended: 'bg-red-100 text-red-800',
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
            placeholder="Search users..."
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
                User
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Registration
              </th>
              <th
                scope="col"
                className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
              >
                Events
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
            {currentUsers.length > 0 ? (
              currentUsers.map((user) => (
                <tr key={user.id} className="hover:bg-gray-50">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm font-medium text-gray-900">
                      {user.name}
                    </div>
                    <div className="text-sm text-gray-500">{user.email}</div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900">
                      Registered:{' '}
                      {new Date(user.registeredDate).toLocaleDateString()}
                    </div>
                    <div className="text-sm text-gray-500">
                      Last login:{' '}
                      {new Date(user.lastLogin).toLocaleDateString()}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {user.eventsSubmitted} submitted
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <StatusBadge status={user.status} />
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      onClick={() => onView(user)}
                      className="text-blue-600 hover:text-blue-900 mr-3"
                      title="View details"
                    >
                      <EyeIcon size={18} />
                    </button>
                    <button
                      onClick={() => onResetPassword(user.id)}
                      className="text-gray-600 hover:text-gray-900 mr-3"
                      title="Reset password"
                    >
                      <KeyIcon size={18} />
                    </button>
                    <button
                      onClick={() => onDelete(user.id)}
                      className="text-red-600 hover:text-red-900"
                      title="Delete user"
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
                  No users found
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      {/* Pagination */}
      {filteredUsers.length > 0 && (
        <div className="px-4 py-3 border-t border-gray-200 sm:px-6 flex items-center justify-between">
          <div className="hidden sm:block">
            <p className="text-sm text-gray-700">
              Showing{' '}
              <span className="font-medium">{indexOfFirstUser + 1}</span> to{' '}
              <span className="font-medium">
                {Math.min(indexOfLastUser, filteredUsers.length)}
              </span>{' '}
              of <span className="font-medium">{filteredUsers.length}</span>{' '}
              users
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
export default UserTable
