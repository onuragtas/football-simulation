#Database Seeders Usage
```
php artisan db:seed --class=Teams
php artisan db:seed --class=Matches
```

#Nginx Conf
```
server {
    server_name domain.ext;
    root /var/www/html/football-simulation/public;
    index index.html index.php;

    location / {

            index index.php;
            # Check if a file or directory index file exists, else route it to
            try_files $uri /index.php?$query_string;

        }

        # set expiration of assets to MAX for caching
        location ~* \.(ico|css|js|gif)(\?[0-9]+)?$ {
            expires max;
            log_not_found off;
        }

        location ~* \.php$ {
            fastcgi_pass php72:9000;
            include fastcgi.conf;

            fastcgi_buffer_size 128k;
            fastcgi_buffers 4 256k;
            fastcgi_busy_buffers_size 256k;
        }

        location ~ /files {
            deny all;
            return 404;
        }
    }

```
