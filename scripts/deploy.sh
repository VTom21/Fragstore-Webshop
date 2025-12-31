#!/bin/bash
set -e

# =========================================
# Deployment Script for Windows Projects
# Installs Chocolatey, Node.js/npm, PHP, and project dependencies
# =========================================

echo "Starting deployment on Windows..."

# --- Prompt user for versions ---
read -p "Enter Node.js version to install (e.g., 20.4.0, leave blank for latest): " NODE_VERSION
read -p "Enter PHP version to install (e.g., 8.2, leave blank for latest): " PHP_VERSION

# =========================================
# Functions
# =========================================

# Install Chocolatey if missing
install_choco() {
    echo "Checking for Chocolatey..."
    if powershell -Command "Get-Command choco -ErrorAction SilentlyContinue" &> /dev/null; then
        echo "Chocolatey already installed."
    else
        echo "Chocolatey not found. Installing..."
        powershell -Command "
            Set-ExecutionPolicy Bypass -Scope Process -Force;
            [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072;
            iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
        " || { echo "Chocolatey installation failed!"; exit 1; }
        echo "Chocolatey installed successfully."
    fi
    echo "---------------------------------------"
}

# Install Node.js
install_node() {
    echo "Installing Node.js..."
    if [ -z "$NODE_VERSION" ]; then
        powershell -Command "choco install -y nodejs" \
            || { echo "Node.js installation failed!"; exit 1; }
        echo "Installed latest Node.js."
    else
        powershell -Command "choco install -y nodejs --version=$NODE_VERSION" \
            || { echo "Node.js installation failed!"; exit 1; }
        echo "Installed Node.js version $NODE_VERSION."
    fi
    echo "---------------------------------------"
}

# Install PHP
install_php() {
    echo "Installing PHP..."
    if [ -z "$PHP_VERSION" ]; then
        powershell -Command "choco install -y php" \
            || { echo "PHP installation failed!"; exit 1; }
        echo "Installed latest PHP."
    else
        powershell -Command "choco install -y php --version=$PHP_VERSION" \
            || { echo "PHP installation failed!"; exit 1; }
        echo "Installed PHP version $PHP_VERSION."
    fi
    echo "---------------------------------------"
}

# Install project dependencies
install_dependencies() {
    echo "Installing Node.js project dependencies..."
    npm install || { echo "npm install failed!"; exit 1; }
    echo "Dependencies installed successfully."
    echo "---------------------------------------"
}

# =========================================
# Main Execution
# =========================================

install_choco
install_node
install_php
install_dependencies

echo "Deployment completed successfully!"
