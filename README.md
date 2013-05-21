zf-redmon
=========

Redis monitoring module for ZF2

## Installation 

### Using composer
```json
{
    "require": {
        "snide/zf-redmon": "dev-master"
    }
}
```
Add module in your applcation.config.php

```php
<?php

return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Application',
        'SnideRedmon',
        ...
```

Symlink public module subfolders into yourApp/public/modules/snide_redmon

### Dependencies

* doctrine/doctrine-orm-module
* predis/predis

## Configuration

You can choose between doctrine repository or file repository
To do this, add some parameters in your application's config file

### Doctrine
```php

'snide_redmon' => array(
    'repository' => array(
        'type' => 'doctrine'
    ),
)
```
### File
```php

'snide_redmon' => array(
    'repository' => array(
        'dir'  => 'your/specific/folder',
        'type' => 'file'
    )
)
```

## Batch

To log Redis instance information, a cli tool is available :

php public/index.php snide-redmon log

You can change log's retention (Default = 30 days):
```php

'snide_redmon' => array(
    'logger' => array(
        'nb_days' => 10
    )
)
```


