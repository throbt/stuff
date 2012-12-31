#!/bin/bash

for f in /home/vvv/Desktop/maxima_sql/*
do
  mysql maxima -u root --password=v  < $f
  echo $f
done
