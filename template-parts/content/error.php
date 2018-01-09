<article>

	<?php if (is_search()): // Check if Search page ?>

		<div class="content">
			<?php echo wpautop( esc_html( 'Geen resultaten.' ) ); ?>			
		</div>
				

	<?php elseif (is_404()): ?>

		<?php //locate_template( array( 'menu/breadcrumbs.php' ), true ); // Loads the menu/breadcrumbs.php template. ?>

		<header>
			<h1><?php echo esc_html( 'Pagina niet gevonden' ); ?></h1>
		</header>

		<div class="content">
			<?php echo wpautop( esc_html( 'De pagina waar u naar zoekt bestaat niet (meer). Misschien vindt u wat u zoekt via de homepagina.' ) ); ?>			
		</div>
			

	<?php else: ?>

		<header>
			<h1><?php echo esc_html( 'Pagina niet gevonden' ); ?></h1>
		</header>

		<div class="content">
			<?php echo wpautop( esc_html( 'De pagina waar u naar zoekt bestaat niet (meer). Misschien vindt u wat u zoekt via de homepagina.' ) ); ?>			
		</div>

	<?php endif; // End check Search ?>

</article>