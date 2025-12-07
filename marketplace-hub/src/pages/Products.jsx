import { useState, useEffect } from 'react';
import { Header } from '@/components/Header';
import { ProductCard } from '@/components/ProductCard';
import { api } from '@/lib/api';
import '@/styles/Products.css';

const Products = () => {
  const [allProducts, setAllProducts] = useState([]);
  const [products, setProducts] = useState([]);
  const [page, setPage] = useState(1);
  const [maxPrice, setMaxPrice] = useState(5000);
  const [loading, setLoading] = useState(true);

  const limit = 12;
  const startIndex = (page - 1) * limit;
  const endIndex = startIndex + limit;
  const productsToShow = products.slice(startIndex, endIndex);
  const totalPages = Math.ceil(products.length / limit);

  useEffect(() => {
    fetchProducts();
  }, []);

  useEffect(() => {
    const filtered = allProducts.filter((p) => p.cena <= maxPrice);
    setProducts(filtered);
    setPage(1);
  }, [allProducts, maxPrice]);

  const fetchProducts = async () => {
    setLoading(true);
    const response = await api.getProducts();
    if (response.data) {
      setAllProducts(response.data);
      setProducts(response.data);
    }
    setLoading(false);
  };

  return (
    <>
      <Header />
      <div className="products-container">
        <div className="price-filter">
          <label>Max Price: {maxPrice}$</label>
          <input
            type="range"
            min="0"
            max="10000"
            step="100"
            value={maxPrice}
            onChange={(e) => setMaxPrice(Number(e.target.value))}
          />
        </div>

        {loading ? (
          <div className="no-products">Loading...</div>
        ) : productsToShow.length === 0 ? (
          <div className="no-products">No products found</div>
        ) : (
          <div className="all-products">
            {productsToShow.map((product) => (
              <ProductCard
                key={product.id}
                id={product.id}
                naziv={product.naziv}
                cena={product.cena}
                slika={product.slika}
              />
            ))}
          </div>
        )}

        {!loading && products.length > 0 && (
          <div className="pagination">
            <button disabled={page === 1} onClick={() => setPage(page - 1)}>
              ⬅ Prev
            </button>
            <span>
              Page {page} of {totalPages}
            </span>
            <button disabled={page === totalPages} onClick={() => setPage(page + 1)}>
              Next ➡
            </button>
          </div>
        )}
      </div>
    </>
  );
};

export default Products;
