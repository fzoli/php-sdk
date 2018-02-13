# Install dependencies
./composer install

# Add dependency
./composer require `name`

# Run a unit test

./phpunit --bootstrap src/autoload.php tests/`ClassName`.php

# Run each unit test

./phpunit --bootstrap src/autoload.php tests