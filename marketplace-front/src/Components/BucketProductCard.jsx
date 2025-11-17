import React, { useState } from 'react'
import { Button } from './Button'
import { useBucket } from '../pages/BucketProvider'

export const BucketProductCard = (props) => {

  return (
    <div className="product-card">
        <h2>{props.name}</h2>
        <img src={props.image} alt={props.name} className="product-image" />
        <p>{props.price}$</p>
    </div>
  )
}
