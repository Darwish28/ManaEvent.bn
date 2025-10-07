import { BrowserRouter, Routes, Route } from "react-router-dom";
import AdminRouter from "./Admin/AdminRouter";

export default function AppRouter() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Admin routes */}
        <Route path="/admin/*" element={<AdminRouter />} />

        {/* Public site routes (later you can add Home, etc.) */}
        {/* <Route path="/" element={<Home />} /> */}
      </Routes>
    </BrowserRouter>
  );
}
