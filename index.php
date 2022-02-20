<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
                                <article>
                                    <h2><?php the_title() ?></h2>
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