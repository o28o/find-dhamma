#!/bin/bash -i
#set -x #
#trap read debug


source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh
cd $output 

function grepbrief {
	
	awk -v ptn="$pattern" -v cnt1=$wbefore -v cnt2=$wafter '
{ for (i=1;i<=NF;i++)
      if ($i ~ ptn) {
         sep=""
         for (j=i-cnt1;j<=i+cnt2;j++) {
             if (j<1 || j>NF) continue
             printf "%s%s", sep ,$j
             sep=OFS
         }
         print ""
      }
}'
}

if [ $# -ne 0 ]
  then
        pattern="$@"
  else
        echo "enter pattern"
        read "pattern"
fi

if [[ "$pattern" == "" ]]
then                                        
   echo empty  pattern 
   exit 1                 
fi

pattern=adhivacanas

function clearargs {
sed -e 's/-pil//g' -e 's/-pi//g' -e 's/-ru//g' -e 's/-en//g' -e 's/-abhi//g' -e 's/-vin//g' -e 's/^ //g'
}
#set search language from args or set default

pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs `
grepgenparam=E


#if you want to use this script for other languages, add blocks that are needed with your language which must be available on suttacentra.net
lookup=$suttapath/sc-data/sc_bilara_data

function clearsed {
sed 's/<p>/\n/g; s/<[^>]*>//g'  | sed  's/": "/ /g' | sed  's/"//1' | sed 's/",$//g' 
}


vin=vinaya
abhi=abhidhamma
sutta=mutta
fortitle=Suttas
if [[ "$@" == *"-vin"* ]]; then
    vin=
    sutta=sutta
	fortitle=Vinaya
    echo search in vinaya
    fileprefix=vin_
fi
if [[ "$@" == *"-abhi"* ]]; then
    abhi=
    sutta=sutta
	fortitle=Abhidhamma
    fileprefix=abhi_
    echo search in abhidhamma
fi

#filename
fn=${fileprefix}`echo $pattern | sed 's/ /_/g' | sed 's/\\\//g' |  awk '{print tolower($0)}'`

extention=txt
result_script=result.sh
basefile=${fn}_fn.$extention

#filelist
words=${fn}_words.$extention
links=${fn}_links.$extention
links_and_words=${fn}_links_words.$extention
quotes=${fn}_quotes.$extention
brief=${fn}_brief.$extention
metaphors=${fn}_metaphors.$extention
top=${fn}_top_count.$extention
table=${fn}_analysis.html

if [[ "$@" == *"-h"* ]]; then
    echo "
    without arguments - starts with prompt in pali
    also search words can be used as arguments e.g.
    
    $> ./scriptname.sh moggall
    
    -vin - to search in vinaya texts only 
    -abhi - to search in abhidhamma texts only
    -en - to search in english
    -ru - to search in russian
    -pil - search in pali on legacy.suttacentral.net archive
    "
    exit 0
elif [[ "$@" == *"-ru"* ]]; then
    pali_or_lang=sc-data/html_text/ru/pli 
    language=Russian
    directlink=
    type=html   
    metaphorkeys="подобно|представь|обозначение"
    nonmetaphorkeys="подобного"
elif [[ "$@" == *"-pil"* ]]; then
    pali_or_lang=legacy-suttacentral-data-master/text/pi
    language=Pali
    directlink=/pli/ms
    directlink=/en/?layout=linebyline
    directlink=
    type=html
    metaphorkeys="seyyathāpi|adhivacan|ūpamā|ūpama|opama|upamā"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath"
   #modify pattern as legacy uses different letters
    #pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs`
elif [[ "$@" == *"-en"* ]]; then
    pali_or_lang=sc-data/sc_bilara_data/translation/
    directlink=/en/?layout=linebyline
    directlink=
    language=English
    type=json
    metaphorkeys="suppose|is a term for|similar to "
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath" 
else
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath"
fi

if [[ "$type" == json ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${brief}
${metaphors}
${top}"`

function extraspaces {
#add extra linebreak
echo >> ${links_and_words}
echo >> ${brief}
}

grepvar=
function removeindex {
sed -e 's/:.*": "/": "/' #      sed 's/ /:/1' | awk -F':'  '{print $1, $3}'
}

function tohtml {
tee -a ${table} table.html >/dev/null
} 

function linklist {
echo Quotes 
echo

title="${pattern^} in $language $fortitle"

templatefolder=$rootpath/template

cat $templatefolder/Header.html | sed 's/$title/'"$title"'/g' | tohtml 


for filenameblock  in `cat $basefile | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -n | uniq` ; do 

    roottext=`find $lookup/root -name "*${filenameblock}_*"`
    translation=`find $lookup/translation/en/ -name "*${filenameblock}_*"`
    rustr=`find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*"`
    variant=`find $lookup/variant -name "*${filenameblock}_*"`
    
    
    if [[ "$language" == "Pali" ]]; then
        file=$roottext
    elif [[ "$language" == "English" ]]; then
        file=$translation
    fi 


translatorsname=`echo $translation | awk -F'/en/' '{print $2}' | awk -F'/' '{print $1}'`

suttanumber="$filenameblock"

linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"'$directlink'"}' `
count=`grep -oi$grepgenparam "$pattern" $file | wc -l` 


#russian text 
#link ru 
#translatorsname=`echo $rustr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

function getwords {
cat $file | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”‘"]/ /g'|grep -io$grepgenparam "[^ ]*$pattern[^ ]*" | sort | uniq 
}

function highlightpattern {
sed 's/'$pattern'/<b>&<\/b>/gI'
}
word=`getwords | xargs | clearsed | sed 's/[.,?;:]//g' | sed 's/[—‘”"]/ /g' | highlightpattern`

indexlist=`grep -i $filenameblock $basefile | awk '{print $2}'`

metaphorindexlist=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 


echo "<tr>
<td>$suttanumber</td>
<td>$word</td>
<td><a target=\"_blank\" href="$linkpli">Pli</a>    <a target=\"_blank\" href="$linken">En</a></td>
<td>$count</td>   
<td>" | tohtml 

for i in $indexlist
do              
		for f in  $roottext $translation #$variant
        do      
        #echo rt=$roottext
		quote=`grep -iE "${i}([^0-9]|$)" $f | removeindex | clearsed | awk '{print substr($0, index($0, $2))}'  | highlightpattern `
echo "$quote</br>"			
        done 
echo '<br class="styled">'
done | tohtml 

echo "</td>
<td>$metaphorcount</td>
</tr>" | tohtml

done

cat $templatefolder/Footer.html | tohtml


}

elif [[ "$type" == html ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${brief}
${metaphors}
${top}"`

#${texts}


function extraspaces {
#add extra linebreak
#echo >> ${texts}
echo >> ${links_and_words}
echo >> ${brief}
echo >> ${metaphors}
}

grepvar=l
function linklist {
    echo Quotes 
echo
    for file in `cat $basefile | sort -n`
do
    echo -e "`echo "$file" | awk '{print $1}' | awk -F'/' '{print $NF}' | sed 's/.html.*//g' |  awk '{print "https://suttacentral.net/"$0"'$directlink'"}' ` `grep -oi$grepgenparam "$pattern" $file | wc -l` " 

done

}

fi


function getbasefile {
egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={xplayground,$sutta,$abhi,$vin,ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} | clearsed > $basefile

if [ ! -s $basefile ]
then
     echo "No matches for $pattern" 
     echo " echo No matches for $pattern" > $result_script 
chmod +x $result_script 
     rm $basefile


     exit 1
fi
}

echo
echo "search language is $language"
echo "search pattern is $pattern"
echo "base file name is $fn"
echo

getbasefile


#cleanup in case the same search was launched before
rm ${words} ${textspi} ${textsru} ${textsen} ${links} ${links_and_words} ${quotes} ${brief} ${top} ${table} table.html > /dev/null 2>&1

#links and quotes
#add links to each file
linklist

rm $basefile
exit 0

cd $output
echo
#little interactive sub-script e.g. result.sh
n=1
set -- ""
command=cat
echo "
if [ -z \$1 ]
  then
  `for name in $filelist
do
echo "echo \$n\) \$command \$name"
n=$(($n+1))
done`
    read EXPRESSION    
  else
    EXPRESSION="\$1"
fi
[ -z \"\$EXPRESSION\" ] && EXPRESSION=0 
" | tee ${fn}_${result_script} $result_script >/dev/null
n=1
for name in $filelist
do
    if [ $n -eq 1  ]; then
        echo "if [ \$EXPRESSION -eq $n ]; then"
        else
        echo "elif [ \$EXPRESSION -eq $n ]; then"
    fi

 echo "echo ;  $command ./$name | egrep -i --color=always \"($pattern|)\" | less -R"
   
n=$(($n+1))
done  | tee -a ${fn}_${result_script} $result_script >/dev/null

echo "else
exit 0
fi" | tee -a ${fn}_${result_script} $result_script >/dev/null
chmod +x ${fn}_${result_script} $result_script

bash -i ./$result_script

exit 0

echo "/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/sn/sn6/Kan/sn6.1.html
/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/sn/sn6/sn6.1.html
/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/sn/sn46/sn46.14.html
/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/sn/sn46/Pannyavaro/sn46.14.html
/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/mn/mn55.html
/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta/mn/SV/mn55.html
" | awk -F'/ru/' '{print $2}'  | awk '{
if ($3 = "mn" || $3 = "dn" ) {
	if ($4 ~ /html/ || $4 ~ /[0-9]/ ) { print "sv" }
	else { print $4 }
	}
elif ( $3 = "an" || $3 = "sn"  || $3 = "kn" ) 
	if ($5 ~ /html/ || $5 ~ /[0-9]/ ) { print "sv" }
	else { print $4 }
	
}'



