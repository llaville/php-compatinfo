<?php

if (function_exists('idn_to_ascii')) {
    if (defined('INTL_IDNA_VARIANT_UTS46')) {
        $domain = idn_to_ascii($domain, 0, INTL_IDNA_VARIANT_UTS46);
    } else {
        $domain = idn_to_ascii($domain);
    }
}
