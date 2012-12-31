#!/bin/bash


#fdisk -l

mount /dev/sda8 /mnt/
mount --bind /dev/ /mnt/dev
mount --bind /proc/ /mnt/proc
mount --bind /sys/ /mnt/sys
mount --bind /dev/pts /mnt/dev/pts
cp /etc/resolv.conf /mnt/etc/resolv.conf

chroot /mnt
