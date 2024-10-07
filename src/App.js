import React, { useState, useEffect } from 'react';
import './App.css';
import PresentationBar from './components/PresentationBar';
import BadgeSystem from './components/BadgeSystem';
import Notifications from './components/Notifications';
import UserInterface from './components/UserInterface';

function App() {
  const [energyConsumption, setEnergyConsumption] = useState(0);
  const [badges, setBadges] = useState([]);
  const [notifications, setNotifications] = useState([]);

  useEffect(() => {
    // Simulate energy consumption data fetching
    const interval = setInterval(() => {
      setEnergyConsumption(prev => prev + Math.floor(Math.random() * 10));
    }, 1000);

    return () => clearInterval(interval);
  }, []);

  useEffect(() => {
    // Award badges based on energy consumption
    const badgeThresholds = [
      { threshold: 100, badge: '100 kWh', message: 'Congratulations! You have reached 100 kWh!' },
      { threshold: 200, badge: '200 kWh', message: 'Congratulations! You have reached 200 kWh!' },
      { threshold: 300, badge: '300 kWh', message: 'Congratulations! You have reached 300 kWh!' },
      { threshold: 400, badge: '400 kWh', message: 'Congratulations! You have reached 400 kWh!' },
      { threshold: 500, badge: '500 kWh', message: 'Congratulations! You have reached 500 kWh!' },
      { threshold: 600, badge: '600 kWh', message: 'Congratulations! You have reached 600 kWh!' },
      { threshold: 700, badge: '700 kWh', message: 'Congratulations! You have reached 700 kWh!' },
      { threshold: 800, badge: '800 kWh', message: 'Congratulations! You have reached 800 kWh!' },
      { threshold: 900, badge: '900 kWh', message: 'Congratulations! You have reached 900 kWh!' },
      { threshold: 1000, badge: '1000 kWh', message: 'Congratulations! You have reached 1000 kWh!' },
      { threshold: 1100, badge: '1100 kWh', message: 'Congratulations! You have reached 1100 kWh!' },
      { threshold: 1200, badge: '1200 kWh', message: 'Congratulations! You have reached 1200 kWh!' }
    ];

    badgeThresholds.forEach(({ threshold, badge, message }) => {
      if (energyConsumption >= threshold && !badges.includes(badge)) {
        setBadges(prevBadges => [...prevBadges, badge]);
        setNotifications(prevNotifications => [...prevNotifications, message]);
      }
    });
  }, [energyConsumption, badges, notifications]);

  return (
    <div className="App">
      <header className="App-header">
        <h1>Energy Meter App</h1>
      </header>
      <main>
        <PresentationBar energyConsumption={energyConsumption} />
        <BadgeSystem badges={badges} />
        <Notifications notifications={notifications} />
        <UserInterface />
      </main>
    </div>
  );
}

export default App;