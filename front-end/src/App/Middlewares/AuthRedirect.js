import { useCookies } from 'react-cookie';
import { useNavigate, useLocation } from 'react-router-dom';
import { useEffect } from 'react';

function AuthRedirect() {
  const [cookie] = useCookies();
  const navigate = useNavigate();
  const path = useLocation();

  useEffect(() => {
    const userState = cookie.user === undefined ? false : cookie.user.is_active;
    const userRole = cookie.user === undefined ? false : cookie.user.is_admin;

    // Not logged in
    if (!userState) {
      if (path.pathname === '/register') {
        return navigate('/register');
      }

      return navigate('/login');
    }

    // Not user but not logged in
    if (!userRole && !userState) return null;

    // User and logged in
    if (!userRole && userState) return navigate('/dashboard');

    // admin and logged in
    return navigate('/admin/dashboard');
  }, []);
}

export default AuthRedirect;
