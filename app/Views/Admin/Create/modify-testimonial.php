<?php helper('form') ?>

<?php $this->extend('Admin/Create/base') ?>

<?php $this->section('form') ?>
    <?= form_open(action: route_to('admin.testimonial.update'), attributes: [
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'id' => 'update-testimonial-form'
    ]) ?>
    
<?php $this->endSection('form') ?>

<?php $this->section('content') ?>
    <div class="pb-5 mb-5">
        <div class="mb-3">
            <label for="name" class="form-label">
                Auteur
            </label>

            <input 
                type="text" 
                id="autor" 
                class="form-control"
                minlength="3"
                maxlength="124"
                placeholder="Ex: Ambara Chrystelle"
                required
                value="<?= esc($testimonial->name) ?>"
            />

            <p class="invalid-feedback"></p>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                Témoignage
            </label>

            <textarea 
                id="testimonial" 
                cols="30" 
                class="form-control"
                placeholder="Ex: J'ai été tellement satisfait par..."
                minlength="6"
                maxlength="200" 
                required
            ><?= esc($testimonial->content) ?></textarea>

            <p class="invalid-feedback"></p>
        </div>
    </div>
<?php $this->endSection('content') ?>