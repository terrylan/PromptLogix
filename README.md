# PromptLogix

PromptLogix is a simple web-based UI tool for managing prompt versions using PHP and MariaDB. It allows users to create, edit, view, hide, unhide, and export prompts while maintaining a versioning system.

## Features
- **CRUD Functionality**: Create, Read, Update (by versioning), and Hide prompts
- **Version Control**: Each update creates a new version instead of modifying existing ones
- **Branching**: Fork a new prompt from an existing one with a new prompt ID
- **Export**: Download prompt data for backup or offline use
- **Hidden Prompt Management**: Hide and unhide versions without deleting data
- **Responsive UI**: Easy navigation and management

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/terrylan/PromptLogix.git
   cd PromptLogix
   ```
2. Set up the database:
   - Import `schema.sql` into your MariaDB instance.
   - Ensure the `config.php` file has the correct database credentials.
3. Run the application on a local or hosted server:
   ```sh
   php -S localhost:8000
   ```
4. Access the application via:
   ```
   http://localhost:8000/index.php
   ```

## Database Schema
- `id` (Primary Key, Auto-increment)
- `prompt_id` (Unique Identifier for a set of versions)
- `name` (Prompt Name)
- `content` (Prompt Content)
- `version` (Float, Tracks versioning)
- `change_type` (Update, Branch, etc.)
- `hidden` (Boolean, Default 0)
- `created_at` (Timestamp)
- `updated_at` (Timestamp)

## Usage
- **Adding a Prompt**: Use `add.php` to create a new prompt.
- **Editing a Prompt**: `edit.php` inserts a new version while keeping the original.
- **Branching a Prompt**: `branch.php` creates a new prompt ID from an existing prompt.
- **Hiding/Unhiding Prompts**: `hide.php` and `unhide.php` manage visibility.
- **View hidden Prompts**: `hidden.php` shows all hidden prompt versions.
- **Viewing Versions**: `view.php` shows all versions of a prompt.
- **Exporting Data**: Use `export.php` to download prompt data.

## License
MIT License

## Author
Terrylan - 

