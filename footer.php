<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
	</div>
	<!-- end content-box -->
	
	<!-- footer-box -->
	<div class="footer-box cf">
	  <?php dynamic_sidebar( 'Homepage Footer' ); ?>		
	</div>
	<!-- end footer-box -->
	
	<!-- copyright-box -->
	<div class="copyright-box cf">
	  <div class="left">
	    <p>Copyright &copy; Core Fitness of Myrtle Beach 2012. All Rights Reserved.</p>
	  </div>
	  
	  <div class="right">
	    <p>Design and Development by <a href="http://www.inkhaus.com" target="_blank">INKHAUS</a></p>
	  </div>	
	</div>
	<!-- end copyright-box -->
  </div>
</div>
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery('div.menu-box ul li:first-child').addClass('home');
jQuery('div.menu-box ul li:last-child').addClass('yellow');
jQuery('div.entry-page td:last-child').addClass('last');
jQuery('div.entry-page th:last-child').addClass('last');
jQuery('ul.group-excercise-list li:first-child').addClass('first');
</script>
</body>
</html>
