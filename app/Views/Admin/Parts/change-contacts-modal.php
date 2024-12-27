<!-- Change Admin Role Modal-->
<div 
 class="modal fade" 
 id="change-contacts-modal" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Change Contact"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Modifier les info 
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
             id="change-contacts-modal"
             method="post" 
             action="<?= route_to('admin.change.contact') ?>"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <div class="mb-3">
                    <label for="contact-content" class="form-label">
                        Modifier le 
                        "<span>Instagram</span>"
                    </label>

                    <input 
                     type="text" 
                     class="form-control" 
                     id="contact-content" 
                     placeholder="Aa"
                     required
                    />

                    <p class="invalid-feedback"></p>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Oui modifier
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