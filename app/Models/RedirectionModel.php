<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class RedirectionModel extends Model
{
    protected $table            = 'redirection';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
    protected $allowedFields    = [
        'id', 'visitor_id', 'item_id',
        'contact_id', 'context',
        'created_at'
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

    public function contactDailyClick(string $name): int
    {
        $res = $this->select('COUNT(redirection.id) AS num')
        ->join('contact', 'contact.id = redirection.contact_id', 'left')
        ->where('contact.name', $name)
        ->where('DATE(redirection.created_at)', Time::today()->format('Y-m-d'))
        ->findAll(limit: 1);

        return empty($res) ? 0 : $res[0]['num'];
    }

    public function todayRedirections(): array
    {
        return $this->select([
            'COUNT(redirection.id) AS num',
            'contact.name AS name'
        ])
        ->join('contact', 'contact.id = redirection.contact_id', 'left')
        ->where('DATE(redirection.created_at)', Time::today()->format('Y-m-d'))
        ->groupBy('contact.id')
        ->findAll();
    }
}
