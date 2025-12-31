#!/bin/bash
set -e

# =========================================
# Multi-Version Environment Checker (Pure Shell)
# =========================================

echo "======================================="
echo "      Multi-Version Environment Check"
echo "======================================="
echo ""

# --- Function to check a command and print version ---
check_version() {
    cmd_name="$1"
    version_cmd="$2"

    echo "Checking $cmd_name..."
    if type "$cmd_name" >/dev/null 2>&1; then
        version=$($version_cmd 2>&1 | sed -n 1p)
        echo "$cmd_name is installed: $version"
    else
        echo "$cmd_name is NOT installed."
    fi
    echo "---------------------------------------"
}

# =========================================
# Begin checks
# =========================================

check_version "node" "node -v"
check_version "npm" "npm -v"
check_version "php" "php -v"
check_version "git" "git --version"
check_version "mysql" "mysql --version"

# =========================================
# Additional environment details
# =========================================

echo ""
echo "Checking additional environment details..."

# OS info
echo "Operating System:"
uname -a 2>/dev/null || echo "Unable to detect OS"
echo "---------------------------------------"

# Current user
echo "Current User:"
whoami 2>/dev/null || echo "Unable to detect current user"
echo "---------------------------------------"

# Home directory
echo "Home Directory:"
echo "$HOME"
echo "---------------------------------------"

# PATH directories
echo "PATH directories:"
echo "$PATH" | tr ':' '\n'
echo "---------------------------------------"

# Disk usage
echo "Disk usage for current directory:"
df -h . 2>/dev/null || echo "Disk usage info not available"
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
