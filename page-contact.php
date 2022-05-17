<?php get_header() ?>
<?php get_template_part('template-parts/content', 'photo-without-form'); ?>
    </div>
    <div class="container-fluid tm-mt-60">
        <div class="row tm-mb-50">
            <div class="col-lg-4 col-12 mb-5">
                <h2 class="tm-text-primary mb-5"><?= __('Contact Page', 'catalog') ?></h2>
                <form id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST"
                      class="tm-contact-form mx-auto">
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control rounded-0" placeholder="Name"
                               required="">
                        <label for="name"></label>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control rounded-0" placeholder="Email"
                               required="">
                        <label for="email"></label>
                    </div>
                    <div class="form-group">
                        <label for="contact-select"></label>
                        <select class="form-control" id="contact-select" name="inquiry">
                            <option value="-">Subject</option>
                            <option value="sales">Sales &amp; Marketing</option>
                            <option value="creative">Creative Design</option>
                            <option value="uiux">UI / UX</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea rows="8" id="message" name="message" class="form-control rounded-0"
                                  placeholder="Message" required=""></textarea>
                        <label for="message"></label>
                    </div>
                    <input type="hidden" name="action" value="contact_form">
                    <div class="form-group tm-text-right">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-12 mb-5">
                <div class="tm-address-col">
                    <h2 class="tm-text-primary mb-5"><?php _e('Our Address', 'catalog'); ?></h2>
                    <?= get_option('catalog_our_address') ?>
                    <ul class="tm-contacts">
                        <?php if ($email = get_option('catalog_email')) : ?>
                            <li>
                                <a href="mailto:<?= $email ?>" class="tm-text-gray">
                                    <i class="fas fa-envelope"></i>
                                    Email: <?= $email ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($tel = get_option('catalog_tel')) : ?>
                            <li>
                                <a href="tel:<?= $tel ?>" class="tm-text-gray">
                                    <i class="fas fa-phone"></i>
                                    Tel: <?= $tel ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($url = get_option('catalog_url')) : ?>
                            <li>
                                <a href="<?= $url ?>" class="tm-text-gray">
                                    <i class="fas fa-globe"></i>
                                    URL: <?= $url ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php if ($location = get_option('catalog_our_location')) : ?>
                <div class="col-lg-4 col-12">
                    <h2 class="tm-text-primary mb-5"><?= __('Our Location', 'catalog') ?></h2>
                    <!-- Map -->
                    <div class="mapouter mb-4">
                        <div class="gmap-canvas">
                            <?= $location ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row tm-mb-74 tm-people-row">
            <?php
            $args = array(
                'post_type' => 'team',
                'posts_per_page' => get_option('catalog_posts_on_page') ?? 4
            );
            $query = new WP_Query($args);
            ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/content', 'employee'); ?>
            <?php endwhile;
            wp_reset_query(); ?>
        </div>
    </div>
<?php get_footer() ?>