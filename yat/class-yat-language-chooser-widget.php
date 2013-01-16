<?php
/*  
    Copyright 2012  Alessandro Staniscia ( alessandro@staniscia.net )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('widgets_init', 'add_yat_google_language_widget');

function add_yat_google_language_widget() {
    register_widget('Yat_Language_Chooser_Widget');
}

if (!class_exists("Yat_Language_Chooser_Widget")) :

    class Yat_Language_Chooser_Widget extends WP_Widget {

        /**
         * il costruttore della classe
         */
        function Yat_Language_Chooser_Widget() {

            $widget_ops = array(
                'classname' => 'yatChooseLanguageGoogleTranslator',
                'description' => __('A widget that displays the chooser of Google Translator', 'A widget that displays the chooser of Google Translator')
            );

            $control_ops = array(
                'width' => 400,
                'height' => 450,
                'id_base' => 'yat-language-chooser-widget'
            );


            $this->WP_Widget(
                'yat-language-chooser-widget',
                __('YAT with gTranslator ', 'Language chooser for Google translator service'),
                $widget_ops,
                $control_ops
            );
        }

        /**
         * Il body del widget
         *
         * @param $args
         * @param $instance
         */
        function widget($args, $instance) {
            extract($args);

            $title = apply_filters('widget_title', $instance['title']);
            $pageLanguage = $instance['pageLanguage'];
            $multilanguagePage = $instance['multilanguagePage'];
            $gaTrack = $instance['gaTrack'];
            $gaId = $instance['gaId'];
            $displayBanner = $instance['displayBanner'];


            echo $before_widget;

            if ($title) {
                echo $before_title . $title . $after_title;
            }

?>
<div id="yat-google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement(
         {
           <?php if ( $gaTrack=='on' ): echo " gaTrack: true,gaId: '$gaId', "; endif;?>
           <?php if ( $multilanguagePage== 'on' ): echo " multilanguagePage: true, "; endif;?>
           <?php if ( $displayBanner == 'on' ): echo " autoDisplay: false, "; endif;?>
           pageLanguage: '<?php echo $pageLanguage; ?>'
         },
         'yat-google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<?php
            echo $after_widget;
        }



        /**
         * doUpdate the configuration of widget
         *
         * @param $new_instance
         * @param $old_instance
         * @return mixed
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            //Strip tags from title and name to remove HTML
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['pageLanguage']=strip_tags($new_instance['pageLanguage']);
            $instance['multilanguagePage']=strip_tags($new_instance['multilanguagePage']);
            $instance['gaTrack']=strip_tags($new_instance['gaTrack']);
            $instance['gaId']=strip_tags($new_instance['gaId']);
            $instance['displayBanner']==strip_tags($new_instance['displayBanner']);
            return $instance;
        }


        /**
         * Form per configurare le configurazione
         * @param $instance
         */
        function form($instance) {
            //Set up some default widget settings.
            $defaults = array(
                'title' => 'Translate',
                'pageLanguage' => 'it',
                'multilanguagePage' => '',
                'gaTrack' => '',
                'gaId' => '-',
                'displayBanner' => ''
            );

            $instance = wp_parse_args((array) $instance, $defaults);
            ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'example'); ?></label><br>
            <input required class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"  />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pageLanguage'); ?>"><?php _e('What is the original language of your website?', 'What is the original language of your website?'); ?></label><br>
            <select  name="<?php echo $this->get_field_name('pageLanguage'); ?>" id="<?php echo $this->get_field_id('pageLanguage'); ?>">
                <option value="af" id="yat-lang-af"><label for="yat-lang-af">afrikaans</label></option>
                <option value="sq" id="yat-lang-sq"><label for="yat-lang-sq">albanese</label></option>
                <option value="ar" id="yat-lang-ar"><label for="yat-lang-ar">arabo</label></option>
                <option value="hy" id="yat-lang-hy"><label for="yat-lang-hy">armeno</label></option>
                <option value="az" id="yat-lang-az"><label for="yat-lang-az">azerbaigiano</label></option>
                <option value="eu" id="yat-lang-eu"><label for="yat-lang-eu">basco</label></option>
                <option value="bn" id="yat-lang-bn"><label for="yat-lang-bn">bengalese</label></option>
                <option value="be" id="yat-lang-be"><label for="yat-lang-be">bielorusso</label></option>
                <option value="bg" id="yat-lang-bg"><label for="yat-lang-bg">bulgaro</label></option>
                <option value="ca" id="yat-lang-ca"><label for="yat-lang-ca">catalano</label></option>
                <option value="cs" id="yat-lang-cs"><label for="yat-lang-cs">ceco</label></option>
                <option value="zh-CN" id="yat-lang-zh-CN"><label for="yat-lang-zh-CN">cinese</label></option>
                <option value="zh-TW" id="yat-lang-zh-TW"><label for="yat-lang-zh-TW">cinese (han tradizionale)</label></option>
                <option value="ko" id="yat-lang-ko"><label for="yat-lang-ko">coreano</label></option>
                <option value="hr" id="yat-lang-hr"><label for="yat-lang-hr">croato</label></option>
                <option value="da" id="yat-lang-da"><label for="yat-lang-da">danese</label></option>
                <option value="iw" id="yat-lang-iw"><label for="yat-lang-iw">ebraico</label></option>
                <option value="eo" id="yat-lang-eo"><label for="yat-lang-eo">esperanto</label></option>
                <option value="et" id="yat-lang-et"><label for="yat-lang-et">estone</label></option>
                <option value="tl" id="yat-lang-tl"><label for="yat-lang-tl">filippino</label></option>
                <option value="fi" id="yat-lang-fi"><label for="yat-lang-fi">finlandese</label></option>
                <option value="fr" id="yat-lang-fr"><label for="yat-lang-fr">francese</label></option>
                <option value="gl" id="yat-lang-gl"><label for="yat-lang-gl">galiziano</label></option>
                <option value="cy" id="yat-lang-cy"><label for="yat-lang-cy">gallese</label></option>
                <option value="ka" id="yat-lang-ka"><label for="yat-lang-ka">georgiano</label></option>
                <option value="ja" id="yat-lang-ja"><label for="yat-lang-ja">giapponese</label></option>
                <option value="el" id="yat-lang-el"><label for="yat-lang-el">greco</label></option>
                <option value="gu" id="yat-lang-gu"><label for="yat-lang-gu">gujarati</label></option>
                <option value="ht" id="yat-lang-ht"><label for="yat-lang-ht">haitiano</label></option>
                <option value="hi" id="yat-lang-hi"><label for="yat-lang-hi">hindi</label></option>
                <option value="id" id="yat-lang-id"><label for="yat-lang-id">indonesiano</label></option>
                <option value="en" id="yat-lang-en"><label for="yat-lang-en">inglese</label></option>
                <option value="ga" id="yat-lang-ga"><label for="yat-lang-ga">irlandese</label></option>
                <option value="is" id="yat-lang-is"><label for="yat-lang-is">islandese</label></option>
                <option value="it" id="yat-lang-it"><label for="yat-lang-it">italiano</label></option>
                <option value="kn" id="yat-lang-kn"><label for="yat-lang-kn">kannada</label></option>
                <option value="lo" id="yat-lang-lo"><label for="yat-lang-lo">lao</label></option>
                <option value="la" id="yat-lang-la"><label for="yat-lang-la">latino</label></option>
                <option value="lv" id="yat-lang-lv"><label for="yat-lang-lv">lettone</label></option>
                <option value="lt" id="yat-lang-lt"><label for="yat-lang-lt">lituano</label></option>
                <option value="mk" id="yat-lang-mk"><label for="yat-lang-mk">macedone</label></option>
                <option value="ms" id="yat-lang-ms"><label for="yat-lang-ms">malese</label></option>
                <option value="mt" id="yat-lang-mt"><label for="yat-lang-mt">maltese</label></option>
                <option value="no" id="yat-lang-no"><label for="yat-lang-no">norvegese</label></option>
                <option value="nl" id="yat-lang-nl"><label for="yat-lang-nl">olandese</label></option>
                <option value="fa" id="yat-lang-fa"><label for="yat-lang-fa">persiano</label></option>
                <option value="pl" id="yat-lang-pl"><label for="yat-lang-pl">polacco</label></option>
                <option value="pt" id="yat-lang-pt"><label for="yat-lang-pt">portoghese</label></option>
                <option value="ro" id="yat-lang-ro"><label for="yat-lang-ro">rumeno</label></option>
                <option value="ru" id="yat-lang-ru"><label for="yat-lang-ru">russo</label></option>
                <option value="sr" id="yat-lang-sr"><label for="yat-lang-sr">serbo</label></option>
                <option value="sk" id="yat-lang-sk"><label for="yat-lang-sk">slovacco</label></option>
                <option value="sl" id="yat-lang-sl"><label for="yat-lang-sl">sloveno</label></option>
                <option value="es" id="yat-lang-es"><label for="yat-lang-es">spagnolo</label></option>
                <option value="sv" id="yat-lang-sv"><label for="yat-lang-sv">svedese</label></option>
                <option value="sw" id="yat-lang-sw"><label for="yat-lang-sw">swahili</label></option>
                <option value="ta" id="yat-lang-ta"><label for="yat-lang-ta">tamil</label></option>
                <option value="de" id="yat-lang-de"><label for="yat-lang-de">tedesco</label></option>
                <option value="te" id="yat-lang-te"><label for="yat-lang-te">telugu</label></option>
                <option value="th" id="yat-lang-th"><label for="yat-lang-th">thai</label></option>
                <option value="tr" id="yat-lang-tr"><label for="yat-lang-tr">turco</label></option>
                <option value="uk" id="yat-lang-uk"><label for="yat-lang-uk">ucraino</label></option>
                <option value="hu" id="yat-lang-hu"><label for="yat-lang-hu">ungherese</label></option>
                <option value="ur" id="yat-lang-ur"><label for="yat-lang-ur">urdu</label></option>
                <option value="vi" id="yat-lang-vi"><label for="yat-lang-vi">vietnamita</label></option>
                <option value="yi" id="yat-lang-yi"><label for="yat-lang-yi">yiddish</label></option>
            </select>
            <script type="text/javascript">document.getElementById('yat-lang-<?php echo  $instance['pageLanguage']; ?>').selected = "1"</script>
        </p>
       <p>
            <input type="checkbox"
                   id="<?php echo $this->get_field_id('multilanguagePage'); ?>"
                   name="<?php echo $this->get_field_name('multilanguagePage'); ?>"
                   <?php if ($instance['multilanguagePage']=='on'): echo "checked=\"checked\""; endif;?>
            />
            <label for="<?php echo $this->get_field_id('multilanguagePage'); ?>"><?php _e('Your page contains content in multiple languages.', 'Your page contains content in multiple languages.'); ?></label>
        </p>
        <p>
            <input type="checkbox"
                   id="<?php echo $this->get_field_id('displayBanner'); ?>"
                   name="<?php echo $this->get_field_name('displayBanner'); ?>"
                <?php if ($instance['displayBanner'] == 'on' ): echo "checked=\"checked\""; endif;?>
                    />
            <label for="<?php echo $this->get_field_id('displayBanner'); ?>"><?php _e('Automatically display translation banner to users speaking languages other than the language of your page.', 'Automatically display translation banner to users speaking languages other than the language of your page.'); ?></label>
        </p>
        <p>
            <input type="checkbox"
                   id="<?php echo $this->get_field_id('gaTrack'); ?>"
                   name="<?php echo $this->get_field_name('gaTrack'); ?>"
                   <?php if ($instance['gaTrack']=='on'): echo "checked=\"checked\""; endif;?>
            />
            <label for="<?php echo $this->get_field_id('gaTrack'); ?>"><?php _e('Track translation traffic using Google Analytics.', 'Track translation traffic using Google Analytics.'); ?></label><br/>
            <label for="<?php echo $this->get_field_id('gaId'); ?>"><?php _e('Paste your Analytics Web Property ID here:', 'example'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('gaId'); ?>" name="<?php echo $this->get_field_name('gaId'); ?>" value="<?php echo $instance['gaId']; ?>"  />
        </p>
        <pre><?php print_r($instance);?></pre>
        <?php
        }
    }

endif;