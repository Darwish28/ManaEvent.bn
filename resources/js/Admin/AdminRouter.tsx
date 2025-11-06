import React from "react";
import { Routes, Route, Navigate } from "react-router-dom";

import AdminLogin from "./Pages/Login";
import AdminDashboard from "./Pages/Dashboard";
import EventSubmissions from "./Pages/EventSubmission";
import PublishEvent from "./Pages/PublishEvent";
import UserManagement from "./Pages/UserManagement";
import AdminSettings from "./Pages/AdminSettings";
import AdminLayout from "./Components/AdminLayout";

// Authentication removed from router - admin dashboard will handle auth checks internally.
export default function AdminRouter() {
  return (
    <Routes>
      {/* Ensure URLs stay under /admin/* */}
      <Route path="/login" element={<AdminLogin />} />

      <Route
        path="/"
        element={<AdminLayout />}
      >
        <Route index element={<AdminDashboard />} />
        <Route path="dashboard" element={<AdminDashboard />} />
        <Route path="submissions" element={<EventSubmissions />} />
        <Route path="publish" element={<PublishEvent />} />
        <Route path="users" element={<UserManagement />} />
        <Route path="settings" element={<AdminSettings />} />
      </Route>

      {/* Redirect anything unknown back to /admin/login */}
      <Route path="*" element={<Navigate to="/login" replace />} />
    </Routes>
  );
}
