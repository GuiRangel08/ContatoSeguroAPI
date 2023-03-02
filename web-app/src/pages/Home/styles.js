import styled from 'styled-components';

export const Container = styled.section`
    max-width: 960px;
    margin: 20px auto;
    box-shadow: 0 0 1em #6c757d;
    padding: 0px 20px 20px;
`

export const TitleSection = styled.section`
    display:flex;
    justify-content: space-between;
`

export const ButtonAction = styled.section`
    margin: 25px;
`

export const SubmitButton = styled.button`
    background-color: #fff;
    color: #198754;
    padding: 8px 12px;
    border: 1px solid #198754;
    border-radius: 4px;
    cursor: pointer;
    :hover{
        background-color: #157347;
        color: #fff;
    }
`;

export const EditButton = styled.button`
    background-color: #fff;
    color: #ffc107;
    padding: 8px 12px;
    border: 1px solid #ffc107;
    border-radius: 4px;
    cursor: pointer;
    :hover{
        background-color: #ffc107;
        color: #fff;
    }
`

export const DeleteButton = styled.button`
    background-color: #fff;
    color: #dc3545;
    padding: 8px 12px;
    border: 1px solid #dc3545;
    border-radius: 4px;
    cursor: pointer;
    :hover{
        background-color: #dc3545;
        color: #fff;
    }
`

export const Title = styled.h1`
    color: #3e3e3e;
    font-size: 23px;
`;

export const Table = styled.table`
    width: 100%;
    th{
        background-color: #ffd219;
        color: #3e3e3e;
        padding: 10px;
    };
    td{
        background-color: #f6f6f6;
        color: #3e3e3e;
        padding: 8px;
    }
`;