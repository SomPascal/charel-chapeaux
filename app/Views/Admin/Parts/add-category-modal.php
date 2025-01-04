<!-- Change Admin Role Modal-->
<div 
 class="modal fade" 
 id="add-category" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Add Category"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Gérer les catégories
                </h5>

                <button 
                 class="close" 
                 type="button" 
                 data-dismiss="modal" 
                 aria-label="Close"
                >
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form 
             id="add-category-form"
             method="post" 
             action="#"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <div class="mb-3">
                    <label for="category_name" class="form-label">
                        Nom
                    </label>

                    <input 
                     type="text" 
                     id="category_name"
                     placeholder="Ex: Funéraille" 
                     class="form-control"
                     minlength="3" 
                     maxlength="124" 
                     required
                    />

                    <p class="invalid-feedback"></p>
                </div>
                <input type="hidden" id="category_code">

                <button type="submit" class="btn btn-primary w-100">
                    Continuer 
                    <i class="fa fa-arrow-right"></i>
                </button>
            </form>

            <div class="modal-footer">
                <button 
                 class="btn btn-secondary" 
                 type="button" 
                 data-dismiss="modal"
                >
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>