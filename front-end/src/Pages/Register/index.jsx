import React from 'react';
import './register.css';
import '../../Assets/Styles/index.css';
import logo from '../../Assets/Images/els.png';
import * as Component from '../../Components';

export default function Register() {
  return (
    <>
      <main className="register-body">
        <img src={logo} alt="logo" />
        <div className="left-container"></div>
        <div className="right-container">
          <h1>Join us now</h1>
          <form action="#">
            <div className="name-field">
              <div className="fname">
                <label htmlFor="fname">First Name</label>
                <input type="text" name="fname" placeholder="John" />
              </div>
              <div className="lname">
                <label htmlFor="lname">Last Name</label>
                <input type="text" name="lname" placeholder="Doe" />
              </div>
            </div>
            <div className="email">
              <label htmlFor="email">Email</label>
              <input type="text" name="email" placeholder="john.doe@mail.com" />
            </div>
            <div className="password-field">
              <div className="password">
                <label htmlFor="password">Password</label>
                <input
                  type="password"
                  name="password"
                  placeholder="- - - - - - - - -"
                />
              </div>
              <div className="confirm-password">
                <label htmlFor="confirm-password">Confirm Password</label>
                <input
                  type="password"
                  name="confirm-password"
                  placeholder="- - - - - - - - -"
                />
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
