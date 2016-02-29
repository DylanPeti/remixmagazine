<div class="vls-gf-page <?php if ( $page > 1 ) {
	echo 'vls-gf-hidden';
} ?>" data-vls-gf-page-no="<?php echo $page ?>">
	<?php foreach ( $page_data as $row_data ) { ?>
		<div class="vls-gf-row">
			<?php foreach ( $row_data as $image ) { ?>
				<div class="vls-gf-item vls-gf-item-<?php echo $col_count ?>">
					<div style="<?php echo $image->spacings_style ?>">
						<a <?php echo $image->url == '' ? '' : 'href="' . $image->url . '" '; ?>
							<?php echo $image->link_target == '' ? '' : 'target="' . $image->link_target . '" '; ?>
							<?php if ( $album->lightbox == 'lightbox2' ) {
								echo 'data-lightbox="vls-gf-' . $album->ID . '" data-title="' . $image->caption . '" ';
							} ?>
							style="<?php echo $image->a_style ?>">
							<img
								class="<?php echo $image->img_class; ?>"
								<?php
								if ( $image->lazy_load === true ) {
									echo 'src="' . VLS_GF_PLUGIN_URL . 'frontend/img/null.gif" data-original="' . $image->url_preview_m . '" ';
								} else {
									echo 'src="' . $image->url_preview_m . '" ';
								}
								?>
								alt="<?php echo $image->alt_text ?>"/>

							<div class="vls-gf-info-back">
								<h2 class="vls-gf-info-caption"
									<?php if ( $image->lightbox_caption !== $image->caption ) {
										echo ' data-lightbox-caption="' . $image->lightbox_caption . '"';
									} ?>>
									<?php echo $image->caption ?>
								</h2>

								<h2 class="vls-gf-info-description"
									<?php if ( $image->lightbox_description !== $image->description ) {
										echo ' data-lightbox-description="' . $image->lightbox_description . '"';
									} ?>>
									<?php echo $image->description ?>
								</h2>
							</div>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
