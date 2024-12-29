<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class ContactFormModel extends Model
{
    protected $table            = 'contact_form';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'visitor_id',
        'name', 'phone',
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

    public function alreadySubmitted(string $visitor_id): bool
    {
        $res = $this->select('COUNT(contact_form.id) AS num')
        ->where('contact_form.visitor_id', $visitor_id)
        ->where('contact_form.created_at >', Time::yesterday())
        ->find();

        return empty($res) ? false : $res[0]['num'] > 0;
    }

    public function store($data): bool
    {
        return $this->insert([
            'id' => uid(), 
            'visitor_id' => $data['visitor_id'],
            'name' => $data['name'], 
            'phone' => $data['phone'],
            'created_at' => Time::now()
        ], returnID: false);
    }

    public function getAll(): self
    {
        return $this->select([
            'contact_form.name',
            'contact_form.phone',
            'contact_form.created_at'
        ])
        ->orderBy('created_at', 'DESC');
    }
}
