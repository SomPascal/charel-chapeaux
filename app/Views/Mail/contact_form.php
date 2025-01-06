<?php

use CodeIgniter\I18n\Time;

$this->extend('Mail/base')
?>

<?php $this->section('title') ?>
    <title>
        Charel Chapeaux | Contact
    </title>
<?php $this->endSection('title') ?>

<?php $this->section('content') ?>
    <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
        <table>
            <tr>
                <td>
                    <div class="text" style="padding: 0 1em; text-align: center;">
                        <h2>
                            Formulaire de contact
                        </h2>

                        <h4>
                            Aujourd'hui, le <?= Time::now()->toDateTimeString() ?> 
                            un nouvel utilisateur s'est enregistré sur le formulaire de contact sur 
                            <a style="color: #30e3ca;" href="<?= base_url('#contact-us') ?>">
                                <?= esc(base_url()) ?>
                            </a>
                        </h4>
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <div class="text" style="padding: 0 1em; text-align: left;">
                        <h2>
                            Information
                        </h2>

                        <h4>
                            <p>
                                <b>nom:</b> <?= esc($visitor['name'] ?? 'Nothing') ?>
                            </p>

                            <p>
                                <b>téléphone:</b> 
                                <a style="color: #30e3ca;" href="tel:<?= esc($visitor['phone']) ?>">
                                    <?= esc($visitor['phone']) ?>
                                </a>
                            </p>
                        </h4>
                    </div>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <div class="text" style="padding: 0 1em; text-align: left;">
                        <a class="btn btn-primary" href="<?= url_to('admin.home') ?>">
                            Dashboard
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </td>
<?php $this->endSection('content') ?>