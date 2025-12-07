import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '@/styles/Auctions.css';
import {Header} from '../components/Header'

const Auctions = () => {
  const [products, setProducts] = useState([]);
  const [naziv, setNaziv] = useState('');
  const [cena, setCena] = useState('');
  const [slika, setSlika] = useState('');
  const navigate = useNavigate();


  const handleImageChange = (e) => {
  const file = e.target.files?.[0];
  if (file) {
    setSlika(file); // čuvamo DIREKTNO fajl
    }
  };

  const handleSubmit = async (e) => {
  e.preventDefault();

  if (!naziv || !cena || !slika) {
    alert("Molimo popunite sva polja");
    return;
  }

  const token = localStorage.getItem("auth_token");

  if (!token) {
    alert("Niste ulogovani!");
    return;
  }

  const formData = new FormData();
  formData.append("naziv", naziv);
  formData.append("cena", cena);
  formData.append("slika", slika);

  try {
    const response = await fetch("http://localhost:8000/api/proizvods", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
      },
      body: formData,
    });

    const data = await response.json();

    if (!response.ok) {
      console.log(data);
      alert("Greška prilikom kreiranja proizvoda");
      return;
    }

    setProducts([...products, data]);
    setNaziv("");
    setCena("");
    setSlika("");

    alert("Proizvod uspešno dodat!");
    navigate("/products")
  } catch (error) {
    console.error(error);
    alert("Došlo je do greške na serveru");
  }
};

  const handleDelete = (id) => {
    setProducts(products.filter((p) => p.id !== id));
  };

  return (
    <div className="products-container">
      <Header/>
      <div className="products-header">
        <h1>Post your product</h1>
      </div>

      <div className="create-product-section">
        <form className="product-form" onSubmit={handleSubmit}>
          <div className="form-group">
            <label htmlFor="naziv">Naziv proizvoda</label>
            <input
              id="naziv"
              type="text"
              value={naziv}
              onChange={(e) => setNaziv(e.target.value)}
              placeholder="Unesite naziv proizvoda"
            />
          </div>

          <div className="form-group">
            <label htmlFor="cena">Cena</label>
            <input
              id="cena"
              type="number"
              step="0.01"
              value={cena}
              onChange={(e) => setCena(e.target.value)}
              placeholder="Unesite cenu"
            />
          </div>

          <div className="form-group">
            <label htmlFor="slika">Slika proizvoda</label>
            <input
              id="slika"
              type="file"
              accept="image/*"
              onChange={handleImageChange}
            />
          </div>

          <button type="submit" className="submit-btn">
            Kreiraj Proizvod
          </button>
        </form>
      </div>

      {products.length === 0 ? (
        <div className="no-products">Nema kreiranih proizvoda</div>
      ) : (
        <div className="all-products">
          {products.map((product) => (
            <div key={product.id} className="product-card">
              <img
                src={product.slika}
                alt={product.naziv}
                className="product-image"
              />
              <h3>{product.naziv}</h3>

              <div className="product-info">
                <p>
                  <strong>Cena:</strong> {product.cena.toFixed(2)} RSD
                </p>
              </div>

              <button
                onClick={() => handleDelete(product.id)}
                className="delete-btn"
              >
                Obriši
              </button>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default Auctions;
