#!/usr/bin/env sh
set -e

echo "======================================="
echo "Checking installed versions"
echo "======================================="

# --- Check Node.js ---
if type node >/dev/null 2>&1; then
    NODE_VERSION=$(node -v)
    echo "Node.js is installed: $NODE_VERSION"
else
    echo "Node.js is NOT installed."
fi

# --- Check npm ---
if type npm >/dev/null 2>&1; then
    NPM_VERSION=$(npm -v)
    echo "npm is installed: $NPM_VERSION"
else
    echo "npm is NOT installed."
fi

# --- Check PHP ---
if type php >/dev/null 2>&1; then
    PHP_VERSION=$(php -v | head -n 1)
    echo "PHP is installed: $PHP_VERSION"
else
    echo "PHP is NOT installed."
fi

# --- Check Composer ---
if type composer >/dev/null 2>&1; then
    COMPOSER_VERSION=$(composer --version)
    echo "Composer is installed: $COMPOSER_VERSION"
else
    echo "Composer is NOT installed."
fi

echo "======================================="
echo "Version check completed."
echo "======================================="
