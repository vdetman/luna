<?php

use Illuminate\Support\Facades\App;

function isProduction(): bool
{
    return App::environment('production');
}
