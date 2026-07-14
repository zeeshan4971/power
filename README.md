# PowerGuard Laravel

Complete Laravel source for Parent, Student, Teacher-public-link flows.

## Install
```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Seed logins:
- Parent: parent@example.com / password
- Student: alex@example.com / password

Teacher access uses a temporary public link generated from Manage Access.

## July 2026 teacher dashboard and notifications update

Run the new migration after replacing the project files:

```bash
php artisan migrate
php artisan optimize:clear
```

Configure mail in `.env` to send teacher check-in requests:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-user
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@powerguard.app
MAIL_FROM_NAME=PowerGuard
```

The public teacher dashboard is opened through the temporary teacher link. It shows pending check-in requests, current goals, live calculated metrics, and lets the teacher submit feedback and update goal progress without an account. Temporary links expire after 14 days.

## Notification update

This build includes:
- Working reward category selection and live reward preview.
- In-app notification bell with unread count and mark-all-read action.
- Chrome notifications using the browser Notification API and a service worker.
- Automatic notification polling every 30 seconds while the browser is open.
- Student notification when a parent creates a goal.
- Student notification when a parent requests a teacher check-in.
- Parent and student notifications when teacher feedback is submitted.
- Parent/student notifications when goal progress changes.
- Guest teacher dashboard notification button for pending check-in requests.

Chrome notifications require HTTPS in production (localhost works for development) and browser permission from the user. This implementation does not require an external push provider; notifications are delivered while the browser is running and the application can poll the server.

After updating files, run:

```bash
php artisan optimize:clear
php artisan migrate
```

## First-login guided tours

Role-specific guided tours are included for Parent, Student, and Teacher accounts.

After updating the project, run:

```bash
php artisan migrate
php artisan optimize:clear
```

Existing accounts are marked as already onboarded by the migration. Newly registered parents and newly created student/teacher users start with the guided tour automatically. Users can restart the tour anytime using **Take Guided Tour** in the sidebar.
