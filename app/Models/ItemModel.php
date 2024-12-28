<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'item';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'admin_id', 'code_category',
        'name', 'price', 'description', 'is_hidden',
        'created_at', 'updated_at', 'deleted_at'
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

    public function in_category(string $category_code): self
    {
        return $this->where(['category.code' => $category_code]);
    }

    public function search(string $term, int $limit=15): array
    {
        return $this->get_items()
        ->like('item.name', $term)
        ->orLike('item.description', $term)
        ->orLike('category.name', $term)
        ->orderBy('item.created_at', 'DESC')
        ->findAll(limit: $limit);
    }

    public function unhided(): self
    {
        return $this->where(['item.is_hidden' => false]);
    }

    protected function not_deleted(): self 
    {
        return $this->where('item.deleted_at', null);
    }

    public function num_of_items(): int
    {
        $r = $this->select('COUNT(id) AS num_of_items')->find();

        return $r[0]['num_of_items'];
    }

    public function hide(string $item_id): bool
    {
        return $this->update(id: $item_id, row: [
            'is_hidden' => true
        ]);
    }

    public function unhide(string $item_id): bool
    {
        return $this->update(id: $item_id, row: [
            'is_hidden' => false
        ]);
    }

    public function add_in_trash(string $item_id): bool
    {
        return $this->update(id: $item_id, row: [
            'deleted_at' => Time::now()
        ]);
    }

    public function get_items(): self
    {
        return $this->select([
            'item.id AS id',
            'item.name AS name',
            'item.price AS price',
            'item.description AS description',
            'item.is_hidden AS is_hidden',
            'item.created_at AS created_at',

            'category.name AS category',
            'category.code AS category_code',

            'users.username AS admin_username',
            'item_pics.id AS item_pic_id'
        ])
        ->join('category', 'category.code = item.code_category', 'left')
        ->join('users', 'users.id = item.admin_id', 'left')
        ->join('item_pics', 'item_pics.item_id = item.id', 'left')
        ->groupBy('item.id')
        ->asObject();
    }

    public function get_item(string $item_id): ?object
    {
        $r = $this->select([
            'item.id AS id',
            'item.name AS name',
            'item.price AS price',
            'item.description AS description',
            'item.created_at AS created_at',
            'item.is_hidden AS is_hidden',

            'category.name AS category',
            'category.code AS category_code'
        ])
        ->where([
            'item.id' => $item_id
        ])
        ->join('category', 'category.code = item.code_category')
        ->findAll();

        return empty($r) ? null : $r[0];
    }
}
