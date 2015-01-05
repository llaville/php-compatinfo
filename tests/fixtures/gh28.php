<?php

throw new XML_XRD_Exception(
    'Error loading XML file: ' . libxml_get_last_error()->message,
    XML_XRD_Exception::LOAD_XML
);
