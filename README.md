# Symfony API-Weather

## Project Description

Symfony API-Weather is a web service that provides weather notifications in subscribed cities via email and webhooks. Users and third-party services can register and obtain authentication tokens (JWT) to access the API. Users can subscribe/unsubscribe to cities, customize notification parameters (e.g., notification interval), edit subscriptions, and delete them. The application fetches actual weather data from third-party services.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [API Documentation](#api-documentation)
- [Project Structure](#project-structure)
- [UML Class Diagram](#uml-class-diagram)
- [Contributing](#contributing)
- [License](#license)

## Features

- User Registration: Users can register to obtain an authentication token (JWT).
- City Subscription: Users can subscribe to one or more cities for weather notifications.
- Customizable Notification Parameters: Users can set notification intervals (e.g., every 1, 3, 6, or 12 hours).
- Subscription Management: Users can edit and delete their city subscriptions.
- List Subscriptions: Users can retrieve a list of their active subscriptions.
- Weather Data Integration: The application fetches actual weather data from third-party services.

## Installation

To run this API locally, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/yourpotion/symfony-api-weather.git
   ```
2.Navigate to the project directory:
   ```bash
   cd instagram-on-symfony
   ```

3.Install dependencies:
   ```bash
   composer install
   ```

4.Configure your database connection in .env and run migrations: 
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5.Start the Symfony development server: 
   ```bash
   symfony server:start
   ```

Access the application in your web browser at http://localhost:8000.



## Project Structure
The project follows a typical Symfony application structure:

- src/: Contains application source code.
- config/: Configuration files.
- public/: Publicly accessible assets like CSS, JavaScript, and uploaded files.
- var/: Temporary files and cache.
- vendor/: Composer dependencies.
- bin/: Console commands and scripts.
- tests/: Unit and functional tests.
- docs/: Documentation files, including API documentation.
- UML Class Diagram


## Contributing
Contributions to this project are welcome. Please follow the contributing guidelines for details on how to contribute.

## License
This project is licensed under the MIT License.


