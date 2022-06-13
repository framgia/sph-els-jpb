import * as Page from './Pages';
import * as ProtectedPage from './Pages/_PROTECTED';
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Navigate,
} from 'react-router-dom';
import AuthChecker from './App/Middlewares/AuthChecker';

function App() {
  const roles = {
    admin: 'admin',
    user: 'user',
    guest: 'guest',
  };

  return (
    <>
      <Router>
        <Routes>
          {/*--------------- Public Routes ---------------*/}
          <Route path="*" element={<Page.Error />} />

          <Route element={<AuthChecker userRoles={roles.guest} />}>
            <Route path="/" element={<Navigate to="/login" />} />
            <Route path="/login" element={<Page.Login />} />
            <Route path="/register" element={<Page.Register />} />
          </Route>

          {/*--------------- User Private Routes ---------------*/}
          <Route element={<AuthChecker userRoles={roles.user} />}>
            <Route path="/" element={<Navigate to="/dashboard" />} />
            <Route path="/dashboard" element={<ProtectedPage.Dashboard />} />
          </Route>

          {/*--------------- Admin Private Routes ---------------*/}
          <Route element={<AuthChecker userRoles={roles.admin} />}>
            <Route path="/" element={<Navigate to="/admin" />} />
            <Route path="/admin" element={<ProtectedPage.AdminDashboard />} />
          </Route>
        </Routes>
      </Router>
    </>
  );
}

export default App;
