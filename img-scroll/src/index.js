// src/index.js

import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';  // You may add styles here
import App from './App';  // This is your main app component
import reportWebVitals from './reportWebVitals';  // Optional, for performance tracking

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')  // Make sure the 'root' div exists in your public/index.html
);

// If you want to start measuring performance in your app, you can pass a function to log results (optional)
reportWebVitals();
