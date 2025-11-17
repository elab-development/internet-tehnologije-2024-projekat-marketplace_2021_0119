import React from 'react'
import './NavBar.css'
import { Link } from 'react-router-dom'
import { Login } from '../pages/Login'


export const NavBar = () => {
  return (
    <header className='header'>
        <Link to='/'>Home</Link>
        <Link to='/login'>Login</Link> 
        <Link to='/signup'>Sign up</Link>
    </header>
  )
}
