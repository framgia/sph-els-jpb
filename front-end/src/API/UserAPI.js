import axios from 'axios';
import { API_BASE_URL, setHeaders } from '.';

const errorHandler = (err) => {
  console.clear();
  console.log(`Error: ${err.message}`);
  console.log(`Response Message: ${err.response.data.message}`);
};

export const register = (data) => {
  return axios.post(`${API_BASE_URL}/users`, data);
};

export const login = (data) => {
  return axios.post(`${API_BASE_URL}/users/login`, data, setHeaders());
};

export const user = (user_id) => {
  return axios
    .get(`${API_BASE_URL}/users/${user_id}`, setHeaders())
    .catch((err) => {
      errorHandler(err);
    });
};

export const logout = (id) => {
  return axios.post(`${API_BASE_URL}/users/logout`, id, setHeaders());
};
