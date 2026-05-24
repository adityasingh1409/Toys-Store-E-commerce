# 🚀 DevOps Setup Guide — Toys Store E-commerce

## 📦 Phase 1 DevOps Stack

| Tool | Purpose |
|------|---------|
| **Docker** | Containerize the app |
| **Docker Compose** | Run PHP + MySQL + Nginx together |
| **Jenkins** | CI/CD pipeline automation |
| **GitHub Actions** | Free cloud CI (runs on every push) |

---

## 🐳 PART 1 — Docker Setup

### Prerequisites
- Install **Docker Desktop** for Windows → https://www.docker.com/products/docker-desktop/
- Make sure Docker Desktop is **running** (whale icon in system tray)

### Step 1 — Create your `.env` file
```bash
copy .env.example .env
```

Edit `.env` and set these values:
```env
APP_KEY=          # Will be generated
DB_DATABASE=myproject
DB_USERNAME=toystore_user
DB_PASSWORD=secret123
DB_ROOT_PASSWORD=rootsecret123
APP_URL=http://localhost:8082
```

### Step 2 — Generate App Key
```bash
php artisan key:generate
```

### Step 3 — Start all containers
```bash
docker-compose up -d
```

This starts:
- 🟢 **toystore_app** → Laravel PHP app (port 9000)
- 🟢 **toystore_nginx** → Web server (port 8082)
- 🟢 **toystore_mysql** → MySQL database (port 3307)

### Step 4 — Run database migrations
```bash
docker-compose exec app php artisan migrate --seed
```

### Step 5 — Open the app
```
http://localhost:8082
```

### Useful Docker Commands
```bash
# See running containers
docker-compose ps

# See app logs
docker-compose logs app

# See nginx logs
docker-compose logs nginx

# Stop all containers
docker-compose down

# Restart containers
docker-compose restart

# Enter the PHP container (like SSH)
docker-compose exec app bash

# Run artisan commands inside container
docker-compose exec app php artisan migrate
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

---

## 🔵 PART 2 — Jenkins Setup

### Prerequisites
- Jenkins must be installed and running on `http://localhost:8080`
  (or whichever port your Jenkins uses)
- Install these Jenkins plugins:
  - **Git Plugin** (pull from GitHub)
  - **Pipeline Plugin** (run Jenkinsfile)
  - **Docker Pipeline Plugin** (build Docker images)

### Step 1 — Create New Jenkins Job

1. Open Jenkins → `http://localhost:8080`
2. Click **"New Item"**
3. Enter name: `ToyStore-Pipeline`
4. Select **"Pipeline"**
5. Click **OK**

### Step 2 — Configure Pipeline

In the job configuration:

1. Scroll to **"Pipeline"** section
2. Select **"Pipeline script from SCM"**
3. SCM: **Git**
4. Repository URL: `https://github.com/adityasingh1409/Toys-Store-E-commerce.git`
5. Branch: `*/main`
6. Script Path: `Jenkinsfile`
7. Click **Save**

### Step 3 — Add GitHub Webhook (Auto-trigger)

1. Go to your GitHub repo → **Settings → Webhooks → Add webhook**
2. Payload URL: `http://YOUR_IP:8080/github-webhook/`
3. Content type: `application/json`
4. Events: **Just the push event**
5. Click **Add webhook**

Now every `git push` automatically triggers Jenkins! 🎉

### Step 4 — Run the Pipeline

1. Click **"Build Now"** in Jenkins
2. Watch the pipeline stages execute:

```
✅ Stage 1: Checkout       → Code pulled from GitHub
✅ Stage 2: Install        → composer install + npm install
✅ Stage 3: Environment    → .env configured
✅ Stage 4: Build Assets   → npm run build
✅ Stage 5: Tests          → php artisan test
✅ Stage 6: Docker Build   → Image created
✅ Stage 7: Deploy         → docker-compose up -d
✅ Stage 8: Migrate        → DB migrations run
✅ Stage 9: Health Check   → App verified running
```

---

## 🟡 PART 3 — GitHub Actions (Free Cloud CI)

This runs **automatically** — no setup needed!

Every time you `git push`:
1. GitHub runs the pipeline in the cloud (free!)
2. Go to your repo → **"Actions"** tab to see results
3. Green ✅ = all good, Red ❌ = something failed

### Adding Secrets to GitHub

Go to: GitHub Repo → **Settings → Secrets and variables → Actions → New repository secret**

Add these secrets (never put real passwords in code!):

| Secret Name | Value |
|-------------|-------|
| `DB_PASSWORD` | Your database password |
| `APP_KEY` | Your Laravel app key |
| `DB_DATABASE` | `myproject` |

---

## 📁 Project Structure After Phase 1

```
myproject/
├── Dockerfile              ← Container definition
├── docker-compose.yml      ← Multi-container setup
├── .dockerignore           ← Files excluded from Docker
├── Jenkinsfile             ← Jenkins CI/CD pipeline
├── nginx/
│   └── default.conf        ← Nginx web server config
├── .github/
│   └── workflows/
│       └── ci.yml          ← GitHub Actions pipeline
└── ... (Laravel files)
```

---

## 🔄 DevOps Workflow

```
You write code
     ↓
git push to GitHub
     ↓
┌─────────────────────────────────┐
│  GitHub Actions (cloud - free)  │
│  → Runs tests automatically     │
│  → Shows ✅ or ❌ on GitHub    │
└─────────────────────────────────┘
     ↓
┌─────────────────────────────────┐
│  Jenkins (local)                │
│  → Triggered by webhook         │
│  → Full 9-stage pipeline        │
│  → Builds Docker image          │
│  → Deploys automatically        │
└─────────────────────────────────┘
     ↓
App live at http://localhost:8082 ✅
```

---

## ❓ Common Issues

| Problem | Solution |
|---------|----------|
| `docker-compose up` fails | Make sure Docker Desktop is running |
| Port 8080 already in use | Change `"8080:80"` to `"9090:80"` in docker-compose.yml |
| Port 3307 already in use | Change `"3307:3306"` to `"3308:3306"` |
| Jenkins can't find Docker | Install Docker Pipeline plugin in Jenkins |
| `.env` not found | Run `copy .env.example .env` first |
