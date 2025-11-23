# 🚀 Production Deployment Guide

In a production environment, you cannot manually run `php artisan queue:work` or `php artisan reverb:start` in a terminal window because they will stop if the session closes or the server restarts.

Instead, you must use a process monitor like **Supervisor** to keep these processes running in the background.

### ❓ Why?
*   **`php artisan serve`** is replaced by **Nginx** or **Apache**. These are robust web servers designed for production traffic.
*   **`queue:work`** and **`reverb:start`** are **long-running processes**. Nginx handles web requests, but it doesn't run background jobs or WebSocket servers. You need to keep these running separately so your app can process AI tasks and handle real-time chat.

## 1. Install Supervisor

On Ubuntu/Debian servers:
```bash
sudo apt-get install supervisor
```

## 2. Configure Queue Worker

Create a configuration file for the queue worker:
`sudo nano /etc/supervisor/conf.d/laravel-worker.conf`

Paste the following (adjust paths and user):

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
# REPLACE WITH YOUR PROJECT PATH
command=php /var/www/html/your-project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
# REPLACE WITH YOUR SYSTEM USER (e.g., www-data or forge)
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/html/your-project/storage/logs/worker.log
stopwaitsecs=3600
```

## 3. Configure Reverb (WebSocket Server)

Create a configuration file for Reverb:
`sudo nano /etc/supervisor/conf.d/laravel-reverb.conf`

Paste the following:

```ini
[program:laravel-reverb]
process_name=%(program_name)s
# REPLACE WITH YOUR PROJECT PATH
command=php /var/www/html/your-project/artisan reverb:start
autostart=true
autorestart=true
# REPLACE WITH YOUR SYSTEM USER
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/html/your-project/storage/logs/reverb.log
```

## 4. Apply Changes

After creating the files, tell Supervisor to read them and start the processes:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```

Check status:
```bash
sudo supervisorctl status
```

## 5. Nginx Configuration (Reverse Proxy)

To make WebSockets work securely (WSS) over HTTPS, you need to configure Nginx to proxy the WebSocket traffic to Reverb (running on port 8080 by default).

Add this `location` block to your Nginx site configuration (inside the `server` block):

```nginx
server {
    listen 443 ssl;
    server_name your-domain.com;
    
    # ... existing SSL and root config ...

    # Proxy WebSocket traffic
    location /app {
        proxy_pass http://127.0.0.1:8080;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

## 6. Production .env Configuration

Update your `.env` file for production:

```env
APP_ENV=production
APP_DEBUG=false

# Reverb Config (Public facing)
REVERB_APP_ID=chatbot-app
REVERB_APP_KEY=qskwvj5qfsqqjsibjws6
REVERB_APP_SECRET=local-secret

# IMPORTANT: In production with Nginx proxy, Reverb runs on localhost internally
REVERB_HOST="127.0.0.1"
REVERB_PORT=8080
REVERB_SCHEME=http

# But the frontend connects to your public domain via HTTPS (WSS)
# You might need to adjust your frontend config to point to:
# Host: your-domain.com
# Port: 443 (standard HTTPS port)
# Scheme: https
```

## 7. Frontend Adjustment for Production

In your JavaScript configuration (`RAG_CONFIG`), update the Pusher settings to point to your real domain:

```javascript
pusher: {
    key: 'qskwvj5qfsqqjsibjws6',
    host: 'your-domain.com',  // Your actual domain
    port: 443,                // Standard HTTPS port
    wssPort: 443,
    forceTLS: true,           // Use WSS
    enabledTransports: ['ws', 'wss'],
    disableStats: true,
    cluster: ''
}
```
