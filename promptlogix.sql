CREATE DATABASE promptlogix;
USE promptlogix;

CREATE TABLE prompts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    version DECIMAL(3,1) NOT NULL DEFAULT 1.0,
    change_type ENUM('Initial', 'Update', 'Refinement') NOT NULL,
    content TEXT NOT NULL,
    reason TEXT,
    performance_impact TEXT,
    test_results TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);