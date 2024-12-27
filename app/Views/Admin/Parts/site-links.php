<?php if(auth()->loggedIn()): ?>
    <div id="site-links" class="my-5">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">
            Liens du site 
        </h1>

        <p class="mb-4">
            Vous pouvez modifier les liens ci-dessous ou les tester.
        </p>

        <div class="row my-3">
            <div class="col-md-6 mb-3">
                <div class="card shadow" type="phone">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fa fa-phone"></i>
                            Appel 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= esc(get_contact('phone')) ?>"
                                readonly
                                id="link-phone"
                            />

                            <a 
                                href="tel:<?= esc(get_contact('phone')) ?>" 
                                target="_blank" 
                                class="input-group-append"
                            >
                                <span class="input-group-text">
                                    <i class="fa fa-external-link-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow" type="whatsapp">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= esc(get_contact('whatsapp')) ?>"
                                readonly
                                id="whatsapp"
                            />

                            <a 
                                href="<?= sprintf('https://wa.me/%s?text=ok', esc(get_contact('whatsapp'))) ?>" 
                                target="_blank" 
                                class="input-group-append"
                            >
                                <span class="input-group-text">
                                    <i class="fa fa-external-link-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6 mb-3">
                <div class="card shadow" type="facebook">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fab fa-facebook"></i>
                            Facebook 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= esc(get_contact('facebook')) ?>"
                                readonly
                                id="link-phone"
                            />

                            <a 
                                href="<?= esc(get_contact('facebook')) ?>" 
                                target="_blank" 
                                class="input-group-append"
                            >
                                <span class="input-group-text">
                                    <i class="fa fa-external-link-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow" type="instagram">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fab fa-instagram"></i>
                            Instagram 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= get_contact('instagram') ?>"
                                readonly
                                id="link-phone"
                            />

                            <a 
                                href="<?= get_contact('instagram') ?>" 
                                target="_blank" 
                                class="input-group-append"
                            >
                                <span class="input-group-text">
                                    <i class="fa fa-external-link-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow" type="map">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fa fa-map-marked"></i>
                            Google Maps 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= get_contact('map') ?>"
                                readonly
                                id="map"
                            />

                            <a 
                                href="<?= get_contact('map') ?>" 
                                target="_blank" 
                                class="input-group-append"
                            >
                                <span class="input-group-text">
                                    <i class="fa fa-external-link-alt"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow" type="location">
                    <div class="card-header">
                        <h5 class="h5 text-capitalize">
                            <i class="fa fa-map"></i> 
                            Localisation 
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                aria-label="Username"
                                value="<?= get_contact('location') ?>"
                                readonly
                                id="location"
                            />
                        </div>
                    </div>

                    <div class="card-footer">
                        <button 
                            type="button"
                            class="btn btn-sm btn-primary btn-icon-split"
                            data-toggle="modal"
                            data-target="#change-contacts-modal"
                        >
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>

                            <span class="text">
                                Modifier
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>