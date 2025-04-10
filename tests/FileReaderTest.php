<?php

declare(strict_types=1);

namespace Tests\VarLab\FileReader;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use VarLab\FileReader\FileReader;

class FileReaderTest extends TestCase
{
    use MatchesSnapshots;

    public function testWithSimpleFile(): void
    {
        $testFile = __DIR__ . '/testfiles/file1.txt';

        $fileReader = new FileReader();

        $contentArray = [];

        $fileReader->readLineByLine(
            $testFile,
            static function (string $content, int $lineNumber) use (&$contentArray): void {
                $contentArray[$lineNumber] = $content;
            },
        );

        self::assertMatchesJsonSnapshot($contentArray);
    }

    public function testCsvFile(): void
    {
        $testFile = __DIR__ . '/testfiles/customers-100.csv';

        $fileReader = new FileReader();

        $contentArray = [];

        $fileReader->readLineByLine(
            $testFile,
            static function (string $content, int $lineNumber) use (&$contentArray): void {
                $contentArray[$lineNumber] = $content;
            },
        );

        self::assertMatchesJsonSnapshot($contentArray);
    }
}
