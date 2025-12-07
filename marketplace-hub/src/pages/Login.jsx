import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { Header } from '@/components/Header';
import { useAuth } from '@/contexts/AuthContext';
import '@/styles/Login.css';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const { login } = useAuth();

  const handleLogin = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      const success = await login(email, password);
      if (success) {
        navigate('/products');
      } else {
        setError('Invalid email or password');
      }
    } catch (err) {
      setError('An error occurred during login');
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <Header />
      <div className="login-container">
        <div className="login-div">
          <h1>Login</h1>
          <form onSubmit={handleLogin} style={{ width: '100%', display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
            <input
              type="email"
              placeholder="Email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
            <input
              type="password"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
            <div className="button-div">
              <button type="submit" disabled={loading}>
                {loading ? 'Loading...' : 'Login'}
              </button>
            </div>
            {error && <p className="error">{error}</p>}
          </form>
          <p className="login-link">
            Don't have an account? <Link to="/register">Sign up</Link>
          </p>
        </div>
      </div>
    </>
  );
};

export default Login;
