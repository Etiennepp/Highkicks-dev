<link rel="stylesheet" type="text/css" href="inscription/fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="inscription/css/normalize.css" />

	<link rel="stylesheet" type="text/css" href="inscription/fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="inscription/css/demo.css" />

<footer style="width: 100%; display: flex; justify-content: space-around; background-color: rgba(63, 63, 63,0.4); position:absolute;bottom:0px;"> 
	<div class="div-foot">
		<h4>NAVIGATION</h4>

		<div><a href="https://highkicks.fr/panier/" class="foot-nav-link">Panier<div id="nb_article"></div></a></div>

		<div><a href="https://highkicks.fr/" class="foot-nav-link">Accueil</a></div>
			
		<div><a href="https://highkicks.fr/boutique/" class="foot-nav-link">Boutique</a></div>

		<div><a href="https://highkicks.fr/marketplace/" class="foot-nav-link">Marketplace</a></div>
		
		
	</div>
	<div class="div-foot">
		<h4>CONTACT</h4>

		<div><a onclick="copyToClipboard('#copy-text')"  class="foot-nav-link" id="copy-text">contact@highkicks.fr</a></div>
		
		<div><a href="https://twitter.com/highkicksfr" class="foot-nav-link">Twitter</a></div>

		<div><a href="https://www.instagram.com/highkicksfr/" class="foot-nav-link">Instagram</a></div>
		
	</div>

	<div class="div-foot">
	<br/>
	<div><a href="https://highkicks.fr/" class="foot-nav-link">Mention legal</a> | <a href="https://highkicks.fr/" class="foot-nav-link">Condition d'utilisation</a> </div>
	<br/><br/>
	<div><a href="https://twitter.com/highlinepixel/" class="foot-nav-link">Created <?php echo( crypt("/xD7è*6?\..%")); ?>by HighLine Pixel</a> </div>
	<br/>
	<div id="copyright"><a class="foot-nav-link">© HIGHKICKS, HIGHLINE PIXEL, 2018</a> </div>
	</div>
</footer>


	

<script>
	function copyToClipboard(element) {

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
 

}
</script>

