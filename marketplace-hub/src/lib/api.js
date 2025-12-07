// API configuration and utilities
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

class ApiClient {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
    this.token = localStorage.getItem('auth_token');
  }

  setToken(token) {
    this.token = token;
    if (token) {
      localStorage.setItem('auth_token', token);
    } else {
      localStorage.removeItem('auth_token');
    }
  }

  getToken() {
    return this.token;
  }

  async request(endpoint, options = {}) {
    const headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      ...options.headers,
    };

    if (this.token) {
      headers['Authorization'] = `Bearer ${this.token}`;
    }

    try {
      const response = await fetch(`${this.baseUrl}${endpoint}`, {
        ...options,
        headers,
      });

      const data = await response.json();

      if (!response.ok) {
        return {
          error: data.message || 'An error occurred',
        };
      }

      return { data };
    } catch (error) {
      return {
        error: error instanceof Error ? error.message : 'Network error',
      };
    }
  }

  async get(endpoint) {
    return this.request(endpoint, { method: 'GET' });
  }

  async post(endpoint, body) {
    return this.request(endpoint, {
      method: 'POST',
      body: JSON.stringify(body),
    });
  }

  async put(endpoint, body) {
    return this.request(endpoint, {
      method: 'PUT',
      body: JSON.stringify(body),
    });
  }

  async delete(endpoint) {
    return this.request(endpoint, { method: 'DELETE' });
  }

  // Auth endpoints
  async register(name, email, password) {
    return this.post('/register', { name, email, password, password_confirmation: password });
  }

  async login(email, password) {
    return this.post('/login', { email, password });
  }

  async logout() {
    return this.post('/logout');
  }

  async getProfile() {
    return this.get('/profile');
  }

  async forgotPassword(email) {
    return this.post('/forgot-password', { email });
  }

  async resetPassword(email, password, token) {
    return this.post('/reset-password', { 
      email, 
      password, 
      password_confirmation: password,
      token 
    });
  }

  // Products endpoints
  async getProducts() {
    return this.get('/proizvods');
  }

  async getProduct(id) {
    return this.get(`/proizvods/${id}`);
  }

  async createProduct(data) {
    return this.post('/proizvods', data);
  }

  async updateProduct(id, data) {
    return this.put(`/proizvods/${id}`, data);
  }

  async deleteProduct(id) {
    return this.delete(`/proizvods/${id}`);
  }

  // Auctions endpoints
  async getAuctions() {
    return this.get('/aukcijas');
  }

  async getAuction(id) {
    return this.get(`/aukcijas/${id}`);
  }

  async createAuction(data) {
    return this.post('/aukcijas', data);
  }

  async filterAuctions(params) {
    const queryString = new URLSearchParams(params).toString();
    return this.get(`/aukcijas/filter?${queryString}`);
  }

  // Users endpoints
  async getUsers() {
    return this.get('/users');
  }

  async getUser(id) {
    return this.get(`/users/${id}`);
  }

  async updateUser(id, data) {
    return this.put(`/users/${id}`, data);
  }

  async deleteUser(id) {
    return this.delete(`/users/${id}`);
  }
}

export const api = new ApiClient(API_BASE_URL);
