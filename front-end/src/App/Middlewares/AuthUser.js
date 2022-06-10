import { Navigate } from 'react-router-dom';
import { useCookies } from 'react-cookie';

export const UserProtectedRoutes = ({ children }) => {
  const [cookie] = useCookies();

  const userState = cookie.user === undefined ? false : cookie.user.is_active;
  const userRole = cookie.user === undefined ? false : cookie.user.is_admin;

  if (userState) {
    return !userRole ? children : <Navigate to="/admin/dashboard" />;
  }

  return <Navigate to="/login" />;
};

export const AdminProtectedRoutes = ({ children }) => {
  const [cookie] = useCookies();

  const userState = cookie.user === undefined ? false : cookie.user.is_active;
  const userRole = cookie.user === undefined ? false : cookie.user.is_admin;

  if (userState) {
    return userRole ? children : <Navigate to="/dashboard" />;
  }

  return <Navigate to="/login" />;
};
