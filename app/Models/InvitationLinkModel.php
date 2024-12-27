<?php

namespace App\Models;

use App\Entities\InviteLinkEntity;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class InvitationLinkModel extends Model
{
    protected $table            = 'invitation_links';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'inviter_id', 'role',
        'created_at', 'expire_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createLink(string $role): ?string
    {
        $link_id = uid();
        $now = Time::now();

        $res = $this->insert([
            'id' => $link_id,
            'inviter_id' => user_id(),
            'role' => $role,
            'created_at' => $now,

            // The link expires after 01 day
            'expire_at' => $now->addDays(1)
        ], false);

        return ($res == false) ? null : $link_id;
    }

    public function getInfo(string $id): InviteLinkEntity
    {
        $r = $this->select([
            'invitation_links.id AS link_id',
            'invitation_links.expire_at AS link_exp',
            'invitation_links.role AS link_role',
            'invitation_links.inviter_id AS link_owner_id',
            'use_invitation_links.created_at AS used_at',
            'users.username AS username'
        ])
        ->join('use_invitation_links', 'use_invitation_links.link_id = invitation_links.id', 'left')
        ->join('users', 'users.id = invitation_links.inviter_id')
        ->where([
            'invitation_links.id' => $id
        ])
        ->limit(1)
        ->findAll();

        return new InviteLinkEntity($r[0] ?? []);
    }
}
