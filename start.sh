#!/bin/bash
#setxkbmap -layout "hu, us" -option "grp:caps_toggle"
#sleep 15;
#amixer sset Master unmute
#xscreensaver &
##dockx &
#kupfer &

if [ $DESKTOP_SESSION == "gnome-compiz" ]; then
  dockx &
fi

terminator & 
sleep 10;
pkill cairo-dock &
