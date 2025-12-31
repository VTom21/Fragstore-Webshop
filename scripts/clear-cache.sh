#!/bin/bash
set -e

# =========================================
# Clear Application Cache and Temporary Files
# =========================================

echo "======================================="
echo "         Clearing Cache Script"
echo "======================================="
echo ""

# --- Define directories to clear ---
# Customize these paths for your project
CACHE_DIR="./cache"
TMP_DIR="./tmp"
BUILD_DIR="./public/build"

# Function to safely delete contents of a directory
clear_dir() {
    local dir="$1"
    if [ -d "$dir" ]; then
        echo "Clearing $dir..."
        rm -rf "${dir:?}/"*   # The ?: prevents rm -rf /* by accident
        echo "$dir cleared."
    else
        echo "Directory $dir does not exist, skipping."
    fi
    echo "---------------------------------------"
}

# --- Clear directories ---
clear_dir "$CACHE_DIR"
clear_dir "$TMP_DIR"
clear_dir "$BUILD_DIR"

# Optional: clear npm cache
if command -v npm >/dev/null 2>&1; then
    echo "Clearing npm cache..."
    npm cache clean --force
    echo "npm cache cleared."
    echo "---------------------------------------"
fi

# Optional: clear Composer cache (if using PHP)
if command -v composer >/dev/null 2>&1; then
    echo "Clearing Composer cache..."
    composer clear-cache
    echo "Composer cache cleared."
    echo "---------------------------------------"
fi

echo ""
echo "======================================="
echo "         Cache Clearing Completed"
echo "======================================="


