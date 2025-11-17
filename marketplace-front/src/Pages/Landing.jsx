import React from 'react'
import { NavBar } from '../Components/NavBar'
import './Styles/Landing.css'
import { createBrowserRouter,RouterProvider} from 'react-router-dom'
import { Login } from './Login'
import { Footer } from '../Components/Footer'



export const Landing = () => {


    return (
    <div className='landing-div'>
        <NavBar/>
        <h1>Welcome to our MARKETPLACE</h1>
        <Footer/>
    </div>
    
    
  )
}
