<?php

namespace App\Models;

use CodeIgniter\Model;

class OutletsModel extends Model
{
    protected $table            = 'outlets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'address',
        'phone',
        'operational_hours',
        'image',
        'maps',
        'category',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Validation
    protected $validationRules      = [
        'name'              => 'required|min_length[3]|max_length[255]',
        'address'           => 'required|max_length[500]',
        'phone'             => 'permit_empty|regex_match[/^\+?[0-9\s\-()]+$/]',
        'operational_hours' => 'permit_empty|max_length[100]',
        'image'             => 'permit_empty|max_length[255]',
        'maps'              => 'permit_empty|max_length[255]',
        'category'          => 'permit_empty|max_length[100]',
    ];
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
}
