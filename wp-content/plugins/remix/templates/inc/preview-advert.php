		<div class="preview-advert">
							<?php
							$articles = get_articles(0, array($recent_post[0]->ID));
							$count = 0;
							//$articles = $get_the_articles; ?>
							<div class="col-md-3"><h4>TOP</h4></div>
							<div class="col-md-6">
								<div class="slot-section">
									<?php foreach ($articles as $article) { ?>
									<?php $count++; ?>
									<?php $cross = ($count == 4 ? "cross" : ""); ?>
									
									<div class="slot <?php echo $cross; ?>" data-pos="<?php echo $count; ?>"></div>
									
									<?php } ?>
								</div>
							</div>
							<div class="col-md-3"><h4 class="pos-number">0</h4></div>
						</div>