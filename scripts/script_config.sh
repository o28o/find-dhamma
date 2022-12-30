#for grepallsuttas.sh
rootpath=/home/a0092061/domains/find.dhamma.gift/public_html/scripts
suttapath=/home/a0092061/data/suttacentral.net/
output=/home/a0092061/domains/find.dhamma.gift/public_html/result/
wbefore=1
wafter=3
linesafter=0
minlength=4
truncatelength=30
filesizenooverwrite=800000
maxmatchesbg=1900
history="/home/a0092061/domains/find.dhamma.gift/public_html/result/.history"
sntoccsv="/home/a0092061/domains/find.dhamma.gift/public_html/assets/sn_toc.csv"
archivenumber=31
function pvlimit {
pv -L 1m -q
}
function clearargs {
sed -e 's/-pli //g' -e 's/-pi //g' -e 's/-ru //g' -e 's/-en //g' -e 's/-abhi //g' -e 's/-vin //g' -e 's/-th //g' -e 's/^ //g' -e 's/-kn //g' -e 's/-all //g' | sed 's/-oru //g' | sed 's/-ogr //g' | sed 's/-oge //g'| sed 's/-nbg //g' | sed 's/ -exc.*//g' | sed 's/-la [0-9]* //g' | sed 's/-def //g' | sed 's/-ply //g'
}

function removefilenames {
sed -Ei 's%^.*(.json|.html):%%g' $basefile 
sed -i 's/$/<br>/' $basefile
(echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>
<body>' && cat $basefile ) > tmp && mv tmp $basefile

echo "</body>
</html>" >> $basefile
newbasefilename=`echo $basefile | sed 's@_fn.tmp@_raw.html@'`
mv $basefile $newbasefilename
basefile=$newbasefilename
}
  
function removeindex {
sed -e 's/:.*": "/": "/' #      sed 's/ /:/1' | awk -F':'  '{print $1, $3}'
}

function tohtml {
tee -a ${table} > /dev/null
} 

function sedexpr {
sed 's/\.$//g' | sed 's/:$//g' | sed 's/[,!?;«—”“‘"]/ /g' | sed 's/)//g' | sed 's/(//g'  
}

function cleanwords {
  cat $file | removeindex | clearsed | sedexpr | awk '{print tolower($0)}' |egrep -Eio$grepgenparam "[^ ]*$patternForHighlight[^ ]*"
  }
  
#| sed 's/’ti//g'  
function getwords {
cleanwords | sort | uniq 
cleanwords | tee -a $tempfilewords > /dev/null

}

function highlightpattern {
sed -E "s@$patternForHighlight@<b>&</b>@gI"
}

sitename=https://find.dhamma.gift
templatefolder=/home/a0092061/domains/find.dhamma.gift/public_html/assets/templates

#for find in all theravada.ru suttas
scriptdir=$rootpath
searchdir=/home/a0092061/data/theravada.ru/Teaching/Canon/Suttanta/Texts
outputdir=$output


#for allwords.sh
homedir=$rootpath
outputdiraw=$output/allwords
suttapath=$suttapath
