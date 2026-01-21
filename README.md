# TaskFlow

TaskFlow is a role-based project and task management system built with Laravel. It supports System Admin, Admin, and Agent roles, providing a full workflow from project approval to Kanban-style task tracking.

---

## Features

### System Admin
- Manage users and assign roles
- View system-wide dashboard

### Admin
- Approve or decline projects submitted by agents
- View and manage all projects
- Kanban board for monitoring tasks
- Add comments to agent tasks

### Agent
- Create and manage own projects
- Kanban board (To Do, In Progress, Done)
- Drag & drop tasks
- Attach files to tasks
- Receive admin feedback

---

## Tech Stack

- Laravel 12
- PHP 8.2
- MySQL
- Tailwind CSS
- Alpine.js
- Vite

---

## Installation

### 1. Clone the repository

```bash
git clone <REPO_URL>
cd TaskFlow
```

### 2. Install dependencies

```bash
composer install
npm install
npm run build
```

### 3. Configure environment

Copy the example environment file and update DB credentials:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```env
DB_DATABASE=taskflow_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Run migrations

```bash
php artisan migrate
```

---

## Seeding Demo Data (Optional)

```bash
php artisan db:seed
```

---

## Roles & Access

| Role         | Description |
|--------------|-------------|
| System Admin | Full system control, role assignment |
| Admin        | Project approval, task oversight |
| Agent        | Create projects, manage tasks |

---

## Demo Credentials (Optional)

> Replace with real test users if provided

```
System Admin
Email: sysadmin@example.com
Password: password

Admin
Email: admin@example.com
Password: password

Agent
Email: agent@example.com
Password: password
```

---

## Kanban Workflow

1. Agent creates a project
2. Admin approves or declines
3. Approved projects appear in Kanban
4. Agent creates tasks
5. Drag tasks between columns
6. Admin can add feedback

---

## File Storage

Task file uploads are stored in:

```
storage/app/public
```

Ensure the storage link exists:

```bash
php artisan storage:link
```

---

## Deployment Notes

- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Run:

```bash
php artisan migrate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## License

MIT License

---
