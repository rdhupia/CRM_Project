<?php
class Footer
{
	public static function write(){
		$instance = new self();
		$instance->writeFooter();
	}
	public function writeFooter()
	{
		?>
							<!-- FOOTER -->
							<footer class="footer-basic-centered">

								<p class="footer-company-motto">Most Recommanded National Dealer</p>
								<p class="footer-company-name">WorldComm CT. &copy; 2015-2016</p>

							</footer>
							<!-- /FOOTER -->

							<!-- BOOTSTRAP: Latest compiled and minified JavaScript -->
							<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
							<script src="../js/bootstrap.min.js"></script>
							
							<script type='text/javascript'>
							
								(function($){
									$(document).ready(function(){
										$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
											event.preventDefault(); 
											event.stopPropagation(); 
											$(this).parent().siblings().removeClass('open');
											$(this).parent().toggleClass('open');
										});
									});
								})(jQuery);
										
							</script>
							
							<!-- Initializing tooltips -->
							<script>
							$(document).ready(function(){
								$('[data-toggle="tooltip"]').tooltip(); 
							});
							</script>
							
						</body>
					</html>

		<?php
	}
}
?>