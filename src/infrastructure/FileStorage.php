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
        $transferDirectory = $this->getTransferDirectory($transfer);

        if (!is_dir($transferDirectory)
            && !mkdir($transferDirectory)
        ) {
            return false;
        }

        $fileTempPath = $file['tmp_name'];
        $filePath     = $this->getFilePath($transfer);

        return move_uploaded_file($fileTempPath, $filePath);
    }

    /**
     * @since 0.1.6
     */
    public function delete(Transfer $transfer): void {}

    private function getTransferDirectory(Transfer $transfer): string
    {
        return $this->storagePath . '/' . $transfer->getId();
    }

    private function getFilePath(Transfer $transfer): string
    {
        return $this->getTransferDirectory($transfer) . '/'
            . $transfer->getFileName();
    }
}
