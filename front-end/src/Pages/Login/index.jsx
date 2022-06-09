import './login.css';
import _ from 'lodash';
import { useCookies } from 'react-cookie';
import { login } from '../../API/userAPI';
import * as Component from '../../Components';
import logo from '../../Assets/Images/els.png';
import { useNavigate } from 'react-router-dom';
import React, { useState } from 'react';
import { AuthRedirect } from '../../App/Middlewares';
import Toast from '../../App/Swal2/toast';

export default function Login() {
  // User state checker
  AuthRedirect();

  const navigate = useNavigate();
  const [, setCookie] = useCookies();

  const [formData, setFormData] = useState({
    email: '',
    password: '',
  });

  // Error handling
  const [flowState, setFlowState] = useState({
    isLoading: false,
    isError: { errors: { email: '', password: '' }, message: '' },
  });

  let { message } = flowState.isError;
  const error = flowState.isError.errors ? flowState.isError.errors : {};
  message =
    message === 'Attempt to read property "id" on null'
      ? 'Email address is not yet registered.'
      : message;

  const onChange = (e) => {
    setFormData((lastState) => ({
      ...lastState,
      [e.target.name]: e.target.value,
    }));
  };

  const onSubmit = (e) => {
    e.preventDefault();

    setFlowState({ ...flowState, isLoading: true });

    login(formData)
      .then((res) => {
        setCookie('token', res.data.token);
        setCookie('user', res.data.data);

        Toast(['top-end', '#f5f5fc'])
          .fire({
            icon: 'success',
            title: 'Signed in successfully',
          })
          .then(() => {
            res.data.data.is_admin
              ? navigate('/admin/dashboard')
              : navigate('/dashboard');
          });

        setFormData({
          email: '',
          password: '',
        });

        setFlowState({ isLoading: false, isError: {} });
      })
      .catch((err) => {
        setFlowState({ ...flowState, isError: err.response.data });
      });
  };

  return (
    <>
      <main className="login-body">
        {flowState.isLoading && <Component.Spinner />}
        <img src={logo} alt="logo" />
        <div className="left-container"></div>
        <div className="right-container">
          <h1>Welcome Back</h1>
          <form onSubmit={onSubmit}>
            <span className="error-field" style={{ textAlign: 'center' }}>
              {_.size(error) === 0 ? message : null}
            </span>
            <div className="email">
              <label htmlFor="email">Email</label>
              <input
                type="text"
                name="email"
                placeholder="john.doe@mail.com"
                onChange={onChange}
                className={error.email ? 'input-error' : ''}
              />
              <span className="error-field">
                {error.email ? error.email : null}
              </span>
            </div>
            <div className="password">
              <label htmlFor="password">Password</label>
              <input
                type="password"
                name="password"
                placeholder="- - - - - - - -"
                onChange={onChange}
                className={error.password ? 'input-error' : ''}
              />
              <span className="error-field">
                {error.password ? error.password : null}
              </span>
            </div>
            <div className="remember">
              <input type="checkbox" name="remember" id="remember" />
              <label htmlFor="remember">Remember me?</label>
            </div>
            <Component.Button value={'Log in'} />
          </form>
          <Component.AuthFooter
            slug={'register'}
            message={"Doesn't have an account yet?"}
            link={'Register'}
          />
        </div>
      </main>
    </>
  );
}
