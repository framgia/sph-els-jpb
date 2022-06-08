import React from 'react';
import './auth-footer.css';
import '../../Assets/Styles/index.css';
import Github from '../../Assets/Images/github.png';
import Twitter from '../../Assets/Images/twitter.png';
import Google from '../../Assets/Images/google.png';
import Facebook from '../../Assets/Images/facebook.png';
import { Link } from 'react-router-dom';

export default function AuthFooter({ slug, message, link }) {
  return (
    <>
      <div className="register-footer">
        <div className="continue-with">
          <span className="line"></span>
          <span name="message">Or continue with</span>
          <span className="line-2"></span>
        </div>
        <div className="connection-btn">
          <div className="github">
            <img src={Github} alt="github" />
          </div>
          <div className="twitter">
            <img src={Twitter} alt="twitter" />
          </div>
          <div className="google">
            <img src={Google} alt="google" />
          </div>
          <div className="facebook">
            <img src={Facebook} alt="facebook" />
          </div>
        </div>
        <p>
          {message} &nbsp;
          <Link to={`/${slug}`} className="link">
            {link}
          </Link>
        </p>
        <span className="copy-rights">&copy; e-learning system | 2022</span>
      </div>
    </>
  );
}

// Duplicate this folder template to create new Route much faster.
// After duplicating, just rename the files and codes then import and export it in the Routes index file.
