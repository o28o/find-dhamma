#for grepallsuttas.sh
rootpath=/home/a0092061/domains/find.dhamma.gift/public_html/scripts
suttapath=/home/a0092061/data/suttacentral.net/
output=/home/a0092061/domains/find.dhamma.gift/public_html/output/
wbefore=1
wafter=3
linesafter=0
minlength=4
truncatelength=30
filesizenooverwrite=700000
maxmatchesbg=1800


function pvlimit {
pv -L 1m -q
}
function clearargs {
sed -e 's/-pli //g' -e 's/-pi //g' -e 's/-ru //g' -e 's/-en //g' -e 's/-abhi //g' -e 's/-vin //g' -e 's/-th //g' -e 's/^ //g' -e 's/-kn //g' | sed 's/-oru //g' | sed 's/-ogr //g' | sed 's/-oge //g'| sed 's/-nbg //g' | sed 's/ -exc.*//g' 
}


function removeindex {
sed -e 's/:.*": "/": "/' #      sed 's/ /:/1' | awk -F':'  '{print $1, $3}'
}

function tohtml {
tee -a ${table} table.html > /dev/null
} 

function sedexpr {
sed 's/\.$//g' | sed 's/:$//g' | sed 's/[,!?;«—”“‘"]/ /g' | sed 's/)//g' | sed 's/(//g'  
}

function cleanwords {
  cat $file | removeindex | clearsed | sedexpr | awk '{print tolower($0)}' |egrep -io$grepgenparam "[^ ]*$pattern[^ ]*"
  }
  
#| sed 's/’ti//g'  
function getwords {
cleanwords | sort | uniq 
cleanwords | tee -a $tempfilewords > /dev/null

}

function highlightpattern {
sed "s@$pattern@<b>&</b>@gI"
}



sitename=https://find.dhamma.gift
templatefolder=/home/a0092061/domains/find.dhamma.gift/public_html/templates

#for find in all theravada.ru suttas
scriptdir=$rootpath
searchdir=/home/a0092061/data/theravada.ru/Teaching/Canon/Suttanta/Texts
outputdir=$output


#for allwords.sh
homedir=$rootpath
outputdiraw=$output/allwords
suttapath=$suttapath
