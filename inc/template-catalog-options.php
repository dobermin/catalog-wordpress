<div class="wrap">
    <h2><?php _e('CatalogOptions', 'catalog') ?></h2>

    <?php settings_errors(); ?>

    <form action="options.php" method="post">

        <?php settings_fields('catalog_general_group'); ?>

        <?php do_settings_sections('catalog-options'); ?>

        <?php submit_button(); ?>

    </form>
</div>
