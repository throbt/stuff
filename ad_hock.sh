#!/bin/bash
####### this part should change or simply be removed depending on the network card
#recreates the wlan0 interface in ad hoc mode
modprobe -r ath_pci
modprobe ath_pci autocreate=adhoc
wlanconfig wlan0 destroy
wlanconfig ath create wlandev wifi0 wlanmode adhoc
#######

#starts the ad hoc server
ifconfig wlan0 down
iwconfig wlan0 mode ad-hoc
iwconfig wlan0 channel 4
iwconfig wlan0 essid 'mine'
ifconfig wlan0 10.0.0.1 up

#forwards the ad hoc network to the router
iptables -A FORWARD -i wlan0 -o eth0 -s 10.0.0.0/24 -m state --state NEW -j ACCEPT
iptables -A FORWARD -m state --state ESTABLISHED,RELATED -j ACCEPT
iptables -A POSTROUTING -t nat -j MASQUERADE


