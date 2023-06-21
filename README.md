<h1 style="text-align: center;">Diabetes Tracker</h1>

<p style="text-align: center;">
<img src="https://dia.vr-soft.eu/build/assets/dia-logo-128-f8818097.png" alt="diabetes-tracker">
</p>

This repository contains the source code for a [demo project](https://dia.vr-soft.eu), Diabetes Tracker, which serves as a blood sugar value
tracking system.  
The project allows users to register, confirm their email, and utilize various functionalities for managing their
diabetes-related data.

## Features

- User Registration: New users can sign up by providing their necessary details and creating an account. Upon
  registration, a confirmation email is sent to verify the user's email address.

- Forgot Password: Users who have forgotten their password can request a password reset. An email will be sent with
  instructions on how to reset their password securely.

- Medication Tracking: Users can keep track of their medications.

- Blood Sugar Tracking: Users can record their blood sugar values before and after meals, including breakfast, lunch,
  and dinner. By tracking these values, users can monitor their blood sugar levels and make informed decisions about
  their dietary choices.

- Dashboard: The dashboard provides users with a comprehensive overview of their diabetes-related data. It displays the
  lowest and highest recorded blood sugar values, a summary of their medication, and a graphical representation of the
  last seven blood sugar readings.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/rajtik76/vr-soft-dia.git
```

2. Navigate to the project directory:

```bash
cd vr-soft-dia
```

3. Install the project dependencies:

```bash
composer install && npm install
```

- Or you can use Laravel Sail service

4. Configure the project:

- Rename the .env.example file to .env.
- Update the required environment variables in the .env file, such as database credentials and email configuration.
- compile frontend assets

```bash
npm run build
```

5. Run migrations and seeder:

```bash
php artisan migrate --seed
```

## Technologies Used

- Frontend: HTML, TailwindCSS, Vite, Vue, TypeScript, Inertia.js
- Backend: Laravel 10
- Database: MySQL

## Contact

If you have any questions, suggestions, or feedback, feel free to reach out to us at [admin@vr-soft.eu](mailto:admin@vr-soft.eu)
