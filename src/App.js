import React from 'react';
import './App.css';
import PresentationBar from './components/PresentationBar';
import BadgeSystem from './components/BadgeSystem';
import Notifications from './components/Notifications';
import UserInterface from './components/UserInterface';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <h1>Energy Meter App</h1>
      </header>
      <main>
        <PresentationBar />
        <BadgeSystem />
        <Notifications />
        <UserInterface />
      </main>
    </div>
  );
}

export default App;
