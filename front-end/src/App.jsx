import * as Page from './Pages';
import * as ProtectedPage from './Pages/PROTECTED';
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from 'react-router-dom';

function App() {
  return (
    <>
      <Router>
        <Routes>
          <Route path="/" element={<Navigate to="/login" />} />
          <Route path="/login" element={<Page.Login />} />
          <Route path="/register" element={<Page.Register />} />
          <Route path="/dashboard" element={<ProtectedPage.Dashboard />} />
          <Route path="*" element={<Page.Error />} />
        </Routes>
      </Router>
    </>
  );
}

export default App;
