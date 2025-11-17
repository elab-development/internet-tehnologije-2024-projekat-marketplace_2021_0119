import React, { createContext, useState } from 'react'
import { useContext } from 'react'

const bucketContext=createContext();

export const BucketProvider = ({children}) => {

    const [bucketItems,setBucketItems]=useState([])

    const addToBucket=(newItem)=>{
        setBucketItems((p)=>[...p,newItem])
    }



    return (
    <bucketContext.Provider value={{bucketItems,addToBucket}}>
        {children}
    </bucketContext.Provider>
  )
}

export const useBucket = () => useContext(bucketContext);