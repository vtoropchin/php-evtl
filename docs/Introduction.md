# Introduction

PHP ETL provides the Extract, Transform and Load capabilities that streamline the process of data manipulation.

---

You can, for example, extract data from a csv file, trim white spaces from specific columns and then load the values into a database table:

```php
use Vtoropchin\Evtl\Etl;

$evtl = new Etl;

$evtl->extract('csv', '/path/to/users.csv')
    ->transform('trim', ['columns' => ['name', 'email']])
    ->load('insert', 'users')
    ->run();
```
