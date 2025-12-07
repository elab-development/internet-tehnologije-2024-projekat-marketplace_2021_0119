import { useCart } from '@/contexts/CartContext';
import '@/styles/ProductCard.css';

export const ProductCard = ({ id, naziv, cena, slika }) => {
  const { addItem } = useCart();

  return (
    <div className="product-card">
      <img
        src={slika ? `http://localhost:8000/storage/${slika}` : '/placeholder.png'}
        alt={naziv}
        className="product-image"
      />

      <h2>{naziv}</h2>
      <p>{cena} RSD</p>

      <button
        className="product-button"
        onClick={() => addItem({ id, naziv, cena, slika })}
      >
        Add to Cart
      </button>
    </div>
  );
};
