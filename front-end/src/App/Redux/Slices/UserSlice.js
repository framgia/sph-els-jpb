import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  admin_token: '',
  user_token: '',
  user: {
    id: 0,
    first_name: '',
    last_name: '',
    email: '',
    avatar_url: '',
    cover_url: '',
  },
  users: [],
};

export const UserSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {},
});

export const {} = UserSlice.actions;
export default UserSlice.reducer;
