import React, { useState } from 'react';

export function InputName() {
  const [name, setName] = useState('');

  const handleChange = (event) => {
    setName(event.target.value);
  };

  return (
    <div>
      <label htmlFor="name">Nome:</label>
      <input type="text" id="name" name="name" required onChange={handleChange} />
    </div>
  );
}
