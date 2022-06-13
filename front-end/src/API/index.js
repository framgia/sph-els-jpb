import axios from 'axios';

const baseURL = process.env.REACT_APP_BACKEND_URL;
const token = getCookie('token');

function getCookie(get_cookie) {
  let name = get_cookie + '=';
  let all_cookie = document.cookie.split(';');

  for (let i = 0; i < all_cookie.length; i++) {
    let your_cookie = all_cookie[i];

    while (your_cookie.charAt(0) === ' ') your_cookie = your_cookie.slice(1);

    if (your_cookie.indexOf(name) === 0)
      return decodeURI(your_cookie.slice(name.length, your_cookie.length));
  }
}

export const apiCall = axios.create({
  baseURL,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
    Authorization: `Bearer ${token}`,
  },
});
