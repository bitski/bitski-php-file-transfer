<?php
/**
 * Mailer.
 *
 * @since 0.1.5
 */

namespace BitskiPHPFileTransfer\infrastructure;

use BitskiPHPFileTransfer\domain\Transfer;

class Mailer
{
    public function send(Transfer $transfer): bool
    {
        return true;
    }
}
