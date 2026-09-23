<?php
/**
 * Transfer creator.
 *
 * @since 0.1.2
 */

namespace BitskiPHPFileTransfer\domain;

use DateTimeImmutable;

class TransferCreator
{
    public function createTransfer(string $initiator, string $recipient, string $fileName, string $mimeType): Transfer
    {
        $createdAt = new DateTimeImmutable();

        // Transfer ID will be assigned during persistence (Phase 3). E.g. auto-increment-int
        return new Transfer(
            null,
            $createdAt,
            $initiator,
            $recipient,
            $fileName,
            $mimeType,
        );
    }
}
