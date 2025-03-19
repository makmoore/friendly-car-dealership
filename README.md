# Friendly Car Dealership Database
## Objective
To create a relational database for a car dealership based on given criteria. A basic website created with php is used to interact with the database but was not the focus of the project.

## File Contents
- `create_database` - the folder containing all files to create and populate the database
- `php_files` - the folder containing all the php files

## Set-up Steps
Step 1: Download XAMPP (or similar local development server)
- In order to run a local host, you will first need to download XAMPP
- Once it is installed, click start on Apache AND MySQL
- Leave XAMPP running in the background and proceed to Step 2

Step 2: Create Database
- Run the SQL files in the create_database folder in the following order in MySQL:
		1. `create_database.sql`
		2. `insert_data.sql`
		3. `create_user.sql`
- This creates and populates the database that will be used for Friendly Car Dealership
- Once everything is created, continue to Step 4

Step 3: Move PHP files
- Access the folder in this directory called php_files
- Copy and paste all PHP files to the following location: C:\xampp\htdocs
  - This should be located on your local disk
- Once all files are in the htdocs folder you are ready to move to the final step

Step 4: Access Local Host
- Go to your web browser and type in the following address: `http://localhost/db_index.php`
- If all steps were completed correctly you should now see the main page of the Friendly Car Dealership database!


### Created by Makenzie Moore
