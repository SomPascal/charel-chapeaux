<?php

use App\Models\ContactFormModel;
use CodeIgniter\I18n\Time;
?>
<!-- Begin Page Content -->
<div class="my-3" id="contacts">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Contacts 
    </h1>

    <p class="mb-4">
        Les numero ci-dessous ont ete ajoute sur le formlaire de contacte
    </p>

    <!-- DataTales Example -->
    <?php if(count($form_submits) > 0): ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                    Liste de prospects
                    (<?= esc(number_format(model(ContactFormModel::class)->num_records())) ?>)
                </h6>
            </div>
    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>
                                    <i class="fa fa-phone"></i>
                                    Appel
                                </th>
    
                                <th>
                                    <i class="fab fa-whatsapp"></i>
                                    WhatsApp
                                </th>
    
                                <th>Date</th>
                            </tr>
                        </thead>
    
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>
                                    <i class="fa fa-phone"></i>
                                    Appel
                                </th>
    
                                <th>
                                    <i class="fab fa-whatsapp"></i>
                                    WhatsApp
                                </th>
    
                                <th>Date</th>
                            </tr>
                        </tfoot>
    
                        <tbody>
                            <?php foreach($form_submits as $form_submit): ?>
                                <tr>
                                    <td>
                                        <?= esc($form_submit->name) ?>
                                    </td>
                                    <td>
                                        <a href="tel:<?= esc($form_submit->phone) ?>">
                                            <?= esc($form_submit->phone) ?>
                                        </a>
                                    </td>
        
                                    <td>
                                        <a href="<?= sprintf(
                                            'https://wa.me/237%d?text=Bonjour %s, bienvenue chez CharelChapeaux', 
                                            preg_replace('/\s{1,}/', '', $form_submit->phone),
                                            $form_submit->name
                                            ) 
                                        ?>">
                                            <?= esc($form_submit->phone) ?>
                                        </a>
                                    </td>
        
                                    <td>
                                        <?= Time::createFromFormat('Y-m-d H:i:s', $form_submit->created_at)->humanize() ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?= $form_submits_pager->links() ?>
    <?php endif ?>
</div>
<!-- Content Row -->