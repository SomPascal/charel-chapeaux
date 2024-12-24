<!-- Hide Item-->
<div 
 class="modal fade" 
 id="delete-category-modal" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Delete Category Modal"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Supprimer Cette categorie 
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
             method="post" 
             action="<?= route_to('admin.category.delete') ?>"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <p>
                    Voulez vous vraiment supprimer cette catégorie.
                </p>

                <button type="submit" class="btn btn-danger w-100">
                    Oui Supprimer
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