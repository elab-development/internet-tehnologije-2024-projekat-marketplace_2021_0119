import React from 'react'
import { Link } from 'react-router-dom'
import './ProductsNavBar.css'
export const ProductsNavBar = (props) => {

    return (
    <header className='header'>
        <input id='search-input' type="text" placeholder='Prodcut name' onChange={(e) => props.setSearchText(e.target.value)}/>
        <Link to='/bucket'>Bucket</Link>
    </header>
    )
}
