<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self OPEN()
 * @method static self RESOLVED()
 * @method static self REJECTED()
 */
class TicketStatus extends Enum
{
    protected static function values(): array
    {
        return [
            'OPEN' => 'open',
            'RESOLVED' => 'resolved',
            'REJECTED' => 'rejected',
        ];
    }
}
