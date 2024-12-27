<!-- Change Admin Role Modal-->
<div 
 class="modal fade" 
 id="change-admin-role" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Change Admin Role"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Modifier de role
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
             id="invite-link-form"
             method="post" 
             action="<?= route_to('admin.change.role') ?>"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <p class="alert alert-info"></p>

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