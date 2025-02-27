# Word Game Challenge

## Requirements
- **PHP**: 8.2+
- **CodeIgniter**: 4.6
- **Database**: MySQL (or any supported database)
- **Composer**: Installed for dependency management

## Installation Steps
1. **Clone the Repository**:
   ```sh
   git clone https://github.com/yeswecan2023/WordGameChallange.git
   cd WordGameChallange
   ```

2. **Install Dependencies**:
   ```sh
   composer install
   ```

3. **Configure Environment**:
   - Copy `.env.example` to `.env` if not already present:
     ```sh
     cp env .env
     ```
   - Open `.env` and configure the database settings:
     ```ini
     database.default.hostname = localhost
     database.default.database = your_database_name
     database.default.username = your_db_user
     database.default.password = your_db_password
     database.default.DBDriver = MySQLi
     ```

4. **Run Migrations**:
   ```sh
   php spark migrate
   ```
   
5. **Start the Server**:
   ```sh
   php spark serve
   ```
   The application will run at:
   [http://localhost:8080/index.php/wordgame](http://localhost:8080/index.php/wordgame)

## Usage
- Open the game in your browser: [http://localhost:8080/index.php/wordgame](http://localhost:8080/index.php/wordgame)
- Play the game and submit words.
- Scores will be stored in the `scores` table.

## Troubleshooting
- If migrations fail, ensure your database is set up correctly.

## Author
Created by **Vishnu Athistaraja**.
