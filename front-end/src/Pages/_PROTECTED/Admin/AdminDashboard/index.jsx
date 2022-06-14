import React from 'react';
import './admin-dashboard.css';
import Toast from 'App/Swal2/toast';
import { logout } from 'API/userAPI';
import Cookies from 'js-cookie';
import { useNavigate } from 'react-router-dom';

export default function AdminDashoard() {
  const navigate = useNavigate();
  const user = Cookies.get('user');

  return (
    <>
      <img src={user.cover_url} alt="cover" />
      <div className="dash-container">
        <div className="dash-content">
          <h1>Welcome Admin</h1>
          <br />
          <div className="profile">
            <img src={user.avatar_url} alt="pp" />
          </div>
          <p>
            <strong>Name</strong>:{`${user.first_name} ${user.last_name}`}
          </p>
          <p>
            <strong>Email</strong>:{user.email}
          </p>
          <button
            onClick={() => {
              logout({
                user_id: user.id,
              });

              Cookies.remove('token');
              Cookies.remove('user');

              navigate('/login');

              Toast(['top-end', '#f5f5fc']).fire({
                icon: 'success',
                title: 'Logged out succesfully.',
              });
            }}
          >
            Logout
          </button>
        </div>
      </div>
    </>
  );
}
