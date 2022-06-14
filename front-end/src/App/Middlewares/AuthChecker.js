import { Navigate, Outlet } from 'react-router-dom';
import Cookies from 'js-cookie';

const AuthChecker = ({ userRoles }) => {
  const userData = Cookies.get('user') && JSON.parse(Cookies.get('user'));

  const userStatus = userData?.is_active ? true : false;

  const user = !userData?.is_admin && userStatus ? 'user' : false;
  const admin = userData?.is_admin ? 'admin' : false;
  const guest = userRoles === 'guest' && !userStatus ? 'guest' : false;

  if (userStatus) {
    if (user === userRoles) return <Outlet />;
    if (!admin) return <Navigate to={'/dashboard'} />;

    if (admin === userRoles) return <Outlet />;
    if (!user) return <Navigate to={'/admin'} />;
  }

  // Only guest can access this Outlet
  if (guest === userRoles) return <Outlet />;
  return <Navigate to={'/login'} />;
};

export default AuthChecker;
