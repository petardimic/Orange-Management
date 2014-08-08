#!/bin/bash

OUT=$(curl -s -u spl1nes:fankanteik https://bitbucket.org/api/1.0/repositories/spl1nes/oms/changesets/ | grep -Po '("count": )(\d*)' | awk '{print $2}')

echo "Build version: $OUT"