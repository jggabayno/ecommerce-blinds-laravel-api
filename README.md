# Ecommerce Blinds API (Laravel 8)

## Overview
This API provides authentication, product management, order handling, and other functionalities for an e-commerce platform. It utilizes **JWT authentication** and enforces **role-based access control (RBAC)** for Admin, Staff, and Customer roles.

## Authentication
- `POST /login` - User login
- `POST /signup` - User registration
- `POST /sendForgotPasswordEmail` - Send password reset email
- `PUT /resetpassword/{user}` - Reset password (requires a valid token)

## Products
- `GET /products` - List all products (paginated)
- `GET /productswithcolors` - List products with available colors
- `GET /productsizes` - List all product sizes
- `GET /productwithcolors/{product}` - Get product details with colors

## Authenticated Routes
**Requires `auth:api` middleware**

### Image Upload
- `POST /imageupload` - Upload an image

### Brands
- `GET /brandsWithDateFilter` - List brands with a date filter
- `GET /brands` - List all brands
- `GET /brandsWithAll` - List all brands with additional data

### Orders
- `GET /orders` - List all orders
- `GET /ownorders` - List user-specific orders
- `POST /orders` - Create a new order
- `PUT /orders/{order}` - Update an order (order status updates trigger notifications)
  - Order status updates trigger **notifications**:
    - **PLACED**: Order confirmation and payment received notification.
    - **PROCESSING**: Order is being processed.
    - **FOR DELIVERY**: Scheduled delivery notification.
    - **DELIVERED**: Successful delivery notification.
    - **CANCELLED**: Order cancellation and refund update notification.
    - **DELIVERY DATE CHANGED**: User is notified of delivery date changes.
  - Inventory updates when an order is marked as **FOR DELIVERY**:
    - Product stock is committed to the order.

### Checkouts
- `GET /checkouts` - List all checkouts
- `GET /checkout/{checkout_no}` - Get a checkout by ID
- `POST /checkouts` - Create a new checkout (separate from orders)

### Order Status
- `GET /orderstatus` - List order statuses

### Notifications
- `GET /notifications` - List all notifications
- `PUT /notifications/{notification}` - Update a notification
- **Notifications include:**
  - Order status updates
  - Delivery date changes
  - Email notifications for new user registration

### Ratings
- `GET /rates` - List ratings
- `POST /rates` - Submit a rating

### Order Cancellations
- `GET /order-cancellations` - List all order cancellations
- `GET /order-cancellations/{order_id}` - Get cancellation details
- `POST /order-cancellations` - Request order cancellation
- `PUT /order-cancellations/{order_cancellation}` - Update order cancellation

### User Profile
- `GET /profile` - Get user profile
- `PUT /profile/{user_id}` - Update user profile (users can update only their own profile)

### Product Sizes
- `POST /product/sizes` - Add a product size
- `POST /product/sizes/client` - Add a product size for a client

## Admin & Staff Routes
**Requires `admin_staff` middleware**

### Users
- `GET /usertypes` - List user types
- `GET /customers` - List customers
- `GET /users` - List users
- `POST /users` - Create a new user (role assignment supported)

### Brands Management
- `POST /brands` - Create a new brand
- `PUT /brands/{brand}` - Update brand details
- `DELETE /brands/{brand}` - Delete a brand (soft delete)

### Product Management
- `POST /products` - Create a product
- `PUT /products/{product}` - Update product details
- `DELETE /products/{product}` - Delete a product (soft delete)
- `GET /productsWithDateFilter` - Filter products by date

### Product Sizes Management
- `PUT /product/sizes/{size}` - Update product size
- `DELETE /product/sizes/{size}` - Delete product size
- `GET /productSizesWithDateFilter` - Filter product sizes by date

### Product Colors Management
- `GET /product/colors` - List product colors with product & brand
- `POST /product/colors` - Add a product color
- `PUT /product/colors/{color}` - Update a product color
- `DELETE /product/colors/{color}` - Delete a product color
- `GET /productColorsWithDateFilter` - Filter product colors by date

### Payments
- `GET /payments` - List payments
- `GET /paymentsWithDateFilter` - Filter payments by date

### Inventory
- `GET /inventories` - List inventories
- `GET /inventories/{color_id}` - Get inventory details by color ID
- `POST /inventories` - Add inventory data
- **Inventory Updates**:
  - When an order is **FOR DELIVERY**, the corresponding product stock is marked as committed.

### Dashboard
- `GET /dashboard` - Get dashboard analytics
- `GET /accreceivable` - List account receivables
- `GET /accountsReceivableWithDateFilter` - Filter account receivables by date

## Customer Routes
**Requires `customer` middleware**

### Product Colors
- `GET /colors/{color}` - Get product color details

### Product Sizes
- `POST /productsizes` - Add a product size

### Cart
- `GET /cart` - View cart
- `POST /cart` - Add/update cart items
- `PUT /cart/{cart}` - Update cart item
- `DELETE /cart` - Clear cart (removes all items)

## Requirements

- PHP 7.3+ or 8.0+
- Composer
- MySQL
- Node.js (for front-end assets)

## Installation

1. **Clone the Repository:**
   ```bash
   git clone using ssh or https
   cd ecommerce-blinds-laravel-api
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Set Up Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database:**
   Edit the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run Migrations and Seed Data:**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Server:**
   ```bash
   php artisan serve
   ```
   The app will be accessible at `http://127.0.0.1:8000`.

## Conclusion
The **Ecommerce Blinds API** provides a robust, secure, and scalable backend solution for managing an e-commerce platform. With comprehensive role-based authentication, order processing, and inventory management, this API ensures a seamless shopping experience for customers while maintaining efficient operations for administrators and staff. Future enhancements can include integrating third-party payment gateways, real-time analytics, and improved customer engagement features.