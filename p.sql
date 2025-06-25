CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    activity_level ENUM('Sedentary', 'Lightly Active', 'Moderately Active', 'Very Active', 'Super Active') NOT NULL,
    consultation_type VARCHAR(255) NOT NULL,
    contact_method ENUM('Email', 'Phone', 'In-Person') NOT NULL,
    appointment_date DATE NOT NULL,
    current_weight DECIMAL(5,2) NOT NULL,
    target_weight DECIMAL(5,2) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE meals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meal_name VARCHAR(255) NOT NULL,
    meal_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE meals ADD COLUMN calories INT NOT NULL DEFAULT 0;

CREATE TABLE care_providers (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialty VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO care_providers (name, specialty, email, phone) VALUES
('Dr. John Doe', 'Nutritionist', 'john@example.com', '+1234567890'),
('Dr. Jane Smith', 'Dietitian', 'jane@example.com', '+0987654321');

CREATE TABLE consultation_requests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    provider_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (provider_id) REFERENCES care_providers(id)
);