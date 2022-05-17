<?php

function thePagination($query, $paged)
{
    if ($query->max_num_pages > 1) :
        $big = 999999999;
        $pagination = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?page/%#%/s=' . get_search_query(),
            'current' => max(1, $paged),
            'total' => $query->max_num_pages,
            'prev_text' => __('Previous', 'catalog'),
            'next_text' => __('Next Page', 'catalog'),
            'prev_next' => true,
            'end_size' => 1,
            'mid_size' => 1,
            'type' => 'array',
        ));
        ?>
        <div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <?php if ($paged !== 1) {
                    echo $pagination[0];
                    array_shift($pagination);
                } else
                    echo '<a class="btn btn-primary tm-btn-prev mb-2 disabled" href="javascript:void(0);">Previous</a>'
                ?>
                <div class="tm-paging d-flex">
                    <?php foreach ($pagination as $page) {
                        if ($paged == $query->max_num_pages || $pagination[count($pagination) - 1] !== $page)
                            echo $page;
                    } ?>
                </div>
                <?php if ($paged == $query->max_num_pages) {
                    echo '<a href="javascript:void(0);" class="btn btn-primary tm-btn-next disabled">Next Page</a>';
                } else
                    echo $pagination[count($pagination) - 1];
                ?>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
