import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

import { Container, TitleSection, ButtonAction, SubmitButton, EditButton, DeleteButton, Table, Title } from './styles';

export const Home = () => {
  
  const [data, setData] = useState([]);

  const getUsers = async () => {
    fetch('http://localhost:81/api/users', {
      method: 'GET',
      headers: {
        'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
      }
    })
    .then((response) => response.json())
    .then((responseJson) =>(
      console.log(responseJson),
      setData(responseJson)
    ));
  }

  const deleteUser = async (userId) => {
    await fetch('http://localhost:81/api/users/' + userId, {
      method: 'DELETE',
      headers: {
        'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
      }
    })
    .then((response) => response.json())
    .then((responseJson) => {
      console.log(responseJson);
    }).catch(() => {
      console.log("Erro: Produto não excluído com sucesso.");
    })
  };

  useEffect(() => {
    getUsers();
  },[])

  return (
    <Container>
      <TitleSection>
        <Title>Listar</Title>
        <ButtonAction>
          <Link to='/adicionar-usuario'>
            <SubmitButton>
              Cadastrar Usuário
            </SubmitButton>
          </Link>
        </ButtonAction>
      </TitleSection>
      <Table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de Nascimento</th>
            <th>Cidade natal</th>
            <th>Empresas</th> 
            <th>Ações</th> 
          </tr>
        </thead>
        <tbody>
          {Object.values(data).map(user => (
            <tr key={user.id}>
              <td>{user.name}</td>
              <td>{user.email}</td>
              <td>{user.phone}</td>
              <td>{user.birth_date}</td>
              <td>{user.birth_city}</td>
              <td>
                {JSON.stringify(user.companies)}
              </td>
              <td>
                <Link to={'/editar-usuario/' + user.id}>
                    <EditButton>Editar</EditButton>
                </Link>
                <Link>
                  <DeleteButton onClick={() => deleteUser(user.id)}>Apagar</DeleteButton>
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </Table>
    </Container>
  )
}