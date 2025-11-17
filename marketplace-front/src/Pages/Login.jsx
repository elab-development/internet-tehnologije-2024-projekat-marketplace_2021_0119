import React, { useState } from 'react'
import { Button } from '../Components/Button'
import "./Styles/Login.css"
import { NavBar } from '../Components/NavBar'
import { useNavigate } from 'react-router-dom'

export const Login = () => {

    const [username,setUsername]=useState("")
    const [password,setPassword]=useState('')
    const [error, setError] = useState(''); 
    const [token, setToken] = useState(null);
    const navigate=useNavigate()

    const handleLogin=()=>{
        fetch('https://dummyjson.com/auth/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        username: username,
        password: password,
      }),
    })
    .then(res => {
      if (!res.ok) {
        throw new Error('Login failed');
      }
      return res.json();
    })
    .then(data => {
      setToken(data.accessToken);
      navigate('/products')
    })
    .catch(err => {
      setError(err.message || 'Error during login');
    })
    }

  return (
    <>
    <div className='login-div'>
        <NavBar/>
        <h1>Login</h1>
        <input className='input' type="text" placeholder='Email'  onChange={e => setUsername(e.target.value)}/>
        <input className='input' type="text" placeholder='Password' onChange={e => setPassword(e.target.value)}/>
        <div className="button-div">
            <Button name="Login" onClick={handleLogin}/>
        </div>

        {error && <p className="error">{error}</p>}
        {token && <p>Token: {token}</p>}
    </div>
    </>
)
}
