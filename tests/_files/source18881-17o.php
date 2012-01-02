<?php
class WidgetFactory
{
}

$WF = new WidgetFactory();

if (is_a($WF, 'WidgetFactory', true)) {
    echo "yes, \$WF is still a WidgetFactory\n";
}
