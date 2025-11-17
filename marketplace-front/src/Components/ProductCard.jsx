import React, { useState } from 'react'
import { Button } from './Button'
import './ProductCard.css'
import { useBucket } from '../pages/BucketProvider'


export const ProductCard = (props) => {
  const [bucketList,setBucketList]=useState([])

  const {bucketItems,addToBucket}=useBucket();
  
  return (
    <div className="product-card">
        <h2>{props.name}</h2>
        <img src={props.image} alt={props.name} className="product-image" />
        <p>{props.price}$</p>
        <Button name='Buy' onClick={()=>addToBucket(props.prod)}/>
    </div>
  )
}
