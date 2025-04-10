<?php

declare(strict_types=1);

namespace VarLab\FileReader;

use function Safe\fclose;
use function Safe\pack;
use function Safe\preg_replace;
use function Safe\fopen;

class FileReader
{
    public function readLineByLine(string $file, callable $lineHandler): void
    {
        $handle = fopen($file, 'r');

        $lineCount = 0;

        while (false !== ($line = \fgets($handle))) {
            if (0 === $lineCount) {
                $line = $this->removeBOM($line);
            }

            $lineHandler(\trim($line), $lineCount);
            $lineCount++;
        }

        fclose($handle);
    }

    private function removeBOM(string $content): string
    {
        $bom     = pack('H*', 'EFBBBF');
        $content = \str_replace("\xEF\xBB\xBF", '', $content);
        $content = preg_replace("/^{$bom}/", '', $content);
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);
        $content = preg_replace('/\x{feff}$/u', '', $content);

        return $content;
    }
}
