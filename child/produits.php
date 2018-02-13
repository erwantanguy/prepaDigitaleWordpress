<?php
/*
Template Name: Mes produits
*/
get_template_part('includes/header'); ?>

<div class="container">
    <div class="row">
        <header class="col-sm-12">
            <h1><?php the_title(); ?></h1>
            <nav>
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="<?php the_permalink(2611); ?>">Tous les produits</a></li>
                <?php $marques = get_terms( 'marque' ); ?>
                <?php foreach($marques as $marque){?>
                    <li role="presentation"><a href="<?php echo get_term_link($marque) ?>"><?php echo $marque->name; ?></a></li>
                <?php }?>
                </ul>
            </nav>
        </header>
        <?php
        $produits = new WP_Query(array(
            'post_type' => 'produit',
        ));
        if($produits->have_posts()):?>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Marques</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
        <?php while($produits->have_posts()): $produits->the_post();?>
        
            <tr>
                <td>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                </td>
                <td>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </td>
                <td><?php $terms = get_the_terms( get_the_ID(), 'marque' );
                if(!empty($terms)):
              foreach($terms as $term){
                  echo '<a href="'.get_term_link( $term ).'" class="btn btn-info">'.$term->name.'</a>';
              } endif;?></td>
                <td>
                    <?php the_field('prix'); ?> €
                </td>
            </tr>
        
        <?php endwhile;?>
            </tbody>
        </table>
        <?php else:?>
        <p class="col-sm-12">Il n'y a pas de produits !</p>
        <?php endif;
        //echo '<hr>';
        //print_r($produits);
        ?>
    </div>
</div>

<?php get_template_part('includes/footer');