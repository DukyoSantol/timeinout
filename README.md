# Time In/Out System

A Laravel-based time tracking system with employee time in/out functionality and admin dashboard.

## Features

- **Time In/Out Form**: Simple form for employees to record their time
- **Admin Dashboard**: Comprehensive dashboard for administrators
- **Real-time Statistics**: View active users, total hours, and daily summaries
- **Filtering & Search**: Filter records by division and date range
- **CRUD Operations**: Complete create, read, update, delete functionality
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS

## Requirements

- PHP 8.0+
- MySQL/MariaDB
- Composer
- Laravel 9.x

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd time-in-time-out
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=time_in_out
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   - Time In/Out Form: `http://localhost:8000/time-in-out`
   - Admin Dashboard: `http://localhost:8000/admin/dashboard`

## Usage

### For Employees
1. Go to the Time In/Out form
2. Fill in your details:
   - Full Name
   - Position
   - Division
   - Time In (automatically set to current time)
   - Time Out (optional, can be filled later)
   - Notes (optional)
3. Submit the form

### For Administrators
1. Access the Admin Dashboard
2. View real-time statistics:
   - Total records for today
   - Currently active employees
   - Total hours worked today
3. Manage records:
   - View all time records
   - Edit existing records
   - Mark time out for active records
   - Delete records
4. Filter records by:
   - Division
   - Date range

## File Structure

```
├── app/
│   ├── Http/Controllers/
│   │   └── TimeRecordController.php
│   └── Models/
│       └── TimeRecord.php
├── database/
│   └── migrations/
│       └── 2024_01_01_000001_create_time_records_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       └── time-records/
│           ├── form.blade.php
│           ├── edit.blade.php
│           └── index.blade.php
├── routes/
│   └── web.php
├── composer.json
└── README.md
```

## Database Schema

The `time_records` table includes:
- `id`: Primary key
- `full_name`: Employee full name
- `position`: Job position
- `division`: Department/division
- `time_in`: Check-in timestamp
- `time_out`: Check-out timestamp (nullable)
- `notes`: Additional notes (nullable)
- `total_hours`: Calculated total hours (nullable)
- `created_at`, `updated_at`: Timestamps

## Features in Detail

### Time In/Out Form
- Required fields: Full Name, Position, Division, Time In
- Optional fields: Time Out, Notes
- Auto-suggests time out (8 hours after time in)
- Form validation and error handling
- Success/error messages

### Admin Dashboard
- **Statistics Cards**: Real-time overview
- **Active Records**: Currently clocked-in employees
- **Today's Records**: All records for current day
- **Filtering**: By division and date range
- **Actions**: Edit, delete, time out functionality

### Data Management
- Automatic calculation of total hours
- Pagination for large datasets
- Soft delete protection (confirmations)
- Responsive tables and forms

## Technologies Used

- **Laravel 9.x**: PHP Framework
- **Tailwind CSS**: Utility-first CSS framework
- **MySQL**: Database
- **Blade**: Laravel templating engine

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License.
