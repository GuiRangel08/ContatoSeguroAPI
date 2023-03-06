import axios from 'axios';
import { useState, useEffect } from 'react';

const api = axios.create({
  baseURL: 'http://localhost:81/api',
  headers: {
    'Content-type': 'application/json',
    'Authorization': '1b9552ff-5940-4f16-af96-97f248a1535f'
  }
})

export function useGet(url) {

  const [data, setData] = useState(null);    
  
  async function fetchData() {
    api.get(url).then(response => {
      setData(response.data);
    });
  }

  useEffect(() => {
    fetchData();
  }, []);

  return { data, refetch: fetchData};
}

export function useDelete(onSuccess) {
  const [data, setData] = useState(null);

  function deleteUser(url) {
    api.delete(url).then(response => {
      setData(response.data);
      if (onSuccess) onSuccess(response.data);
    });
  }

  return { data, deleteUser };
}

export function useStore(url, body) {

  const [data, setData] = useState(null);    

  useEffect(() => {
    api.post(url, body).then(response => {
      setData(response.data);
    });
  }, [])

  return { data };
}

export function useUpdate(url, body) {

  const [data, setData] = useState(null);    

  useEffect(() => {
    api.put(url, body).then(response => {
      setData(response.data);
    });
  }, [])

  return { data };
}