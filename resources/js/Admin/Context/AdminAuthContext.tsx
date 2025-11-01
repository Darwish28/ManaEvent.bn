import React, { useEffect, useState, createContext, useContext } from 'react'
import axios from 'axios'

interface AdminUser {
  id: number
  admin_id: string
  name: string
  email?: string
}

interface AdminAuthContextType {
  isAuthenticated: boolean
  adminUser: AdminUser | null
  setIsAuthenticated: (value: boolean) => void
  login: (adminId: string, password: string) => Promise<boolean>
  logout: () => Promise<void>
}

const AdminAuthContext = createContext<AdminAuthContextType>({
  isAuthenticated: false,
  adminUser: null,
  setIsAuthenticated: () => {},
  login: async () => false,
  logout: async () => {},
})

export const useAdminAuth = () => useContext(AdminAuthContext)

export const AdminAuthProvider = ({ children }: { children: React.ReactNode }) => {
  const [isAuthenticated, setIsAuthenticated] = useState(() => {
    // ✅ Load from localStorage if available
    const stored = localStorage.getItem('adminAuth')
    if (stored) {
      try {
        const data = JSON.parse(stored)
        return !!data.authenticated
      } catch {
        return false
      }
    }
    return false
  })

  const [adminUser, setAdminUser] = useState<AdminUser | null>(() => {
    const stored = localStorage.getItem('adminAuth')
    if (stored) {
      try {
        const data = JSON.parse(stored)
        return data.user || null
      } catch {
        return null
      }
    }
    return null
  })

  // ✅ Always include cookies and CSRF headers for Laravel
  axios.defaults.withCredentials = true
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
  axios.defaults.baseURL = 'http://manaevent.bn.test'

  // ✅ Sync auth state to localStorage whenever it changes
  useEffect(() => {
    localStorage.setItem(
      'adminAuth',
      JSON.stringify({ authenticated: isAuthenticated, user: adminUser })
    )
  }, [isAuthenticated, adminUser])

  // ✅ Login function
  const login = async (adminId: string, password: string): Promise<boolean> => {
    try {
      await axios.get('/sanctum/csrf-cookie')

      const res = await axios.post(
        '/admin/login',
        { admin_id: adminId, password },
        { withCredentials: true }
      )

      if (res.status === 200 && res.data?.success) {
        // Optional: verify via /api/admin/me
        const me = await axios.get('/api/admin/me', { withCredentials: true })

        if (me.data?.authenticated) {
          setIsAuthenticated(true)
          setAdminUser(me.data.user)
          localStorage.setItem(
            'adminAuth',
            JSON.stringify({ authenticated: true, user: me.data.user })
          )
          return true
        }
      }
      return false
    } catch (error) {
      console.error('❌ Login failed:', error)
      return false
    }
  }

  // ✅ Logout function
  const logout = async (): Promise<void> => {
    try {
      await axios.post('/admin/logout', {}, { withCredentials: true })
    } catch (error) {
      console.warn('Logout error (ignored):', error)
    }
    setIsAuthenticated(false)
    setAdminUser(null)
    localStorage.removeItem('adminAuth')
  }

  return (
    <AdminAuthContext.Provider
      value={{
        isAuthenticated,
        adminUser,
        setIsAuthenticated,
        login,
        logout,
      }}
    >
      {children}
    </AdminAuthContext.Provider>
  )
}
