#!/bin/bash
DATE="$(date)"
echo "Content-type: text/html"
echo ""
echo "<html><head><title>Test</title></head><body>"
echo "Today is $DATE <br>"
echo "`cat ../suttacentral.net/sc-data/sc_bilara_data/root/pli/ms/sutta/sn/sn35/sn35.28_root-pli-ms.json | grep cakkh
`"
touch /home/a0092061/domains/find.dhamma.gift/public_html/output/tst
