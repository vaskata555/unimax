<?php
/*
 * Configure constants for Braintree's JavaScript Client SDKs, Server SDK, and Access Token for
 * Express Checkout via Braintree SDK
 */

// sandbox | production
define("ENVIRONMENT", 'sandbox');

define("ACCESS_TOKEN", 'access_token$sandbox$hb3cnvgktgqk7sd2$991604e5065f07afe106d0ead0686569');

define("BT_JAVASCRIPT_CLIENT", 'https://js.braintreegateway.com/web/3.30.0/js/client.min.js');
define("BT_JAVASCRIPT_PAYPAL", 'https://js.braintreegateway.com/web/3.30.0/js/paypal-checkout.min.js');
define("PP_CHECKOUT", 'https://www.paypalobjects.com/api/checkout.js');

define("BRAINTREE_PHP_SDK", 'braintree-php-3.30.0/lib/Braintree.php');
define("BRAINTREE_PHP_SDK1", '../braintree-php-3.30.0/lib/Braintree.php');
define("CHANNEL", 'PP-DemoPortal-EC_BT-php');
?>