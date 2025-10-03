import { Routes, Route, Navigate } from "react-router-dom";

// Pages
import AdminLogin from "./Pages/Login";
import AdminDashboard from "./Pages/Dashboard";
import EventSubmissions from "./Pages/Eventsubmission";
import PublishEvent from "./Pages/PublishEvent";
import UserManagement from "./Pages/UserManagement";
import NotificationSettings from "./Pages/NotificationSettings";
import AdminSettings from "./Pages/AdminSettings";

// Components
import AdminLayout from "./Components/AdminLayout";

// Context
import { AdminAuthProvider, useAdminAuth } from "./Context/AdminAuthContext";

// ✅ Protected Route wrapper
const ProtectedRoute = ({ children }: { children: React.ReactNode }) => {
  const { isAuthenticated } = useAdminAuth();
  if (!isAuthenticated) {
    return <Navigate to="/admin/login" replace />;
  }
  return <>{children}</>;
};

export default function AdminRouter() {
  return (
    <AdminAuthProvider>
      <Routes>
        {/* Public route */}
        <Route path="/admin/login" element={<AdminLogin />} />

        {/* Protected admin routes */}
        <Route
          path="/admin"
          element={
            <ProtectedRoute>
              <AdminLayout />
            </ProtectedRoute>
          }
        >
          <Route index element={<AdminDashboard />} />
          <Route path="submissions" element={<EventSubmissions />} />
          <Route path="publish" element={<PublishEvent />} />
          <Route path="users" element={<UserManagement />} />
          <Route path="notifications" element={<NotificationSettings />} />
          <Route path="settings" element={<AdminSettings />} />
        </Route>
      </Routes>
    </AdminAuthProvider>
  );
}
