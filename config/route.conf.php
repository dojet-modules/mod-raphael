<?php

Dispatcher::loadNamespaceRoute('\Mod\Raphael\\',
    array(
        '/^raphael\/thumb\/(?<width>\d+)x(?<height>\d+)\/[0-9a-fA-F]{2}\/(?<hash>[a-fA-F0-9]{32})$/' => 'ImageThumbAction',
    )
);
