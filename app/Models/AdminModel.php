<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username'
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

    public function getAdmins(): array
    {
        return $this->select([
            'users.username AS username',
            'users.id AS id',
            'auth_groups_users.group AS group'
        ])
        ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
        ->limit(6)
        ->findAll();
    }

    public function changePassword(int $admin_id, string $password): bool
    {
        return db_connect()->table('auth_identities')
        ->update(
            set: [
                'auth_identities.updated_at' => Time::now(),
                'auth_identities.secret2' => password_hash($password, config('Config\Auth')->hashAlgorithm)
            ],
            where: [
                'auth_identities.type' => 'email_password',
                'auth_identities.user_id' => $admin_id,
                'auth_identities.last_used_at != ' => null
            ]        
        );
    }
}