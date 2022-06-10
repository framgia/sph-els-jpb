import * as Page from './Pages';
import * as ProtectedPage from './Pages/_PROTECTED';
import * as Middleware from './App/Middlewares';
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
          {/*--------------- Public Routes ---------------*/}
          <Route path="/" element={<Navigate to="/register" />} />
          <Route path="/login" element={<Page.Login />} />
          <Route path="/register" element={<Page.Register />} />
          <Route path="*" element={<Page.Error />} />

          {/*--------------- User Private Routes ---------------*/}
          <Route
            path="/dashboard"
            element={
              <Middleware.UserProtectedRoutes>
                <ProtectedPage.Dashboard />
              </Middleware.UserProtectedRoutes>
            }
          />

          {/*--------------- Admin Private Routes ---------------*/}
          <Route path="/admin" element={<Navigate to="/admin/dashboard" />} />
          <Route exact path="/admin/*" element={<Page.Error />} />
          <Route
            path="/admin/dashboard"
            element={
              <Middleware.AdminProtectedRoutes>
                <ProtectedPage.AdminDashboard />
              </Middleware.AdminProtectedRoutes>
            }
          />
        </Routes>
      </Router>
    </>
  );
}

export default App;
