<form class="d-flex position-absolute tm-search-form" id="searchform" method="get" action="<?= home_url('/') ?>">
    <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search" name="s" id="s">
    <button class="btn btn-outline-success tm-search-btn" type="submit">
        <img src="<?= get_template_directory_uri() . '/assets/img/search.png'; ?>" alt="Search"/>
    </button>
</form>
