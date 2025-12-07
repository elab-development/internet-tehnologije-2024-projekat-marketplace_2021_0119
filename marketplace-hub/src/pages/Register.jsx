import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { Header } from '@/components/Header';
import { useAuth } from '@/contexts/AuthContext';
import '@/styles/Login.css';

const Register = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();
  const { register } = useAuth();

  const handleRegister = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {
      const success = await register(name, email, password);
      if (success) {
        navigate('/products');
      } else {
        setError('Registration failed');
      }
    } catch (err) {
      setError('An error occurred during registration');
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <Header />
      <div className="login-container">
        <div className="login-div">
          <h1>Sign Up</h1>
          <form onSubmit={handleRegister} style={{ width: '100%', display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
            <input
              type="text"
              placeholder="Name"
              value={name}
              onChange={(e) => setName(e.target.value)}
              required
            />
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
                {loading ? 'Loading...' : 'Sign Up'}
              </button>
            </div>
            {error && <p className="error">{error}</p>}
          </form>
          <p className="login-link">
            Already have an account? <Link to="/login">Login</Link>
          </p>
        </div>
      </div>
    </>
  );
};

export default Register;
