/* global vls_gf_script_l10n */

(function ($, window, document) {

    "use strict";

    $.fn.vlsGfAlbum = function (options) {

        var albums = this;

        /**
         * Initializes the GF jQuery plugin
         */
        function init() {

            //binding layout update on window resize
            $(window).on('resize.vls-gf', function () {
                albums.each(function () {
                    $(this).data('vlsGfAlbum').updateLayout();
                });
            });

            //initializing lazy loading
            if ($().vlsGfLazyload) {
                $('.vls-gf-album img[data-original]').vlsGfLazyload({
                    threshold: 100,
                    effect: 'fadeIn'
                });
            }

            //initializing album object
            albums.each(function () {
                $.data(this, 'vlsGfAlbum', new Album(this));
            });

        }


        function Album(element) {


            var album = $(element),
                albumId = album.data('vlsGfAlbumId'),
                layoutType = '',
                paginationType = 'none',
                currentPage = 1,
                totalPages = album.data('vlsGfTotalPages'),
                paginationControl,
                loadMoreButton,
                isBusy = false;

            function init() {

                album.removeClass('no-js');

                if (album.hasClass('vls-gf-album-metro')) {
                    layoutType = 'metro';
                    $(window).on('resize.vls-gf-' + albumId, updateLayout);
                }

                if (album.hasClass('vls-gf-paginated-paged-numbers')) {
                    paginationType = 'numbers';
                } else if (album.hasClass('vls-gf-paginated-paged-bullets')) {
                    paginationType = 'bullets';
                } else if (album.hasClass('vls-gf-paginated-load-more')) {
                    paginationType = 'load-more';
                } else if (album.hasClass('vls-gf-paginated-load-scroll')) {
                    paginationType = 'load-scroll';
                }

                if (paginationType != 'none') {
                    paginationControl = $('<div />').addClass('vls-gf-pagination-control').appendTo(album);
                }

                if (totalPages > 1) {
                    if (paginationType == 'numbers' || paginationType == 'bullets') {
                        renderPaginationControls();
                    } else if (paginationType == 'load-more') {
                        initLoadMore();
                    }
                    else if (paginationType == 'load-scroll') {
                        initLoadScroll();
                    }
                }

                updateLayout();
            }

            /**
             * Updates layout for the albums
             */
            function updateLayout() {
                if (layoutType == 'metro') {
                    updateLayoutMetro(true);
                }
            }


            /**
             * Updates Metro layout
             * @param firstPass
             */
            function updateLayoutMetro(firstPass) {

                if ($(window).width() <= 640) {
                    album.find('.vls-gf-thumbnail-container').css('height', '');
                    return true;
                }

                var aspectRatio = album.data('vlsGfAspectRatio'),
                    hSpacing = album.data('vlsGfHorizontalSpacing'),
                    vSpacing = album.data('vlsGfVerticalSpacing'),
                    columnCount = album.data('vlsGfColumnCount'),
                    containerWidth = Math.floor(album[0].getBoundingClientRect().width), //manually rounding actual size down to be on the safe side
                    colWidths = [],
                    rowHeight = 0,
                    containerHeight,
                    firstRowOffset = -1,
                    lastRow = 0;

                //calculating row widths
                var totWidth = containerWidth - hSpacing * (columnCount - 1);  //total width of row items without spacings
                var baseWidth = Math.floor(totWidth / columnCount);
                var extraPixels = totWidth - baseWidth * columnCount;

                for (var a = 0; a < columnCount; a++) {
                    colWidths[a] = baseWidth;
                    if (extraPixels > 0) {
                        colWidths[a]++;
                        extraPixels--;
                    }

                }

                //calculating row height
                rowHeight = Math.round(baseWidth / aspectRatio);

                //processing items
                album.find('.vls-gf-page:not(".vls-gf-hidden") .vls-gf-item').each(function () {

                    var item = $(this),
                        imageAspect = item.data('vlsGfImageAspect'),
                        metroWidth = item.data('vlsGfWidth'),
                        metroHeight = item.data('vlsGfHeight'),
                        col = item.data('vlsGfCol'),
                        row = item.data('vlsGfRow'),
                        width = 0,
                        height = 0,
                        left = 0,
                        top = 0;

                    //if first pages are not visible, set the starting offset
                    if (firstRowOffset < 0) {
                        firstRowOffset = row;
                    }

                    var visibleRow = row - firstRowOffset;

                    //calculating width
                    for (a = col; a < col + metroWidth; a++) {
                        width += colWidths[a];
                    }
                    width += hSpacing * (metroWidth - 1);

                    //calculating height
                    height = rowHeight * metroHeight + vSpacing * (metroHeight - 1);

                    for (a = 0; a < col; a++) {
                        left += colWidths[a];
                    }
                    left += hSpacing * col;

                    top = rowHeight * visibleRow + vSpacing * visibleRow;

                    //positioning item
                    item.css({
                        width: width,
                        height: height,
                        left: left,
                        top: top
                    });

                    //calculating aspect-related class (for proper image scaling)
                    if (width / height > imageAspect) {
                        item.find('img').removeClass('vls-gf-wide').addClass('vls-gf-tall');
                    } else {
                        item.find('img').removeClass('vls-gf-tall').addClass('vls-gf-wide');
                    }

                    if (lastRow < visibleRow + metroHeight - 1) {
                        lastRow = visibleRow + metroHeight - 1;
                    }

                });

                containerHeight = rowHeight * (lastRow + 1) + vSpacing * lastRow;

                album.find('.vls-gf-thumbnail-container').css('height', containerHeight + 'px');

                //if update affects container width (due to scroll bar show/hide), then update again. Restricted to one update to avoid endless cycle in certain situations.
                if (firstPass && containerWidth != parseInt(album.width())) {
                    updateLayoutMetro(false);
                }

            }


            //region pagination functions

            /**
             * Initializes load more button
             */
            function initLoadMore() {
                if (paginationType != 'load-more') return;

                loadMoreButton = $('<button />').text(vls_gf_script_l10n.btnTextLoadMore).appendTo(paginationControl);
                loadMoreButton.on('click.vls-gf', doLoadMore);
                $('<span/>').appendTo(paginationControl);
            }

            /**
             * Initializes load on scroll
             */
            function initLoadScroll() {

                if (paginationType != 'load-scroll') return;

                $('<span/>').appendTo(paginationControl);
                $(window).on('scroll.vls-gf-' + albumId, loadOnScroll);

                //if content height is less than window height, try loading the next page
                loadOnScroll();

            }

            /**
             * Renders pagination controls (numbers or bullets)
             */
            function renderPaginationControls() {

                if (paginationType != 'numbers' && paginationType != 'bullets') return;

                var elements = [],
                    numbers = [],
                    a;

                // total page count is under 7, so no truncation needed
                if (totalPages <= 7 || (paginationType == 'bullets')) {
                    for (a = 1; a <= totalPages; a++) {
                        numbers.push(a);
                    }
                    // current page is at the beginning, so truncating only the right side
                } else if (currentPage <= 3) {
                    for (a = 1; a <= 5; a++) {
                        numbers.push(a);
                    }
                    numbers.push(0);
                    numbers.push(totalPages);
                    // current page is at the end, so truncating only the left side
                } else if (currentPage > totalPages - 3) {
                    numbers.push(1);
                    numbers.push(0);
                    for (a = totalPages - 4; a <= totalPages; a++) {
                        numbers.push(a);
                    }
                    //truncating both sides
                } else {
                    numbers.push(1);
                    numbers.push(0);
                    for (a = currentPage - 1; a <= currentPage + 1; a++) {
                        numbers.push(a);
                    }
                    numbers.push(0);
                    numbers.push(totalPages);
                }

                //prev
                if (paginationType == 'numbers') {
                    el = $('<a/>', {
                        text: '<<'
                    });
                    if (currentPage > 1) {
                        el.attr('href', '#page/' + (currentPage - 1));
                        el.on('click.vls-gf', function () {
                            var pageNo = parseInt($(this).attr('href').replace('#page/', ''));
                            switchToPage(pageNo);
                            return false;
                        });
                    } else {
                        el.addClass('vls-gf-disabled');
                    }
                    elements.push(el);
                }


                for (a = 0; a < numbers.length; a++) {


                    var el,
                        number = numbers[a];

                    // hiding some pages under ellipsis
                    if (number == 0) {
                        el = $('<span />', {text: '...'});
                        elements.push(el);
                    } else { //adding a page button

                        el = $('<a/>', {
                            href: '#page/' + number,
                            text: paginationType == 'numbers' ? number : ''
                        });
                        if (number == currentPage) el.addClass('vls-gf-active');

                        el.on('click.vls-gf', function (e) {
                            var pageNo = parseInt($(this).attr('href').replace('#page/', ''));
                            switchToPage(pageNo);
                            e.preventDefault();
                            return false;
                        });
                        elements.push(el);
                    }

                }

                //next
                if (paginationType == 'numbers') {
                    el = $('<a/>', {
                        text: '>>'
                    });
                    if (currentPage < totalPages) {
                        el.attr('href', '#page/' + (currentPage + 1));
                        el.on('click.vls-gf', function () {
                            var pageNo = parseInt($(this).attr('href').replace('#page/', ''));
                            switchToPage(pageNo);
                            return false;
                        });
                    } else {
                        el.addClass('vls-gf-disabled');
                    }
                    elements.push(el);
                }

                paginationControl.empty().append(elements);
            }


            /**
             * Switches to the specific page
             * @param pageNo: number of the page to switch to
             */
            function switchToPage(pageNo) {

                //scrollPosition = $(window).scrollTop();
                currentPage = pageNo;
                renderPaginationControls();

                var page = album.find('.vls-gf-page[data-vls-gf-page-no="' + pageNo + '"]');

                //if page already loaded, just show it
                if (page.length > 0) {

                    showSwitchedPage(page);

                    // else load the page and show it
                } else {

                    $.get(
                        vls_gf_script_l10n.ajaxurl,
                        {
                            action: 'vls_gf_get_album_page',
                            album_id: albumId,
                            page_no: pageNo
                        },
                        function (data) {

                            album.find('.vls-gf-thumbnail-container').append(data);

                            var page = album.find('.vls-gf-page:last');

                            showSwitchedPage(page);

                            if ($().vlsGfLazyload) {
                                page.find('img[data-original]').vlsGfLazyload({
                                    threshold: 100,
                                    effect: 'fadeIn'
                                });
                            }

                        },
                        'html'
                    );
                }
            }

            function showSwitchedPage(page) {

                //first showing the new page, then hiding old one
                page.removeClass('vls-gf-hidden');
                var pageNo = page.data('vlsGfPageNo');

                album.find('.vls-gf-page').each(function () {
                    var $this = $(this);
                    if ($this.data('vlsGfPageNo') != pageNo) {
                        $this.addClass('vls-gf-hidden');
                    }
                });

                updateLayout();

                scrollToPage(page);

                //re-init lightbox (imagelightbox only is supported)
                var lightbox = page.closest('.vls-gf-album').data('vlsGfLightbox');
                if (lightbox && typeof lightbox.updateTargets === "function") {
                    lightbox.updateTargets(page, false);
                }

            }

            /**
             * Loads the next page and appends it to the bottom of the album
             */
            function doLoadMore() {

                if (isBusy) return false;

                isBusy = true;
                paginationControl.addClass('vls-gf-busy');

                currentPage++;

                var page = album.find('.vls-gf-page[data-vls-gf-page-no="' + currentPage + '"]');

                //if page already loaded, just show it
                if (page.length > 0) {

                    showAppendedPage(page);

                    isBusy = false;
                    paginationControl.removeClass('vls-gf-busy');

                    if (currentPage >= totalPages) {
                        $(window).off('scroll.vls-gf-' + albumId);
                        paginationControl.remove();
                    }

                    // else load the page and show it
                } else {

                    $.get(
                        vls_gf_script_l10n.ajaxurl,
                        {
                            action: 'vls_gf_get_album_page',
                            album_id: albumId,
                            page_no: currentPage
                        },
                        function (data) {

                            album.find('.vls-gf-thumbnail-container').append(data);

                            var page = album.find('.vls-gf-page:last');

                            showAppendedPage(page);

                            if ($().vlsGfLazyload) {
                                page.find('img[data-original]').vlsGfLazyload({
                                    threshold: 100,
                                    effect: 'fadeIn'
                                });
                            }

                            isBusy = false;
                            paginationControl.removeClass('vls-gf-busy');

                            if (currentPage >= totalPages) {
                                $(window).off('scroll.vls-gf-' + albumId);
                                paginationControl.remove();
                            }

                        },
                        'html'
                    );
                }

                return false;
            }

            function loadOnScroll() {

                if (isBusy) return;

                var $window = $(window),
                    curScroll = $window.scrollTop() + $window.height(),
                    loadMorePosition = paginationControl.offset().top;

                //if scrolled to the bottom of the album, load the next page
                if (curScroll > loadMorePosition) {

                    doLoadMore();

                }

            }

            function showAppendedPage(page) {

                page.removeClass('vls-gf-hidden');

                updateLayout();

                //re-init lightboxes
                var lightbox = page.closest('.vls-gf-album').data('vlsGfLightbox');
                if (lightbox && typeof lightbox.updateTargets === "function") {
                    lightbox.updateTargets(page, true);
                }

                //could be cleaner: trigger scroll event to initiate lazy loading new page's thumbs
                $(window).trigger('scroll.vls-gf-lazyload');

            }

            /**
             * if the album's top is above the top of the screen, scroll to it
             * @param page
             * @returns {boolean}
             */
            function scrollToPage(page) {

                var topOffsetScreen = 80, //set this to change offset from the top of a viewport to the top of a gallery
                    topOffsetMobile = 4,
                    curScroll = Math.floor($(window).scrollTop()),
                    pageTop = page.closest('.vls-gf-thumbnail-container').offset().top;

                if (curScroll > pageTop) {

                    var topOffset = topOffsetScreen;
                    if ($(window).width() <= 640) {
                        topOffset = topOffsetMobile;
                    }

                    //no animation
                    $('html,body').scrollTop(pageTop - topOffset);
                    //animated scroll
                    //$('html,body').animate({scrollTop: pageTop - topOffset}, 600, 'swing');
                }

            }

            init();

            return {
                updateLayout: updateLayout
            }

        }

        init();


        return this;

    };

    //activating on document ready
    $(document).ready(function () {
        $('.vls-gf-album').vlsGfAlbum();
    });

})(jQuery, window, document);



   