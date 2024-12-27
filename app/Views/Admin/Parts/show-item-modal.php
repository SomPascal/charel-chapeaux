<!-- Hide Item-->
<div 
 class="modal fade" 
 id="show-item-modal" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Hide Item Modal"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Afficher Cette article 
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
             action="<?= route_to('item.unhide') ?>"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <p>
                    Voulez vous vraiment afficher cette article.
                </p>

                <button type="submit" class="btn btn-primary w-100">
                    Oui Afficher
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