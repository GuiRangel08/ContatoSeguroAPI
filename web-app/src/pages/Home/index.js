import React, { useRef, useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { useGet, useDelete } from '../../hooks/useApi';
import './index.css';

import { Container, TitleSection, ButtonAction, SubmitButton, EditButton, DeleteButton, Table, Title } from './styles';

export function Home() {

  const [isModalOpen, setIsModalOpen] = useState(false);
  const { data: users, refetch } = useGet('users');
  const [filteredUsers, setFilteredUsers] = useState([]);
  const [userId, setUserId] = useState();
  const { deleteUser } = useDelete();
  const nameFilterInput = useRef();
  const emailFilterInput = useRef();
  const phoneFilterInput = useRef();
  const birthDateFilterInput = useRef();
  const birthCityFilterInput = useRef();
  const companyFilterInput = useRef();

  function handleDeleteClick(id) {
    setIsModalOpen(true);
    setUserId(id)
  }

  useEffect(() => {
    setFilteredUsers(users);
  }, [users]);

  function handleFilterChange() {
    const nameFilterValue = nameFilterInput.current.value;
    const emailFilterValue = emailFilterInput.current.value;
    const phoneFilterValue = phoneFilterInput.current.value;
    const birthDateFilterValue = birthDateFilterInput.current.value;
    const birthCityFilterValue = birthCityFilterInput.current.value;
    const companyFilterValue = companyFilterInput.current.value;
  
    let filtered = users;
  
    if (nameFilterValue) {
      filtered = filtered.filter(user => user.name.includes(nameFilterValue));
    }
  
    if (emailFilterValue) {
      filtered = filtered.filter(user => user.email.includes(emailFilterValue));
    }

    if (phoneFilterValue) {
      filtered = filtered.filter(user => user.email.includes(emailFilterValue));
    }

    if (birthDateFilterValue) {
      filtered = filtered.filter(user => user.email.includes(emailFilterValue));
    }

    if (birthCityFilterValue) {
      filtered = filtered.filter(user => user.email.includes(emailFilterValue));
    }

    if (companyFilterValue) {
      filtered = filtered.filter(user => user.email.includes(emailFilterValue));
    }
  
    setFilteredUsers(filtered);
  }
  
  function handleConfirmClick() {
    deleteUser(`/users/${userId}`);
    refetch();
    setIsModalOpen(false);
  }

  function handleCancelClick() {
    setIsModalOpen(false);
  }

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
            <th>
              Nome
              <input type="text" ref={nameFilterInput} onChange={handleFilterChange} />
            </th>
            <th>
              E-mail
              <input type="text" ref={emailFilterInput} onChange={handleFilterChange} />
            </th>
            <th>
              Telefone
              <input type="text" ref={phoneFilterInput} onChange={handleFilterChange} />
            </th>
            <th>
              Data de Nascimento
              <input type="date" ref={birthDateFilterInput} onChange={handleFilterChange} />  
            </th>
            <th>
              Cidade natal
              <input type="text" ref={birthCityFilterInput} onChange={handleFilterChange} />
            </th>
            <th>
              Empresas
              <input type="text" ref={companyFilterInput} onChange={handleFilterChange} />
            </th> 
            <th>Ações</th> 
          </tr>
        </thead>
        <tbody>
          {filteredUsers?.map(user => (
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
                <Link to={`/editar-usuario/${user.id}`}>
                    <EditButton>Editar</EditButton>
                </Link>
                <Link>
                  <DeleteButton onClick={() => handleDeleteClick(user.id)}>Apagar</DeleteButton>
                  {isModalOpen && (
                    <div className='modal'>
                      <div className='modal-content'>
                        <p>Tem certeza de que deseja apagar este registro?</p>
                        <button onClick={handleConfirmClick}>Sim</button>
                        <button onClick={handleCancelClick}>Não</button>
                      </div>
                    </div>
                  )}
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </Table>
    </Container>
  )
}