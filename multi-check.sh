#!/bin/bash
set -e

# =========================================
# Multi-Version Environment Checker
# =========================================

echo "======================================="
echo "      Multi-Version Environment Check"
echo "======================================="
echo ""

# --- Function to check a command and print version ---
check_version() {
    local cmd_name=$1
    local version_cmd=$2

    echo "Checking $cmd_name..."
    if command -v "$cmd_name" &> /dev/null; then
        local version=$($version_cmd 2>&1 | head -n1)
        echo "$cmd_name is installed: $version"
    else
        echo "$cmd_name is NOT installed."
    fi
    echo "---------------------------------------"
}

# =========================================
# Begin checks
# =========================================

# Node.js
check_version "node" "node -v"

# npm
check_version "npm" "npm -v"

# PHP
check_version "php" "php -v"

# Git
check_version "git" "git --version"

# MySQL
check_version "mysql" "mysql --version"

# =========================================
# Additional checks
# =========================================

echo ""
echo "Checking additional environment details..."

# OS info
echo "Operating System:"
uname -a || echo "Unable to detect OS"
echo "---------------------------------------"

# Current user
echo "Current User:"
whoami || echo "Unable to detect current user"
echo "---------------------------------------"

# Home directory
echo "Home Directory:"
echo "$HOME"
echo "---------------------------------------"

# PATH directories
echo "PATH directories:"
echo $PATH | tr ':' '\n'
echo "---------------------------------------"

# Disk usage
echo "Disk usage for current directory:"
df -h .
echo "---------------------------------------"

# Memory info (Linux/Mac)
echo "Memory info:"
if [ -f /proc/meminfo ]; then
    head -n 5 /proc/meminfo
else
    free -h 2>/dev/null || echo "Memory info not available"
fi
echo "---------------------------------------"

# =========================================
# Summary
# =========================================

echo ""
echo "======================================="
echo "      Multi-Version Check Completed"
echo "======================================="
