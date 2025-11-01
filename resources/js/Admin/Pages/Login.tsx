import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { EyeIcon, EyeOffIcon } from 'lucide-react'
import axios from 'axios'
import "../../../css/app.css";
import { useAdminAuth } from '../Context/AdminAuthContext'

axios.defaults.withCredentials = true
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

const AdminLogin = () => {
  const [adminId, setAdminId] = useState('')
  const [password, setPassword] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [error, setError] = useState('')
  const [isLoading, setIsLoading] = useState(false)
  const navigate = useNavigate()
  const { setIsAuthenticated } = useAdminAuth() // ✅ Correct hook placement (top level)

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    setIsLoading(true)

    try {
      // ✅ Step 1: Refresh CSRF cookie
      await axios.get('/sanctum/csrf-cookie', { withCredentials: true })

      // ✅ Step 2: Attempt login
      const res = await axios.post(
        '/admin/login',
        { admin_id: adminId, password },
        { withCredentials: true }
      )

      console.log('✅ Login response:', res.data)

      if (res.data?.success) {
        // ✅ Step 3: Verify admin identity
        const me = await axios.get('/api/admin/me', { withCredentials: true })
        console.log('✅ Me response:', me.data)

        if (me.data?.authenticated) {
          // ✅ Set auth state + store locally
          setIsAuthenticated(true)
          localStorage.setItem('adminAuth', JSON.stringify({
            authenticated: true,
            user: me.data.user
          }))

          console.log('🧭 Navigating to dashboard now...')
          navigate('/dashboard')
          return
        } else {
          setError('Session not established. Try again.')
        }
      } else {
        setError('Invalid Admin ID or Password.')
      }
    } catch (err: any) {
      console.error('❌ Login error:', err)
      if (err.response?.status === 422) {
        setError('Both Admin ID and Password are required.')
      } else if (err.response?.status === 401) {
        setError('Invalid Admin ID or Password.')
      } else {
        setError('Login failed. Please try again later.')
      }
    } finally {
      setIsLoading(false)
    }
  }

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <div className="text-center">
          <h1 className="text-3xl font-extrabold text-yellow-400">ManaEvent</h1>
          <h2 className="mt-6 text-2xl font-bold text-gray-900">Admin Login</h2>
          <p className="mt-2 text-sm text-gray-600">
            Enter your credentials to access the admin dashboard
          </p>
        </div>

        {error && (
          <div className="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
            <p className="text-sm text-red-700">{error}</p>
          </div>
        )}

        <form className="mt-8 space-y-6" onSubmit={handleSubmit}>
          <div className="rounded-md shadow-sm -space-y-px">
            <div>
              <label htmlFor="admin_id" className="sr-only">Admin ID</label>
              <input
                id="admin_id"
                name="admin_id"
                type="text"
                className="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400 focus:z-10 sm:text-sm"
                placeholder="Admin ID"
                value={adminId}
                onChange={(e) => setAdminId(e.target.value)}
                required
              />
            </div>
            <div className="relative">
              <label htmlFor="password" className="sr-only">Password</label>
              <input
                id="password"
                name="password"
                type={showPassword ? 'text' : 'password'}
                className="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400 focus:z-10 sm:text-sm"
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
              <button
                type="button"
                className="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                onClick={() => setShowPassword(!showPassword)}
              >
                {showPassword ? (
                  <EyeOffIcon className="h-5 w-5" aria-hidden="true" />
                ) : (
                  <EyeIcon className="h-5 w-5" aria-hidden="true" />
                )}
              </button>
            </div>
          </div>

          <div className="flex items-center justify-between">
            <div className="flex items-center">
              <input
                id="remember-me"
                name="remember-me"
                type="checkbox"
                className="h-4 w-4 text-yellow-400 focus:ring-yellow-500 border-gray-300 rounded"
              />
              <label htmlFor="remember-me" className="ml-2 block text-sm text-gray-900">
                Remember me
              </label>
            </div>
            <div className="text-sm">
              <a href="#" className="font-medium text-gray-700 hover:text-yellow-400">
                Forgot your password?
              </a>
            </div>
          </div>

          <div>
            <button
              type="submit"
              disabled={isLoading}
              className={`group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white ${
                isLoading
                  ? 'bg-yellow-300 cursor-not-allowed'
                  : 'bg-yellow-400 hover:bg-yellow-500'
              } focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400`}
            >
              {isLoading ? 'Signing in...' : 'Sign in'}
            </button>
          </div>
        </form>
      </div>
    </div>
  )
}

export default AdminLogin
