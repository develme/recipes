## SOLR

After setting up MySQL indices, and switching to simple pagination, the search would return results  in roughly
200-800ms. Randomly, the search would slow down to 10-20 seconds.

MySQL MATCH AGAINST was tried, but would perform worse in certain circumstances.

SOLR was chosen to provide recipes search functionality, consistently return results under 300ms with a lot of responses
under 100ms.


#### Start SOLR

```bash
docker-compose up -d solr
```

#### Load data

```bash
php artisan app:load-recipes
```

#### Erase all data

```bash
curl "http://localhost:8983/solr/recipes/update?commit=true" -H "Content-Type: text/xml" --data-binary '<delete><query>*:*</query></delete>'
```

#### Destroy SOLR

```bash
docker-compose down -v solr
```
