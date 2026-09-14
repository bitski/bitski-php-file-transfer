<?php
/**
 * File storage.
 *
 * @since 0.1.3
 */

namespace BitskiPHPFileTransfer\infrastructure;

use BitskiPHPFileTransfer\domain\Transfer;

class FileStorage
{
    public function saveFile(Transfer $transfer): bool
    {
        return true;
    }
}
