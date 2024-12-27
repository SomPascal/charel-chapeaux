<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'visitor';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'ip', 'user_agent',
        'accept_lang', 'referrer_url',
        'created_at', 'deleted_at'
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

    public function hasAlreadyVisited(string $ip, string $ua): bool
    {
        $res = $this->select('COUNT(visitor.id) AS num')
        ->where([
            'visitor.ip' => $ip,
            'visitor.user_agent' => $ua,
            'visitor.created_at >' => Time::yesterday(),
            'visitor.deleted_at' => null
        ])->findAll();

        return ! empty($res) && $res[0]['num'] > 0;
    }

    public function findOne(string $ip, string $ua): array
    {
        $res = $this->select([
            'visitor.id AS id',
            'visitor.ip AS ip',
            'visitor.user_agent AS user_agent'
        ])
        ->where([
            'visitor.ip' => $ip,
            'visitor.user_agent' => $ua
        ])
        ->orderBy('visitor.created_at', 'DESC')
        ->limit(1)
        ->find();

        return empty($res) ? [] : $res[0];
    }

    public function todayVisits(): int
    {
        $res = $this->select('COUNT(visitor.id) AS num')->findAll();

        return empty($res) ? 0 : $res[0]['num'];
    }
}
