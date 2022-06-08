import React from 'react';
import './login.css';
import logo from '../../Assets/Images/els.png';
import * as Component from '../../Components';

export default function Login() {
  return (
    <>
      <main className="login-body">
        <img src={logo} alt="logo" />
        <div className="left-container"></div>
        <div className="right-container">
          <h1>Welcome Back</h1>
          <form action="#">
            <div className="email">
              <label htmlFor="email">Email</label>
              <input type="text" name="email" placeholder="john.doe@mail.com" />
            </div>
            <div className="password">
              <label htmlFor="password">Password</label>
              <input
                type="password"
                name="password"
                placeholder="- - - - - - - -"
              />
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
