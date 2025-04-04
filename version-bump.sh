#!/bin/bash

# Pfad zur Datei mit Versionsnummer
VERSION_FILE="VERSION"

# Aktuelle Version lesen
VERSION=$(cat $VERSION_FILE)

# Version parsen
IFS='.' read -r MAJOR MINOR PATCH <<< "$VERSION"

# Argument prüfen
BUMP=${1:-patch}

if [ "$BUMP" == "patch" ]; then
  PATCH=$((PATCH + 1))
elif [ "$BUMP" == "minor" ]; then
  MINOR=$((MINOR + 1))
  PATCH=0
elif [ "$BUMP" == "major" ]; then
  MAJOR=$((MAJOR + 1))
  MINOR=0
  PATCH=0
else
  echo "Ungültiges Argument: $BUMP"
  exit 1
fi

# Neue Version schreiben
NEW_VERSION="$MAJOR.$MINOR.$PATCH"
echo "$NEW_VERSION" > $VERSION_FILE

# Git-Commit + Tag
git add $VERSION_FILE
git commit -m "Release v$NEW_VERSION"
git tag -a "v$NEW_VERSION" -m "Release v$NEW_VERSION"
git push && git push origin "v$NEW_VERSION"

echo "✅ Neue Version: $NEW_VERSION"
