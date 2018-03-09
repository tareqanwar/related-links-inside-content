<?php 
function rlic_tareqanwar_search_posts() {
	if(!isset($_POST['rlic_tareqanwar_nonce'])){
		die("Permission check failed");
	}
$keyword = esc_sql(sanitize_title_for_query($_POST['suggest']));
$num = esc_sql(sanitize_text_field($_POST['num']));
// args
$args = array('s' => $keyword,'post_status' => 'publish', 'posts_per_page' => 25);

// get results
$the_query = new WP_Query( $args );

// The Loop
?>
<style>
  .rlic_tareqanwar_post_list p{color: #0074a2; text-decoration: underline; cursor: pointer;}
</style>
<?php if( $the_query->have_posts() ): ?>
	<ul class="rlic_tareqanwar_post_list">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<p id="<?php the_ID(); ?>" onclick="rlic_tareqanwar_pushvalue<?php echo $num; ?>('<?php the_ID();?>', '<?php the_title(); ?>')" ><?php the_title(); ?></p>
		</li>
	<?php endwhile; ?>
    <?php else: ?>
        <p>No post found!</p>
    <?php endif; ?>
	</ul>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). 
die();
}
?>
