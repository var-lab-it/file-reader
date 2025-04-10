# File-Reader

Read text-based files line-by-line.

## Installation

```bash
composer require var-lab/file-reader
```

## Usage

```php
<?php

$fileReader = new FileReader();

$fileReader->readLineByLine($testFile, function (string $content, int $lineNumber) {
    // do something with the current line...
});
```
