import React, { useState,useEffect } from 'react'
import { ProductCard } from '../Components/ProductCard'
import './Styles/Products.css'
import { ProductsNavBar } from '../Components/ProductsNavBar'
import { Breadcrumbs } from '../Components/BreadCrumbs'

export const Products = () => {
    const [allProducts, setAllProducts] = useState([])
    const [products,setProducts]=useState([])
    const [page, setPage] = useState(1);
    const [total, setTotal] = useState(0);
    const [search,setSearch]=useState()
    const [maxPrice, setMaxPrice] = useState(50); 
    const limit = 12;
    const startIndex = (page - 1) * limit;
    const endIndex = startIndex + limit;
    const productsToShow = products.slice(startIndex, endIndex);
    


    useEffect(()=>{
       fetch(`https://dummyjson.com/products?limit=100`)
      .then(res => res.json())
      .then(data => {
        setAllProducts(data.products) 
        setProducts(data.products)    
        setTotal(data.total)
      });
    },[page]) 

    useEffect(() => {
      setPage(1);   
    }, [search, maxPrice]); 
     
    const totalPages = Math.ceil(total / limit);

     useEffect(() => {
    let filtered = allProducts;

    if (search) {
      filtered = filtered.filter(p =>
        p.title.toLowerCase().includes(search.toLowerCase())
      );
    }

    filtered = filtered.filter(p => p.price <= maxPrice);

    setProducts(filtered);
  }, [allProducts, search, maxPrice]);

  const handlePriceFilter = (value) => {
    setMaxPrice(Number(value));
  };

  const handleProductSearch = (text) => {
    setSearch(text);
  };

  

  return (
    <div>
        <ProductsNavBar handleSearch={handleProductSearch} setSearchText={setSearch}/>
        <div className="price-filter">
        <label>Max Price: {maxPrice}$</label>
        <input
          type="range"
          min="0"
          max="20000"
          step="10"
          value={maxPrice}
          onChange={(e) => handlePriceFilter(e.target.value)}
        />
      </div>
        <div className="all-products">
            {productsToShow.map((p,index)=><ProductCard key={index} name={p.title} price={p.price} image={p.thumbnail} prod={p}/>)}
        </div>
        <div className="pagination">
            <button className='next-previous-btn' disabled={page === 1} onClick={() => setPage(page - 1)}>⬅ Prev</button>
            <span>Page {page} of {totalPages}</span>
            <button className='next-previous-btn' disabled={page === totalPages} onClick={() => setPage(page + 1)}>Next ➡</button>
            <Breadcrumbs/>
        </div>
        
    </div>
    

  )
}
