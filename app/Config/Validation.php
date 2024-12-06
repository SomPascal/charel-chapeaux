<?php

namespace Config;

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
        ValidationRules::class
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
}
