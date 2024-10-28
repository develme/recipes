## SOLR

#### Load data

```bash
php artisan app:load-recipes
```

#### Erase all data

```bash
curl "http://localhost:8983/solr/recipes/update?commit=true" -H "Content-Type: text/xml" --data-binary '<delete><query>*:*</query></delete>'
```
