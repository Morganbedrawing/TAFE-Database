# SunnySpot Holidays
## Made For TAFE education
T.morgan
This project has been created as part of TAFE CI_ServersideDatabase_AE_Pro2. 

## Project Overview
SunnySpot Holidays is a web application designed to provide information and management capabilities for various types of accommodations, including camping, caravans, and cabins. The application allows users to view available cabins, and administrators to manage cabin information through an administrative interface.

## Project Structure
The project consists of the following files and directories:

- **css/style.css**: Contains styles for the SunnySpot website, defining layout, colors, fonts, and other visual aspects.
- **images/**: Folder containing image files used throughout the website, including cabin photos and other relevant images.
- **includes/db_connect.php**: Establishes a connection to the SunnySpot database using MySQLi or PDO, with error handling for connection issues.
- **includes/header.php**: Contains the HTML code for the header section of the website, including navigation and branding.
- **includes/footer.php**: Contains the HTML code for the footer section of the website, including copyright information and additional links.
- **index.html**: Main landing page of the SunnySpot website, providing an overview of services offered.
- **allCabins.php**: Retrieves and displays all cabin information from the database, including type, description, price per night, price per week, and images.
- **adminMenu.php**: Administrative menu providing links to insert, update, and delete cabin information.
- **insertCabin.php**: Form for inserting a new cabin into the database, including image upload functionality and input validation.
- **updateCabin.php**: Allows users to select a cabin to update, displaying current details in a form for editing.
- **deleteCabin.php**: Provides a list of cabins for users to select and delete from the database.

## Setup Instructions
1. **Clone the Repository**: Download or clone the SunnySpot Holidays project to your local machine.
2. **Install XAMPP**: Ensure that XAMPP is installed and running on your machine.
3. **Create Database**: Use phpMyAdmin to create a database named `SunnySpot` and import the provided SQL file to set up the cabin table.
4. **Configure Database Connection**: Update the `includes/db_connect.php` file with your database credentials.
5. **Access the Application**: Open your web browser and navigate to `http://localhost/sunnyspot-holidays/index.html` to view the application.

## Features
- View all available cabins with detailed information.
- Administrative interface for managing cabin data (insert, update, delete).
- Image upload functionality for new cabins.
- Input validation for cabin details to ensure data integrity.

## Contributing
Contributions to the SunnySpot Holidays project are welcome. Please fork the repository and submit a pull request for any changes or enhancements.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.
