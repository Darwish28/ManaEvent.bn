import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import AdminRouter from "./Admin/AdminRouter";
import "../css/app.css";


ReactDOM.createRoot(document.getElementById("root") as HTMLElement).render(
  <React.StrictMode>
    <BrowserRouter basename="/admin">
      <AdminRouter />
    </BrowserRouter>
  </React.StrictMode>
);
