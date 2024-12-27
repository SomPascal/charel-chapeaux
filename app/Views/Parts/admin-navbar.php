<?php if (auth()->loggedIn()): ?>
    <nav class="sticky-top w-100 bg-primary text-light py-2 px-3 d-flex align-items-center justify-content-between">
        <span class="mb-0 text-capitalize text-light">
            
            <?php if (auth()->user()->inGroup('superadmin')): ?>
                <i class="fa fa-crown"></i>
            <?php endif ?>

            <?= esc(auth()->user()->username) ?>
        </span>

        <div class="d-flex gap-2 align-items-center mb-0">
            <div class="dropdown-center">
                <button 
                 class="btn btn-sm btn-light dropdown-toggle" 
                 type="button" 
                 data-bs-toggle="dropdown" 
                 aria-expanded="false"
                >
                    Stats
                </button>

                <ul class="dropdown-menu">
                    <li class="dropdown-item d-flex justify-content-between">
                        <i class="fa fa-chart-line"></i>
                        <span>53</span>
                    </li>
                    
                    <li class="dropdown-item d-flex justify-content-between">
                        <i class="fa fa-phone"></i>
                        <span>14</span>
                    </li>

                    <li class="dropdown-item d-flex justify-content-between">
                        <i class="fab fa-whatsapp"></i>
                        <span>14</span>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li class="dropdown-item">
                        <a 
                         href="<?= route_to('admin.stats', request()->getLocale()) ?>" 
                         target="_blank"
                        >
                            Ouvrir
                            <i class="fa fa-up-right-from-square"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <a 
            href="<?= route_to('admin.home', request()->getLocale()) ?>" 
            class="btn btn-light btn-sm"
            target="_blank"
            >
                Dashboard
            </a>
        </div>
    </nav>
<?php endif ?>