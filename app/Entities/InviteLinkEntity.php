<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class InviteLinkEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function exist(): bool
    {
        return ! empty($this->link_id);
    }

    public function hasBeenAlreadyUsed(): bool
    {
        return ! empty($this->used_at);
    }

    public function hasExpired(): bool
    {
        return Time::now()->isAfter($this->link_exp);
    }

    public function activate(string $link_id): bool
    {
        return db_connect()->table('use_invitation_links')
        ->insert([
            'id' => uid(),
            'link_id' => $link_id,
            'ip' => request()->getIPAddress(),
            'user_agent' => request()->getUserAgent(),
            'created_at' => Time::now()
        ]);
    }
}
