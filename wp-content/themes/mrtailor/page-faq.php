<?php
/*
Template Name: Faq
*/
?>

<?php get_header(); ?>

    <div class="page_with_slider inner_top_slider">
       <?php
        global $slider_metabox;
        $slider_metabox->the_meta();
    ?>
    
    <?php
    
	$slider_style = $slider_metabox->get_the_value('slider_template');
	switch ($slider_style) {
		case "style_1":
			include_once('templates/slider/style_1.php');
			break;
		case "style_2":
			include_once('templates/slider/style_2.php');
			break;
		case "style_3":
			include_once('templates/slider/style_3.php');
			break;
		case "style_4":
			include_once('templates/slider/style_4.php');
			break;
		case "style_5":
			include_once('templates/slider/style_5.php');
			break;
		case "style_6":
			include_once('templates/slider/style_6.php');
			break;
		default:
			include_once('templates/slider/style_1.php');
	}
	
	?>
    </div>

	<div class="full-width-page">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="entry-content">
                            <?php //the_content(); ?>
                            
                            
                            
                            
                       
      <div class="boxed-row">
            <!--<div class="row" style="padding:60px 0 0 0; text-align:left;"><h1 class="page-title shop_page_title">Faq</h1></div>-->
              
           <div class="faq-content">                 
             <div id="tabs" class="row">
               <div class="row-fluid">
                      <ul>
                      <?php 
					   $i=1;
					   if(get_field('category')){
						   while(has_sub_field('category')){
					  ?>
                        <li><a href="#tabs-<?php echo $i; ?>"><?php echo the_sub_field('name'); ?></a></li>
                      <?php $i++;}} ?>
                      </ul>
                  </div>
                  
                  <div class="tab_right_part">
                    <?php 
					   $k=1;
					   if(get_field('category')){
						   while(has_sub_field('category')){
					  ?>
                      <div id="tabs-<?php echo $k; ?>">
                      <h4><?php echo the_sub_field('name'); ?></h4>
                        <?php $j=1; while(has_sub_field('questions')){ ?>
                       <div  class="row acc_qa">
                        <h5 class="tgl"><span><?php echo $j; ?>.</span> <?php echo the_sub_field('question'); ?></h5>
                        <div class="ans_div">
                          <p><?php echo the_sub_field('answer'); ?></p>
                        </div>
                        </div>
                       <?php    $j++;} ?>
                      </div>
                      <?php $k++;}} ?>
                      
                  </div>
          
          	</div>
           </div>                 
                            
      </div>                    
                            
                            
                            
                            
                            
                            
                        </div><!-- .entry-content -->
        
                    <?php endwhile; // end of the loop. ?>
    
            </div><!-- #content -->           
            
        </div><!-- #primary -->
    
    </div><!-- .full-width-page -->
    
  
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
	  $(function() {
		$( "#tabs" ).tabs();
		
		//accodion start
		$(".ans_div").css({"display":"none"});
 		$('.tgl').on('click', function () {
        $(this)
        .next('.ans_div')
        .slideDown(300)
        .parent()
        .siblings()
        .find('.ans_div')
        .slideUp(300);
    });
	  
	  });
  </script>

    
<?php get_footer(); ?>
