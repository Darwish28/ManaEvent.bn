import React, { useState } from 'react'
import UserTable, { User } from '../Components/UserTable'

// Mock data for users
const mockUsers: User[] = [
  {
    id: '1',
    name: 'John Doe',
    email: 'john@example.com',
    registeredDate: '2023-01-15T08:30:00',
    lastLogin: '2023-11-05T14:20:00',
    eventsSubmitted: 5,
    status: 'active',
  },
  {
    id: '2',
    name: 'Jane Smith',
    email: 'jane@example.com',
    registeredDate: '2023-02-20T10:15:00',
    lastLogin: '2023-11-08T09:45:00',
    eventsSubmitted: 3,
    status: 'active',
  },
  {
    id: '3',
    name: 'Robert Johnson',
    email: 'robert@example.com',
    registeredDate: '2023-03-10T15:40:00',
    lastLogin: '2023-10-30T11:30:00',
    eventsSubmitted: 2,
    status: 'inactive',
  },
  {
    id: '4',
    name: 'Emily Wilson',
    email: 'emily@example.com',
    registeredDate: '2023-04-05T09:20:00',
    lastLogin: '2023-11-07T16:15:00',
    eventsSubmitted: 7,
    status: 'active',
  },
  {
    id: '5',
    name: 'Michael Brown',
    email: 'michael@example.com',
    registeredDate: '2023-05-12T11:10:00',
    lastLogin: '2023-09-20T10:05:00',
    eventsSubmitted: 0,
    status: 'inactive',
  },
  {
    id: '6',
    name: 'Sarah Johnson',
    email: 'sarah@example.com',
    registeredDate: '2023-06-18T14:30:00',
    lastLogin: '2023-11-02T13:45:00',
    eventsSubmitted: 4,
    status: 'active',
  },
  {
    id: '7',
    name: 'David Lee',
    email: 'david@example.com',
    registeredDate: '2023-07-22T16:50:00',
    lastLogin: '2023-11-01T08:30:00',
    eventsSubmitted: 1,
    status: 'active',
  },
  {
    id: '8',
    name: 'Lisa Chen',
    email: 'lisa@example.com',
    registeredDate: '2023-08-14T09:15:00',
    lastLogin: '2023-10-25T15:20:00',
    eventsSubmitted: 2,
    status: 'active',
  },
  {
    id: '9',
    name: 'Jennifer Adams',
    email: 'jennifer@example.com',
    registeredDate: '2023-09-05T10:45:00',
    lastLogin: '2023-11-06T12:10:00',
    eventsSubmitted: 6,
    status: 'active',
  },
  {
    id: '10',
    name: 'Mark Wilson',
    email: 'mark@example.com',
    registeredDate: '2023-10-10T13:30:00',
    lastLogin: '2023-10-15T09:50:00',
    eventsSubmitted: 0,
    status: 'suspended',
  },
]
const UserManagement = () => {
  const [users, setUsers] = useState<User[]>(mockUsers)
  const [selectedUser, setSelectedUser] = useState<User | null>(null)
  const [showUserModal, setShowUserModal] = useState(false)
  const [showResetPasswordModal, setShowResetPasswordModal] = useState(false)
  const handleViewUser = (user: User) => {
    setSelectedUser(user)
    setShowUserModal(true)
  }
  const handleResetPassword = (id: string) => {
    setSelectedUser(users.find((user) => user.id === id) || null)
    setShowResetPasswordModal(true)
  }
  const handleDeleteUser = (id: string) => {
    if (
      window.confirm(
        'Are you sure you want to delete this user? This action cannot be undone.',
      )
    ) {
      setUsers(users.filter((user) => user.id !== id))
    }
  }
  const handleUpdateUserStatus = (id: string, status: User['status']) => {
    setUsers(
      users.map((user) =>
        user.id === id
          ? {
              ...user,
              status,
            }
          : user,
      ),
    )
    setShowUserModal(false)
  }
  const confirmResetPassword = () => {
    // In a real app, this would call an API to reset the password
    alert(`Password reset email sent to ${selectedUser?.email}`)
    setShowResetPasswordModal(false)
  }
  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">User Management</h1>
        <p className="mt-1 text-sm text-gray-600">
          Manage registered users and their accounts
        </p>
      </div>
      <UserTable
        users={users}
        onView={handleViewUser}
        onResetPassword={handleResetPassword}
        onDelete={handleDeleteUser}
      />
      {/* User Detail Modal */}
      {showUserModal && selectedUser && (
        <div className="fixed inset-0 overflow-y-auto z-50">
          <div className="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
              className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
              onClick={() => setShowUserModal(false)}
            ></div>
            <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
              <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start">
                  <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 className="text-lg leading-6 font-medium text-gray-900">
                      User Details
                    </h3>
                    <div className="mt-4">
                      <div className="flex items-center mb-4">
                        <div className="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-lg">
                          {selectedUser.name.charAt(0)}
                        </div>
                        <div className="ml-4">
                          <p className="text-lg font-medium text-gray-900">
                            {selectedUser.name}
                          </p>
                          <p className="text-sm text-gray-500">
                            {selectedUser.email}
                          </p>
                        </div>
                      </div>
                      <div className="border-t border-gray-200 py-4">
                        <dl className="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                          <div className="sm:col-span-1">
                            <dt className="text-sm font-medium text-gray-500">
                              Registration Date
                            </dt>
                            <dd className="mt-1 text-sm text-gray-900">
                              {new Date(
                                selectedUser.registeredDate,
                              ).toLocaleDateString()}
                            </dd>
                          </div>
                          <div className="sm:col-span-1">
                            <dt className="text-sm font-medium text-gray-500">
                              Last Login
                            </dt>
                            <dd className="mt-1 text-sm text-gray-900">
                              {new Date(
                                selectedUser.lastLogin,
                              ).toLocaleDateString()}
                            </dd>
                          </div>
                          <div className="sm:col-span-1">
                            <dt className="text-sm font-medium text-gray-500">
                              Events Submitted
                            </dt>
                            <dd className="mt-1 text-sm text-gray-900">
                              {selectedUser.eventsSubmitted}
                            </dd>
                          </div>
                          <div className="sm:col-span-1">
                            <dt className="text-sm font-medium text-gray-500">
                              Status
                            </dt>
                            <dd className="mt-1">
                              <span
                                className={`px-2 py-1 text-xs font-medium rounded-full 
                                ${selectedUser.status === 'active' ? 'bg-green-100 text-green-800' : selectedUser.status === 'inactive' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800'}`}
                              >
                                {selectedUser.status.charAt(0).toUpperCase() +
                                  selectedUser.status.slice(1)}
                              </span>
                            </dd>
                          </div>
                        </dl>
                      </div>
                      <div className="border-t border-gray-200 pt-4">
                        <h4 className="text-sm font-medium text-gray-500 mb-2">
                          Update Status
                        </h4>
                        <div className="flex space-x-3">
                          <button
                            onClick={() =>
                              handleUpdateUserStatus(selectedUser.id, 'active')
                            }
                            className={`px-3 py-1 text-xs font-medium rounded-full border ${selectedUser.status === 'active' ? 'bg-green-100 text-green-800 border-green-200' : 'bg-white text-gray-600 border-gray-300 hover:bg-green-50'}`}
                          >
                            Active
                          </button>
                          <button
                            onClick={() =>
                              handleUpdateUserStatus(
                                selectedUser.id,
                                'inactive',
                              )
                            }
                            className={`px-3 py-1 text-xs font-medium rounded-full border ${selectedUser.status === 'inactive' ? 'bg-gray-100 text-gray-800 border-gray-200' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50'}`}
                          >
                            Inactive
                          </button>
                          <button
                            onClick={() =>
                              handleUpdateUserStatus(
                                selectedUser.id,
                                'suspended',
                              )
                            }
                            className={`px-3 py-1 text-xs font-medium rounded-full border ${selectedUser.status === 'suspended' ? 'bg-red-100 text-red-800 border-red-200' : 'bg-white text-gray-600 border-gray-300 hover:bg-red-50'}`}
                          >
                            Suspended
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                  type="button"
                  className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={() => setShowUserModal(false)}
                >
                  Close
                </button>
                <button
                  type="button"
                  className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={() => {
                    setShowUserModal(false)
                    handleResetPassword(selectedUser.id)
                  }}
                >
                  Reset Password
                </button>
                <button
                  type="button"
                  className="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={() => {
                    setShowUserModal(false)
                    handleDeleteUser(selectedUser.id)
                  }}
                >
                  Delete User
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
      {/* Reset Password Modal */}
      {showResetPasswordModal && selectedUser && (
        <div className="fixed inset-0 overflow-y-auto z-50">
          <div className="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
              className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
              onClick={() => setShowResetPasswordModal(false)}
            ></div>
            <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
              <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div className="sm:flex sm:items-start">
                  <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 className="text-lg leading-6 font-medium text-gray-900">
                      Reset User Password
                    </h3>
                    <div className="mt-2">
                      <p className="text-sm text-gray-500">
                        Are you sure you want to reset the password for{' '}
                        {selectedUser.name} ({selectedUser.email})? This will
                        send a password reset link to the user's email.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                  type="button"
                  className="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={confirmResetPassword}
                >
                  Reset Password
                </button>
                <button
                  type="button"
                  className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                  onClick={() => setShowResetPasswordModal(false)}
                >
                  Cancel
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  )
}
export default UserManagement
