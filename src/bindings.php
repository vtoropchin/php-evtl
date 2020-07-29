<?php

use Vtoropchin\Evtl\Container;

$container = Container::getInstance();

// Database
$container->singleton(Vtoropchin\Evtl\Database\Manager::class);
$container->alias(Vtoropchin\Evtl\Database\Manager::class, 'db');

// Extractors
$container->bind('collection_extractor', Vtoropchin\Evtl\Extractors\Collection::class);
$container->bind('csv_extractor', Vtoropchin\Evtl\Extractors\Csv::class);
$container->bind('fixed_width_extractor', Vtoropchin\Evtl\Extractors\FixedWidth::class);
$container->bind('json_extractor', Vtoropchin\Evtl\Extractors\Json::class);
$container->bind('query_extractor', Vtoropchin\Evtl\Extractors\Query::class);
$container->bind('table_extractor', Vtoropchin\Evtl\Extractors\Table::class);
$container->bind('xml_extractor', Vtoropchin\Evtl\Extractors\Xml::class);

// Transformers
$container->bind('convert_case_transformer', Vtoropchin\Evtl\Transformers\ConvertCase::class);
$container->bind('json_decode_transformer', Vtoropchin\Evtl\Transformers\JsonDecode::class);
$container->bind('json_encode_transformer', Vtoropchin\Evtl\Transformers\JsonEncode::class);
$container->bind('rename_columns_transformer', Vtoropchin\Evtl\Transformers\RenameColumns::class);
$container->bind('trim_transformer', Vtoropchin\Evtl\Transformers\Trim::class);
$container->bind('unique_rows_transformer', Vtoropchin\Evtl\Transformers\UniqueRows::class);
$container->bind('replace_transformer', Vtoropchin\Evtl\Transformers\Replace::class);

// Loaders
$container->bind('insert_loader', Vtoropchin\Evtl\Loaders\Insert::class);
$container->bind('insert_update_loader', Vtoropchin\Evtl\Loaders\InsertUpdate::class);
