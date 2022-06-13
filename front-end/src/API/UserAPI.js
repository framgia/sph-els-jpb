import { apiCall } from '.';

export const register = (data) => {
  return apiCall.post('/users', data);
};

export const login = (data) => {
  return apiCall.post('/users/login', data);
};

export const user = (user_id) => {
  return apiCall.get(`/users/${user_id}`);
};

export const logout = (id) => {
  return apiCall.post('/users/logout', id);
};
