import { configureStore } from "@reduxjs/toolkit";
import * as Slice from "./Slices/";

export const Store = configureStore({
  reducer: {
    counter: Slice.counterSlice,
  },
});
