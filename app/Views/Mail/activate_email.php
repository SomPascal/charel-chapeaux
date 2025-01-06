<?php $this->extend('Mail/base') ?>

<?php $this->section('content') ?>
  <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
    <table>
      <tr>
        <td>
          <div class="text" style="padding: 0 1em; text-align: center;">
            <h2>Activez Votre Compte</h2>
            <h4>
                Hey <?= esc($username) ?>, utilisez le code ci-dessous 
                pour activer votre compte
            </h4>
            <p class="btn btn-primary" style="font-size: 1.5rem;">
                <?= esc($code) ?>
            </p>
          </div>
        </td>
      </tr>
    </table>
  </td>
<?php $this->endSection('content') ?>

<?php $this->section('title') ?>
    <title>
        Charel Chapeaux | Activation
    </title>
<?php $this->endSection('title') ?>