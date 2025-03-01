<?php
include 'top.php';
?>
<main>
    <h2>Create Table Users</h2>
    <pre>
    CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        password_hash VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        salt VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        role VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
        failed_attempts INT NULL DEFAULT 0,
        is_locked TINYINT(1) NULL DEFAULT 0,
        PRIMARY KEY (id),
        KEY idx_username (username)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    </pre>

    <h2>Table to store food items</h2>
    <pre>
    CREATE TABLE items (
        id INT NOT NULL AUTO_INCREMENT,
        food_type VARCHAR(100) NOT NULL,
        quantity INT NOT NULL,
        exp_date DATE,
        location VARCHAR(100),
        allergies TEXT,
        dietary_considerations TEXT,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    </pre>

    <h2>Table to log item transactions</h2>
    <pre></pre>
    CREATE TABLE item_log (
        id INT NOT NULL AUTO_INCREMENT,
        item_id INT NOT NULL,
        action ENUM('added', 'removed') NOT NULL,
        user_id INT NOT NULL,
        action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        FOREIGN KEY (item_id) REFERENCES items(id),
        FOREIGN KEY (user_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    </pre>

    <h2>Table for requests</h2>
    <pre>
    CREATE TABLE requests (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        item1 VARCHAR(100) NOT NULL,
        item2 VARCHAR(100) DEFAULT NULL,
        item3 VARCHAR(100) DEFAULT NULL,
        request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    </pre>


</main>
<?php include 'footer.php'?>