import React from 'react';
import './button.css';
import '../../Assets/Styles/index.css';

export default function Button({ value }) {
  return (
    <>
      <button type="submit" name="submit" className="global-button">
        {value}
      </button>
    </>
  );
}

// Duplicate this folder template to create new Route much faster.
// After duplicating, just rename the files and codes then import and export it in the Routes index file.
