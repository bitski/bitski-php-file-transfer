<?php
/**
 * Transfer creator.
 *
 * @since 0.1.2
 */

namespace BitskiPHPFileTransfer\domain;

class TransferCreator
{
    public function createTransfer(): Transfer
    {
        return new Transfer();
    }
}
