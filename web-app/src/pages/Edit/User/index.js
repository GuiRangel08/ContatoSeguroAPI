import React, { useState, useEffect} from "react";
import { Link, useParams } from "react-router-dom";

import { Form, EditButton, ButtonAction, HomeButton, TitleSection, Select, Label, Input, FormSection, Container, AlertSuccess, AlertError, Title } from './styles';

export const EditUser = () => {

    const { id } = useParams();

    const [name, setName] = useState([]);
    const [email, setEmail] = useState([]);
    const [phone, setPhone] = useState([]);
    const [birth_date, setBirthDate] = useState([]);
    const [birth_city, setBirthCity] = useState([]);
    const [birth_state, setBirthState] = useState([]);
    const [company, setCompany] = useState([]);

    const getUsers = async () => {
        fetch('http://localhost:81/api/users/' + id, {
          method: 'GET',
          headers: {
            'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f',
            'Content-type': 'application/json'
          }
        })
        .then((response) => response.json())
        .then((responseJson) =>(
            setName(responseJson.name),
            setEmail(responseJson.email),
            setPhone(responseJson.phone),
            setBirthDate(responseJson.birth_date),
            setBirthCity(responseJson.birth_city),
            setBirthState(responseJson.birth_state.toString())
        ));
    };

    useEffect(() => {
        getUsers();
    },[])

    const getCompany = async () => {
      const response = await fetch('http://localhost:81/api/companies', {
        headers: {
          'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f',
          'Content-type': 'application/json',
        }
      })
      const data = await response.json();
      setCompany(data);
    };

    useEffect(() => {
        getCompany();
    },[]);

    const [user, setUser] = useState({
        name: null,
        email: null,
        phone: null,
        birth_date: null,
        birth_city: null,
        birth_state: null,
        companies: null,
      });

    const inputValue = e => {
        if (e.target.name === 'companies') {
            const selectedOptions = Array.from(e.target.options).filter(option => option.selected);
            const selectedCompanies = selectedOptions.map(option => option.value);
            setUser({...user, companies: selectedCompanies});
        } else {
            setUser({...user, [e.target.name]: e.target.value});
        }
    };

    return(
        <Container>
            <FormSection>
                <TitleSection>
                    <Title>Editar Usuário</Title>
                    <ButtonAction>
                        <Link to='/'>
                            <HomeButton>
                                Home
                            </HomeButton>
                        </Link>
                    </ButtonAction>
                </TitleSection>
                <Form>
                    <Label>Nome:</Label>
                    <Input type="text" name="name" placeholder="Nome do usuário" value={name}/><br/><br/>
                    <Label>E-mail:</Label>
                    <Input type="text" name="email" placeholder="E-mail do usuário" value={email}/><br/><br/>
                    <Label>Telefone:</Label>
                    <Input type="text" name="phone" placeholder="Telefone do usuário" value={phone}/><br/><br/>
                    <Label>Data de Nascimento:</Label>
                    <Input type="text" name="birth_date" placeholder="Data de nascimento" value={birth_date}/><br/><br/>
                    <Label>Cidade natal:</Label>
                    <Input type="text" name="birth_city" placeholder="Cidade natal" value={birth_city}/><br/><br/>
                    <Label>Estado:</Label>
                    <Input type="text" name="birth_states" placeholder="Estado natal" value={birth_state}/><br/><br/>
                    <Label>Empresas:</Label>
                    <Select name="companies" multiple>
                        {company.map(company => (
                            <option value={company.id}>
                                {company.name}
                            </option>
                        ))}
                    </Select>
                    <EditButton type="submit">Editar</EditButton>
                </Form>
            </FormSection>
        </Container>

    );
}