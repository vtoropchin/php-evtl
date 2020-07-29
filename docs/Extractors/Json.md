# JSON

Extracts data from a JavaScript Object Notation file.

```php
$evtl->extract('json', 'path/to/file.json', $options);
```


## Options

### Columns
Columns that will be extracted. If `null`, the first level key/value pairs of the object in each iteration will be used.

| Type | Default value |
|----- | ------------- |
| array | `null` |

For more control over the columns, you may use JSON path:
```php
$options = ['columns' => [
    'id' => '$..bindings[*].id.value',
    'name' => '$..bindings[*].name.value',
]];
```
