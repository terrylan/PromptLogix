CREATE DATABASE IF NOT EXISTS promptlogix;
USE promptlogix;

CREATE TABLE IF NOT EXISTS prompts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prompt_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    version DECIMAL(5,2) NOT NULL,
    change_type ENUM('Initial','Update','Refinement','Branch') NOT NULL,
    hidden TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE INDEX idx_prompt_id ON prompts(prompt_id);

-- Sample Data
INSERT INTO prompts (prompt_id, name, content, version, change_type) VALUES
(1, 'Initial Prompt', 'This is the first prompt.', 1.0, 'Create');
