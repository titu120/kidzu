<?php
global $kidzu_option;

$current_id = get_queried_object_id();
$header_width_meta = $current_id ? get_post_meta( $current_id, 'header_width_custom', true ) : '';
$header_width = ! empty( $header_width_meta ) ? $header_width_meta : ( ! empty( $kidzu_option['header-grid'] ) ? $kidzu_option['header-grid'] : '' );
$header_width = ( 'full' === $header_width ) ? 'container-fluid' : 'container';

$banner_hide = $current_id ? get_post_meta( $current_id, 'banner_hide', true ) : 'show';
if ( 'hide' === $banner_hide ) {
	return;
}

$content_banner       = $current_id ? get_post_meta( $current_id, 'content_banner', true ) : '';
$post_meta_title      = $current_id ? get_post_meta( $current_id, 'select-title', true ) : '';
$post_meta_breadcrumb = $current_id ? get_post_meta( $current_id, 'select-bread', true ) : '';
if ( 'hide' === $post_meta_breadcrumb ) {
	return;
}

$title = '';
if ( ! empty( $content_banner ) ) {
	$title = $content_banner;
} elseif ( is_home() ) {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	$title         = $posts_page_id ? get_the_title( $posts_page_id ) : esc_html__( 'Blog', 'kidzu' );
} elseif ( is_search() ) {
	$title = sprintf( esc_html__( 'Search Results for: %s', 'kidzu' ), get_search_query() );
} elseif ( is_404() ) {
	$title = esc_html__( '404 Page', 'kidzu' );
} elseif ( is_singular() ) {
	$title = get_the_title( $current_id );
} elseif ( is_archive() ) {
	$title = wp_strip_all_tags( get_the_archive_title() );
}

if ( '' === trim( $title ) ) {
	$title = esc_html__( 'Page', 'kidzu' );
}

$items   = array();
$items[] = array(
	'label' => esc_html__( 'Home', 'kidzu' ),
	'url'   => home_url( '/' ),
);

if ( is_home() ) {
	$items[] = array( 'label' => $title );
} elseif ( is_singular() ) {
	$post_type = get_post_type( $current_id );
	if ( $post_type && 'page' !== $post_type && 'post' !== $post_type ) {
		$post_type_obj = get_post_type_object( $post_type );
		if ( $post_type_obj && ! empty( $post_type_obj->has_archive ) ) {
			$items[] = array(
				'label' => $post_type_obj->labels->name,
				'url'   => get_post_type_archive_link( $post_type ),
			);
		}
	}

	if ( is_page() ) {
		$ancestors = array_reverse( get_post_ancestors( $current_id ) );
		foreach ( $ancestors as $ancestor_id ) {
			$items[] = array(
				'label' => get_the_title( $ancestor_id ),
				'url'   => get_permalink( $ancestor_id ),
			);
		}
	}

	$items[] = array( 'label' => $title );
} elseif ( is_post_type_archive() ) {
	$items[] = array( 'label' => $title );
} elseif ( is_tax() || is_category() || is_tag() ) {
	$term = get_queried_object();
	if ( $term && ! empty( $term->taxonomy ) ) {
		$taxonomy = get_taxonomy( $term->taxonomy );
		if ( $taxonomy && ! empty( $taxonomy->object_type[0] ) ) {
			$tax_post_type = get_post_type_object( $taxonomy->object_type[0] );
			if ( $tax_post_type && ! empty( $tax_post_type->has_archive ) ) {
				$items[] = array(
					'label' => $tax_post_type->labels->name,
					'url'   => get_post_type_archive_link( $tax_post_type->name ),
				);
			}
		}
	}
	$items[] = array( 'label' => $title );
} elseif ( is_author() || is_date() || is_search() || is_404() || is_archive() ) {
	$items[] = array( 'label' => $title );
} else {
	$items[] = array( 'label' => $title );
}

$breadcrumb_bg_image = ! empty( $kidzu_option['breadcrumb_bg_image']['url'] ) ? $kidzu_option['breadcrumb_bg_image']['url'] : '';
if ( empty( $breadcrumb_bg_image ) && ! empty( $kidzu_option['page_banner_main']['url'] ) ) {
	$breadcrumb_bg_image = $kidzu_option['page_banner_main']['url'];
}

$home_icon_html = '';
if ( ! empty( $kidzu_option['breadcrumb_home_icon_image']['url'] ) ) {
	$home_icon_html = '<img src="' . esc_url( $kidzu_option['breadcrumb_home_icon_image']['url'] ) . '" alt="' . esc_attr__( 'Home', 'kidzu' ) . '">';
} else {
	$home_icon_class = ! empty( $kidzu_option['breadcrumb_home_icon_class'] ) ? $kidzu_option['breadcrumb_home_icon_class'] : 'fa-solid fa-house';
	$home_icon_html  = '<i class="' . esc_attr( $home_icon_class ) . '"></i>';
}

$shape_1 = ! empty( $kidzu_option['breadcrumb_shape_1']['url'] ) ? $kidzu_option['breadcrumb_shape_1']['url'] : '';
$shape_2 = ! empty( $kidzu_option['breadcrumb_shape_2']['url'] ) ? $kidzu_option['breadcrumb_shape_2']['url'] : '';
$shape_3 = ! empty( $kidzu_option['breadcrumb_shape_3']['url'] ) ? $kidzu_option['breadcrumb_shape_3']['url'] : '';
$shape_4 = ! empty( $kidzu_option['breadcrumb_shape_4']['url'] ) ? $kidzu_option['breadcrumb_shape_4']['url'] : '';
?>

<div class="breadcrumb-wrapper bg-cover" <?php if ( ! empty( $breadcrumb_bg_image ) ) : ?>style="background-image: url('<?php echo esc_url( $breadcrumb_bg_image ); ?>');"<?php endif; ?>>
	<?php if ( ! empty( $shape_1 ) ) : ?>
		<div class="shape-1"><img src="<?php echo esc_url( $shape_1 ); ?>" alt="<?php esc_attr_e( 'shape', 'kidzu' ); ?>"></div>
	<?php endif; ?>
	<?php if ( ! empty( $shape_2 ) ) : ?>
		<div class="shape-2"><img src="<?php echo esc_url( $shape_2 ); ?>" alt="<?php esc_attr_e( 'shape', 'kidzu' ); ?>"></div>
	<?php endif; ?>
	<?php if ( ! empty( $shape_3 ) ) : ?>
		<div class="shape-3"><img src="<?php echo esc_url( $shape_3 ); ?>" alt="<?php esc_attr_e( 'shape', 'kidzu' ); ?>"></div>
	<?php endif; ?>
	<?php if ( ! empty( $shape_4 ) ) : ?>
		<div class="shape-4"><img src="<?php echo esc_url( $shape_4 ); ?>" alt="<?php esc_attr_e( 'shape', 'kidzu' ); ?>"></div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $header_width ); ?>">
		<div class="page-heading">
			<?php if ( 'hide' !== $post_meta_title ) : ?>
				<div class="breadcrumb-sub-title">
					<h1 class="wow fadeInUp" data-wow-delay=".3s"><?php echo esc_html( $title ); ?></h1>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $kidzu_option['off_breadcrumb'] ) ) : ?>
				<ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
					<?php foreach ( $items as $index => $item ) : ?>
						<?php if ( $index > 0 ) : ?>
							<li>/</li>
						<?php endif; ?>
						<li>
							<?php if ( ! empty( $item['url'] ) ) : ?>
								<a href="<?php echo esc_url( $item['url'] ); ?>">
									<?php if ( 0 === $index ) : ?>
										<?php echo wp_kses_post( $home_icon_html ); ?>
									<?php endif; ?>
									<?php echo esc_html( $item['label'] ); ?>
								</a>
							<?php else : ?>
								<?php echo esc_html( $item['label'] ); ?>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>