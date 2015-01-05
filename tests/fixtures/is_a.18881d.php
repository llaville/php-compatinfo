<?php
class WidgetFactory
{
}

$WF = new WidgetFactory();

if (is_a($WF, 'WidgetFactory')) {
    echo "yes, \$WF is still a WidgetFactory\n";
}
