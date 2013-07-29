<?php
    new ezcGraphLinearGradient(
        $this->get3dCoordinate( new ezcGraphCoordinate( $barCoordinateArray['x'][2], $topLocation ), $midDepth ),
        $this->get3dCoordinate( new ezcGraphCoordinate( $barCoordinateArray['x'][0], $topLocation ), $midDepth ),
        ezcGraphColor::fromHex( '#FFFFFFFF' ),
        ezcGraphColor::fromHex( '#FFFFFF' )->transparent( 1 - $this->options->barChartGleam )
    );
