#!/bin/bash
PWD="."

JAVA=""
if [ -z "$1" ]
then
	JAVA="java" 
else
	JAVA="$1"
fi

echo 'Clear previous builds'
rm -R ../www/lib/mnvc/build/
mkdir ../www/lib/mnvc/build/
echo 'Start building  M N V C framework...'
$JAVA -jar JSBuilder2.jar --projectFile $PWD/mnvc.jsb2 --homeDir $PWD/ -v
echo 'Project builded!'