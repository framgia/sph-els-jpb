import React from "react";
import Logo from "../../Assets/Images/redux-logo.png";
import "./header.css";
import "../../Assets/Styles/index.css";

export default function Header() {
  return (
    <>
      <div className="header">
        <img src={Logo} alt="logo" />
      </div>
    </>
  );
}
