import React, { useState } from 'react'
import { useAdminAuth } from '../Context/AdminAuthContext'
import { EyeIcon, EyeOffIcon, DownloadIcon, LogOutIcon } from 'lucide-react'
const AdminSettings = () => {
  const { adminUser, logout } = useAdminAuth()
  const [currentPassword, setCurrentPassword] = useState('')
  const [newPassword, setNewPassword] = useState('')
  const [confirmPassword, setConfirmPassword] = useState('')
  const [showCurrentPassword, setShowCurrentPassword] = useState(false)
  const [showNewPassword, setShowNewPassword] = useState(false)
  const [showConfirmPassword, setShowConfirmPassword] = useState(false)
  const [error, setError] = useState('')
  const [success, setSuccess] = useState('')
  const [isChangingPassword, setIsChangingPassword] = useState(false)
  const [isExporting, setIsExporting] = useState(false)
  const handleChangePassword = (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    setSuccess('')
    // Validate passwords
    if (!currentPassword || !newPassword || !confirmPassword) {
      setError('All password fields are required')
      return
    }
    if (newPassword !== confirmPassword) {
      setError('New password and confirmation do not match')
      return
    }
    if (newPassword.length < 8) {
      setError('New password must be at least 8 characters long')
      return
    }
    // Simulate password change
    setIsChangingPassword(true)
    setTimeout(() => {
      setIsChangingPassword(false)
      setSuccess('Password has been changed successfully')
      setCurrentPassword('')
      setNewPassword('')
      setConfirmPassword('')
    }, 1000)
  }
  const handleExportData = (dataType: string) => {
    setIsExporting(true)
    // Simulate data export
    setTimeout(() => {
      setIsExporting(false)
      alert(`${dataType} data exported successfully`)
    }, 1500)
  }
  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">Admin Settings</h1>
        <p className="mt-1 text-sm text-gray-600">
          Manage your admin account and system settings
        </p>
      </div>
      <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {/* Account Settings */}
        <div className="bg-white shadow rounded-lg overflow-hidden">
          <div className="px-6 py-5 border-b border-gray-200">
            <h3 className="text-lg font-medium text-gray-900">
              Account Settings
            </h3>
          </div>
          <div className="p-6">
            <div className="flex items-center mb-6">
              <div className="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold text-xl">
                {adminUser?.name.charAt(0) || 'A'}
              </div>
              <div className="ml-4">
                <h4 className="text-lg font-medium text-gray-900">
                  {adminUser?.name || 'Admin User'}
                </h4>
                <p className="text-sm text-gray-500">Administrator</p>
              </div>
            </div>
            {error && (
              <div className="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
                <div className="flex">
                  <div className="ml-3">
                    <p className="text-sm text-red-700">{error}</p>
                  </div>
                </div>
              </div>
            )}
            {success && (
              <div className="mb-4 bg-green-50 border-l-4 border-green-500 p-4">
                <div className="flex">
                  <div className="ml-3">
                    <p className="text-sm text-green-700">{success}</p>
                  </div>
                </div>
              </div>
            )}
            <form onSubmit={handleChangePassword} className="space-y-4">
              <div>
                <label
                  htmlFor="current-password"
                  className="block text-sm font-medium text-gray-700"
                >
                  Current Password
                </label>
                <div className="mt-1 relative rounded-md shadow-sm">
                  <input
                    type={showCurrentPassword ? 'text' : 'password'}
                    id="current-password"
                    className="block w-full pr-10 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value={currentPassword}
                    onChange={(e) => setCurrentPassword(e.target.value)}
                  />
                  <button
                    type="button"
                    className="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                    onClick={() => setShowCurrentPassword(!showCurrentPassword)}
                  >
                    {showCurrentPassword ? (
                      <EyeOffIcon className="h-5 w-5" aria-hidden="true" />
                    ) : (
                      <EyeIcon className="h-5 w-5" aria-hidden="true" />
                    )}
                  </button>
                </div>
              </div>
              <div>
                <label
                  htmlFor="new-password"
                  className="block text-sm font-medium text-gray-700"
                >
                  New Password
                </label>
                <div className="mt-1 relative rounded-md shadow-sm">
                  <input
                    type={showNewPassword ? 'text' : 'password'}
                    id="new-password"
                    className="block w-full pr-10 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value={newPassword}
                    onChange={(e) => setNewPassword(e.target.value)}
                  />
                  <button
                    type="button"
                    className="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                    onClick={() => setShowNewPassword(!showNewPassword)}
                  >
                    {showNewPassword ? (
                      <EyeOffIcon className="h-5 w-5" aria-hidden="true" />
                    ) : (
                      <EyeIcon className="h-5 w-5" aria-hidden="true" />
                    )}
                  </button>
                </div>
              </div>
              <div>
                <label
                  htmlFor="confirm-password"
                  className="block text-sm font-medium text-gray-700"
                >
                  Confirm New Password
                </label>
                <div className="mt-1 relative rounded-md shadow-sm">
                  <input
                    type={showConfirmPassword ? 'text' : 'password'}
                    id="confirm-password"
                    className="block w-full pr-10 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    value={confirmPassword}
                    onChange={(e) => setConfirmPassword(e.target.value)}
                  />
                  <button
                    type="button"
                    className="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                    onClick={() => setShowConfirmPassword(!showConfirmPassword)}
                  >
                    {showConfirmPassword ? (
                      <EyeOffIcon className="h-5 w-5" aria-hidden="true" />
                    ) : (
                      <EyeIcon className="h-5 w-5" aria-hidden="true" />
                    )}
                  </button>
                </div>
              </div>
              <div className="flex justify-end">
                <button
                  type="submit"
                  disabled={isChangingPassword}
                  className={`inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white ${isChangingPassword ? 'bg-blue-400' : 'bg-blue-600 hover:bg-blue-700'} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500`}
                >
                  {isChangingPassword ? 'Changing...' : 'Change Password'}
                </button>
              </div>
            </form>
          </div>
        </div>
        {/* Data Management */}
        <div className="bg-white shadow rounded-lg overflow-hidden">
          <div className="px-6 py-5 border-b border-gray-200">
            <h3 className="text-lg font-medium text-gray-900">
              Data Management
            </h3>
          </div>
          <div className="p-6">
            <p className="text-sm text-gray-500 mb-6">
              Export system data for backup or analysis purposes. All data is
              exported in CSV format.
            </p>
            <div className="space-y-4">
              <button
                type="button"
                onClick={() => handleExportData('Events')}
                disabled={isExporting}
                className="inline-flex items-center w-full justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                <DownloadIcon size={18} className="mr-2" />
                Export Events Data
              </button>
              <button
                type="button"
                onClick={() => handleExportData('Users')}
                disabled={isExporting}
                className="inline-flex items-center w-full justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                <DownloadIcon size={18} className="mr-2" />
                Export Users Data
              </button>
              <button
                type="button"
                onClick={() => handleExportData('System')}
                disabled={isExporting}
                className="inline-flex items-center w-full justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                <DownloadIcon size={18} className="mr-2" />
                Export System Logs
              </button>
            </div>
            <div className="mt-8 pt-6 border-t">
              <h4 className="text-base font-medium text-gray-900 mb-4">
                Account Actions
              </h4>
              <button
                type="button"
                onClick={() => logout()}
                className="inline-flex items-center w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
              >
                <LogOutIcon size={18} className="mr-2" />
                Log Out
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
export default AdminSettings
