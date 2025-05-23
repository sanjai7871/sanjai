// src/components/Card/index.jsx

import React from 'react';
import './style.scss'; // If you're using a separate stylesheet for the card component

const Card = ({ title, description, src, url, color, i }) => {
  return (
    <div className="card-container">
      <div className="card" style={{ backgroundColor: color }}>
        <h2>{title}</h2>
        <div className="body">
          <div className="description">
            <p>{description}</p>
            <span>
              <a href={url} target="_blank" rel="noopener noreferrer">See more</a>
            </span>
          </div>
          <div className="image-container">
            <img src={`/images/${src}`} alt={title} />
          </div>
        </div>
      </div>
    </div>
  );
};

export default Card;
