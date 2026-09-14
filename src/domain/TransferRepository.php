<?php
/**
 * Transfer repository.
 *
 * @since 0.1.4
 */

namespace BitskiPHPFileTransfer\domain;

class TransferRepository
{
    public function save(Transfer $transfer): bool
    {
        return true;
    }
}
