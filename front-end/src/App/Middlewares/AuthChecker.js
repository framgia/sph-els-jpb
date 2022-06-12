import { Navigate, Outlet } from 'react-router-dom';
import { useCookies } from 'react-cookie';

const AuthChecker = ({ userRoles }) => {
  const [cookie] = useCookies();

  const userStatus = cookie?.user?.is_active ? true : false;

  const user = !cookie?.user?.is_admin && userStatus ? 'user' : false;
  const admin = cookie?.user?.is_admin ? 'admin' : false;
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
