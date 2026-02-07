## ContactPro 🚀
Modern contact and lightweight CRM workspace built with Laravel. Manage contacts, stages, owners, imports, and a live dashboard with minimal setup.

### 📸 Screenshots
| Dashboard | Growth by stage | Contacts | Register | Login |
| --- | --- | --- | --- | --- |
| ![Dashboard](public/screenshots/screencapture-localhost-8000-dashboard-2026-02-07-12_34_01.png) | ![Stage](public/screenshots/screencapture-localhost-8000-dashboard-2026-02-07-12_34_13.png) | ![Contacts](public/screenshots/screencapture-localhost-8000-contacts-2026-02-07-12_32_55.png) | ![Register](public/screenshots/screencapture-localhost-8000-register-2026-02-07-12_32_10.png) | ![Login](public/screenshots/screencapture-localhost-8000-login-2026-02-07-12_31_55.png) |

### ✨ Highlights
- 📊 Live dashboard: monthly growth and stage breakdown by user.
- 🧭 Extended contacts: stage, job title, source, tags, owner, last contacted.
- ⬆️ CSV/XLSX import with smart upsert (email/phone match).
- 🌓 Theme-aware UI (light/dark) and refreshed auth experience.
- ✅ Quality: Pest tests and Laravel Pint formatting.

### 🛠️ Tech Stack
- Backend: Laravel 12, PHP 8.2+
- Frontend: Blade, Bootstrap 5, Chart.js
- Tooling: Vite, Pest, Pint, PhpSpreadsheet

### ✅ Requirements
- PHP 8.2+ with extensions: `gd`, `zip`, `fileinfo`, `mbstring`, `openssl`
- Composer
- Node.js 18+
- Database: MySQL/PostgreSQL/SQLite (SQLite works out of the box)

### 🚀 Quickstart
```bash
git clone <repo-url>
cd ContactPro

# Backend deps
composer install

# Frontend deps
npm install

# Env & key
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate

# (Optional) seed demo data
php artisan db:seed

# Assets
npm run dev   # or: npm run build

# Serve
php artisan serve
```

### 📦 Feature Notes
- **Imports:** CSV/XLSX via Contacts. Columns: Name, Email, Phone, Company, Address, Notes, Stage, Job title, Source, Tags, Last contacted at. Existing contacts (email/phone) are updated.
- **Dashboard:** Monthly contact creation and stage distribution for the signed-in user.
- **Themes:** Light/dark toggle in layout.
- **Auth UX:** Plan cards, dynamic summary, password strength meter.

### 📋 Import Column Map
| Column | Field | Notes |
| --- | --- | --- |
| A | name | Required |
| B | email | Used for matching existing |
| C | phone | Used for matching existing |
| D | company | Optional |
| E | address | Optional |
| F | notes | Optional |
| G | stage | Defaults to `lead` |
| H | job_title | Optional |
| I | source | Optional |
| J | tags | Optional |
| K | last_contacted_at | Parsed date if valid |

### 🧪 Testing & Quality
```bash
# Run tests
./vendor/bin/pest

# Lint/format PHP
./vendor/bin/pint
```

### 🗂️ Useful Commands
| Purpose | Command |
| --- | --- |
| Clear caches | php artisan optimize:clear |
| Fresh DB | php artisan migrate:fresh --seed |
| Run dev server | php artisan serve |
| Run Vite dev | npm run dev |
| Build assets | npm run build |

### ⚙️ Environment Cheatsheet
- `APP_ENV`, `APP_DEBUG`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Mail (optional): `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`

### 🛟 Troubleshooting
- PhpSpreadsheet install issues: enable `gd` and `zip` in `php.ini`, then rerun `composer install`.
- Assets not updating: stop dev server and rerun `npm run dev`, or clear caches with `php artisan optimize:clear`.
- DB errors: verify `.env` credentials and rerun `php artisan migrate`.

### 🧭 Roadmap Ideas
- Contact ownership analytics per team member.
- Email/task timelines on contact detail pages.
- Webhooks and API access keys.
- Admin plan management with metered billing.

### 📄 License
MIT
