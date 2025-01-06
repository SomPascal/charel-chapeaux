<?php helper('form') ?>

<?php $this->extend('Admin/Create/base') ?>

<?php $this->section('form') ?>
    <?= form_open(action: route_to('admin.item.update'), attributes: [
        'method' => 'post',
        'enctype' => 'multipart/form-data',
        'id' => 'update-item-form'
    ]) ?>
<?php $this->endSection('form') ?>

<?php $this->section('content') ?>
    <div class="container-fluid mb-3">
        <h3 class="text-uppercase h6">Images</h3>

        <ul 
            class="d-flex align-items-start w-100 rounded p-3 overflox-y-hidden overflow-x-auto" 
            style="background-color: #ddd;"
            id="img-previews-box"
        >
            <?php foreach ($item_pics as $item_pic): ?>
                <li 
                 id="preview-<?= esc($item_pic->id, 'attr') ?>" 
                 class="shadow m-2 position-relative"
                 style="width: 100px;"
                >
                    <img 
                     class="img-fluid rounded" 
                     src="<?= route_to('item.pic', $item_pic->id) ?>" 
                     alt="Preview image"
                    />

                    <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                        <i class="fa fa-times"></i>
                    </button>
                </li>

            <?php endforeach ?>
        </ul>
    </div>

    <h3 class="h6 text-uppercase mb-3">
        Description
    </h3>

    <div class="pb-5 mb-5">
        <div class="mb-3">
            <label for="images" class="form-label">
                Image
            </label>

            <div class="input-group">
                <input 
                    type="file" 
                    class="form-control" 
                    placeholder="Rajouter des images"
                    accept="image/*"
                    id="item-images"
                    multiple 
                    <?= attr(count($item_pics) < 1, 'required') ?> 
                />

                <p class="invalid-feedback"></p>
            </div>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">
                Nom
            </label>

            <input 
                type="text" 
                id="item-name" 
                class="form-control"
                minlength="3"
                maxlength="124"
                placeholder="Ex: Chapeau de marriage..."
                value="<?= esc($item->name) ?>"
                required
            />

            <p class="invalid-feedback"></p>
        </div>

        <div class="mb-3">
            <label for="categories" class="form-label">
                Catégorie
            </label>

            <div class="d-flex align-items-center gap-4" style="gap: 30px;">
                <select id="categories" class="form-control">
                    <?php foreach($categories as $category): ?>
                        <option 
                         value="<?= esc($category['code'], 'attr') ?>"
                         <?= attr($item->category_code == $category['code'], 'selected') ?>
                        >
                            <?= esc($category['name'])  ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <?php if (auth()->loggedIn() && auth()->user()->inGroup('superadmin')): ?>
                    <button 
                        type="button" 
                        class="btn btn-sm btn-primary"
                        data-target="#add-category"
                        data-toggle="modal"
                    >
                        <i class="fa fa-plus"></i>
                    </button>
                <?php endif ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                Description
            </label>

            <textarea 
                id="item-description" 
                cols="30" 
                class="form-control"
                placeholder="Chapeaux afritude, parfait pour des cérémonies, con..."
                minlength="6"
                maxlength="200" 
                required
            ><?= esc($item->description) ?></textarea>

            <p class="invalid-feedback"></p>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">
                Prix
            </label>

            <input 
                type="number" 
                id="item-price" 
                placeholder="Ex: 18000"
                class="form-control"
                value="<?= esc($item->price) ?>"
                required
            />

            <p class="invalid-feedback"></p>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="/assets/Admin/js/handle-item.js"></script>
<?php $this->endSection('script') ?>