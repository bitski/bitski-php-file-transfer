<?php
/**
 * Transfer repository.
 *
 * @since 0.1.4
 */

namespace BitskiPHPFileTransfer\domain;

class TransferRepository
{
    public function save(Transfer $transfer): ?int
    {
        // Temporary stub: simulate database-generated ID.
        return 1;
    }

    /**
     * @since 0.1.6
     */
    public function delete(Transfer $transfer): void {}
}
