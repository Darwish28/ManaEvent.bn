import React, { useState } from 'react'
import { BellIcon, MailIcon, InfoIcon } from 'lucide-react'
interface NotificationSetting {
  id: string
  name: string
  description: string
  enabled: boolean
  icon: React.ReactNode
}
const NotificationSettings = () => {
  const [settings, setSettings] = useState<NotificationSetting[]>([
    {
      id: 'event-approval',
      name: 'Event Approval Notifications',
      description:
        'Notify users when their submitted event is approved, rejected, or published',
      enabled: true,
      icon: <BellIcon size={20} className="text-yellow-400" />,
    },
    {
      id: 'event-reminder',
      name: 'Event Reminders',
      description:
        "Send reminders to users about upcoming events they've registered for",
      enabled: true,
      icon: <BellIcon size={20} className="text-yellow-400" />,
    },
    {
      id: 'new-registration',
      name: 'New User Registration',
      description: 'Notify admins when new users register on the platform',
      enabled: false,
      icon: <BellIcon size={20} className="text-yellow-400" />,
    },
    {
      id: 'email-marketing',
      name: 'Email Marketing',
      description:
        'Send promotional emails about featured events and platform updates',
      enabled: false,
      icon: <MailIcon size={20} className="text-yellow-400" />,
    },
    {
      id: 'weekly-digest',
      name: 'Weekly Event Digest',
      description:
        'Send users a weekly digest of upcoming events in their area',
      enabled: true,
      icon: <MailIcon size={20} className="text-yellow-500" />,
    },
  ])
  const [isSaving, setIsSaving] = useState(false)
  const [saveSuccess, setSaveSuccess] = useState(false)
  const handleToggle = (id: string) => {
    setSettings(
      settings.map((setting) =>
        setting.id === id
          ? {
              ...setting,
              enabled: !setting.enabled,
            }
          : setting,
      ),
    )
  }
  const handleSaveSettings = () => {
    setIsSaving(true)
    // Simulate API call
    setTimeout(() => {
      setIsSaving(false)
      setSaveSuccess(true)
      // Hide success message after a few seconds
      setTimeout(() => {
        setSaveSuccess(false)
      }, 3000)
    }, 1000)
  }
  return (
    <div>
      <div className="mb-6">
        <h1 className="text-2xl font-bold text-gray-900">
          Notification Settings
        </h1>
        <p className="mt-1 text-sm text-gray-600">
          Configure which notifications are sent to users and admins
        </p>
      </div>
      {saveSuccess && (
        <div className="mb-6 bg-green-50 border-l-4 border-green-500 p-4">
          <div className="flex">
            <div className="ml-3">
              <p className="text-sm text-green-700">
                Notification settings saved successfully!
              </p>
            </div>
          </div>
        </div>
      )}
      <div className="bg-white shadow rounded-lg overflow-hidden">
        <div className="p-6">
          <div className="bg-blue-50 p-4 rounded-lg mb-6 flex items-start">
            <InfoIcon
              size={20}
              className="text-red-400 mt-0.5 flex-shrink-0"
            />
            <p className="text-sm text-gray-900 ml-3">
              These settings control the automated notifications sent to users
              and administrators. Notifications can help increase user
              engagement but should be used thoughtfully to avoid overwhelming
              users.
            </p>
          </div>
          <div className="space-y-6">
            {settings.map((setting) => (
              <div
                key={setting.id}
                className="flex items-start justify-between"
              >
                <div className="flex items-start">
                  <div className="flex-shrink-0 mt-1">{setting.icon}</div>
                  <div className="ml-3">
                    <h3 className="text-base font-medium text-gray-900">
                      {setting.name}
                    </h3>
                    <p className="text-sm text-gray-500">
                      {setting.description}
                    </p>
                  </div>
                </div>
                <div className="ml-4 flex-shrink-0">
                  <button
                    type="button"
                    className={`relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-200 focus:ring-offset-2 ${setting.enabled ? 'bg-yellow-400' : 'bg-gray-200'}`}
                    role="switch"
                    aria-checked={setting.enabled}
                    onClick={() => handleToggle(setting.id)}
                  >
                    <span
                      className={`pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out ${setting.enabled ? 'translate-x-5' : 'translate-x-0'}`}
                    ></span>
                  </button>
                </div>
              </div>
            ))}
          </div>
          <div className="mt-8 border-t pt-6 flex justify-end">
            <button
              type="button"
              className="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3"
            >
              Reset to Default
            </button>
            <button
              type="button"
              onClick={handleSaveSettings}
              disabled={isSaving}
              className={`inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white ${isSaving ? 'bg-yellow-400' : 'bg-yellow-400 hover:bg-yellow-500'} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500`}
            >
              {isSaving ? 'Saving...' : 'Save Settings'}
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}
export default NotificationSettings
