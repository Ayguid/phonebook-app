# Phonebook Application

A modern, responsive phonebook application built with Laravel, Inertia.js, and Vue.js. This application allows users to manage their contacts with features like adding, searching, and deleting contacts.

## Features

- 📱 Responsive design that works on both mobile and desktop
- 🔍 Real-time search functionality for contacts
- ➕ Add new contacts with name and phone number
- ❌ Delete existing contacts
- 📱 Collapsible add contact form to save space
- 🌓 Dark mode support
- 📱 Mobile-first design
- 🔒 Input validation and error handling
- 📊 Pagination for contact list

## Prerequisites

- PHP 8.1 or higher with SQLite extension enabled
- Composer
- Node.js and npm

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd phonebook-app
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install Node.js dependencies and build assets:
```bash
npm install && npm run build
```

4. Create a copy of the environment file:
```bash
cp .env.example .env
```

5. Generate application key (only needed for fresh installations):
```bash
php artisan key:generate
```

6. Create the SQLite database file:
```bash
touch database/database.sqlite
```

7. Run database migrations and seeders:
```bash
php artisan migrate:fresh --seed
```

## Running the Application

1. Start the development server:
```bash
composer run dev
```

2. Open your browser and navigate to:
```
http://localhost:8000
```

## Database Structure

The application uses SQLite as its database system, with a single `contacts` table containing the following structure:
- `id` - Auto-incrementing primary key
- `name` - Contact's name (string)
- `phone_number` - Contact's phone number (string, unique)
- `created_at` - Timestamp of creation
- `updated_at` - Timestamp of last update

The database file is located at `database/database.sqlite`.

## Features in Detail

### Contact Management
- Add new contacts with name and phone number
- Delete existing contacts
- Phone numbers must be unique
- Names can be duplicated (for multiple phone numbers of the same person)

### Search Functionality
- Search contacts by name or phone number
- Real-time search results
- Case-insensitive search
- Partial match support

### User Interface
- Clean, modern design
- Responsive layout for all screen sizes
- Collapsible add contact form
- Dark mode support
- Pagination for better performance with large contact lists

## Development

### Frontend
- Vue.js components in `resources/js/Components/`
- Pages in `resources/js/Pages/`
- Tailwind CSS for styling

### Backend
- Laravel controllers in `app/Http/Controllers/`
- Models in `app/Models/`
- Migrations in `database/migrations/`
- Seeders in `database/seeders/`

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 