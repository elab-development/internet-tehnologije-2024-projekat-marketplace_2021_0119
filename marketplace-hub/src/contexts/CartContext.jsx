import React, { createContext, useContext, useState } from 'react';
import { useToast } from '@/hooks/use-toast';

const CartContext = createContext(undefined);

export const CartProvider = ({ children }) => {
  const [items, setItems] = useState([]);
  const { toast } = useToast();

  const addItem = (item) => {
          alert("Proizvod uspešno dodat!");
    setItems((prevItems) => {
      const existingItem = prevItems.find((i) => i.id === item.id);

      // odložen toast
      setTimeout(() => {
        if (existingItem) {
          toast({
            title: "Updated cart",
            description: `Increased quantity of ${item.naziv}`,
          });
        } else {
          toast({
            title: "Added to cart",
            description: `${item.naziv} has been added to your cart`,
          });
        }
      });

      if (existingItem) {
        return prevItems.map((i) =>
          i.id === item.id ? { ...i, quantity: i.quantity + 1 } : i
        );
      }
      return [...prevItems, { ...item, quantity: 1 }];
    });
  };

  const removeItem = (id) => {
    setItems((prevItems) => {
      const item = prevItems.find((i) => i.id === id);

      setTimeout(() => {
        if (item) {
          toast({
            title: "Removed from cart",
            description: `${item.naziv} has been removed`,
          });
        }
      });

      return prevItems.filter((i) => i.id !== id);
    });
  };

  const updateQuantity = (id, quantity) => {
    if (quantity <= 0) {
      removeItem(id);
      return;
    }
    setItems((prevItems) =>
      prevItems.map((i) => (i.id === id ? { ...i, quantity } : i))
    );
  };

  const clearCart = () => {
    setItems([]);
    setTimeout(() => {
      toast({
        title: "Cart cleared",
        description: "All items have been removed from your cart",
      });
    });
  };

  const total = items.reduce((sum, item) => sum + item.cena * item.quantity, 0);
  const itemCount = items.reduce((sum, item) => sum + item.quantity, 0);

  return (
    <CartContext.Provider
      value={{
        items,
        addItem,
        removeItem,
        updateQuantity,
        clearCart,
        total,
        itemCount,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => {
  const context = useContext(CartContext);

  if (context === undefined) {
    throw new Error('useCart must be used within a CartProvider');
  }
  return context;
};
