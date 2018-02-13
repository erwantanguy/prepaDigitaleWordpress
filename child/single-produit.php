<?php get_template_part('includes/header'); ?>

<div class="container">
  <div class="row">
    
      <div class="col-sm-4">
          <?php if( have_rows('slider') ):?>
          <div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                  <?php  $i = 1;while ( have_rows('slider') ) : the_row();?>
                  <div class="item <?php if($i==1){echo 'active';} ?>">
                      <?php $image = get_sub_field('image');
                      $size = 'slider';
                      echo wp_get_attachment_image( $image, $size );$i++;?>
                  </div>
                  <?php endwhile; ?>
              </div>
              <a href="#carousel-example-generic" class="left carousel-control" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
              <a href="#carousel-example-generic" class="right carousel-control" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
          </div>
            <?php else: ?>
              <?php the_post_thumbnail('slider'); ?>
          <?php endif; ?>
      </div>
      <main class="col-sm-8">
          <h1><?php the_title(); ?></h1>
          <?php //print_r($_REQUEST['nom']);
          //$nom=sanitize_key($_POST['unique_name']); print_r($nom);echo '<hr>';
          //$nom = $_REQUEST['nom'];print_r($_REQUEST);
          //$prenom = $_REQUEST['prenom'];print_r($prenom);
          if($_REQUEST['nom'] && $_REQUEST['prenom']){ ?>
          <h2>Bonjour <?php echo $_REQUEST['prenom'].' '.$_REQUEST['nom'];?></h2>
          <?php } ?>
          <nav>
              <?php $terms = get_the_terms( get_the_ID(), 'marque' );
              //print_r($terms);
              foreach($terms as $term){
                  //print_r($term); 
                  echo '<a href="'.get_term_link( $term ).'" class="btn btn-info">'.$term->name.'</a>';
              }
              //the_terms(get_the_ID(), 'marque'); ?>
          </nav>
          <?php the_content(); ?>
          <span class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-euro" aria-hidden="true"></span> <?php the_field('prix'); ?>
          </span>
      </main>
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_template_part('includes/footer'); ?>
