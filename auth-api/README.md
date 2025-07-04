# API Authentication Project

This project demonstrates how to implement API authentication in a Laravel application using Laravel Sanctum. The main features and steps completed in this project include:

## What Has Been Done

-   **Sanctum Setup:**

    -   Installed and configured Laravel Sanctum for API token authentication.
    -   Published Sanctum configuration and migration files.
    -   Ran migrations to create the `personal_access_tokens` table.

-   **User Authentication:**

    -   Created user registration and login endpoints.
    -   Implemented token issuing on successful login.
    -   Protected API routes using Sanctum middleware.

-   **Token Abilities:**
    -   Defined custom token abilities using the `TokenAbilities` enum.
    -   Assigned abilities to tokens during authentication.
    -   Restricted access to certain endpoints based on token abilities.
