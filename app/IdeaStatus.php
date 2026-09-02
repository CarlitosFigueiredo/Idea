<?php

namespace App;

enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }

    public function colors(): string
    {
        return match ($this) {
            self::PENDING => 'text-yellow-500 bg-yellow-500/10 border-yellow-500/20',
            self::IN_PROGRESS => 'text-orange-500 bg-orange-500/10 border-orange-500/20',
            self::COMPLETED => 'text-green-500 bg-green-500/10 border-green-500/20',
        };
    }
}
