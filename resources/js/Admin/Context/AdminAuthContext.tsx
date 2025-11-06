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
  loading: boolean
  setIsAuthenticated: (value: boolean) => void
  login: (adminId: string, password: string) => Promise<boolean>
  logout: () => Promise<void>
}

const AdminAuthContext = createContext<AdminAuthContextType>({
  isAuthenticated: false,
  adminUser: null,
  loading: true,
  setIsAuthenticated: () => {},
  login: async () => false,
  logout: async () => {},
})

export const useAdminAuth = () => useContext(AdminAuthContext)

export const AdminAuthProvider = ({ children }: { children: React.ReactNode }) => {
  const [isAuthenticated, setIsAuthenticated] = useState(false)
  const [adminUser, setAdminUser] = useState<AdminUser | null>(null)
  const [loading, setLoading] = useState(true)

  axios.defaults.withCredentials = true
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
  axios.defaults.baseURL = 'http://manaeventbn.duckdns.org'

  // ✅ Verify Laravel session on app load
  useEffect(() => {
    axios
      .get('/api/admin/me')
      .then((res) => {
        if (res.data?.authenticated) {
          setIsAuthenticated(true)
          setAdminUser(res.data.user)
        }
      })
      .catch(() => {
        setIsAuthenticated(false)
        setAdminUser(null)
      })
      .finally(() => setLoading(false))
  }, [])

  // ✅ Login
  const login = async (adminId: string, password: string): Promise<boolean> => {
    try {
      await axios.get('/sanctum/csrf-cookie')

      const res = await axios.post(
        '/admin/login',
        { admin_id: adminId, password },
        { withCredentials: true }
      )

      if (res.status === 200 && res.data?.success) {
        const me = await axios.get('/api/admin/me', { withCredentials: true })
        if (me.data?.authenticated) {
          setIsAuthenticated(true)
          setAdminUser(me.data.user)
          return true
        }
      }
      return false
    } catch (error) {
      console.error('❌ Login failed:', error)
      return false
    }
  }

  // ✅ Logout
  const logout = async (): Promise<void> => {
    try {
      await axios.post('/admin/logout', {}, { withCredentials: true })
    } catch (error) {
      console.warn('Logout error (ignored):', error)
    }
    setIsAuthenticated(false)
    setAdminUser(null)
  }

  return (
    <AdminAuthContext.Provider
      value={{
        isAuthenticated,
        adminUser,
        loading,
        setIsAuthenticated,
        login,
        logout,
      }}
    >
      {children}
    </AdminAuthContext.Provider>
  )
}
