<!-- Admin Details Modal-->
<div 
 class="modal fade" 
 id="admin-details" 
 tabindex="-1" 
 role="dialog" 
 aria-labelledby="Logout Modal"
 aria-hidden="true"
 >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Profile 
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
            <div class="modal-body">
                <div style="width: 80px;">
                    <img 
                     src="/assets/Admin/img/undraw_profile.svg" 
                     alt=""
                    />
                </div>

                <ul class="mt-3">
                    <li>
                        <p class="d-flex align-items-center justify-content-between" id="detail-id">
                            <b>Type: </b>
                            <span>Admin</span>
                        </p>
                    </li>


                    <li>
                        <p class="d-flex align-items-center justify-content-between" id="detail-invitedBy">
                            <b>Invité par: </b>
                            <span>Steve</span>
                        </p>
                    </li>

                    <li>
                        <p class="d-flex align-items-center justify-content-between" id="detail-username">
                            <b>Username: </b>
                            <span>mongo</span>
                        </p>
                    </li>

                    <li>
                        <p class="d-flex align-items-center justify-content-between" id="detail-email">
                            <b>Email: </b>
                            <span>mongo@gmail.com</span>
                        </p>
                    </li>

                    <li>
                        <p class="d-flex align-items-center justify-content-between" id="detail-registredAt">
                            <b>Inscrit le: </b>
                            <span>20 Janvier 2024</span>
                        </p>
                    </li>
                </ul>
            </div>

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