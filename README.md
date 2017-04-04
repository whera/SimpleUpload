# SimpleUpload
Simple upload system in PHP, compatible with AWS S3, Dropbox, Azure and others.

[![Travis](https://img.shields.io/travis/whera/SimpleUpload.svg?style=flat-square)](https://travis-ci.org/whera/SimpleUpload)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/whera/SimpleUpload/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/whera/SimpleUpload/?branch=master)
[![Github All Releases](https://img.shields.io/github/downloads/whera/SimpleUpload/total.svg?style=flat-square)](https://packagist.org/packages/wsw/simple-upload/stats)
[![Packagist](https://img.shields.io/packagist/v/wsw/simple-upload.svg?style=flat-square)](https://github.com/whera/SimpleUpload)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?style=flat-square)](https://github.com/whera/SimpleUpload/blob/master/LICENSE)

Component responsible for simplifying file upload.
With it it is possible to perform local uploads and services such as: Dropbox, AWS S3, Azure, SFTP among others. Check out the full list [here](Adapters.md).

# Installation

Via Composer:

```
composer require wsw/simple-upload
```

## Usage

Basic use:

``` php
<?php

use League\Flysystem\Adapter\Local;
use WSW\SimpleUpload\Services\SimpleUpload;

try {
    $adapter = new Local('/home/files');
    $file    = SimpleUpload::create($_FILES['file'], $adapter)->send();
   
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Advanced use:

``` php
<?php

use League\Flysystem\Adapter\Local;
use WSW\SimpleUpload\Services\SimpleUpload;

try {
    $adapter = new Local('/home/files');
    $upload  = SimpleUpload::create($_FILES['file'], $adapter);
    
    // Optional Methods
    
    //Create a new directory from the root directory defined on the adapter.
    $upload->setPath('newDir'); // Ex:/home/files/newDir/
    
    // Define a new file name
    $upload->setName('newName'); // Ex: newName.csv
    
    // Defines which file extensions the upload will allow
    $upload->setAllowedExtensions(['csv', 'txt']);
    
    $file = $upload->send();

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Result

``` php
<?php
    // Returns the size of the file in KB
    echo $file->getSize(); // 94762
    
    // Returns the file type
    echo $file->getMimetype(); // text/plain
    
    // Returns instance of DateTime for date and time of creation
    echo $file->getTimestamp(); // \DateTime
    
    // Absolute file path
    echo $file->getPath(); // /home/files/file.txt
    
    // Directory where the file is located
    echo $file->getFilePath(); // /home/files/
    
    // Filename with extension
    echo $file->getFileName(); // file.txt
    
    // Filename without extension
    echo $file->getName(); // file
    
    // File extension
    echo $file->getExtension(); // txt
    
```

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email [ronaldo@whera.com.br](mailto:ronaldo@whera.com.br?subject=Security SimpleUpload) instead of using the issue tracker.

## Credits

- [Ronaldo Matos Rodrigues](https://github.com/whera)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

