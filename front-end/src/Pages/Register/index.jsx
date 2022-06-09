import './register.css';
import Swal from 'sweetalert2';
import React, { useState } from 'react';
import { register } from '../../API/userAPI';
import * as Component from '../../Components';
import { useNavigate } from 'react-router-dom';
import logo from '../../Assets/Images/els.png';
import { AuthRedirect } from '../../App/Middlewares';

export default function Register() {
  // User state checker
  AuthRedirect();

  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });

  // Error handling
  const [flowState, setFlowState] = useState({
    isLoading: false,
    isError: {},
  });
  const error = flowState.isError;

  const onChange = (e) => {
    setFormData((lastState) => ({
      ...lastState,
      [e.target.name]: e.target.value,
    }));
  };

  const onSubmit = (e) => {
    e.preventDefault();

    setFlowState({ ...flowState, isLoading: true });

    register(formData)
      .then((res) => {
        Swal.fire({
          title: 'Success',
          text: `${res.data.message} you can now continue to Log in.`,
          icon: 'success',
          confirmButtonText: 'Continue',
          confirmButtonColor: '#0081f9',
        }).then(() => {
          navigate('/login');
        });

        setFormData({
          first_name: '',
          last_name: '',
          email: '',
          password: '',
          password_confirmation: '',
        });

        setFlowState({ isLoading: false, isError: {} });
      })
      .catch((err) => {
        setFlowState({ ...flowState, isError: err.response.data.errors });
      });
  };

  return (
    <>
      <main className="register-body">
        {flowState.isLoading && <Component.Spinner />}
        <img src={logo} alt="logo" />
        <div className="left-container"></div>
        <div className="right-container">
          <h1>Join us now</h1>
          <form onSubmit={onSubmit}>
            <div className="name-field">
              <div className="fname">
                <label htmlFor="fname">First Name</label>
                <input
                  type="text"
                  name="first_name"
                  placeholder="John"
                  onChange={onChange}
                  value={formData.first_name}
                  className={flowState.isError.first_name ? 'input-error' : ''}
                />
                <span className="error-field">
                  {error.first_name ? error.first_name : null}
                </span>
              </div>
              <div className="lname">
                <label htmlFor="lname">Last Name</label>
                <input
                  type="text"
                  name="last_name"
                  placeholder="Doe"
                  onChange={onChange}
                  value={formData.last_name}
                  className={error.last_name ? 'input-error' : ''}
                />
                <span className="error-field">
                  {error.last_name ? error.last_name : null}
                </span>
              </div>
            </div>
            <div className="email">
              <label htmlFor="email">Email</label>
              <input
                type="text"
                name="email"
                placeholder="john.doe@mail.com"
                onChange={onChange}
                value={formData.email}
                className={error.email ? 'input-error' : ''}
              />
              <span className="error-field">
                {error.email ? error.email : null}
              </span>
            </div>
            <div className="password-field">
              <div className="password">
                <label htmlFor="password">Password</label>
                <input
                  type="password"
                  name="password"
                  placeholder="- - - - - - - - -"
                  onChange={onChange}
                  value={formData.password}
                  className={error.password ? 'input-error' : ''}
                />
                <span className="error-field">
                  {error.password ? error.password[1] || error.password : null}
                </span>
              </div>
              <div className="confirm-password">
                <label htmlFor="confirm-password">Confirm Password</label>
                <input
                  type="password"
                  name="password_confirmation"
                  placeholder="- - - - - - - - -"
                  onChange={onChange}
                  value={formData.password_confirmation}
                  className={error.password ? 'input-error' : ''}
                />
                <span className="error-field">
                  {error.password ? error.password[0] : null}
                </span>
              </div>
            </div>
            <Component.Button value={'Register'} />
          </form>
          <Component.AuthFooter
            slug={'login'}
            message={'Already have an account?'}
            link={'Log in'}
          />
        </div>
      </main>
    </>
  );
}
