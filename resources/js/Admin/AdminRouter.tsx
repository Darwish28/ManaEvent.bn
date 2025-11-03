import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";

// ✅ Pages
import AdminLogin from "./Pages/Login";
import AdminDashboard from "./Pages/Dashboard";
import EventSubmissions from "./Pages/EventSubmission";
import PublishEvent from "./Pages/PublishEvent";
import UserManagement from "./Pages/UserManagement";
import NotificationSettings from "./Pages/NotificationSettings";
import AdminSettings from "./Pages/AdminSettings";

// ✅ Components
import AdminLayout from "./Components/AdminLayout";

// ✅ Context
import { AdminAuthProvider, useAdminAuth } from "./Context/AdminAuthContext";

// ✅ Protected Route wrapper
const ProtectedRoute = ({ children }: { children: React.ReactNode }) => {
  const { isAuthenticated, loading } = useAdminAuth();
  
  // Wait until auth check finishes
  if (loading) {
    return <div className="text-center mt-10 text-gray-500">Checking session...</div>;
  }

  if (!isAuthenticated) {
    // Redirect unauthenticated users to /login
    return <Navigate to="/login" replace />;
  }

  return <>{children}</>;
};

// ✅ Main Router
export default function AdminRouter() {
  return (
    <AdminAuthProvider>
      <Routes>
        {/* Public route */}
        <Route path="/login" element={<AdminLogin />} />

        {/* Protected routes under /admin/* */}
        <Route
          path="/"
          element={
            <ProtectedRoute>
              <AdminLayout />
            </ProtectedRoute>
          }
        >
          <Route index element={<AdminDashboard />} />
          <Route path="dashboard" element={<AdminDashboard />} /> 
          <Route path="submissions" element={<EventSubmissions />} />
          <Route path="publish" element={<PublishEvent />} />
          <Route path="users" element={<UserManagement />} />
          <Route path="notifications" element={<NotificationSettings />} />
          <Route path="settings" element={<AdminSettings />} />
        </Route>

        {/* Catch all — redirect to dashboard if path doesn’t exist */}
        <Route path="*" element={<Navigate to="/login" replace />} />
      </Routes>
    </AdminAuthProvider>
  )};

