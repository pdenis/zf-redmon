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

TODO