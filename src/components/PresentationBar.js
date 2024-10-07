import React from 'react';

const PresentationBar = ({ energyConsumption }) => {
  return (
    <div>
      <h2>Current Energy Consumption: {energyConsumption} kWh</h2>
    </div>
  );
};

export default PresentationBar;