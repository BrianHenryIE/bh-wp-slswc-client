#!/bin/bash

# Script which runs outside Docker

# Print the script name.
echo $(basename "$0")

# This presumes the current working directory is the project root and the directory name matches the plugin slug.
PLUGIN_SLUG=$(basename $PWD)
echo "Building $PLUGIN_SLUG"

# Build the plugin
#vendor/bin/wp i18n make-pot src languages/$PLUGIN_SLUG.pot --domain=$PLUGIN_SLUG
#vendor/bin/wp dist-archive . ./tests/e2e-pw/setup --plugin-dirname=$PLUGIN_SLUG --filename-format="{name}.latest"

# Run the internal scripts which configure the environments:
# First the script that is common to both environments:
echo "run npx wp-env run cli ./setup/initialize-internal.sh $PLUGIN_SLUG;"
npx wp-env run cli ./setup/initialize-internal.sh $PLUGIN_SLUG;
echo "run npx wp-env run tests-cli ./setup/initialize-internal.sh $PLUGIN_SLUG;"
npx wp-env run tests-cli ./setup/initialize-internal.sh $PLUGIN_SLUG;

# The the scripts individual to each:
echo "run npx wp-env run cli ./setup/initialize-internal-dev.sh $PLUGIN_SLUG;"
npx wp-env run cli ./setup/initialize-internal-dev.sh $PLUGIN_SLUG;

echo "run npx wp-env run tests-cli ./setup/initialize-internal-tests.sh $PLUGIN_SLUG;"
npx wp-env run tests-cli ./setup/initialize-internal-tests.sh $PLUGIN_SLUG;



TEST_DB_PORT=$(docker ps -f ancestor=mariadb:lts -f name=tests-mysql --format='{{.Ports}}' | sed -E 's/.*:(.*)->.*/\1/')
find . -depth \( -name '.env.testing' \) -exec sed -i '' "s/TEST_DB_PORT=\".*\"/TEST_DB_PORT=\"$TEST_DB_PORT\"/g" {} +
echo "Updated .env.testing with TEST_DB_PORT=\"$TEST_DB_PORT\"";
