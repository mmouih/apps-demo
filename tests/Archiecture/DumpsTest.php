<?php

arch('Do not forget dumps in your production code')
    ->expect(['dd', 'dump', 'exit', 'die', 'print_r', 'var_dump', 'echo', 'print'])
    ->not
    ->toBeUsed();
