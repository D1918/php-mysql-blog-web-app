#!/bin/bash

set -e

echo "Watching SCSS files..."

SCSS_DIR="public/assets/scss"

while true; do
	inotifywait -r -e modify,create,delete "$SCSS_DIR"

	echo "Change detected → rebuilding CSS..."

	php scripts/build-assets.php
done
