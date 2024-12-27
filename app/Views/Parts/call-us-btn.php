<?php

use Config\Contact;
?>
<a 
   href="tel:<?= esc(get_contact('phone') ?? Contact::$phone) ?>" 
   class="call-cta-btn btn btn-dark"
>
    <i class="fa fa-phone"></i>
    Appelez-nous
</a>