import { BrowserRouter } from "react-router-dom";
import AppRouter from "./Admin/AdminRouter";

function App() {
  return (
    <BrowserRouter>
      <AppRouter />
    </BrowserRouter>
  );
}

export default App;

