export const API_BASE_URL = process.env.REACT_APP_BACKEND_URL;

export const setHeaders = () => {
  let token = decodeURI(getCookie('token'));

  function getCookie(cookie_name) {
    let name = cookie_name + '=';
    let all_cookie = document.cookie.split(';');

    for (let i = 0; i < all_cookie.length; i++) {
      let your_cookie = all_cookie[i];

      while (your_cookie.charAt(0) === ' ') your_cookie = your_cookie.slice(1);

      if (your_cookie.indexOf(name) === 0)
        return your_cookie.slice(name.length, your_cookie.length);
    }
    return '';
  }

  return {
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`,
    },
  };
};
