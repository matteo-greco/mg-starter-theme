<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MG_Starter_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
		<?php if( get_theme_mod( 'mg_footer_enable', false ) ): ?>
			<?php for( $i = 1; $i <= get_theme_mod( 'mg_footer_number_columns', 0 ); $i++ ): ?>
			<div class="footer-<?php echo $i; ?> footer-column">
				<?php dynamic_sidebar( 'footer-' . $i ); ?>
			</div>
			<?php endfor; ?>
		<?php else: ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'mg-starter-theme' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'mg-starter-theme' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'mg-starter-theme' ), 'mg-starter-theme', '<a href="http://underscores.me/">Underscores.me</a>' );
			?>
		<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
