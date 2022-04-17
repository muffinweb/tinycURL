# tinyCURL

tinyCURL is cURL easfier tool for PHP development

## Installation

Use composer to install tinyCURL.

```bash
composer require muffinweb/tinycurl
```

## Usage

```php
//Composer Autoload
require './../vendor/autoload.php';

use Muffinweb\tinyCURL;
use Muffinweb\tinyCURLException;

try {
    $curl = new tinyCURL();
    $curl->get('https://ntv.com.tr')->render();
} catch (tinyCURLException $e){
    echo $e->getMessage();
}