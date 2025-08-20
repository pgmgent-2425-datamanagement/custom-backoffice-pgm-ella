# Urban Flowers Backoffice

**Student:** Ella Jekale  
**Student Number:** 202126115  
**Course:** PGM2  

*'No need to specific login credentials for the backoffice!'*

---

## Project Description  

The Urban Flowers Backoffice is a custom-built management system for a flower shop. It provides administrators with an easy-to-use interface to manage the store’s products, such as flowers and bouquets.  

The application is built with PHP and MySQL following the MVC pattern. It allows CRUD (Create, Read, Update, Delete) operations on products, while also supporting image uploads and price management.  

### Key Features  
- Manage flowers and bouquets (add, edit, delete).  
- Upload images for each product.  
- Update product details including names, descriptions, and prices.  
- Organized views for bouquets, flowers, and clients.  
- Extendable structure for future features (e.g., authentication, more product types).  

### Technology Stack  
- **Backend:** PHP (custom MVC)  
- **Database:** MySQL  
- **Frontend:** HTML, PHP views with Bootstrap/Tailwind for styling  
- **Charts & Statistics:** Chart.js (for admin dashboard visualization)  

---

## Authentication  

Currently, the system does not require login credentials for access. However, authentication functionality can be added to secure the backoffice.  

---

## Installation  
1. Clone the repository from GitHub.  
2. Import the database from `database.sql` into MySQL.  
3. Configure the `.env` file with your database connection details.  
4. Run the application locally via a PHP server or DDEV/Docker.  

---

## Database Model  
- Minimum of 6 tables, including:  
  - flowers  
  - bouquets  
  - clients  
  - users (optional for authentication)  
  - orders  
  - bouquet_flower (pivot table for many-to-many relation)  

The full model is documented in `databasemodel.pdf`.  

---

## Security  
- SQL Injection is prevented because all database queries use prepared statements with parameter binding (PDO).  
- Example: `SELECT * FROM profiles WHERE id = :id` with `$stmt->execute(['id' => $id]);`  
- No user input is ever directly concatenated into SQL strings.  
- By using `prepare()` + `execute()`, the system ensures that unsafe input cannot be injected into queries.  

---