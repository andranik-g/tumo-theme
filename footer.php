		<footer itemscope itemtype="http://schema.org/WPFooter">
			<div class="footer">
				<div class="container">
					<div class="main-footer d-flex align-items-center justify-content-between">
						<div itemscope itemtype="http://schema.org/Organization" id="logo">
							<?php the_custom_logo(); ?>
						</div>
						<?php if (is_active_sidebar('footer-social-sidebar')) : ?>
							<div class="footer-social-sidebar">
								<?php dynamic_sidebar('footer-social-sidebar'); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="bottom-footer text-center border-top">
						Copyright &copy; <?php echo date("Y") . " " . get_bloginfo("name"); ?>. All Rights Reserved.
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
		</body>

		</html>