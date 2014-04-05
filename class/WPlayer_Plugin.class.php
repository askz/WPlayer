<?php

class WPlayer_Plugin
    {

        public function __construct()
        {
            $this->tools = new Wplayer_Tools();  
            add_action( 'admin_print_footer_scripts', array($this, 'embed_player_quicktag') );

        }

        public static function embed_player_quicktag() {

            if ( wp_script_is( 'quicktags' ) ) {
            ?>
            <script type="text/javascript">
            QTags.addButton( 'wplayer-post', '', '[WPlayer', ']', '', 'WPlayer', 22 );
            </script>
            <?php
            }

        }
        
        public static function activate()
        {
            
        } 
        public static function deactivate()
        {
            
        } 
    } 

?>