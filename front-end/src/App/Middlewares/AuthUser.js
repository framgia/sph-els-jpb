import { Navigate } from 'react-router-dom';
import { useCookies } from 'react-cookie';

export const UsersProtectedRoutes = ({ children }) => {
  const [cookie] = useCookies();

  const userState = cookie.user === undefined ? false : cookie.user.is_active;

  return userState ? children : <Navigate to="/login" />;
};
