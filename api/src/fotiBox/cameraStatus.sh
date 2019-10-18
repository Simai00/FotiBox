#!/usr/bin/env bash
lineCount=`gphoto2 --auto-detect | wc -l`

if [ $lineCount -gt 2 ]
then
    while read -r line; do
        if [[ $line =~ "Abilities for camera" ]]
        then
            cameraName=`echo "$line" | cut -f 2 -d ':' | sed -e 's/^[[:space:]]*//' | awk -F '\ \(' '{print $1}'`
        fi
    done <<< `gphoto2 -a`
    echo "$cameraName"
    echo "online"
else
    echo ""
    echo "offline"
fi
