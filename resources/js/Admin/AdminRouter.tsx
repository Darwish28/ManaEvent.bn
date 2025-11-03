import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";

import AdminLogin from "./Pages/Login";
import AdminDashboard from "./Pages/Dashboard";
import EventSubmissions from "./Pages/EventSubmission";
import PublishEvent from "./Pages/PublishEvent";
import UserManagement from "./Pages/UserManagement";
import NotificationSettings from "./Pages/NotificationSettings";
import AdminSettings from "./Pages/AdminSettings";
import AdminLayout from "./Components/AdminLayout";

import { AdminAuthProvider, useAdminAuth } from "./Context/AdminAuthContext";

const ProtectedRoute = ({ children }: { children: React.ReactNode }) => {
  const { isAuthenticated, loading } = useAdminAuth();

  if (loading) {
    return <div className="text-center mt-10 text-gray-500">Checking session...</div>;
  }

  if (!loading && !isAuthenticated) {
    console.warn("🔒 Redirecting: Auth state is false after check");
    return <Navigate to="/login" replace />;
  }

  return <>{children}</>;
};

export default function AdminRouter() {
  return (
    <AdminAuthProvider>
      <Routes>
        {/* ✅ This ensures URLs stay under /admin/* */}
        <Route path="/login" element={<AdminLogin />} />

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

        {/* ✅ Redirect anything unknown back to /admin/login */}
        <Route path="*" element={<Navigate to="/login" replace />} />
      </Routes>
    </AdminAuthProvider>
  );
}
