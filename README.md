# Laravel-Authentications

A robust Laravel 11+ authentication and authorization system featuring multi-role support, social login (GitHub, Google, Facebook), email/OTP verification, and user profile management.

## Features

- **User Registration & Login**: Standard authentication using email or phone number with password.
- **Logout**: Securely log out from the current session or all active devices.
- **Social Login**: GitHub, Google, and Facebook login via Laravel Socialite.
- **Password Reset**: Forgot/reset password with email support.
- **Email/OTP Verification**: Secure account verification via email or phone OTP.
- **User Profile Management**: View and update user profile details (name, email, phone).
- **User Roles & Permissions**: Admin, Teacher, Student roles with permission-based access control.
- **Role Management**: Admin can manage roles and assign permissions.
- **Session Security**: Database-backed session management.
- **Modern UI**: Built with Tailwind CSS and Vite.

## API endpoints

- `/api/login`
- `/api/register`
- `/api/logout`
- `/api/profile`
- `/api/refresh-token`

