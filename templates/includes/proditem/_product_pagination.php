<!-- Pagination -->
<?php

use Inc\Functions\ProdItems;

$count_poducitems = ProdItems::countProditems();

$cantPages = ceil($count_poducitems/$limit);

bootstrap_pagination($cantPages); //helper crea la paginación

