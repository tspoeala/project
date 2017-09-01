<div class="container">
    <ul class="pagination">
        <?php if ($currentPage != 1) { ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?php
                   if (strpos($query, 'id') === false) {
                       echo $pageURL . '?page=' . $previous;
                   } else {
                       echo $pageURL . '&page=' . $previous;
                   } ?>">
                    Prev
                </a>
            </li>
        <?php } ?>

        <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
            <?php $active = ($page == $currentPage) ? 'active' : '' ?>
            <li class="page-item <?php echo $active; ?>">
                <a class="page-link" href="<?php if (strpos($query, 'id') === false) {
                    echo $pageURL . '?page=' . $page;
                } else {
                    echo $pageURL . '&page=' . $page;
                }
                ?>"> <?php echo $page; ?> </a>
            </li>
        <?php } ?>
        <?php if ($currentPage != $totalPages && $totalPages != 0) { ?>
            <li class="page-item">
                <a class="page-link" href="<?php if (strpos($query, 'id') === false) {
                    echo $pageURL . '?page=' . $next;
                } else {
                    echo $pageURL . '&page=' . $next;
                } ?>">
                    Next
                </a>
            </li>
        <?php } ?>
    </ul>
</div>