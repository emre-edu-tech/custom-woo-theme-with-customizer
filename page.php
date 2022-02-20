<?php
/**
 * The template for displaying all pages
 *
 * This is the template file that displays all pages by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MyCodingWoocom
 */

get_header()
?>
        <section class="content-area">
            <main>
                <div class="container">
                    <div class="row">
                        <?php if(have_posts()): ?>
                            <?php while(have_posts()): the_post(); ?>
                                <article class="col-12">
                                    <h1><?php the_title() ?></h1>
                                    <div class="post-content">
                                        <?php the_content() ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>There are no posts to display.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </section>
<?php get_footer() ?>