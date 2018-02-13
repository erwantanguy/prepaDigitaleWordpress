<?php
/*
Template Name: Equipe
*/
?>
<?php get_template_part('includes/header'); ?>

<div class="container">
  <div class="row">

    <div class="col-xs-12 col-sm-8">
      <div id="content" role="main" class="row">
        <?php //get_template_part('includes/loops/content', 'page'); ?>
        <?php if( have_rows('equipe') ):?>
        <?php while ( have_rows('equipe') ) : the_row();
        $image = get_sub_field('image');
        $size = 'medium';?>
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <?php if( $image ) {
                echo wp_get_attachment_image( $image, $size );
                } ?>
              <div class="caption">
                <h3><?php the_sub_field('nom'); ?></h3>
                <p><?php the_sub_field('presentation'); ?></p>
                <p><a href="mailto:<?php the_sub_field('mail'); ?>" class="btn btn-primary" role="button">Mail</a> <a href="tel:<?php the_sub_field('telephone'); ?>" class="btn btn-default" role="button">Téléphone</a></p>
              </div>
            </div>
  </div>
        <?php endwhile;?>
        <?php endif;?>
      </div><!-- /#content -->
    </div>
    
    <div class="col-xs-6 col-sm-4" id="sidebar" role="navigation">
      <?php get_template_part('includes/sidebar'); ?>
    </div>
    
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_template_part('includes/footer'); ?>
