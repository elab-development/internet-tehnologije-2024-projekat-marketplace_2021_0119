import React from 'react'
import './Styles/Signup.css'
import { Button } from '../Components/Button'
import {NavBar} from '../Components/NavBar'

export const SignUp = () => {
  return (
    <div className='signup-div'>
        <NavBar/>
        <h1>Sign up</h1>
        <input className='input' type="text" placeholder='First name'/>
        <input className='input' type="text" placeholder='Last name'/>
        <input className='input' type="text" placeholder='Email'/>
        <input className='input' type="text" placeholder='Password'/>
        <div className="button-div">
            <Button name="Sign up"/>
        </div>


    </div>
  )
}
