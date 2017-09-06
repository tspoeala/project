<div class="container">
    <ul class="pagination">
        <?php function setQuery($query, $pageURL, $filterDates, $page)
        {
            if (strpos($query, 'page')) {
                $query = substr($query, 0, strpos($query, '&page'));
            }
            echo (strpos($query, 'id') === false) ? (isset($filterDates['submit']) ? $pageURL . "?$query&page=" . $page :
                $pageURL . "?page=" . $page) : $pageURL . '&page=' . $page;
        } ?>
        <?php if ($currentPage != 1) { ?>
            <li class="page-item">
                <a class="page-link"
                   href="
                   <?php setQuery($query, $pageURL, $filterDates, $previous) ?>">
                    Prev
                </a>
            </li>
        <?php } ?>

        <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
            <?php $active = ($page == $currentPage) ? 'active' : '' ?>
            <li class="page-item <?php echo $active; ?>">
                <a class="page-link" href="
                <?php setQuery($query, $pageURL, $filterDates, $page) ?>">
                    <?php echo $page; ?> </a>
            </li>
        <?php } ?>
        <?php if ($currentPage != $totalPages && $totalPages != 0) { ?>
            <li class="page-item">
                <a class="page-link" href="
                <?php setQuery($query, $pageURL, $filterDates, $next) ?>">
                    Next
                </a>
            </li>
        <?php } ?>
    </ul>
</div>