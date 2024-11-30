<!-- Admin Details Modal-->
<div 
 class="modal fade" 
 id="invitation-link" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Invitation Link Modal"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Inviter une personne 
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
             action="<?= route_to('invite.get') ?>"
             class="modal-body"
            >
                <p class="alert alert-danger d-none"></p>

                <div class="mb-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-link"></i>
                        </span>
                    </div>
                    
                    <input 
                     type="text" 
                     placeholder="Lien d'invitation"
                     class="form-control"
                     id="invite-link-field"
                     readonly
                    />
                </div>

                <div class="d-flex align-items-center justify-content-between mb-5">
                    <span class="mr-3">Role: </span>
                    
                    <select id="invite-link-role" required class="form-control form-control-sm">
                        <option value="admin" selected>
                            Admin
                        </option>

                        <option value="superadmin">
                            Super Admin
                            <i class="fa fa-crown"></i>
                        </option>
                    </select>
                </div>

                <div class="d-flex align-items-start justify-content-between">
                    <button 
                     id="generate-invite-link"
                     type="submit" 
                     class="btn btn-sm btn-primary"
                    >
                        Generate
                    </button>

                    <button 
                     id="copy-invite-link"
                     type="button" 
                     class="btn btn-sm btn-secondary btn-icon-split"
                     disabled
                    >
                        <span class="icon">
                            <i class="fa fa-clipboard"></i>
                        </span>

                        <span class="text">
                            Copier
                        </span>
                    </button>
                </div>
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