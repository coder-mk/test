// Базовый цикл. По умолчанию выводит все записи для данного URL

<?php
if ( have_posts() ) :
while ( have_posts() ) :
the_post();
?>
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<br />
	<?php the_content();
endwhile;
endif;
?>



// Произвольный цикл. По умолчанию выводит 5 последних записей

<?php
$myPosts = new WP_Query( 'posts_per_page=5' );while ( $myPosts->have_posts() )
: $myPosts->the_post();
?>
<!-- делаем, что нам нужно -->
<?php endwhile; ?>



// Пагинация произвольного цикла

<?php
$temp = $wp_query;
$wp_query= null;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$wp_query = new WP_Query( 'posts_per_page=5&paged='.$paged );
while ( $wp_query->have_posts() ) : $wp_query->the_post();
?>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php the_excerpt(); ?>
<?php endwhile; ?>

<div class="navigation">
<div class="alignleft"><?php previous_posts_link( '&laquo; Previous' ); ?></div>
<div class="alignright"><?php next_posts_link( 'More &raquo;' ); ?></div>
</div>

<?php
$wp_query = null;
$wp_query = $temp;
?>



// Изменение параметов базового цикла

<?php
query_posts( 'posts_per_page=5&paged='.$paged );
if ( have_posts() ) :
while ( have_posts() ) : the_post();
// код внутри цикла (теги шаблонов, html и пр.)
endwhile;
endif;
?>