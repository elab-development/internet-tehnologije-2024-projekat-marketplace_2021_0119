import { ProductsNavBar } from '../Components/ProductsNavBar'
import React from 'react'
import { useBucket } from './BucketProvider';
import { BucketProductCard } from '../Components/BucketProductCard';
import './Styles/Bucket.css'

export const Bucket = () => {
  
    const {bucketItems,addToBucket}=useBucket();
  
  
  
  return (
    <div>
        <ProductsNavBar/>
        <div className="bucket-items">
          {bucketItems.map((p,index)=><BucketProductCard key={index} name={p.title} price={p.price} image={p.thumbnail} prod={p}/>)}
        </div>
    </div>
  )
}
