import React, { useState, useEffect } from 'react';
import './userForm.css';

export function UserForm() {
  const [username, setUsername] = useState('');
  const [email, setEmail] = useState('');
  const [phone, setPhone] = useState('');
  const [birthCity, setBirtyCity] = useState('');
  const [birthDate, setBirtyDate] = useState('');
  const [companies, setCompanies] = useState(['']);
  const [error, setError] = useState(null);
  const [companyOptions, setCompanyOptions] = useState([]);

  const handleUsernameChange = (event) => {
    setUsername(event.target.value);
  };

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handlePhoneChange = (event) => {
    setPhone(event.target.value);
  };

  const handleBirthCityChange =(event) => {
    setBirtyCity(event.target.value);
  }

  const handleBirthDateChange =(event) => {
    setBirtyDate(event.target.value);
  }

  const handleCompanyChange = (index) => (event) => {
    const newCompanies = [...companies];
    console.log(companies);
    newCompanies[index] = event.target.value;
    setCompanies(newCompanies);
  };

  const handleAddCompany = () => {
    setCompanies([...companies, '']);
  };

  const fetchCompanyOptions = async () => {
    try {
      const response = await fetch('http://localhost:81/api/companies', {
        headers: { 
          'Content-Type': 'application/json',
          'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
        }
      });
      if (!response.ok) throw new Error('Erro ao buscar as opções de empresas');
      const data = await response.json();
      setCompanyOptions(data);
    } catch (error) {
      console.error(error);
    }
  };

  useEffect(() => {
    fetchCompanyOptions();
  }, []);
  
  const handleRemoveCompany = (index) => () => {
    if (companies.length === 1) {
      alert('Você deve cadastrar pelo menos uma empresa.');
      return;
    }
    setCompanies((prevCompanies) => {
      const newCompanies = [...prevCompanies];
      newCompanies.splice(index, 1);
      return newCompanies;
    });
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    if (!username.trim()) {
      setError('O campo Nome de usuário é obrigatório.');
      return;
    }
    if (!companies.some((company) => company.trim() !== '')) {
      setError('Você deve cadastrar pelo menos uma empresa.');
      return;
    }

    try {
      const response = await fetch('http://localhost:81/api/users', {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
          'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
        },
        body: JSON.stringify({
          name: username,
          email, 
          phone,
          birth_city: birthCity,
          birth_date: birthDate,
          companies: companies.filter((company) => company.trim() !== ''),
        }),
      });
      
      if (!response.ok) throw new Error('Erro ao enviar os dados para o servidor');
      
      console.log(await response.json());
      
      setUsername('');
      setCompanies(['']);
      
      alert('Usuário cadastrado com sucesso!');
      
    } catch (error) {
      console.error(error);
      alert('Erro ao enviar os dados para o servidor');
    }
  };

  return (
    <div class="container">
      <div class="centered-div">
        <form onSubmit={handleSubmit}>
          <label>
            Nome
            <input type="text" value={username} onChange={handleUsernameChange} />
          </label>
          <br/>
          <label>
            E-mail
            <input type="text" value={email} onChange={handleEmailChange} />
          </label>
          <br />
          <label>
            Telefone
            <input type="text" value={phone} onChange={handlePhoneChange} />
          </label>
          <br />
          <label>
            Cidade de nascimento:
            <input type="text" value={birthCity} onChange={handleBirthCityChange} />
          </label>
          <br />
          <label>
            Data de nascimento:
            <input type="date" value={birthDate} onChange={handleBirthDateChange} />
          </label>
          <br />
          <label>Empresas</label>
          {companies.map((company, index) => (
            <div key={index}>
              <select
                id={`company-${index}`}
                value={companies[index]}
                onChange={handleCompanyChange(index)}
              >
                <option value="">Selecione uma empresa</option>
                {companyOptions.map((option) => (
                  <option key={option.id} value={option.id}>
                    {option.name}
                  </option>
                ))}
              </select>
              <button type="button" onClick={handleRemoveCompany(index)}>
                Remover
              </button>
            </div>
          ))}
          <br />
          <button type="button" onClick={handleAddCompany}>
            Adicionar empresa
          </button>
          <br />
          <input type="submit" value="Enviar" />
        </form>
      </div>
    </div>
  );
}