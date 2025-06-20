# Game Talk

A full-stack web application built to connect gaming enthusiasts, allowing them to explore free-to-play games, share comments, and engage in threaded discussions using Laravel 12, Tailwind CSS, and the FreeToGame API.

## About
Game Forum is a dynamic platform designed for gamers to discover and discuss free-to-play games. By integrating the FreeToGame API, the application provides real-time game data, including titles, descriptions, and thumbnails. Users can search for games, post comments, reply to discussions, and delete their own comments, all within a modern and responsive interface. The project emphasizes best practices in full-stack development, security, and user experience.

## Features
- **Game Exploration**: Fetch and display free-to-play games using the FreeToGame API.
- **Search Functionality**: Filter games by title or description for quick discovery.
- **Nested Comment System**: Authenticated users can post comments, reply to others, and delete their own comments.
- **Responsive Design**: Modern UI built with Tailwind CSS, optimized for desktop and mobile devices.
- **User Authentication**: Secure login/register system with Laravel Breeze, restricting comment actions to authenticated users.
- **Data Optimization**: Pagination for game listings and eager loading for efficient database queries.
- **Security**: CSRF protection, input validation, and authorization to ensure only comment owners can delete their posts.

## Technologies
- **Backend**: Laravel 12, PHP 8.2+, Eloquent ORM, MySQL
- **Frontend**: Tailwind CSS, Blade templating, JavaScript 
- **API**: FreeToGame API for game data
- **Tools**: Composer, npm, Git, Laravel Artisan
- **Database**: MySQL with polymorphic relationships for comments
- **Authentication**: Laravel Breeze for user management

## Installation
Follow these steps to set up the project locally:

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL
- Git

### Steps
1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/game-forum.git
   cd game-forum
   ```
2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```
3. **Copy the .env.example file to .env:**
   ```bash
   cp .env.example .env
   ```
4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```
5. **Run Migrations**
   ```bash
   php artisan migrate
   ```
6. **Start the Server**
   ```bash
   php artisan serve
   ```


