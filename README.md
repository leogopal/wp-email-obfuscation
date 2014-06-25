WordPress Email Obfuscation PHP Functions
====================

[WordPress] Email Obfuscation PHP Functions using ROT13 and Hex Encoding in PHP and Javascript, Add to Any WordPress project to protect emails.

## Usage

Place all of these files in a folder of your choosing in your project, make sure you require_once in your main functions file to call it.

```
      require_once( '/encode-init.php' );
```

### Use with mailto link

```
  rot13_encode_mailto($the_email, $anchor_text, $email_class);
```

This function will out put an obfuscated clickable email address, accepts anchor text (will default to email address as anchor) and will also take an email class for styling.

### Use as plaintext

```
  rot13_encode_plaintext($the_email);
```

This accepts just an email address, outputs an obfuscated email in the code and a human readable as output. Do not encase in html wrappers (outputs javascript for obfuscation, does not play well with links)

## Improve

Feel free to improve on this effort via pull requests and suggestions.
