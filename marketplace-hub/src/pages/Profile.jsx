import { useNavigate } from 'react-router-dom';
import { Header } from '@/components/Header';
import { useAuth } from '@/contexts/AuthContext';
import { useEffect } from 'react';
import '@/styles/Profile.css';

const Profile = () => {
  const { user, logout, isAuthenticated } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (!isAuthenticated) {
      navigate('/login');
    }
  }, [isAuthenticated, navigate]);

  if (!user) {
    return null;
  }

  return (
    <>
      <Header />
      <div className="profile-container">
        <div className="profile-card">
          <h1>Profile</h1>
          <div className="profile-info">
            <div className="profile-field">
              <label>Name</label>
              <p>{user.name}</p>
            </div>
            <div className="profile-field">
              <label>Email</label>
              <p>{user.email}</p>
            </div>
            <div className="profile-field">
              <label>User ID</label>
              <p>{user.id}</p>
            </div>
          </div>
          <div className="profile-actions">
            <button onClick={() => navigate('/products')}>
              Browse Products
            </button>
            <button className="logout-button" onClick={logout}>
              Logout
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Profile;
