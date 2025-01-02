<h1 align="center">
SimpleERP 
</h1>

<p align="center">
  <img src="https://drive.google.com/uc?id=1olfMsiOQPFjCCnQ_ujLUSAT_TqZlnDxx" alt="SimpleERP Image"/>
</p>


Welcome to **SimpleERP** – a **lightweight enterprise resource planning (ERP)** system designed to simplify business management processes. With a user-friendly interface and robust database integration, SimpleERP helps businesses efficiently manage customer data, inventory, and invoice generation.

---

## **Prerequisites**

Before running the project, ensure you have the following tools installed on your system:

- **XAMPP or WAMP**: To set up a local PHP server.
- **MySQL**: For database management.
- **Git**: To clone the project repository.
- A modern web browser such as **Google Chrome**, **Mozilla Firefox**, or **Microsoft Edge**.

---

## **Installation Guide**

Follow these steps to get SimpleERP running on your local machine:

---

### 1. Clone the Project
Use the following command to clone the repository to your local machine:
```bash
git clone https://github.com/Mufli-Mohideen/simpleERP
```

### 2. Move to the Web Server Directory
Copy the project folder into the web server directory:

- **XAMPP**: Place it in the `htdocs` folder (e.g., `C:/xampp/htdocs/`).
- **WAMP**: Place it in the `www` folder (e.g., `C:/wamp/www/`).

### 3. Setup the Database
1. Open your MySQL database tool (e.g., phpMyAdmin).
2. Create a new database named `simpleerp`.
3. Import the provided SQL file:
   - Navigate to the `assignment(1) 1.sql` file included in the project.
   - Import it into the `simpleerp` database.

### 4. Update Database Configuration
1. Open the `db.php` file in the project directory.
2. Update the database connection settings with your MySQL username and password:
   ```php
   $db_user = 'your_username';
   $db_pass = 'your_password';
   ```
## 5. Run the Project

Open your browser and navigate to: http://localhost/CsquareProject/


You should now be able to access and use the **SimpleERP** system.

---

## Project Structure

- **Frontend**:  
  Built using HTML, CSS, and JavaScript to create a user-friendly interface.

- **Backend**:  
  PHP scripts handle server-side logic and database interactions.

- **Database**:  
  MySQL database with pre-configured tables and sample data to support the system.

---

## Features

1. **Customer Management**:  
   - Add, update, delete, and retrieve customer data.  
   - Includes fields like title, name, contact number, and district.  

2. **Item Management**:  
   - Add, update, delete, and retrieve item details.  
   - Fields include item code, name, category, sub-category, quantity, and unit price.  

3. **Invoice Generation**:  
   - Generate detailed invoices using the **FPDF library**.  
   - Include reports like invoice summary, itemized details, and customer information.
