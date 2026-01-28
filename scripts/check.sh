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

echo "======================================="
echo "Version check completed."
echo "======================================="


# =========================================
# Composer installation (always fresh)
# =========================================
install_composer() {
    echo "======================================="
    echo "Downloading and installing Composer..."
    echo "======================================="

    # Download installer
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

    # Install globally if possible, otherwise locally
    if [ -w "/usr/local/bin" ]; then
        php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    else
        echo "No write access to /usr/local/bin, installing to current directory..."
        php composer-setup.php --install-dir=. --filename=composer
    fi

    # Remove installer
    rm -f composer-setup.php

    # Show version
    if command -v composer >/dev/null 2>&1; then
        echo "Composer installed successfully: $(composer --version)"
    else
        echo "Composer installed in current directory: ./composer"
        ./composer --version
    fi

    echo "======================================="
    echo "Composer installation completed."
    echo "======================================="
}

# Run Composer installation
install_composer
