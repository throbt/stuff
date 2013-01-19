#!/bin/bash
#setxkbmap -layout "hu, us" -option "grp:caps_toggle"
#sleep 15;
#amixer sset Master unmute
#xscreensaver &
##dockx &
#kupfer &

#if [ $DESKTOP_SESSION == "gnome-compiz" ]; then
#  dockx &
#fi

#terminator & 
#sleep 10;
#pkill cairo-dock &

# mount remote stuff

#optirun gnome-shell --replace &

echo v | sshfs vvv@192.168.1.101:/home/vvv ~/player -o password_stdin &
echo Nfs13%kG | sshfs www-data@halation.hu:/var/www ~/halation -o password_stdin &
guake &
terminator &
