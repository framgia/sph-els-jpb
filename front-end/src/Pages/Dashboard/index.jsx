import React from 'react';
import './dashboard.css';
import { useDispatch } from 'react-redux';
import { destroyToken } from '../../App/Redux/Slices/UserSlice';
import Swal from 'sweetalert2';
import { useCookies } from 'react-cookie';

export default function Dashoard() {
  const dispatch = useDispatch();
  const [cookie, , removeCookie] = useCookies();

  return (
    <>
      <h1>Welcome to Dashboard</h1>
      <div className="profile">
        {/* CORB Error need to bypass */}
        {/* <img src={cookie.user.avatar_url} alt="pp" /> */}
        <img src={cookie.user.cover_url} alt="pp" />
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
          removeCookie('token');
          removeCookie('user');
          dispatch(destroyToken());
        }}
      >
        Logout
      </button>
    </>
  );
}
