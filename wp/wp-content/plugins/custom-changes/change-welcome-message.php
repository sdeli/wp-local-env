<?php

remove_action('welcome_panel', 'wp_welcome_panel');
add_action('welcome_panel', 'cs_welcome_panel_yeah');
function cs_welcome_panel_yeah() {
	list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );
	$can_customize           = current_user_can( 'customize' );
	$is_block_theme          = wp_is_block_theme();
	?>
	<div class="welcome-panel-content">
	<div class="welcome-panel-header">
		<h2><?php _e( 'Welcome to myyyyyyy WordPress!' ); ?></h2>
		<p>
			<a href="<?php echo esc_url( admin_url( 'about.php' ) ); ?>">
			<?php
				/* translators: %s: Current WordPress version. */
				printf( __( 'Learn more about the %s version.' ), $display_version );
			?>
			</a>
		</p>
	</div>
	<div class="welcome-panel-column-container">
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-pages"></div>
			<div class="welcome-panel-column-content">
				<h3><?php _e( 'Author rich content with blocks and patterns' ); ?></h3>
				<p><?php _e( 'Block patterns are pre-configured block layouts. Use them to get inspired or create new pages in a flash.' ); ?></p>
				<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>"><?php _e( 'Add a new page' ); ?></a>
			</div>
		</div>
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-layout"></div>
			<div class="welcome-panel-column-content">
			<?php if ( $is_block_theme ) : ?>
				<h3><?php _e( 'Customize your entire site with block themes' ); ?></h3>
				<p><?php _e( 'Design everything on your site &#8212; from the header down to the footer, all using blocks and patterns.' ); ?></p>
				<a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php _e( 'Open site editor' ); ?></a>
			<?php else : ?>
				<h3><?php _e( 'Start Customizing' ); ?></h3>
				<p><?php _e( 'Configure your site&#8217;s logo, header, menus, and more in the Customizer.' ); ?></p>
				<?php if ( $can_customize ) : ?>
					<a class="load-customize hide-if-no-customize" href="<?php echo wp_customize_url(); ?>"><?php _e( 'Open the Customizer' ); ?></a>
				<?php endif; ?>
			<?php endif; ?>
			</div>
		</div>
		<div class="welcome-panel-column">
			<div class="welcome-panel-icon-styles"></div>
			<div class="welcome-panel-column-content">
			<?php if ( $is_block_theme ) : ?>
				<h3><?php _e( 'Switch up your site&#8217;s look & feel with Styles' ); ?></h3>
				<p><?php _e( 'Tweak your site, or give it a whole new look! Get creative &#8212; how about a new color palette or font?' ); ?></p>
				<a href="<?php echo esc_url( admin_url( 'site-editor.php?styles=open' ) ); ?>"><?php _e( 'Edit styles' ); ?></a>
			<?php else : ?>
				<h3><?php _e( 'Discover a new way to build your site.' ); ?></h3>
				<p><?php _e( 'There&#8217;s a new kind of WordPress theme, called a block theme, that lets you build the site you&#8217;ve always wanted &#8212; with blocks and styles.' ); ?></p>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/support/article/block-themes/' ) ); ?>"><?php _e( 'Learn about block themes' ); ?></a>
			<?php endif; ?>
			</div>
		</div>
	</div>
	</div>
	<?php
}