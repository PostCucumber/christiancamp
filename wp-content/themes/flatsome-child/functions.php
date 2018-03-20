<?php
// Add custom Theme Functions here

add_action('init', 'tc_add_shortcodes');

function tc_add_shortcodes()
{
    add_shortcode('product', 'cr_product_print_shortcode');
    add_shortcode('accommodations', 'cr_accommodations_print_shortcode');
    add_shortcode('testimonials', 'cr_testimonials_print_shortcode');
    add_shortcode('drop', 'cr_drop_print_shortcode');
    add_shortcode('drop2', 'cr_drop2_print_shortcode');
}


function cr_drop_print_shortcode($atts)
{
    extract(shortcode_atts([
        'category' => ''
    ], $atts));

    $post_query_options   = [
        'post_type'      => 'accommodation',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'posts_per_page' => -1,
        'category_name'  => 'main-campus'
    ];
    $post_query_options_2 = [
        'post_type'      => 'accommodation',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'posts_per_page' => -1,
        'category_name'  => 'cottages'
    ];

    $post_query      = new WP_Query($post_query_options);
    $post_collection = $post_query->posts;

    $post_query_2      = new WP_Query($post_query_options_2);
    $post_collection_2 = $post_query_2->posts;

    $out = '<select id="drop-accommodations" onChange="window.document.location.href=this.options[this.selectedIndex].value;"><option>Select..</option><optgroup label="Main Campus">';

    /*foreach($post_collection as $post_resul){
        //template
        $_product = wc_get_product( $post_resul->ID );
        $post_tpl = '<option value="%s">%s</option>';
        // get_permalink($post_resul->ID)
        // $post_resul->post_excerpt
        // $post_resul->post_title
        // $post_resul->post_content
        // $post_resul->post_name
        // apply_filters('the_content', $post_resul->post_content)
        // get_the_post_thumbnail( $post_resul->ID, "full" )
        $out.= sprintf($post_tpl, get_permalink($post_resul->ID), $post_resul->post_title );
    }
    $out.='</optgroup"><optgroup label="Cottage">';

      foreach($post_collection_2 as $post_resul_2){
        //template
        $_product_2 = wc_get_product( $post_resul_2->ID );
        $post_tpl_2 = '<option value="%s">%s</option>';
        // get_permalink($post_resul->ID)
        // $post_resul->post_excerpt
        // $post_resul->post_title
        // $post_resul->post_content
        // $post_resul->post_name
        // apply_filters('the_content', $post_resul->post_content)
        // get_the_post_thumbnail( $post_resul->ID, "full" )
        $out.= sprintf($post_tpl_2, get_permalink($post_resul_2->ID), $post_resul_2->post_title );
    }
      $out.='</optgroup></select>';*/


    return $out;

}


add_shortcode( 'drop', function ($atts)
{
    extract(shortcode_atts([
        'category' => ''
    ], $atts));

    $post_query_options = [
        'post_type'      => 'accommodation',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'posts_per_page' => -1,
        'category_name'  => $atts['category']
    ];

    $post_query      = new WP_Query($post_query_options);
    $post_collection = $post_query->posts;


    $out = '<select id="drop-accommodations" onChange="window.document.location.href=this.options[this.selectedIndex].value;"><option>Select..</option>';

    foreach ($post_collection as $post_resul) {
        //template
//        $_product = wc_get_product($post_resul->ID);
        $post_tpl = '<option value="%s">%s</option>';
         get_permalink($post_resul->ID);
         $post_resul->post_excerpt;
         $post_resul->post_title;
         $post_resul->post_content;
         $post_resul->post_name;
         apply_filters('the_content', $post_resul->post_content);
         get_the_post_thumbnail( $post_resul->ID, "full" );
        $out .= sprintf($post_tpl, get_permalink($post_resul->ID), $post_resul->post_title);
    }
    $out .= '</select>';

    return $out;

});


function cr_product_print_shortcode($atts)
{
    extract(shortcode_atts([
        '' => ''
    ], $atts));

    $post_query_options = [
        'post_type'      => 'product',
        'order'          => 'ACS',
        'orderby'        => 'date',
        'posts_per_page' => -1
    ];

    $post_query      = new WP_Query($post_query_options);
    $post_collection = $post_query->posts;


    $out = '<div class="woocommerce columns-3"><div class="products row row-small large-columns-3 medium-columns-3 small-columns-2">';

    foreach ($post_collection as $post_resul) {
        //template
        //$_product = wc_get_product( $post_resul->ID );
        $post_tpl = '<div class="product-small col has-hover post-11 product type-product status-publish has-post-thumbnail first instock shipping-taxable purchasable product-type-simple">
                        <div class="box">
                        	<div class="box-image">%s</div>
	                        <div class="box-text box-text-products">
	                            <span class="title-wrapper">%s</span>
	                            <span class="price-wrapper">$%s</span>
	                        </div>
	                        <a href="%s">SHOP NOW</a>
	                    </div>
                      </div>';
        get_permalink($post_resul->ID);
        $post_resul->post_excerpt;
        $post_resul->post_title;
        $post_resul->post_content;
        $post_resul->post_name;
        apply_filters('the_content', $post_resul->post_content);
        get_the_post_thumbnail($post_resul->ID, "full");
        $out .= sprintf($post_tpl, get_the_post_thumbnail($post_resul->ID, "full"), $post_resul->post_title,
            get_permalink($post_resul->ID));
//        $out .= sprintf($post_tpl, get_the_post_thumbnail($post_resul->ID, "full"), $post_resul->post_title,
//            $_product->get_price(), get_permalink($post_resul->ID));
    }
    $out .= '</div></div>';

    return $out;

}


function cr_accommodations_print_shortcode($atts)
{
    extract(shortcode_atts([
        'category' => ''
    ], $atts));

    $post_query_options = [
        'post_type'      => 'accommodation',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'posts_per_page' => -1,
        'category_name'  => $atts['category']
    ];

    $post_query      = new WP_Query($post_query_options);
    $post_collection = $post_query->posts;


    $out = '<div id="list-accommodations">';

    foreach ($post_collection as $post_resul) {
        //template
        //        $_product = wc_get_product( $post_resul->ID );
        $post_tpl = '<div class="vc_col-sm-4" style="background-image: url(%s)">
        				<div class="box-link-acc">
	                    	<a href="%s">%s</a>
	                    </div>
                      </div>';
        get_permalink($post_resul->ID);
        $post_resul->post_excerpt;
        $post_resul->post_title;
        $post_resul->post_content;
        $post_resul->post_name;
        apply_filters('the_content', $post_resul->post_content);
        get_the_post_thumbnail($post_resul->ID, "full");
        $out .= sprintf($post_tpl, get_the_post_thumbnail_url($post_resul->ID, "full"), get_permalink($post_resul->ID),
            $post_resul->post_title);
    }
    $out .= '</div>';

    return $out;

}

function cr_testimonials_print_shortcode($atts)
{
    extract(shortcode_atts([
        '' => ''
    ], $atts));

    $post_query_options = [
        'post_type'      => 'testimonial',
        'order'          => 'ACS',
        'orderby'        => 'date',
        'posts_per_page' => -1
    ];

    $post_query      = new WP_Query($post_query_options);
    $post_collection = $post_query->posts;


    $out = '<div id="testimonials"><div class="container-testimonials">';

    foreach ($post_collection as $post_resul) {
        //template
        //        $_product = wc_get_product( $post_resul->ID );
        $post_tpl = '<div class="item-testimonial">
                        <p>%s</p>
                        <hr>
                        <h3>%s</h3>
                      </div>';
        get_permalink($post_resul->ID);
        $post_resul->post_excerpt;
        $post_resul->post_title;
        $post_resul->post_content;
        $post_resul->post_name;
        apply_filters('the_content', $post_resul->post_content);
        get_the_post_thumbnail($post_resul->ID, "full");
        $out .= sprintf($post_tpl, $post_resul->post_content, $post_resul->post_title);
    }
    $out .= '</div></div>';

    return $out;

}