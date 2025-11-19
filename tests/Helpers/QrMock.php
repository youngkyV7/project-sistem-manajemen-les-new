<?php

namespace Tests\Helpers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrMock
{
    public static function fake($return = 'PNG_DUMMY')
    {
        QrCode::shouldReceive('format')->andReturnSelf();
        QrCode::shouldReceive('size')->andReturnSelf();
        QrCode::shouldReceive('margin')->andReturnSelf();
        QrCode::shouldReceive('errorCorrection')->andReturnSelf();
        QrCode::shouldReceive('generate')->andReturn($return);
    }
}
