import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import { createBrowserRouter,RouterProvider } from 'react-router-dom';
import { Login } from './Pages/Login.jsx';
import { Landing } from './Pages/Landing.jsx';
import { SignUp } from './Pages/SignUp.jsx';
import { Products } from './Pages/Products.jsx';
import { Bucket } from './Pages/Bucket.jsx';
import { BucketProvider, useBucket } from './pages/BucketProvider.jsx';


const router = createBrowserRouter([
        {
            path: '/login',
            element: <Login />,
            errorElement: <div>Error 404</div>
        },
        {
          path:'/',
          element:<Landing/>,
          errorElement: <div>Error 404</div>
          
        },
        {
          path:'/signup',
          element:<SignUp/>,
          errorElement: <div>Error 404</div>
        },
        {
          path:'/products',
          element:<Products/>,
          errorElement:<div>Error 404</div>
        },
        {
          path:'/bucket',
          element:<Bucket/>,
          errorElement:<div>Error 404</div>
        }
]);


createRoot(document.getElementById('root')).render(
  <StrictMode>
      <BucketProvider>
            <RouterProvider router={router}/>
      </BucketProvider>
  </StrictMode>,
)
