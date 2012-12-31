#!/bin/bash

git config --global user.name "robThot"
git config --global user.email "robthot@gmail.com"
git config --global core.whitespace "trailing-space,space-before-tab"
git config --global apply.whitespace "fix"
git config --global core.autocrlf "false"
git config --global color.ui true
git config --global push.default "matching"
git config --global merge.summary "true"
git config --global mergetool.prompt "false"
git config --global difftool.prompt "false"
git config --global alias.unstage "reset HEAD"
git config --global alias.st "status"
git config --global alias.st "status"
git config --global alias.co "checkout"
git config --global alias.ci "commit"
git config --global alias.dt "difftool"
git config --global color.ui "auto"
git config --global color.branch.current "yellow reverse"
git config --global color.branch.local "yellow"
git config --global color.branch.remote "green"
git config --global color.diff.meta "yellow bold"
git config --global color.diff.frag "magenta bold"
git config --global color.diff.old "red bold"
git config --global color.diff.new "green bold"
git config --global color.status.added "yellow"
git config --global color.status.changed "green"
git config --global color.status.untracked "cyan"
git config --global core.editor "medit"

source /home/v/scripts/git-completion.bash


#source /usr/lib/libui.sh



export GIT_PS1_SHOWDIRTYSTATE=true

# export PS1='\n\[\e[1;32m\]\h:\w\[\e[0;33m\]$(__git_ps1) \[\e[1;33m\]\n\$ \[\033[m\]'
# export CLICOLOR=1
# export LSCOLORS=ExFxCxDxBxegedabagacad



CLCYAN="\[\033[0;36m\]" # text elements
CLBLUE="\[\033[1;34m\]" # brackets
CLPURP="\[\033[1;35m\]" # for user if whoami outputs 'root'
CLLGREY="\[\033[1;37m\]" # for user if whoami outputs something other than 'root'
CLSYS="\[\033[0;0m\]" # set the text after the prompt to the color defined in the terminal profile

if [ `/usr/bin/whoami` = 'root' ]
then
    export PS1="\n$CLBLUE[$CLPURP\u$CLBLUE@$CLCYAN\h$CLBLUE][$CLCYAN\w$CLBLUE]: $CLBLUE    \$(__git_ps1) \n$CLSYS\$ "
    
    #export PS1="\e[1;33;47m\u \e[1;32;47mon \h \e[1;35;47m\d \@\e[0;0m\n\e[1;34m[dir.= \w] \# > \e[0;0m  \$(__git_ps1) \n$CLSYS\$ "
    
else
    export PS1="\n$CLBLUE[$CLLGREY\u$CLBLUE@$CLCYAN\h$CLBLUE][$CLCYAN\w$CLBLUE]: $CLBLUE     \$(__git_ps1) \n$CLSYS\$ "
    
    #export PS1="\e[1;33;47m\u \e[1;32;47mon \h  \e[1;34m[\w] \e[0;0m  \$(__git_ps1) \n$CLSYS\$ "
fi


EDITOR=vim
export $EDITOR

export PATH=${PATH}:/opt/android-sdk/platform-tools/

## cabal
export PATH=${PATH}:/home/v/.cabal/bin


