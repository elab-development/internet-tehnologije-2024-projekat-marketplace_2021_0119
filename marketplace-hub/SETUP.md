# Marketplace Setup Guide

## Overview

This is a modern marketplace application built with React, TypeScript, and Tailwind CSS that connects to your Laravel backend API.

## Features

- 🔐 **Authentication**: Complete login, registration, and password reset
- 🛍️ **Products**: Browse, search, and filter products
- 🎯 **Auctions**: View and participate in live auctions
- 🛒 **Shopping Cart**: Add items, manage quantities, and checkout
- 👤 **User Profile**: Manage account information
- 📱 **Responsive Design**: Beautiful UI that works on all devices

## Prerequisites

- Node.js (v18 or higher)
- npm or yarn
- Laravel backend API running

## Installation

1. **Clone the repository** (if not already done)

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Configure API endpoint**
   
   Create a `.env` file in the root directory:
   ```bash
   cp .env.example .env
   ```
   
   Update the API URL to match your Laravel backend:
   ```
   VITE_API_URL=http://localhost:8000/api
   ```
   
   Or use your production URL:
   ```
   VITE_API_URL=https://your-api-domain.com/api
   ```

4. **Start the development server**
   ```bash
   npm run dev
   ```
   
   The app will be available at `http://localhost:8080`

## Laravel Backend Configuration

### CORS Setup

Your Laravel backend needs to allow requests from this frontend. Update `config/cors.php`:

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],

'allowed_origins' => ['http://localhost:8080', 'http://localhost:5173'],

'supports_credentials' => true,
```

### API Routes

Make sure your Laravel `routes/api.php` includes all the routes as shown in your configuration:

- `/register` - User registration
- `/login` - User login
- `/logout` - User logout (protected)
- `/profile` - Get user profile (protected)
- `/proizvods` - Products CRUD
- `/aukcijas` - Auctions endpoints
- `/users` - Users management
- `/forgot-password` - Password reset request
- `/reset-password` - Password reset

### Sanctum Configuration

If using Laravel Sanctum for authentication, update `.env`:

```
SANCTUM_STATEFUL_DOMAINS=localhost:8080,localhost:5173
SESSION_DOMAIN=localhost
```

## API Integration

The app includes a complete API client (`src/lib/api.ts`) that handles:

- Authentication (token management)
- All CRUD operations for products, auctions, users
- Automatic authorization headers
- Error handling

### Example API Response Format

Your Laravel API should return responses in this format:

**Success:**
```json
{
  "data": { ... },
  "message": "Success message"
}
```

**Error:**
```json
{
  "message": "Error message",
  "errors": { ... }
}
```

**Login Response:**
```json
{
  "token": "your-auth-token",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

## Project Structure

```
src/
├── components/          # Reusable UI components
│   ├── ui/             # shadcn/ui components
│   ├── Header.tsx      # Navigation header
│   ├── ProductCard.tsx # Product display card
│   └── AuctionCard.tsx # Auction display card
├── contexts/           # React contexts
│   ├── AuthContext.tsx # Authentication state
│   └── CartContext.tsx # Shopping cart state
├── pages/              # Page components
│   ├── Index.tsx       # Landing page
│   ├── Login.tsx       # Login page
│   ├── Register.tsx    # Registration page
│   ├── Products.tsx    # Products listing
│   ├── Auctions.tsx    # Auctions listing
│   ├── Cart.tsx        # Shopping cart
│   └── Profile.tsx     # User profile
├── lib/                # Utilities
│   └── api.ts          # API client
└── index.css           # Global styles & design system
```

## Design System

The app uses a carefully crafted design system with:

- **Primary Color**: Blue (#3B9FFF) - Trust and professionalism
- **Accent Color**: Orange (#FF9642) - Action and energy
- **Typography**: Clean, modern fonts
- **Components**: All styled using Tailwind CSS with semantic tokens
- **Shadows & Gradients**: Defined in CSS variables for consistency

## Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run preview` - Preview production build
- `npm run lint` - Run ESLint

## Environment Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `VITE_API_URL` | Backend API base URL | `http://localhost:8000/api` |

## Troubleshooting

### CORS Errors

If you see CORS errors in the console:
1. Check Laravel `config/cors.php` configuration
2. Ensure your frontend URL is in `allowed_origins`
3. Clear Laravel config cache: `php artisan config:clear`

### Authentication Issues

If login/logout doesn't work:
1. Verify API endpoint in `.env`
2. Check Laravel Sanctum configuration
3. Ensure cookies are enabled
4. Check browser console for errors

### Products Not Loading

If products don't appear:
1. Verify the API endpoint is correct
2. Check Laravel backend is running
3. Ensure database has product data
4. Check network tab for API responses

## Production Deployment

1. **Build the app**
   ```bash
   npm run build
   ```

2. **Update environment variables**
   Set `VITE_API_URL` to your production API URL

3. **Deploy the `dist` folder** to your hosting provider
   - Netlify
   - Vercel
   - AWS S3 + CloudFront
   - Any static hosting service

4. **Configure backend**
   - Update CORS settings for production domain
   - Update Sanctum stateful domains
   - Ensure HTTPS is enabled

## License

This project is built with Lovable and integrates with your Laravel backend.

## Support

For issues or questions, please refer to:
- [Lovable Documentation](https://docs.lovable.dev/)
- [Laravel Documentation](https://laravel.com/docs)
- [React Documentation](https://react.dev/)
