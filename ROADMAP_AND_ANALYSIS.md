# Project Analysis & Roadmap: Ticket Hub

## Current State Analysis

The project is a solid Laravel application for team-based ticket management. It leverages modern Laravel 12 conventions, Pest for testing, and Tailwind CSS for styling.

### Strengths
- **Clean Architecture:** Uses standard Laravel patterns (Policies, Requests, Resources).
- **Testing Culture:** Pest tests exist for core features (Teams, Tickets, Members).
- **Modern Stack:** Laravel 12, Tailwind v4, Vite.
- **Security:** Policies are used to authorize actions (e.g., `TeamPolicy`).

### Gaps
- **API Capabilities:** No current API infrastructure (Sanctum/Passport) for external integrations.
- **Visual Identity:** Lack of user avatars and team logos makes the UI feel generic.
- **Public Engagement:** No way for non-users (customers) to report issues without creating an account.
- **Production Readiness:** Missing some robust features like file storage configuration, email queuing setup, and error logging strategies.

---

## Roadmap

### Phase 1: Visual Identity (Profile Pictures)
**Goal:** Enhance the user experience by adding visual identifiers for users and teams.

1.  **Database Updates:**
    -   `users` table: Add `avatar_path` column.
    -   `teams` table: Ensure `logo` column is being used (it exists).
2.  **Implementation:**
    -   Update `UpdateUserProfile` logic (needs creation/modification) to handle file uploads.
    -   Update `TeamController@update` to handle logo uploads.
    -   Use `Storage` facade with `public` disk.
    -   Create a helper/component to display Avatar/Logo or initials if missing.

### Phase 2: Team Robots (API Automation)
**Goal:** Allow automated scripts (CI/CD, external monitors) to create tickets.

1.  **Infrastructure:**
    -   Install **Laravel Sanctum**.
2.  **Database:**
    -   Create `team_bots` table (id, team_id, name, token_last_used_at).
    -   OR use Sanctum tokens directly on a `TeamBot` model.
3.  **Logic:**
    -   `TeamBot` belongs to `Team`.
    -   Admins can generate/regenerate API keys for a bot.
    -   API Endpoints: `POST /api/v1/tickets` (Protected by Sanctum).
    -   Bots act as "reporters" for tickets.

### Phase 3: Public Customer Portal
**Goal:** Allow external users to report issues.

1.  **Routes:**
    -   `GET /portal/{team:slug}`: Public team landing page.
    -   `POST /portal/{team:slug}/tickets`: Public ticket submission.
2.  **Security & Logic:**
    -   **Rate Limiting:** Critical to prevent spam.
    -   **Guest Handling:** Store "Guest Name" and "Guest Email" on ticket if no user is logged in.
    -   **Validation:** Strict validation on public forms.
    -   **Feedback:** Show a "Ticket Created" success page with a tracking ID (optional).

---

## Production Readiness Assessment

Is the project production-ready after these features? **Yes, but with caveats.**

### Requirements for "Green Light":
1.  **Queue Configuration:** Ensure `QUEUE_CONNECTION` is set (Redis/Database) and workers are running (Supervisor). Emails and file processing should be queued.
2.  **Storage:** Ensure `FILESYSTEM_DISK` is configured correctly (S3 for production usually).
3.  **Error Tracking:** Install Sentry or similar for tracking production errors.
4.  **Backups:** Set up `spatie/laravel-backup` to backup DB and files.
5.  **HTTPS:** Ensure the production server enforces SSL.
6.  **CI/CD:** Automated testing pipeline before deployment.

### Business Logic
The current business logic is sound for an MVP. Adding "Robots" and "Public Portals" moves it from an internal tool to a customer-facing product, which significantly increases value.

---

**Next Steps:**
1.  Implement Phase 1 (Profile/Logo Uploads).
2.  Implement Phase 2 (Sanctum & Robots).
3.  Implement Phase 3 (Public Portal).
