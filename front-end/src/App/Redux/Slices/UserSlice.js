import { createSlice } from '@reduxjs/toolkit';

// This state will be used in future task for getting and setting realtime user state in client side
const initialState = {
  token: '',
  user: {
    id: 0,
    first_name: '',
    last_name: '',
    email: '',
    is_active: false,
    is_admin: false,
    avatar_url: '',
    cover_url: '',
  },
  users: [],
};

export const UserSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    setUser: (state, action) => {
      state.user = action.payload;
    },
    setToken: (state, action) => {
      state.token = action.payload;
    },
  },
});

export const { setUser, setToken } = UserSlice.actions;
export default UserSlice.reducer;
