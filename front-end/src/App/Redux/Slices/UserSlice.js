import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  admin_token: '',
  user_token: '',
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
    setUserToken: (state, action) => {
      state.user.is_admin === false
        ? (state.user_token = action.payload)
        : (state.admin_token = action.payload);
    },
    destroyToken: (state) => {
      state.user_token = '';
      state.admin_token = '';
    },
  },
});

export const { setUser, setUserToken, destroyToken } = UserSlice.actions;
export default UserSlice.reducer;
