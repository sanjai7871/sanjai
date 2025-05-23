// src/App.js

import React from 'react';
import { projects } from './data';  // Assuming data is in the 'src/data.js' file
import Card from './components/Card';  // Path to your Card component

function App() {
  return (
    <div className="app">
      {projects.map((project, index) => (
        <Card
          key={index}
          title={project.title}
          description={project.description}
          src={project.src}
          url={project.link}
          color={project.color}
          i={index}
        />
      ))}
    </div>
  );
}

export default App;
