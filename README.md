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

### Using composer
```php
<?php

return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Application',
        'SnideRedmon',
        ...
```


### Dependencies

* doctrine/doctrine-orm-module
* predis/predis

## Configuration

TODO