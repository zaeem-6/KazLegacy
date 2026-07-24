# KazLegacy

A full-stack insurance quotation management system built with PHP and MySQL. Originally developed as a diploma final year project, later revived and containerized with Docker.

The system supports three user roles — **Admin**, **Agent**, and **Client** — each with their own dashboard and workflows for managing insurance plans, agents, and quotations.

## Features

- **Client** — sign up, browse available insurance plans, submit a quotation request (personal details, plan selection, agent selection), track quotation status, view/download receipt
- **Agent** — view assigned quotations, update quotation progress (Pending/Completed), manage profile
- **Admin** — manage agents, manage insurance plans, view/search all quotations across the system
- Session-based authentication for all three roles
- Dynamic search (AJAX) across agent, client, and quotation tables
- Circular progress indicator showing an agent's quotation completion rate

## Tech Stack

- **Backend:** PHP 8.2 (mysqli)
- **Database:** MariaDB 10.4
- **Frontend:** HTML, CSS, vanilla JavaScript
- **Environment:** Docker & Docker Compose (Apache + PHP, MariaDB, phpMyAdmin)

## Getting Started

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running

### Setup

1. Clone the repo
   ```bash
   git clone https://github.com/zaeem-6/KazLegacy.git
   cd KazLegacy
   ```

2. Install PHP dependencies (Composer, used for a couple of vendor packages)
   ```bash
   cd src
   composer install
   cd ..
   ```

3. Start the containers
   ```bash
   docker compose up -d
   ```

4. Open the app
   - **App:** [http://localhost:8080](http://localhost:8080)
   - **phpMyAdmin:** [http://localhost:8081](http://localhost:8081) (login: `root` / `root`)

The database schema and seed data are automatically imported on first run from `db/schema.sql`.

### Default Logins

| Role  | Username | Password |
|-------|----------|----------|
| Admin | `admin`  | `admin123` |

> Agent and client accounts are seeded with placeholder data — check `db/schema.sql` for sample records, or sign up a new client account directly through the app.

## Project Structure

```
KazLegacy/
├── docker-compose.yml
├── db/
│   └── schema.sql        # Database schema + seed data
└── src/                  # PHP application source
    ├── index.php
    ├── dbConfig.php       # DB connection config
    └── ...
```

## Screenshots

<img width="1881" height="931" alt="image" src="https://github.com/user-attachments/assets/f41c9008-2a66-4288-a34f-fea7d44d460c" />
<img width="1908" height="931" alt="image" src="https://github.com/user-attachments/assets/ce49fee3-2015-4a9e-a1f2-9a2067ba0888" />
<img width="1906" height="930" alt="image" src="https://github.com/user-attachments/assets/822ed771-1c6f-44cf-8877-1f917ac4af28" />
<img width="1910" height="935" alt="image" src="https://github.com/user-attachments/assets/747154f7-e8f2-4899-be0d-c4bea7699e01" />

## Notes

This project was originally built without any AI assistance as a diploma final year project. It was later revived, containerized, and debugged (across a 3-year PHP/MariaDB version gap) for portfolio purposes.

## License

This project is for educational and portfolio purposes.
