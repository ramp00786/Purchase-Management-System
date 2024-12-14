# Purchase Management System

## Overview
The **Purchase Management System** is a web-based application built with Next.js and Laravel. It allows users to manage suppliers, products, and purchase orders efficiently. Users can create, list, and view invoices for purchase orders, calculate totals with GST, and maintain accurate records of all transactions.

## Features
- **Create Purchase Orders**: Add suppliers, select products, and specify quantities.
- **List Purchase Orders**: View a summarized table of all purchase orders with supplier details.
- **Invoice Details**: View detailed invoice information for a specific purchase order.
- **Real-time Calculations**: Automatically calculate subtotals, GST, and grand totals while creating orders.

## Technologies Used
- **Frontend**: Next.js (React)
- **Styling**: Bootstrap
- **Backend**: Laravel
- **Database**: MySQL
- **API Communication**: Axios

## Installation

### Prerequisites
Ensure you have the following installed:
- Node.js (>= 16.x)
- PHP (>= 8.x)
- Composer
- MySQL

### Frontend Setup (Next.js)
1. Navigate to the `frontend` directory:
   ```bash
   cd frontend
   ```
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the development server:
   ```bash
   npm run dev
   ```
   The application will run at `http://localhost:3000`.

### Backend Setup (Laravel)
1. Navigate to the `backend` directory:
   ```bash
   cd backend
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Configure the `.env` file:
   - Update the database connection settings.
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=purchase_db
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```
4. Run migrations and seed the database:
   ```bash
   php artisan migrate 
   and 
   php artisan make:seeder ProductSeeder
   php artisan make:seeder SupplierSeeder
   ```
5. Start the development server:
   ```bash
   php artisan serve
   ```
   The backend will run at `http://localhost:8000`.

## API Endpoints

### Products
- **GET** `/products`: Retrieve all available products.

### Suppliers
- **GET** `/suppliers`: Retrieve all available suppliers.

### Purchase Orders
- **GET** `/purchase`: Retrieve all purchase orders.
- **POST** `/submit-purchase`: Submit a new purchase order.
- **GET** `/invoice/{id}`: Retrieve invoice details for a specific purchase order.

## Folder Structure
```
project-root/
├── frontend/              # Next.js application
│   ├── invoice/            # Next.js invoice pages
│   ├── purchase/            # Next.js create order pages
│   ├── hooks/            # Next.js hooks
│   ├── components/       # Reusable components
│   └── utils/            # Axios and helper functions
│   ├── page.js/            # Next.js display all Purchase Orders
├── backend/               # Laravel application
│   ├── app/              # Application logic
│   ├── database/         # Migrations and seeders
│   └── routes/           # API routes
└── README.md              # Project documentation
```

## Usage
1. Open the frontend application in your browser (`http://localhost:3000`).
2. Navigate to **Create Order** to add a new purchase order.
3. View all purchase orders under the **All Purchase Orders** page.
4. Click on an order to view its detailed invoice.

## Contributing
Feel free to fork this repository and submit pull requests for improvements or bug fixes.

## License
This project is licensed under the MIT License. See the `LICENSE` file for details.

## Contact
For inquiries or support, please contact:
- Name: [Tulsiram Kushwah]
- Email: [ramp00786@gmail.com](mailto:ramp00786@gmail.com)
- GitHub: [https://github.com/your-repo](https://github.com/ramp00786/Purchase-Management-System.git)
