#!/bin/bash
set -e

# Run migrations automatically on container start
php artisan migrate --force 2>/dev/null || true

exec "$@"