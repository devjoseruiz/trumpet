# Trumpet MVC Framework

<div align="center">

<img src="https://raw.githubusercontent.com/devjoseruiz/trumpet-mvc-framework/refs/heads/master/src/public/assets/img/favicon.svg" alt="Trumpet Logo" width="100">

A lightweight PHP framework for building web applications using the Model-View-Controller (MVC) pattern.

![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)
![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white)

</div>

## Features

- **🚀 Modern Architecture:** Harness the power of PHP 8.2+ with cutting-edge design patterns and best practices.
- **🎯 Simple & Intuitive:** Designed for simplicity, offering an API that makes coding seamless and enjoyable.
- **🔧 Easily Customizable:** Tailor the framework effortlessly with a configuration system that adapts to you.
- **🐳 Docker Ready:** Get started instantly with a pre-configured Docker setup for hassle-free development.
- **📦 Easy Installation:** Install it in seconds using a single Composer command.
- **🗄️ Migrations:** Simplify your database updates with an intuitive migration system.
- **🔒 Form Validations:** Ensure data integrity with robust and easy-to-use form validation tools.
- **👥 User Authentication:** Quickly set up secure user authentication with pre-built functionalities.
- **📡 Session Management:** Effortlessly manage user sessions with built-in, streamlined tools.
- **🔗 Middleware:** Enhance your app’s functionality with customizable middleware support.
- **🎉 Application Events:** Easily handle app-wide events with an integrated event management system.
- **🛣️ Routing:** Define clear and efficient routes with a simplified routing engine.

## Getting Started

> At the moment, the framework is under early development and is not yet ready for production use.

### Previus steps

1. Clone the repository: `git clone https://github.com/devjoseruiz/trumpet-mvc-framework.git`.
2. Create your own `.env` file based on the `.env.example` file: `cp .env.example .env`.
3. Customize the `.env` file to fit your needs.

### Docker installation (highly recommended)

1. Navigate to the project directory: `cd trumpet-mvc-framework`.
2. Install the dependencies: `docker-compose exec php composer install`.
3. Start the application: `docker-compose up -d`.
4. Run the migrations: `docker-compose exec php php migrations.php`.
5. You can access the application at `http://localhost:8080`.

### Local installation

1. Navigate to the source directory: `cd trumpet-mvc-framework/src`.
2. Install the dependencies: `composer install`.
3. Run the migrations: `php migrations.php`.
4. Run the application: `php -S localhost:8080 -t public/`.

## Contributing

We welcome contributions from the community. Please follow the [Contributing Guidelines](https://github.com/devjoseruiz/trumpet-mvc-framework/blob/master/CONTRIBUTING.md) to contribute to the project.

## License

This project is released under the [GPLv3 License](https://github.com/devjoseruiz/trumpet-mvc-framework/blob/master/LICENSE).
