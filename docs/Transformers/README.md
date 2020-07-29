# Transformers

Manipulates data, in sequence, from the data source previously defined in the extractor. They can be used multiple times in the same process before and after loaders. Transformers receive two arguments: type and options (optional).

```php
$evtl->transform('type', $options);
```


## Available transformers types

* [Convert Case](ConvertCase.md)
* [JSON Decode](JsonDecode.md)
* [JSON Encode](JsonEncode.md)
* [Rename Columns](RenameColumns.md)
* [Trim](Trim.md)
* [Unique Rows](UniqueRows.md)
