<?php

namespace SantiMilos\CrudPackage\Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use SantiMilos\CrudPackage\Tests\TestCase;

class MakeFooCommandTest extends TestCase
{
    /** @test */
    function it_creates_a_new_foo_class()
    {
        // Run the make command
        Artisan::call('make:crud Prueba');

    }
}
