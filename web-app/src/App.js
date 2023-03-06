import React from 'react';
import {
  BrowserRouter as Router,
  Routes,
  Route
} from 'react-router-dom'

import { Home } from './pages/Home';
import { AddUser } from './pages/Add/User';
import { EditUser } from './pages/Edit/User';
import { UserForm } from './components/UserForm/UserForm';

function App() {
  return (
    <div>
      <Router>
        <Routes>
          <Route exact path="/" element={<Home/>} />
          <Route path="/adicionar-usuario" element={<UserForm/>} />
          {/* <Route path="/editar-usuario/:id" element={<EditUser/>} /> */}
        </Routes>
      </Router>
    </div>
  );
}

export default App;