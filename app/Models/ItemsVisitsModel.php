<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class ItemsVisitsModel extends Model
{
    protected $table            = 'items_visits';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'visitor_id', 'item_id',
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

    public function hasAlreadyBeenVisited(string $vistor_id, $item_id): bool
    {
        $res = $this->select('COUNT(items_visits.id) AS num')
        ->where([
            'items_visits.visitor_id' => $vistor_id,
            'items_visits.item_id' => $item_id,
            'items_visits.created_at >' => Time::yesterday()
        ])
        ->findAll(limit: 1);

        return empty($res) ? false : $res[0]['num'] > 0;
    }

    public function visits(string $item_id): int
    {
        $res = $this->select('COUNT(items_visits.id) AS num')
        ->where([
            'items_visits.item_id' => $item_id
        ])
        ->findAll(limit: 1);

        return empty($res) ? 0 : $res[0]['num'];
    }
}
