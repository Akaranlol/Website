<form method="get" id="searchform" action="<?php bloginfo('home'); ?>">

<input type="text" class="searching" value="<?php _e('search...', 'theme1885'); ?>" onfocus="if(this.value=='<?php _e('search...', 'theme1885'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('search...', 'theme1885'); ?>'}" name="s" id="s" /><input class="submit" type="submit" value="<?php _e('Go', 'theme1885'); ?>" />

</form>
