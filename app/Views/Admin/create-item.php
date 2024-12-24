<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        Charel Chapeaux | Ajouter
    </title>

    <!-- Custom fonts for this template-->
    <link href="/assets/Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
     href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
     rel="stylesheet"
    >

    <!-- Custom styles for this template-->
    <link href="/assets/Admin/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/Admin/css/style.css">
    <?= csrf_meta() ?>

</head>

<body style="background-color: #f2f2f2;">
    <section id="create-form" class="container">
        <form 
         action="<?= route_to('admin.item.store') ?>" 
         method="post" 
         enctype="multipart/form-data"
        >
            <nav class="w-100 rounded shadow sticky-top bg-light p-3 mt-3 mb-3 d-flex justify-content-between">
                <a class="btn btn-dark" href="javascript:void(0)" onclick="history.back()">
                    <i class="fa fa-arrow-circle-left"></i>
                    Retour
                </a>
    
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Poster
                </button>
            </nav>

            <p class="alert alert-danger d-none"></p>
    
            <div class="container-fluid mb-3">
                <h3 class="text-uppercase h6">Images</h3>
    
                <ul 
                 class="d-flex align-items-start w-100 rounded p-3 overflox-y-hidden overflow-x-auto" 
                 style="background-color: #ddd;"
                 id="img-previews-box"
                >
                    <!-- <li class="shadow m-2 position-relative" style="width: 100px;">
                        <img 
                         src="/assets/images/items/chapeaux-3.jpg"
                         class="img-fluid rounded" 
                         style="min-width: 100px;"
                        />
    
                        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </li>
    
                    <li class="shadow m-2 position-relative" style="width: 100px;">
                        <img 
                         src="/assets/images/items/chapeaux-1.jpg" 
                         class="img-fluid rounded" 
                         style="min-width: 100px;"
                        />
    
                        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </li>
    
                    <li class="shadow m-2  position-relative" style="width: 100px;">
                        <img 
                         src="/assets/images/items/chapeaux-8.jpg" 
                         class="img-fluid rounded" 
                         style="min-width: 100px;" 
                        />
    
                        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </li>
    
                    <li class="shadow m-2  position-relative" style="width: 100px;">
                        <img 
                         src="/assets/images/items/chapeaux-1.jpg" 
                         class="img-fluid rounded" 
                         style="min-width: 100px;"
                        />
    
                        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </li>
    
                    <li class="shadow m-2  position-relative" style="width: 100px;">
                        <img 
                         src="/assets/images/items/chapeaux-8.jpg" 
                         class="img-fluid rounded" 
                         style="min-width: 100px;" 
                        />
    
                        <button type="button" class="btn btn-sm btn-danger shadow position-absolute" style="top: 5px;right: 5px;">
                            <i class="fa fa-times"></i>
                        </button>
                    </li> -->
                </ul>
            </div>
    
            <div class="container-fluid">
                <h3 class="h6 text-uppercase mb-3">
                    Description
                </h3>

                <div class="pb-5 mb-5">
                    <div class="mb-3">
                        <label for="images" class="form-label">
                            Images
                        </label>
    
                        <div class="input-group">
                            <input 
                             type="file" 
                             class="form-control" 
                             placeholder="Rajouter des images"
                             accept="image/*"
                             id="item-images"
                             multiple 
                             required 
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
                         value="Chapeau de soiré"
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
                                    <option value="<?= esc($category['code'], 'attr') ?>">
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
                        >Chapeau classe parfait pour vos sorties.</textarea>

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">
                            Prix
                        </label>

                        <input 
                         type="text" 
                         id="item-price" 
                         placeholder="Ex: 18 000"
                         class="form-control"
                         value="10000"
                         required
                        />

                        <p class="invalid-feedback"></p>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <?= $this->include('Admin/Parts/add-category-modal') ?>
    <?= $this->include('Admin/Parts/notification') ?>
    <?= $this->include('Admin/Parts/scripts') ?>

    <script type="module" src="/assets/Admin/js/create-item.js"></script>
</body>