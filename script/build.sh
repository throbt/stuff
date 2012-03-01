#!/bin/bash

PWD="/home/vvv/sites/newStufff/script/"

JAVA=""
if [ -z "$1" ]
then
	JAVA="java" 
else
	JAVA="$1"
fi

echo 'Clear previous builds'
rm -R ../public/js/build
mkdir ../public/js/build
echo 'Start building in4 client side...'
$JAVA -jar ~/JSBuilder/JSBuilder2.jar --projectFile $PWD/maxima.jsb2 --homeDir $PWD/ -v
echo 'Project builded!'