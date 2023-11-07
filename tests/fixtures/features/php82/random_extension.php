<?php
class MyRandom extends \Random\Randomizer {
    protected Random\Engine\Mt19937 $propertyA;
    protected Random\Engine\PcgOneseq128XslRr64 $propertyB;
    protected Random\Engine\Xoshiro256StarStar $propertyC;

    public function foo(): \Random\Engine\Secure {
        try {
        } catch( Random\RandomError | Random\BrokenRandomEngineError ) {
        } catch( Random\RandomException $e ) {
        }
    }
}
