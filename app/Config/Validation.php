<?php

namespace Config;

use App\Validation\PhoneValidation;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Shield\Authentication\Passwords\ValidationRules;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        ValidationRules::class,
        PhoneValidation::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $changePassword = [
        'current-password'      => 'required|min_length[6]|max_length[124]',
        'new-password'          => 'required|min_length[6]|max_length[124]|differs[current-password]|strong_password',
        'new-password-confirm'  => 'required|matches[new-password]'
    ];

    public array $changeUsername = [
        'username' => 'required|min_length[3]|max_length[30]|regex_match[/^([a-zA-Z][a-zA-Z0-9\s]{2,29})$/]|is_unique[users.username]',
        'password' => 'required|min_length[6]|max_length[124]'
    ];

    public array $invite_admin = [
        'role' => 'required|in_list[admin,superadmin]'
    ];

    public array $change_role = [
        'admin_id' => 'required',
        'role' => 'required|in_list[superadmin,admin]'
    ];

    public array $ban_admin = [
        'admin_id' => 'required',
        'ban' => 'required|in_list[on,off]'
    ];

    public array $change_contact = [
        'content' => 'required',
        'name' => 'required|in_list[phone,whatsapp,instagram,facebook,location,map]|max_length[300]'
    ]; 

    public array $set_category = [
        'category_name' => 'required|min_length[3]|max_length[124]|is_unique[category.name]'
    ];

    public array $set_category_errors = [
        'category_name' => [
            'is_unique' => 'Vous avez déjà utilisé ce nom de catégorie'
        ]
    ];

    public array $store_item = [
        'item-name' => 'required|min_length[3]|max_length[124]',
        'categories' => 'required',
        'item-description' => 'required|min_length[6]|max_length[200]',
        'item-price' => 'required|numeric|is_natural',
        // 'item-images' => 'required|uploaded[item-images]|is_image[item-images]|max_size[item-images,' . TWO_MB .']|mime_in[item-images,image/png,image/jpeg,image/jpg]'
    ];

    public array $store_testimonail = [
        'autor' => 'required|min_length[3]|max_length[124]',
        'testimonial' => 'required|min_length[6]|max_length[200]'
    ];

    public array $update_testimonial = [
        'id' => 'required|is_natural',
        'autor' => 'required|min_length[3]|max_length[124]',
        'testimonial' => 'required|min_length[6]|max_length[200]'
    ];

    public array $store_contact = [
        'name' => 'required|min_length[3]|max_length[24]',
        'phone' => 'required|phone'
    ];

    public array $update_description = [
        'desc-content' => 'required|min_length[6]|max_length[200]'
    ];
}
