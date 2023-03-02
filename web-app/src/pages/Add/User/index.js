import React, { useEffect, useState } from "react";
import { Link } from 'react-router-dom'

import { Form, ButtonSubmit, ButtonAction, InfoButton, TitleSection, Select, Label, Input, FormSection, Container, AlertSuccess, AlertError, Title } from './styles';

export const AddUser = () => {
  const [user, setUser] = useState({
    name: null,
    email: null,
    phone: null,
    birth_date: null,
    birth_city: null,
    birth_state: null,
    companies: null,
  });

  const [company, setCompany] = useState([]);

  useEffect(() => {
    const fetchCompany = async () => {
      const response = await fetch('http://localhost:81/api/companies', {
        headers: {
          'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f',
          'Content-type': 'application/json',
        }
      });
      const data = await response.json();
      setCompany(data);
    };
    fetchCompany();
  }, []);

  const [status, setStatus] = useState({
    error: '',
    message: ''
  })

  const inputValue = e => {
    if (e.target.name === 'companies') {
      const selectedOptions = Array.from(e.target.options).filter(option => option.selected);
      const selectedCompanies = selectedOptions.map(option => option.value);
      setUser({...user, companies: selectedCompanies});
    } else {
      setUser({...user, [e.target.name]: e.target.value});
    }
  };

  const submitAddUser = async e => {
    e.preventDefault();
    console.log(user);

    await fetch("http://localhost:81/api/users", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
      },
      body: JSON.stringify(user)
    })
    .then((response) => response.json())
    .then((responseJson) => {
      console.log(responseJson)
      if(responseJson.error){
        setStatus({
          type: 'error',
          message: responseJson.message
        });
      } else {
        setStatus({
          type: 'success',
          message: responseJson.message
        });
      }
    })
    .catch(() => {
      setStatus({
        type: 'error',
        message: 'error on add User'
      })
    })

  };

  return (
    <Container>
      <FormSection>
        <TitleSection>
          <Title>Adicionar Usuário</Title>
          <ButtonAction>
            <Link to='/'>
              <InfoButton>
                Home
              </InfoButton>
            </Link>
          </ButtonAction>
        </TitleSection>

        {status.type === 'error' ? <AlertError>{status.message}</AlertError> : ""}
        {status.type === 'success' ? <AlertSuccess>{status.message}</AlertSuccess> : ""}
        
        <Form onSubmit={submitAddUser}>
          <Label>Nome:</Label>
          <Input type="text" name="name" placeholder="Nome do usuário" onChange={inputValue}/><br/><br/>
          <Label>E-mail:</Label>
          <Input type="text" name="email" placeholder="E-mail do usuário" onChange={inputValue} /><br/><br/>
          <Label>Telefone:</Label>
          <Input type="text" name="phone" placeholder="Telefone do usuário" onChange={inputValue} /><br/><br/>
          <Label>Data de Nascimento:</Label>
          <Input type="text" name="birth_date" placeholder="Data de nascimento" onChange={inputValue} /><br/><br/>
          <Label>Cidade natal:</Label>
          <Input type="text" name="birth_city" placeholder="Cidade natal" onChange={inputValue} /><br/><br/>
          <Label>Estado:</Label>
          <Input type="text" name="birth_state" placeholder="Estado natal" onChange={inputValue} /><br/><br/>
          <Label>Empresas:</Label>
          <Select name="companies" multiple onChange={inputValue}>
            {company.map(company => (
              <option value={company.id}>
                {company.name}
              </option>
            ))}
          </Select>
          <ButtonSubmit type="submit">Adicionar</ButtonSubmit>
        </Form>
      </FormSection>
    </Container>
  )
}