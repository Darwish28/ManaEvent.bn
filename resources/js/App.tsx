import { BrowserRouter } from "react-router-dom";
import AppRouter from "./Admin/AdminRouter";
import axios from 'axios';
import { AdminAuthProvider } from "./Admin/Context/AdminAuthContext";

function App() {
  return (
    <BrowserRouter>
      <AppRouter />
    </BrowserRouter>
  );
}

// ✅ Always send cookies/session with every request
axios.defaults.withCredentials = true;

// ✅ Set base URL for Laravel backend (adjust to your case)
axios.defaults.baseURL = import.meta.env.VITE_API_BASE_URL;

// ✅ Attach CSRF token automatically
const token = document
  .querySelector('meta[name="csrf-token"]')
  ?.getAttribute('content');

if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default App;

