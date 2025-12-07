import { Link } from 'react-router-dom';
import { ShoppingCart, User, LogOut, Package, Gavel } from 'lucide-react';
import { useAuth } from '@/contexts/AuthContext';
import { useCart } from '@/contexts/CartContext';
import { useState } from 'react';
import '@/styles/Header.css';

export const Header = () => {
  const { user, logout, isAuthenticated } = useAuth();
  const { itemCount } = useCart();
  const [showDropdown, setShowDropdown] = useState(false);

  return (
    <header className="header">
      <div className="header-left">
        <Link to="/" className="header-logo">
          <Package />
          <span>Marketplace</span>
        </Link>
        
        <nav className="header-nav">
          <Link to="/products">Products</Link>
          <Link to="/auctions">
            <Gavel />
            Add products
          </Link>
        </nav>
      </div>

      <div className="header-right">
        <Link to="/cart">
          <button className="cart-button">
            <ShoppingCart />
            {itemCount > 0 && (
              <span className="cart-badge">{itemCount}</span>
            )}
          </button>
        </Link>

        {isAuthenticated ? (
          <div style={{ position: 'relative' }}>
            <button 
              className="user-button"
              onClick={() => setShowDropdown(!showDropdown)}
            >
              <User />
            </button>
            {showDropdown && (
              <div className="user-dropdown">
                <div className="user-info">
                  <p className="user-name">{user?.name}</p>
                  <p className="user-email">{user?.email}</p>
                </div>
                <Link to="/profile" onClick={() => setShowDropdown(false)}>
                  <div className="dropdown-item">Profile</div>
                </Link>
                <div 
                  className="dropdown-item logout" 
                  onClick={() => {
                    logout();
                    setShowDropdown(false);
                  }}
                >
                  <LogOut />
                  Logout
                </div>
              </div>
            )}
          </div>
        ) : (
          <div className="auth-buttons">
            <Link to="/login">
              <button className="login-btn">Login</button>
            </Link>
            <Link to="/register">
              <button>Sign Up</button>
            </Link>
          </div>
        )}
      </div>
    </header>
  );
};
