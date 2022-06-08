import axios from 'axios';
import { API_BASE_URL, setHeaders } from '.';

export const register = (data) => {
  return axios.post(`${API_BASE_URL}/users`, data);
};
