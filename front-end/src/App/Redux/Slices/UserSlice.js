import { createSlice } from '@reduxjs/toolkit';

// This state will be used in future task for getting and setting realtime user state in client side
const initialState = {
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
  reducers: {},
});

export const {} = UserSlice.actions;
export default UserSlice.reducer;
