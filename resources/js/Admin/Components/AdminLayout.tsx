import React, { useState } from 'react'
import { Outlet, NavLink, useNavigate } from 'react-router-dom'
import { useAdminAuth } from '../Context/AdminAuthContext'
import "../../../css/app.css";

import {
  LayoutDashboardIcon,
  ClipboardListIcon,
  CalendarPlusIcon,
  UsersIcon,
  BellIcon,
  SettingsIcon,
  LogOutIcon,
  MenuIcon,
  XIcon,
} from 'lucide-react'
const AdminLayout = () => {
  const { logout, adminUser } = useAdminAuth()
  const navigate = useNavigate()
  const [sidebarOpen, setSidebarOpen] = useState(false)
  const handleLogout = () => {
    logout()
    navigate('/admin/login')
  }
  const navItems = [
    {
      name: 'Dashboard',
      path: '/admin',
      icon: <LayoutDashboardIcon size={20} />,
    },
    {
      name: 'Event Submissions',
      path: '/admin/submissions',
      icon: <ClipboardListIcon size={20} />,
    },
    {
      name: 'Publish Event',
      path: '/admin/publish',
      icon: <CalendarPlusIcon size={20} />,
    },
    {
      name: 'User Management',
      path: '/admin/users',
      icon: <UsersIcon size={20} />,
    },
    {
      name: 'Notification Settings',
      path: '/admin/notifications',
      icon: <BellIcon size={20} />,
    },
    {
      name: 'Admin Settings',
      path: '/admin/settings',
      icon: <SettingsIcon size={20} />,
    },
  ]
  return (
    <div className="flex h-screen bg-gray-100">
      {/* Mobile sidebar toggle */}
      <div className="lg:hidden fixed top-0 left-0 z-20 p-4">
        <button
          onClick={() => setSidebarOpen(!sidebarOpen)}
          className="text-gray-600 focus:outline-none"
        >
          {sidebarOpen ? <XIcon size={24} /> : <MenuIcon size={24} />}
        </button>
      </div>
      {/* Sidebar */}
      <div
        className={`fixed inset-y-0 left-0 transform ${sidebarOpen ? 'translate-x-0' : '-translate-x-full'} lg:translate-x-0 transition duration-200 ease-in-out lg:relative lg:inset-0 z-10 w-64 bg-white shadow-lg`}
      >
        <div className="flex flex-col h-full">
          <div className="px-4 py-6 border-b">
            <h1 className="text-2xl font-bold text-blue-600">ManaEvent</h1>
            <p className="text-sm text-gray-600 mt-1">Admin Panel</p>
          </div>
          <div className="flex-1 px-4 py-6 overflow-y-auto">
            <nav className="space-y-1">
              {navItems.map((item) => (
                <NavLink
                  key={item.path}
                  to={item.path}
                  className={({ isActive }) =>
                    `flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors ${isActive ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100'}`
                  }
                  onClick={() => setSidebarOpen(false)}
                >
                  <span className="mr-3">{item.icon}</span>
                  {item.name}
                </NavLink>
              ))}
            </nav>
          </div>
          <div className="px-4 py-4 border-t">
            <div className="flex items-center mb-4">
              <div className="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                {adminUser?.name.charAt(0) || 'A'}
              </div>
              <div className="ml-3">
                <p className="text-sm font-medium text-gray-700">
                  {adminUser?.name || 'Admin User'}
                </p>
                <p className="text-xs text-gray-500">Administrator</p>
              </div>
            </div>
            <button
              onClick={handleLogout}
              className="flex items-center w-full px-4 py-2 text-sm font-medium text-red-600 rounded-md hover:bg-red-50 transition-colors"
            >
              <LogOutIcon size={18} className="mr-2" />
              Logout
            </button>
          </div>
        </div>
      </div>
      {/* Main content */}
      <div className="flex-1 overflow-x-hidden overflow-y-auto">
        <div className="container mx-auto px-6 py-8">
          <Outlet />
        </div>
      </div>
    </div>
  )
}
export default AdminLayout
