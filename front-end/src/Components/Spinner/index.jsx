import React from 'react';
import './spinner.css';

export default function Spinner() {
  return (
    <>
      <div className="spinner-container">
        <div className="lds-roller">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </>
  );
}

// Duplicate this folder template to create new Route much faster.
// After duplicating, just rename the files and codes then import and export it in the Routes index file.
