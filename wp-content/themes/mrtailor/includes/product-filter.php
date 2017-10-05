<?php
function get_term_attribute($att,$list){
	$args = array( 'hide_empty=0' );
    $att_ids=explode(',',$list);
	$terms = get_terms( $att, $args );
    if($list=='')
    {
    	switch ($att) {
    		case 'pa_color':
    			$default = 'All Colors';
    			break;
    		case 'pa_fabric-weight':
    			$default = 'All Weights';
    			break;
    		default:
    			$default = 'All Patterns';
    			break;
    	}
    }
    else{
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                foreach($att_ids as $att_id){
                    if($term->term_id==$att_id)
                      $default.=  $term->name.',';
                }
            }
        }

    }
    
  
    
    $term_list = '<dl class="dropdown" id="'.$att.'">';
    $term_list .= '<dt><a href="javascript:void(0)"><span class="hida" id="hida-'.$att.'">'. $default .'</span><p class="multiSel" id="multiSel-'.$att.'"></p></a></dt>';
    $term_list .= '<dd><div class="mutliSelect" id="mutliSelect-'.$att.'"><ul>';
    $a=$_SERVER['REQUEST_URI'];
    $b=explode('/',$a);
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        if($b['2'] != 'jackets' ){            
            foreach ( $terms as $term ) {        
                $checked=in_array($term->term_id,$att_ids)?'checked':'';
                $term_list .= '<li><input type="checkbox" onClick="submit" onChange="auto_seach()"  name="checkbox-'. $term->term_id .'"  id="checkbox-'. $term->term_id .'" name="'.$att.'[]" value ="'. $term->term_id .'" data-name="'.$term->name.'" '.$checked.'/><label for="checkbox-'. $term->term_id.'">'.$term->name.'</label></li>';
            }
            }else{            
               foreach ( $terms as $term ) {             
                    $checked=in_array($term->term_id,$att_ids)?'checked':'';                            
                    if($term->term_id != 105 && $term->term_id != 99 && $term->term_id != 97){
                      $term_list .= '<li><input type="checkbox" onClick="submit" onChange="auto_seach()" name="checkbox-'. $term->term_id .'" id="checkbox-'. $term->term_id .'" name="'.$att.'[]" value ="'. $term->term_id .'" data-name="'.$term->name.'" '.$checked.'/><label for="checkbox-'. $term->term_id.'">'.$term->name.'</label></li>';
                    } 
                }
            }
    }
    $term_list .= '</ul></div></dd></dl>';
	return $term_list;
}

function get_list_price($category,$list){
	$args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'tax_query' => array( array('taxonomy' => $category->taxonomy, 'terms' => $category->term_id, 'field' => 'term_id')),
        'posts_per_page' => -1
    );
    $loop = new WP_Query( $args );
    $array = array();
    $i =0;
    if ( $loop->have_posts() ):
    	while ( $loop->have_posts() ): $loop->the_post();
        global $product;

        $array[$product->price] =  $product->price;
    	$i++;
        // echo $price = $product->price;

    	endwhile;
    endif;
    wp_reset_postdata();

    $array = array_unique($array);
    sort($array, SORT_NUMERIC) ;


	/*$str = '<select name ="price">';
	$str .= '<option value = ""> All Price </option>';
    foreach ($array as $key => $value) {
    	$str .= '<option  value = "'.$value.'" >' .$value.'</option>';
    }
    $str .= '</select>';*/
    $att_ids=explode(',',$list);
    $str = '<dl class="dropdown" id="price">';
    if($list=='')
        $str .= '<dt><a href="javascript:void(0)"><span class="hida" id="hida-price"> All Prices </span><p class="multiSel" id="multiSel-price"></p></a></dt>';
    else
        $str .= '<dt><a href="javascript:void(0)"><span class="hida" id="hida-price">'.$list.'</span><p class="multiSel" id="multiSel-price"></p></a></dt>';
    $str .= '<dd><div class="mutliSelect" id="mutliSelect-price"><ul>';

    foreach ($array as $key => $value) {
        foreach($att_ids as $att_id){
            $checked=($value==$att_id)?'checked':'';
            $str .= '<li><input type="checkbox" name="price[]" value ="'. $value .'" data-name="'.$value.'" '.$checked.' />'.$value.'</li>';
        }
    }
    $str .= '</ul></div></dd></dl>';

    return 	$str;
}

function design_filter($arg,$content) {
    
     $a=$_SERVER['REQUEST_URI'];
    if($a=="/product-category/accessories/ties/"){
        $html="";
        echo $html;
        return $htlm;
    }else{
	$category = get_queried_object();
    // $html = '<div class = "large-12 columns "><div class = "form-filter"><form action = "'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'" method = "post">';
	$html = '<div class = "large-12 columns "><div class = "form-filter"><form id="submit-filter" class="filter_size" action="" method = "post">';
   	$html .= '<div class = "fabric-weight">'. get_term_attribute('pa_color',$arg['color']) .'</div>';
    $html .= '<div class = "fabric-weight">'. get_term_attribute('pa_fabric-weight',$arg['weight']) . '</div>';
    $html .= '<div class = "fabric-weight">'. get_term_attribute('pa_pattern',$arg['pattern']) .'</div>';
    $html .= '<div class = "fabric-weight">'. get_list_price($category,$arg['price']) .'</div>';
    $html .= '<div class="active-filters"><button class="products-filter-clear fl " data-ember-action="1334">clear all</button><div class="active-filter-list"></div></div>';
    //$html .= '<div class = "but-fiter"><input type = "submit" value = "Search"/></div>';
    $html .= '<input type="hidden" name="submit-filter-ajax-none" value="'.wp_create_nonce( "submit-filter-ajax-none" ).'" />';
    $current_url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    $current_url = strtok($current_url, '?');
    $html .= '<input type="hidden" name="current-url" value="'.$current_url.'" />';
    $html .= '</form></div></div>';
    echo $html;
    return $htlm;
    }
}
add_shortcode( 'product_filter', 'design_filter' );
add_shortcode('get_new_query','get_new_query');



//function filed_select($arg,$content) {
//    $key=$arg['key'];
//    return 'ket qua:'.$content.var_dump($arg);
//}
//add_shortcode( 'loc_sanpham', 'filed_select' );
?>