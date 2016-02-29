<div class="wrap">
    <?php
    if (version_compare($GLOBALS['wp_version'], '4.3', '<')) {
        echo '<h2>' . __( 'Gallery Factory Settings', VLS_GF_TEXTDOMAIN ) . '</h2>';
    } else {
        echo '<h1>' . __( 'Gallery Factory Settings', VLS_GF_TEXTDOMAIN ) . '</h1>';
    }
    ?>

    <form action="options.php" method="post">

        <?php settings_fields('vls-gallery-factory'); ?>

        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="vls_gf_lightbox"><?php _e('Lightbox', VLS_GF_TEXTDOMAIN); ?></label></th>
                <td>
                    <select name="vls_gf_lightbox" id="vls_gf_lightbox">
                        <option
                            value="disabled" <?php echo 'disabled' == get_option('vls_gf_lightbox') ? 'selected="selected"' : ''; ?>>
	                        <?php _e( 'Disable', VLS_GF_TEXTDOMAIN ); ?>
                        </option>
                        <option
                            value="imagelightbox" <?php echo 'imagelightbox' == get_option('vls_gf_lightbox') ? 'selected="selected"' : ''; ?>>
                            Imagelightbox
                        </option>
                        <option
                            value="colorbox" <?php echo 'colorbox' == get_option('vls_gf_lightbox') ? 'selected="selected"' : ''; ?>>
                            Colorbox
                        </option>
                        <option
                            value="lightbox2" <?php echo 'lightbox2' == get_option('vls_gf_lightbox') ? 'selected="selected"' : ''; ?>>
                            Lightbox2
                        </option>
                    </select>

	                <p class="description"><?php _e( 'This option defines the lightbox to be used. Select "Disable" to disable lightbox integration.', VLS_GF_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label
                        for="vls_gf_display_image_info_on_hover"><?php _e('Image info display on hover', VLS_GF_TEXTDOMAIN); ?></label>
                </th>
                <td>
                    <select name="vls_gf_display_image_info_on_hover" id="vls_gf_display_image_info_on_hover">
                        <option
                            value="none" <?php echo 'disabled' == get_option('vls_gf_display_image_info_on_hover') ? 'selected="selected"' : ''; ?>>
	                        <?php _e( 'None', VLS_GF_TEXTDOMAIN ); ?>
                        </option>
                        <option
                            value="caption" <?php echo 'caption' == get_option('vls_gf_display_image_info_on_hover') ? 'selected="selected"' : ''; ?>>
	                        <?php _e( 'Caption', VLS_GF_TEXTDOMAIN ); ?>
                        </option>
                        <option
                            value="all" <?php echo 'all' == get_option('vls_gf_display_image_info_on_hover') ? 'selected="selected"' : ''; ?>>
	                        <?php _e( 'Caption & description', VLS_GF_TEXTDOMAIN ); ?>
                        </option>
                    </select>

	                <p class="description"><?php _e( 'Select which info will be displayed on hovering the thumbnail.', VLS_GF_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label
                        for="vls_gf_pagination_page_size"><?php _e('Page size', VLS_GF_TEXTDOMAIN); ?></label></th>
                <td>
                    <input type="number" name="vls_gf_pagination_page_size" id="vls_gf_pagination_page_size" step="0.1"
                           value="<?php echo get_option('vls_gf_pagination_page_size'); ?>"/>

	                <p class="description">
		                <?php _e( 'This is a number of rows in a page, relative to the album  layout\'s column count (e.g. value 1.5 for 6-column layout results in 9 rows on a page).', VLS_GF_TEXTDOMAIN ); ?>
	                </p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label
                        for="vls_gf_pagination_type"><?php _e('Pagination type', VLS_GF_TEXTDOMAIN); ?></label></th>
                <td>
                    <select name="vls_gf_pagination_type" id="vls_gf_pagination_type">
                        <option
                            value="none" <?php echo ('none' == get_option('vls_gf_pagination_type')) ? 'selected' : ''; ?>><?php _e('None', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="paged-numbers" <?php echo ('paged-numbers' == get_option('vls_gf_pagination_type')) ? 'selected' : ''; ?>><?php _e('Paged (numbers)', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="paged-bullets" <?php echo ('paged-bullets' == get_option('vls_gf_pagination_type')) ? 'selected' : ''; ?>><?php _e('Paged (bullets)', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="load-more" <?php echo ('load-more' == get_option('vls_gf_pagination_type')) ? 'selected' : ''; ?>><?php _e('Load more button', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="load-scroll" <?php echo ('load-scroll' == get_option('vls_gf_pagination_type')) ? 'selected' : ''; ?>><?php _e('Load on scroll', VLS_GF_TEXTDOMAIN); ?></option>
                    </select>

	                <p class="description"><?php _e( 'Set the default pagination behaviour for the albums. For more info on available options please refer to the documentation.', VLS_GF_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label
                        for="vls_gf_pagination_style"><?php _e('Pagination style', VLS_GF_TEXTDOMAIN); ?></label></th>
                <td>
                    <select name="vls_gf_pagination_style" id="vls_gf_pagination_style">
                        <option
                            value="light" <?php echo ("light" == get_option('vls_gf_pagination_style')) ? 'selected' : ''; ?>><?php _e('Light', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="dark" <?php echo ("dark" == get_option('vls_gf_pagination_style')) ? 'selected' : ''; ?>><?php _e('Dark', VLS_GF_TEXTDOMAIN); ?></option>
                        <option
                            value="custom" <?php echo ("custom" == get_option('vls_gf_pagination_style')) ? 'selected' : ''; ?>><?php _e('Custom', VLS_GF_TEXTDOMAIN); ?></option>
                    </select>

	                <p class="description"><?php _e( 'You can choose from two predefined styles for pagination controls or select "Custom" and define your own style in css.', VLS_GF_TEXTDOMAIN ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Lazy loading', VLS_GF_TEXTDOMAIN); ?></th>
                <td>
                    <fieldset>
	                    <legend class="screen-reader-text">
		                    <span><?php _e( 'Use lazy loading', VLS_GF_TEXTDOMAIN ); ?></span></legend>
                        <label for="vls_gf_use_lazy_loading">
                            <input name="vls_gf_use_lazy_loading" type="checkbox" id="vls_gf_use_lazy_loading"
                                   value="1" <?php checked(true, get_option('vls_gf_use_lazy_loading')); ?>>
	                        <?php _e( 'Use lazy loading', VLS_GF_TEXTDOMAIN ); ?>
                        </label>
                    </fieldset>
	                <p class="description"><?php _e( 'Lazy loading of thumbnails means that image thumbnails outside of viewport are not loaded until user scrolls to them.', VLS_GF_TEXTDOMAIN ); ?></p>
                </td>
            </tr>

            </tbody>
        </table>

        <?php submit_button(__("Save Changes", VLS_GF_TEXTDOMAIN)); ?>
    </form>

</div>