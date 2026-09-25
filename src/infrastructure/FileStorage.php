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
    private string $storagePath;

    /**
     * @since 0.1.9
     */
    public function __construct()
    {
        $this->storagePath = dirname(__DIR__, 2) . '/storage';
    }

    public function save(Transfer $transfer, $file): bool
    {
        $transferStoragePath = $this->storagePath . '/' . $transfer->getId();

        if (!is_dir($transferStoragePath)
            && !mkdir($transferStoragePath)
        ) {
            return false;
        }

        $fileTempPath    = $file['tmp_name'];
        $fileStoragePath = $transferStoragePath . '/'
            . $transfer->getFileName();

        return move_uploaded_file($fileTempPath, $fileStoragePath);
    }

    /**
     * @since 0.1.6
     */
    public function delete(Transfer $transfer): void {}
}
