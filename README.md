# Phonebook Application

A modern, responsive phonebook application built with Laravel, Inertia.js, and Vue.js. This application allows users to manage their contacts with features like adding, searching, and deleting contacts.

## Features

- 📱 Responsive design that works on both mobile and desktop
- 🔍 Search functionality for contacts
- ➕ Add new contacts with name and phone number
- ❌ Delete existing contacts
- 📱 Collapsible add contact form to save space
- 🌓 Dark mode support
- 📱 Mobile-first design
- 🔒 Input validation and error handling
- 📊 Pagination for contact list
- 🌐 Multi-language support (English and Spanish)

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
if in cmd/win 
```bash
(npm install) -and (npm run build)
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
if in cmd/win 
```bash
echo database/database.sqlite
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

## Testing

The application uses Pest PHP for backend testing and Vitest for frontend component testing.

### Backend Tests (Pest)

Run all backend tests: (auth-related features are not enabled)
```bash
php artisan test
```

Run specific test file: 
```bash
php artisan test tests/Unit/ContactTest.php -v
```

Run tests with verbose output:
```bash
php artisan test -v
```

### Frontend Tests (Vitest)

Run all frontend component tests: (only tests add form, for now)
```bash
npm test
```

The frontend tests cover:
- Component rendering
- Form submission
- Validation error handling
- Component state management
- User interactions

Example test output:
```bash
PASS  resources/js/components/__tests__/ContactForm.test.ts
✓ renders properly                                                             0.09s
✓ submits form data when submitted                                             0.02s
✓ shows validation errors when submitting empty form                           0.02s
✓ toggles form visibility when button is clicked                              0.02s

Tests:    4 passed (7 assertions)
Duration: 0.29s
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

### Notes
- All of laravels default auth code has been bypassed for simplicity, but not removed.
- Contacts could be easily added with a relationship to the user_id. But again, simple. For now the apps runs locally for a single user.
- Auth-related tests have been commented out. But not removed, might need them in the future.
- Adding user register-login, so each user could have its own contacts should be simple, as nothing in the auth-scaffold was deleted.

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 