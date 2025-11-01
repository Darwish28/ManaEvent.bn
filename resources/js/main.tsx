import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import AdminRouter from "./Admin/AdminRouter";
import "../css/app.css";
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://manaevent.bn.test';

const token = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

ReactDOM.createRoot(document.getElementById("root") as HTMLElement).render(
  <React.StrictMode>
    <BrowserRouter basename="/admin">
      <AdminRouter />
    </BrowserRouter>
  </React.StrictMode>
);
