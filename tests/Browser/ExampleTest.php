<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/test')
                ->type('name', 'Mwanga')
                ->press('Submit')
                ->assertSee('You typed Mwanga');
        });
    }

    /**
     *@test
     **/
    public function testHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Laravel')
                ->assertSee('LARACASTS');
        });
    }
}
