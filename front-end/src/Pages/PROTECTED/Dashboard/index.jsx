import React from 'react';
import './dashboard.css';
import Swal from 'sweetalert2';
import { useCookies } from 'react-cookie';
import { logout } from '../../../API/UserAPI';
import { store } from '../../../App/Redux/Store';

export default function Dashoard() {
  const [cookie, , removeCookie] = useCookies();
  const state = store.getState().user;
  console.log(state);
  return (
    <>
      <img src={cookie.user.cover_url} alt="cover" />
      <div className="dash-container">
        <div className="dash-content">
          <h1>Welcome to Dashboard</h1>
          <br />
          <div className="profile">
            <img src={cookie.user.avatar_url} alt="pp" />
          </div>
          <p>
            <strong>Name</strong>:
            {`${cookie.user.first_name} ${cookie.user.last_name}`}
          </p>
          <p>
            <strong>Email</strong>:{cookie.user.email}
          </p>
          <button
            onClick={() => {
              Swal.fire({
                title: 'Logged out',
                text: `See you soon!`,
                icon: 'success',
                confirmButtonText: 'ok',
                confirmButtonColor: '#0081f9',
              }).then(() => {
                window.location = '/login';
              });

              logout({
                user_id: cookie.user.id,
              }).then((res) => {
                console.log(res);
              });

              removeCookie('token');
              removeCookie('user');
            }}
          >
            Logout
          </button>
        </div>
      </div>
    </>
  );
}
