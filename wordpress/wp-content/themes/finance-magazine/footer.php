</div>
<?php $footer_widget_style = get_theme_mod('footerWidgetStyle',4); ?>
<!-- Footer-Start -->
<footer class="footer">
    <div class="container">
        <div class="footer-area">
            <div class="row">
            	<?php $k = 1; 
            	 for( $i=0; $i<$footer_widget_style; $i++) { ?>
	                    <?php if (is_active_sidebar('footer-'.$k)) { ?>
	                        <div class="col-md-3 col-sm-6 col-xs-12">
	                        	<?php dynamic_sidebar('footer-'.$k); ?>
	                        </div>
	                    <?php }
	                    $k++;
	             } ?>                
            </div>
        </div>
        <div class="sub-footer-area">
            <div class="row">
                <div class="col-sm-12">
                    <div class="copywrite-section">
                         <?php if(get_theme_mod('footerCopyright') != ""){ ?>
                            <p><?php echo wp_kses_post(get_theme_mod('footerCopyright')); ?></p>
                        <?php } 
                        esc_html_e('Theme : ','finance-magazine'); ?><a href="<?php echo esc_url('https://investorzone.in/wordpress-themes/finance-magazine/'); ?>"><?php esc_html_e('Finance Magazine WordPress Theme','finance-magazine'); ?></a>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer-End -->

<?php wp_footer(); ?>
</body>
</html>