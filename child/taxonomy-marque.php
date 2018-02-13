<?php get_template_part('includes/header'); ?>

<div class="container">
    <div class="row">
        <header class="col-sm-12">
            <h1><?php single_term_title(); ?></h1>
            <nav>
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="<?php the_permalink(2611); ?>">Tous les produits</a></li>
                <?php $marques = get_terms( 'marque' ); ?>
                <?php foreach($marques as $marque){?>
                    <li role="presentation" <?php if($marque->slug === $term){echo 'class="active"';} ?>><a href="<?php echo get_term_link($marque); ?>"><?php echo $marque->name; ?></a></li>
                <?php }?>
                </ul>
            </nav>
        </header>
        <?php if (have_posts()) : ?>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
            <?php while (have_posts()) : the_post(); ?>
            <tr>
                <td>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                </td>
                <td>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </td>
                <td><?php the_excerpt_max_charlength(200);
                //print_r(get_the_ID());
                        //the_excerpt(); ?></td>
                <td>
                    <?php the_field('prix'); ?> €
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part('includes/footer'); ?>