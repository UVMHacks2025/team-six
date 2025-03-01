# Rally Cat's Cupboard Inventory System

**Rally Cat's Cupboard Inventory System** is a web-based application designed to manage the food inventory at Rally Cat's Cupboard—a UVM on-campus food pantry. The system provides an easy-to-use interface for volunteers to add, update, and search for food items, and for administrators to receive low-stock and out-of-stock email alerts.

---

## Table of Contents

- [Features](#features)
- [Installation and Setup](#installation-and-setup)
- [Usage](#usage)
- [Admin Notifications](#admin-notifications)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [License](#license)

---

## Features

- **Inventory Management:**  
  Add new food items with details such as food type, quantity, expiration date, dietary considerations, and allergen information.

- **Low Stock Alerts:**  
  Automatically send email notifications to administrators when an item’s stock falls below a defined threshold or reaches zero.

- **Search and Filter:**  
  Search for food items by name and filter by allergies or dietary options.

- **User Authentication:**  
  Only registered and logged-in users can add or modify food items.

- **Data Analytics:**  
  View a bar chart visualization of current food stock levels.

- **Request Submission:**  
  Public users can submit item requests via a dedicated request form.

---

## Installation and Setup

### Prerequisites

- [PHP 7.2+](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/) (for Chart.js)

### Steps

1. **Clone the Repository:**
    ```bash
    git clone https://github.com/UVMHacks2025/team-six.git
    cd team-six
    ```

2.	**Install PHP Dependencies:**
    ```bash
    composer install
    ```
3. **Install Front-End Dependencies:**
    ```bash
    npm install chart.js
    ```

4. **Set Up Environment Variables:**
Create a .env file in the project root with the following variables:
    ```ini
    DBNAME=your_database_name
    DBUSER=your_database_username
    DBPASS=your_database_password
    ```

5.	Import the Database Schema:
Use the provided SQL scripts in the sql.php file (or a separate .sql file if available) to create the following tables:
- users
- items
- item_log
- requests

6. Run the Application Locally:
Start the built-in PHP server:
    ```bash
    php -S localhost:8000 -t src/
    ```
Then, visit http://localhost:8000 in your browser.

## Usage

### For Volunteers
#### Add New Food Item:
Once logged in, volunteers can use the “Add New Food Item” form on the homepage to enter new donations. The form requires details such as food type, quantity, expiration date, dietary and allergen information, and an image of the item.

#### Search and Filter Inventory:
Use the search bar and dropdown filters on the homepage to locate specific food items.

#### View Item Details:
Click on an item card to open a modal displaying more detailed information about the food item. Logged-in users can adjust item quantities directly through the modal.

#### For Administrators
Receive Low Stock Alerts:
When an item’s quantity falls below the configured “Low Stock Alert Threshold” or reaches zero, the system automatically sends email notifications.

#### View Transaction Logs:
Administrators can view logs of all inventory transactions via the “Logs” page.

#### Analytics:
The “Analytics” page displays a bar chart showing current stock levels for each food type.

### Technologies Used
- Backend: PHP, PDO for MySQL database connectivity
- Frontend: HTML, CSS, JavaScript
- Charts: Chart.js for data visualization
- Environment Management: PHP Dotenv

### Project Structure
```
team-six/
│
├── src/
│   ├── css/
│   │   └── custom.css       # Main stylesheet
│   ├── public/
│   │   └── texts/
│   │       └── hours.txt    # Hours of operation text file
│   ├── about.php            # About page
│   ├── add_item.php         # Form submission for adding a new food item
│   ├── add_request.php      # Request submission form handler
│   ├── analytics.php        # Analytics dashboard (charts)
│   ├── authenticate.php     # Login authentication script
│   ├── connect-db.php       # Database connection
│   ├── footer.php           # Footer included on all pages
│   ├── index.php            # Homepage with item listings
│   ├── login.php            # User login page
│   ├── logout.php           # User logout script
│   ├── logs.php             # Inventory transaction logs
│   ├── make_request.php     # Public request form page
│   ├── nav.php              # Navigation bar
│   ├── register.php         # User registration page
│   ├── sql.php              # Database schema creation script
│   ├── top.php              # Header and beginning of the HTML document
│   ├── update_quantity.php  # AJAX endpoint for updating item quantities
│   └── view_requests.php    # Admin view for submitted requests
│
├── .gitignore
├── composer.json
├── composer.lock
├── LICENSE
├── NotesFromRep.md        # Notes from project rep
├── package.json
└── README.md              # This file
```

### License
This project is licensed under the MIT License. See the LICENSE file for details.