// axios.js
import axios from 'axios';

// Set the base URL for your backend API
// axios.defaults.baseURL = 'https://your-backend-api.com';

// Add a request interceptor
axios.interceptors.request.use(
  (config) => {
    // Modify the request config before it is sent (e.g., add headers)
    const token = localStorage.getItem('acicms_platform_admin_pass');
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    // Handle request errors
    return Promise.reject(error);
  }
);

// Add a response interceptor
axios.interceptors.response.use(
  (response) => {
    // Modify the response data before it is resolved (e.g., handle success responses)
    return response;
  },
  (error) => {
    // Handle response errors (e.g., check for unauthorized access)
    if (error.response && error.response.status === 401) {
      // Redirect to the login page or handle unauthorized access
      // Example: router.push('/login');
    }
    return Promise.reject(error);
  }
);

export default axios;
