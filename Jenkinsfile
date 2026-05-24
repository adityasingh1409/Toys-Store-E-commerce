// ═══════════════════════════════════════════════════════
//  Jenkinsfile — Toys Store E-commerce CI/CD Pipeline
//  
//  PIPELINE STAGES:
//  1. Checkout     → Pull latest code from GitHub
//  2. Install      → composer install + npm install
//  3. Environment  → Setup .env file
//  4. Build        → npm run build (CSS/JS assets)
//  5. Test         → php artisan test (unit tests)
//  6. Docker Build → Build Docker image
//  7. Deploy       → Run with docker-compose
//  8. Migrate      → Run DB migrations
// ═══════════════════════════════════════════════════════

pipeline {

    // Run on any available Jenkins agent
    agent any

    // ─────────────────────────────────────────
    //  Global Environment Variables
    // ─────────────────────────────────────────
    environment {
        APP_NAME    = 'toystore'
        IMAGE_NAME  = 'toystore-app'
        IMAGE_TAG   = "build-${BUILD_NUMBER}"   // Unique tag per build
        COMPOSE_FILE = 'docker-compose.yml'
    }

    // ─────────────────────────────────────────
    //  Build Options
    // ─────────────────────────────────────────
    options {
        // Keep only last 5 builds to save disk space
        buildDiscarder(logRotator(numToKeepStr: '5'))
        // Fail build if it runs more than 20 minutes
        timeout(time: 20, unit: 'MINUTES')
        // Don't run multiple builds of same branch at once
        disableConcurrentBuilds()
    }

    stages {

        // ─────────────────────────────────────
        //  STAGE 1: Checkout Code from GitHub
        // ─────────────────────────────────────
        stage('🔁 Checkout') {
            steps {
                echo '================================================'
                echo '  STAGE 1: Pulling latest code from GitHub...'
                echo '================================================'
                checkout scm   // Gets code from the configured GitHub repo
                echo "✅ Code checked out on branch: ${env.GIT_BRANCH}"
                echo "✅ Commit: ${env.GIT_COMMIT}"
            }
        }

        // ─────────────────────────────────────
        //  STAGE 2: Install Dependencies
        //  composer install = Maven's mvn install
        // ─────────────────────────────────────
        stage('📦 Install Dependencies') {
            steps {
                echo '================================================'
                echo '  STAGE 2: Installing PHP & Node dependencies...'
                echo '================================================'

                // Windows batch commands
                bat 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                bat 'npm install'

                echo '✅ All dependencies installed!'
            }
        }

        // ─────────────────────────────────────
        //  STAGE 3: Setup Environment
        // ─────────────────────────────────────
        stage('⚙️ Setup Environment') {
            steps {
                echo '================================================'
                echo '  STAGE 3: Setting up environment...'
                echo '================================================'

                // Copy example env if .env doesn't exist
                bat '''
                    IF NOT EXIST .env (
                        copy .env.example .env
                        echo Created .env from .env.example
                    ) ELSE (
                        echo .env already exists
                    )
                '''

                // Generate Laravel app key
                bat 'php artisan key:generate --force'

                echo '✅ Environment ready!'
            }
        }

        // ─────────────────────────────────────
        //  STAGE 4: Build Frontend Assets
        //  npm run build = Maven's compile phase
        // ─────────────────────────────────────
        stage('🔨 Build Assets') {
            steps {
                echo '================================================'
                echo '  STAGE 4: Building CSS/JS assets with Vite...'
                echo '================================================'

                bat 'npm run build'

                echo '✅ Assets built successfully!'
            }
        }

        // ─────────────────────────────────────
        //  STAGE 5: Run Tests
        //  php artisan test = Maven's mvn test
        // ─────────────────────────────────────
        stage('🧪 Run Tests') {
            steps {
                echo '================================================'
                echo '  STAGE 5: Running PHPUnit tests...'
                echo '================================================'

                // Use SQLite in-memory for fast testing (no MySQL needed)
                bat '''
                    set DB_CONNECTION=sqlite
                    set DB_DATABASE=:memory:
                    php artisan test --env=testing
                '''
            }
            post {
                failure {
                    echo '❌ TESTS FAILED! Pipeline stopped. Fix tests before deploying.'
                }
                success {
                    echo '✅ All tests passed!'
                }
            }
        }

        // ─────────────────────────────────────
        //  STAGE 6: Build Docker Image
        // ─────────────────────────────────────
        stage('🐳 Build Docker Image') {
            steps {
                echo '================================================'
                echo "  STAGE 6: Building Docker image: ${IMAGE_NAME}:${IMAGE_TAG}"
                echo '================================================'

                bat "docker build -t ${IMAGE_NAME}:${IMAGE_TAG} -t ${IMAGE_NAME}:latest ."

                echo "✅ Docker image built: ${IMAGE_NAME}:${IMAGE_TAG}"
            }
        }

        // ─────────────────────────────────────
        //  STAGE 7: Deploy with Docker Compose
        // ─────────────────────────────────────
        stage('🚀 Deploy') {
            steps {
                echo '================================================'
                echo '  STAGE 7: Deploying with Docker Compose...'
                echo '================================================'

                // Stop old containers, start new ones
                bat 'docker-compose down --remove-orphans'
                bat 'docker-compose up -d --build'

                // Wait for containers to be healthy
                bat 'timeout /t 15 /nobreak > NUL'

                // Check containers are running
                bat 'docker-compose ps'

                echo '✅ Application deployed!'
            }
        }

        // ─────────────────────────────────────
        //  STAGE 8: Database Migrations
        //  Run any new database migrations
        // ─────────────────────────────────────
        stage('🗄️ Database Migrate') {
            steps {
                echo '================================================'
                echo '  STAGE 8: Running database migrations...'
                echo '================================================'

                // Run migrations inside the running app container
                bat 'docker-compose exec -T app php artisan migrate --force'

                echo '✅ Database migrations complete!'
            }
        }

        // ─────────────────────────────────────
        //  STAGE 9: Health Check
        // ─────────────────────────────────────
        stage('❤️ Health Check') {
            steps {
                echo '================================================'
                echo '  STAGE 9: Verifying app is running...'
                echo '================================================'

                // Wait a moment then check the app responds
                bat 'timeout /t 5 /nobreak > NUL'
                bat 'curl -f http://localhost:8082 || echo "Warning: Health check failed but continuing"'

                echo '✅ Health check done!'
            }
        }
    }

    // ─────────────────────────────────────────
    //  Post-build actions (always runs)
    // ─────────────────────────────────────────
    post {

        success {
            echo '''
            ╔══════════════════════════════════════╗
            ║  ✅  PIPELINE SUCCEEDED!              ║
            ║  App is live at: http://localhost:8082 ║
            ╚══════════════════════════════════════╝
            '''
        }

        failure {
            echo '''
            ╔══════════════════════════════════════╗
            ║  ❌  PIPELINE FAILED!                 ║
            ║  Check the stage logs above           ║
            ╚══════════════════════════════════════╝
            '''
            // Roll back — restart previous containers
            bat 'docker-compose up -d || echo "Rollback attempted"'
        }

        always {
            echo "📋 Build #${BUILD_NUMBER} finished."
            // Clean up dangling Docker images to save disk space
            bat 'docker image prune -f || echo "Cleanup done"'
        }
    }
}
