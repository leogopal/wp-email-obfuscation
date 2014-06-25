<?php 

// If this file is called directly, abort.
// if ( ! defined( 'WPINC' ) ) {
//   die('Nice Try!');
// }
     function hex_encode($baseString) {
            $chars = str_split($baseString);
            $seed = mt_rand(0, (int) abs(crc32($baseString) / strlen($baseString)));

            foreach ($chars as $key => $char) {

              $ord = ord($char);

              if ($ord < 128) { // ignore non-ascii chars

                $r = ($seed * (1 + $key)) % 100; // pseudo "random function"

                if ($r > 60 && $char != '@') ; // plain character (not encoded), if not @-sign
                else if ($r < 45) $chars[$key] = '&#x'.dechex($ord).';'; // hexadecimal
                else $chars[$key] = '&#'.$ord.';'; // decimal (ascii)

              }

            }
            return implode('', $chars);
          }

      function reversed_encode($rev_enc) {
        return hex_encode(strrev($rev_enc));
      }
    
     function rot13_encode_mailto($the_email, $the_text = null, $email_class) {

        //$encryptedEmail = addslashes(str_rot13('<a href="mailto:' . $the_email . '" rel="nofollow">' . ($the_text ? : $the_email) . '</a>'));
        $applyROT = str_replace("/","\\057", str_replace('"', '\\"', str_replace(".", "\\056", str_replace("@", "\\100", str_rot13( $the_email )))));
        $ROTwMailto = 
        str_replace("/","\\057", 
          str_replace('"', '\\"', 
            str_replace(".", "\\056", 
              str_replace("@", "\\100", 
                str_replace(":", "\\072",
                  str_replace("=", "\\075",
                    str_rot13( '<a class="enc-mail ' . ($email_class ? : '') . '" href="mailto:' . $the_email . '" rel="nofollow">' . ($the_text ? : $the_email) . '</a>' )))))));
           return '
           <script type="text/javascript">
           /* <![CDATA[ */
           erosROT13.writeROT13("' . $ROTwMailto . '");
           /* ]]-> */
           </script>
           <noscript>
           <span style="unicode-bidi:bidi-override; direction:rtl;">' . reversed_encode($the_email) . '</span>
           </noscript>
           ';
      }

      function rot13_encode_plaintext($the_email) {

        $revenc_email = hex_encode(strrev($the_email));

        $ROTplaintext = 
        str_replace("/","\\057", 
          str_replace('"', '\\"', 
            str_replace(".", "\\056", 
              str_replace("@", "\\100", 
                str_replace(":", "\\072",
                  str_replace("=", "\\075",
                    str_rot13( $the_email )))))));
           return '
           <script type="text/javascript">
           /* <![CDATA[ */
           erosROT13.writeROT13("' . $ROTplaintext . '");
           /* ]]-> */
           </script>
           <noscript>
           <span style="unicode-bidi: bidi-override; direction: rtl;">' . reversed_encode($the_email) . '</span>
           </noscript>
           ';
      }



        function erosenc_register_scripts() {

          wp_register_script( 'obfuscript', EROS_ENCODER_URL . 'obfuscript.js' );
          wp_register_style( 'obfustyle', EROS_ENCODER_URL . 'style.css' );
          wp_enqueue_script( 'obfuscript' );
          wp_enqueue_style( 'obfustyle' );

        }

        add_action('wp_enqueue_scripts', 'erosenc_register_scripts');

  