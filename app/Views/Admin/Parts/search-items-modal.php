<!-- Change Admin Role Modal-->
<div 
 class="modal fade" 
 id="search-admin-modal" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Change Admin Role"
 aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-scrollable modal-lg position-relative" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="bg-light p-2 mb-3">
                    <button type="button" class="btn btn-sm btn-dark mb-3" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        Fermer
                    </button>

                    <form 
                    method="get"
                    action="<?= route_to('item.search') ?>" 
                    class="d-flex align-items-center justify-content-between mb-3 flex-wrap" 
                    style="gap: 5px;"
                    >
                        <input 
                        id="search-terms"
                        type="text" 
                        class="form-control" 
                        placeholder="Ex: chapeaux funérailles..."
                        maxlength="300"
                        style="max-width: 550px;"
                        />

                        <select id="search-category" class="form-control" style="max-width: 120px;">
                            <option value="-1" selected>
                                Aucune
                            </option>

                            <?php foreach($categories as $category): ?>
                                <option value="<?= esc($category->code, 'attr') ?>">
                                    <?= esc($category->name) ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                        <button id="search-submit" type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <p id="number-results" class="mb-0 d-none">
                        (<span></span>) résultats
                    </p>
                </div>

                <div id="search-welcome" class="w-100 p-3 rounded h-10 bg-light text-center">
                    <i class="fa fa-search" style="font-size: 55px;"></i>
                </div>

                <div id="search-noresult" class="w-100 p-3 rounded h-10 bg-light text-center d-none" style="font-size: 20px;">
                    Pas de résultats pour "<span>chapeau de luxe</span>"
                </div>

                <ul id="search-results" class="flex-wrap justify-content-center align-items-start d-none" style="gap: 15px;">
                </ul>
            </div>
        </div>
    </div>
</div>