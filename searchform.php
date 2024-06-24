<form action="<?php bloginfo("url"); ?>" method="get" id="search" class="form-inline transition">
	<input class="search-bar transition" type="search" value="<?php (isset($_GET["s"]) ? _e($_GET["s"]) : ""); ?>" type="search" name="s" autocomplete="off" placeholder="Search">
	<button class="transition search-submit" type="submit">Search</button>
</form>