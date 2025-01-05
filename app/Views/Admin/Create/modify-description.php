<?php helper('form') ?>

<?php $this->extend('Admin/Create/base') ?>

<?php $this->section('form') ?>
    <?= form_open(action: route_to('admin.description.update'), attributes: [
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'id' => 'update-description-form'
    ]) ?>

<?php $this->endSection('form') ?>
    
<?php $this->section('content') ?>
    <div class="pb-5 mb-5">
        <input type="hidden" id="desc-name" value="<?= esc($description['name']) ?>">

        <div class="mb-3">
            <label for="content" class="form-label">
                <?= esc($description['label']) ?>
            </label>

            <textarea 
                id="desc-content" 
                cols="20" 
                rows="10"
                class="form-control"
                placeholder="Ex: Charel Chapeaux | Nous confectionnons des chapeaux sur mesures..."
                minlength="6"
                maxlength="200" 
                required
            ><?= esc($description['content']) ?></textarea>

            <p class="invalid-feedback"></p>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script src=""></script>
<?php $this->endSection('script') ?>