# Mars Rover 

Bu proje, Mars'a iniş yapan roverları simüle etmektedir.

#### Gereksinimler

- PHP v8+
- Composer v2+
- PHP Redis Extension
- Redis Client

## Kurulumu

```bash
composer install
cp .env.example .env
php artisan key:generate
```

### Ayarlar

Redis bağlantı kimlik bilgilerinizi `.env` dosyasında 
yapılandırmanız yeterlidir.

### API Dokumantasyon

https://app.swaggerhub.com/apis/kmlatila/mars-rover/1.0.0-oas3
