import React, { createContext, useContext, useState, useEffect } from 'react';
import { api } from '@/lib/api';
import { useToast } from '@/hooks/use-toast';

const AuthContext = createContext(undefined);

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const { toast } = useToast();

  useEffect(() => {
    checkAuth();
  }, []);

  const checkAuth = async () => {
    const token = api.getToken();
    if (token) {
      const response = await api.getProfile();
      if (response.data) {
        setUser(response.data);
      } else {
        api.setToken(null);
      }
    }
    setLoading(false);
  };

  const login = async (email, password) => {
  const response = await api.login(email, password);

  if (response.data && response.data.access_token) {
    api.setToken(response.data.access_token);
    setUser(response.data.data); 
    toast({
      title: "Welcome back!",
      description: "You've successfully logged in.",
    });
    return true;
  } else {
    toast({
      title: "Login failed",
      description: response.error || "Invalid credentials",
      variant: "destructive",
    });
    return false;
  }
};

  const register = async (name, email, password) => {
  const response = await api.register(name, email, password);

  if (response.data && response.data.access_token) {
    api.setToken(response.data.access_token);
    setUser(response.data.data);
    toast({
      title: "Account created!",
      description: "Welcome to our marketplace.",
    });
    return true;
  } else {
    toast({
      title: "Registration failed",
      description: response.error || "Could not create account",
      variant: "destructive",
    });
    return false;
  }
};

  const logout = async () => {
    await api.logout();
    api.setToken(null);
    setUser(null);
    toast({
      title: "Logged out",
      description: "You've been successfully logged out.",
    });
  };

  return (
    <AuthContext.Provider
      value={{
        user,
        loading,
        login,
        register,
        logout,
        isAuthenticated: !!user,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
