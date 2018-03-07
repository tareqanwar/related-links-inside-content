<?php 
function get_keyword() {
	if(!isset($_POST['rp_nonce'])){
		die("Permission check failed");
	}
$keyword = $_POST['suggest'];
$num = $_POST['num'];
// args
$args = array('s' => $keyword,'post_status' => 'publish', 'posts_per_page' => 25);

// get results
$the_query = new WP_Query( $args );

// The Loop
?>
<style>
.rp_post_list p{color: #0074a2; text-decoration: underline;cursor: pointer;}
</style>
<?php if( $the_query->have_posts() ): ?>
	<ul class="rp_post_list">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<li>
			<p id="<?php the_ID(); ?>" onclick="pushvalue<?php echo $num; ?>('<?php the_ID();?>', '<?php the_title(); ?>')" ><?php the_title(); ?></p>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query();  // Restore global post data stomped by the_post(). 
die();
}
?>
