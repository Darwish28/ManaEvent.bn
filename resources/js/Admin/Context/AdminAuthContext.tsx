import React, { useEffect, useState, createContext, useContext } from 'react'
interface AdminAuthContextType {
  isAuthenticated: boolean
  login: (adminId: string, password: string) => Promise<boolean>
  logout: () => void
  adminUser: {
    id: string
    name: string
  } | null
}
const AdminAuthContext = createContext<AdminAuthContextType>({
  isAuthenticated: false,
  login: async () => false,
  logout: () => {},
  adminUser: null,
})
export const useAdminAuth = () => useContext(AdminAuthContext)
export const AdminAuthProvider = ({
  children,
}: {
  children: React.ReactNode
}) => {
  const [isAuthenticated, setIsAuthenticated] = useState(false)
  const [adminUser, setAdminUser] = useState<{
    id: string
    name: string
  } | null>(null)
  // Check if user is already logged in on initial load
  useEffect(() => {
    const storedAuth = localStorage.getItem('adminAuth')
    if (storedAuth) {
      const authData = JSON.parse(storedAuth)
      setIsAuthenticated(true)
      setAdminUser(authData.user)
    }
  }, [])
  // Mock login function (in a real app, this would call an API)
  const login = async (adminId: string, password: string): Promise<boolean> => {
    // Mock validation - in a real app this would be a server call
    if (adminId === 'admin' && password === 'password123') {
      const userData = {
        id: adminId,
        name: 'Admin User',
      }
      setIsAuthenticated(true)
      setAdminUser(userData)
      // Store auth in localStorage for persistence
      localStorage.setItem(
        'adminAuth',
        JSON.stringify({
          authenticated: true,
          user: userData,
        }),
      )
      return true
    }
    return false
  }
  const logout = () => {
    setIsAuthenticated(false)
    setAdminUser(null)
    localStorage.removeItem('adminAuth')
  }
  return (
    <AdminAuthContext.Provider
      value={{
        isAuthenticated,
        login,
        logout,
        adminUser,
      }}
    >
      {children}
    </AdminAuthContext.Provider>
  )
}
