# Laravel loggers tests
We try to test Laravel 5.2 with different logger endpoints and handlers:

- Files
- Mongo
- Redis
- elastic (ELK)
- NXlog
- Sentry


## Requirement

- For tests uses open source load testing tool [k6.io](https://k6.io/)
- Docker


## Install

```
docker-compose up -d
docker-compose exec php71 composer install
```

## Tests

```
k6 run -e MY_HOSTNAME=file script.js
k6 run -e MY_HOSTNAME=mongo script.js
k6 run -e MY_HOSTNAME=redis script.js
```