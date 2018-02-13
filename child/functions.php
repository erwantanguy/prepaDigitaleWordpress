<?php

/*** formats des images ****/

add_image_size('slider',400,400, true);

/* mes scripts */
function mes_scripts2() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'style-name', get_stylesheet_uri(),false,time() );
}
add_action( 'wp_enqueue_scripts', 'mes_scripts2' );

/*** Fil ariane ***/



add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;

//    if ( is_home() || is_singular( 'post' ) || is_archive() ) {
//        $breadcrumb[] = array(
//            'url' => get_permalink( get_option( 'page_for_posts' ) ),
//            'text' => 'Blog',
//        );
//
//        array_splice( $links, 1, -2, $breadcrumb );
//    }
    
    if(is_tax('marque') || is_singular('produit')){
        $breadcrumb[] = array(
            'url' => get_page_link( 2611 ),
            'text' => 'Mes produits',
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}

/*** excerpt personnalisé ****/

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...] <a href="'.get_permalink( get_the_ID() ).'">Lire la suite</a>';
	} else {
		echo $excerpt;
	}
}
/*** CPT ****/
function wpm_custom_post_type() {
	$labels = array(
		'name'                => _x( 'Pièces', 'Post Type General Name'),
		'singular_name'       => _x( 'Pièce', 'Post Type Singular Name'),
		'menu_name'           => __( 'Pièces'),
		'all_items'           => __( 'Toutes les pièces'),
		'view_item'           => __( 'Voir les pièces'),
		'add_new_item'        => __( 'Ajouter une nouvelle pièce'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la pièce'),
		'update_item'         => __( 'Modifier la pièce'),
		'search_items'        => __( 'Rechercher une pièce'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __( 'Pièces'),
		'description'         => __( 'Tous sur nos pièces'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/*
		* Différentes options supplémentaires
		*/
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'pieces'),

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'pieces', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );