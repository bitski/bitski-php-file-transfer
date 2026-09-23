<?php
/**
 * Transfer creator.
 *
 * @since 0.1.2
 */

namespace BitskiPHPFileTransfer\domain;

class TransferCreator
{
    public function createTransfer(string $initiator, string $recipient): Transfer
    {
        return new Transfer();
    }
}
