import React from 'react';

const BadgeSystem = ({ badges }) => {
  return (
    <div>
      <h2>Badges</h2>
      <ul>
        {badges.map((badge, index) => (
          <li key={index}>{badge}</li>
        ))}
      </ul>
    </div>
  );
};

export default BadgeSystem;