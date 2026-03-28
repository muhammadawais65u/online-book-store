# Netlify Deployment Instructions

## Prerequisites
- Netlify account
- Git repository (GitHub, GitLab, or Bitbucket)
- Laravel project configured for production

## Step 1: Push to Git Repository
```bash
git add .
git commit -m "Add Netlify configuration"
git push origin main
```

## Step 2: Create Netlify Site
1. Go to [Netlify](https://app.netlify.com/)
2. Click "Add new site" → "Import an existing project"
3. Connect your Git provider
4. Select your repository
5. Configure build settings:
   - **Build command**: `npm run netlify:build`
   - **Publish directory**: `public`
   - **Node version**: `18`
   - **PHP version**: `8.2`

## Step 3: Environment Variables
In Netlify dashboard → Site settings → Environment variables, add:

```
APP_NAME=Online Book Store
APP_ENV=production
APP_KEY=base64:your-generated-key-here
APP_DEBUG=false
APP_URL=https://your-site-name.netlify.app
DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite
```

**Important**: Generate a new APP_KEY:
```bash
php artisan key:generate --show
```

## Step 4: Deploy
1. Click "Deploy site"
2. Netlify will automatically build and deploy your Laravel app

## Important Notes
- Laravel apps on Netlify run as serverless functions
- Database uses SQLite (stored in /tmp/)
- File uploads may not persist between deployments
- For production use, consider external database services

## Troubleshooting
- If build fails, check the build logs in Netlify dashboard
- Ensure all PHP dependencies are in composer.json
- Verify environment variables are correctly set
