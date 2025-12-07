import { Header } from '@/components/Header';
import { useCart } from '@/contexts/CartContext';
import { useNavigate } from 'react-router-dom';
import '@/styles/Cart.css';

const Cart = () => {
  const { items, removeItem, updateQuantity, clearCart, total } = useCart();
  const navigate = useNavigate();

  const handleCheckout = async () => {
    if (items.length === 0) return;

    const token = localStorage.getItem('auth_token');
    if (!token) {
      alert("Niste ulogovani!");
      return;
    }

    const payload = {
      items: items.map(i => ({ id_proizvod: i.id, quantity: i.quantity }))
    };

    try {
      const res = await fetch('http://localhost:8000/api/kupovinas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(payload)
      });

      const text = await res.text(); // prvo pročitaj kao tekst
      let data = null;

      try {
        data = JSON.parse(text); // pokušaj da parsiraš JSON
      } catch (err) {
        console.error('Ne mogu da parsiram JSON:', err);
        console.log('Response text:', text); // vidi šta je stvarno došlo sa servera
        alert('Došlo je do greške pri kupovini: server je vratio nevalidan odgovor');
        return;
      }

      if (!res.ok) {
        console.log('Server error:', data);
        alert(data.message || 'Došlo je do greške pri kupovini');
        return;
      }

      alert(data.message || 'Kupovina uspešno izvršena');
      clearCart();
      navigate('/products');

    } catch (err) {
      console.error(err);
      alert('Došlo je do greške pri kupovini');
    }
  };

  if (items.length === 0) {
    return (
      <>
        <Header />
        <div className="cart-container">
          <div className="empty-cart">
            <h2>Your cart is empty</h2>
            <button onClick={() => navigate('/products')}>
              Continue Shopping
            </button>
          </div>
        </div>
      </>
    );
  }

  return (
    <>
      <Header />
      <div className="cart-container">
        <div className="cart-header">
          <h1>Shopping Cart</h1>
        </div>

        <div className="cart-items">
          {items.map((item) => (
            <div key={item.id} className="cart-item">
              <div className="cart-item-image" style={{
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                fontSize: '2rem',
                fontWeight: 'bold',
                color: 'rgba(255,255,255,0.3)'
              }}>
                {item.naziv.charAt(0)}
              </div>
              <div className="cart-item-info">
                <h3>{item.naziv}</h3>
                <p>Price: ${item.cena}</p>
                <p>Subtotal: ${(item.cena * item.quantity).toFixed(2)}</p>
              </div>
              <div className="cart-item-controls">
                <div className="quantity-control">
                  <button onClick={() => updateQuantity(item.id, item.quantity - 1)}>
                    -
                  </button>
                  <span>{item.quantity}</span>
                  <button onClick={() => updateQuantity(item.id, item.quantity + 1)}>
                    +
                  </button>
                </div>
                <button
                  className="remove-button"
                  onClick={() => removeItem(item.id)}
                >
                  Remove
                </button>
              </div>
            </div>
          ))}
        </div>

        <div className="cart-summary">
          <h2>Order Summary</h2>
          <p>Total: ${total.toFixed(2)}</p>
          <div className="cart-actions">
            <button onClick={handleCheckout}>
              Checkout
            </button>
            <button className="clear-button" onClick={clearCart}>
              Clear Cart
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Cart;