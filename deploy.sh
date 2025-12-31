#!/usr/bin/env sh
set -e

# =========================================
# Pure Shell Deployment Script (Windows/WSL-friendly)
# Guides installation of Node.js, PHP, npm, and project dependencies
# =========================================

echo "======================================="
echo "Starting deployment..."
echo "======================================="

# --- Prompt user for versions ---
read -p "Enter Node.js version to install (e.g., 20.4.0, leave blank for latest): " NODE_VERSION
read -p "Enter PHP version to install (e.g., 8.2, leave blank for latest): " PHP_VERSION

# --- Function to check if a command exists ---
command_exists() {
    command -v "$1" &> /dev/null
}

# --- Function to check Node.js ---
check_node() {
    if command_exists node; then
        echo "Node.js is installed: $(node -v)"
    else
        echo "Node.js is NOT installed."
        echo "Please install Node.js manually from https://nodejs.org/"
    fi
    echo "---------------------------------------"
}

# --- Function to check npm ---
check_npm() {
    if command_exists npm; then
        echo "npm is installed: $(npm -v)"
    else
        echo "npm is NOT installed."
        echo "npm comes with Node.js. Install Node.js first."
    fi
    echo "---------------------------------------"
}

# --- Function to check PHP ---
check_php() {
    if command_exists php; then
        echo "PHP is installed: $(php -v | head -n1)"
    else
        echo "PHP is NOT installed."
        echo "Please install PHP manually from https://windows.php.net/download/"
    fi
    echo "---------------------------------------"
}

# --- Function to install project dependencies ---
install_dependencies() {
    if command_exists npm; then
        echo "Installing Node.js project dependencies..."
        npm install || { echo "npm install failed!"; exit 1; }
        echo "Dependencies installed successfully."
    else
        echo "npm not found. Skipping project dependencies installation."
    fi
    echo "---------------------------------------"
}

# =========================================
# Main Execution
# =========================================

check_node
check_npm
check_php
install_dependencies

echo "======================================="
echo "Deployment guidance completed!"
echo "Please follow instructions above for missing tools."
echo "======================================="



