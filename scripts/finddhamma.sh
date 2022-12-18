#!/bin/bash -i
set -x 
trap read debug
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh --source-only
cd $output 

if [[ "$@" == *"-oru"* ]]; then
excluderesponse="исключая"
function bgswitch {
	echo "Найдено $linescount строк с $pattern<br> 
	к сожалению ресурсы сервера ограничены.<br>
	Этот запрос не может быть обработан.<br>
	Пожалуйста, измените критерий поиска<br>
	к примеру более длинное или<br>
	более специфическое слово."
	exit 3
}

function reverseyoinpattern {
pattern="`echo $pattern | sed 's/\[ёе\]/е/g'`"
}  


function capitalized {
echo "$pattern" | sed 's/[[:lower:]]/\U&/'
}

function emptypattern {
   echo "Что искать?"
}

function OKresponse {
  echo "`echo "$pattern" | sed 's/[[:lower:]]/\U&/'`${addtotitleifexclude} $textsqnty в $fortitle $language - "
#echo "$language - "
}

function Erresponse {
     echo "${pattern} нет в $fortitle $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./result/${tempfilewords}">Слова</a> и \");"  
}

function quoteresponse {
	php -r "print(\"<a class="outlink" href="./result/${table}">Цитаты</a><br>\n\");"
	
}
function minlengtherror {
echo "Слишком коротко. Мин $minlength символа"
}

elif [[ "$@" == *"-ogr"* ]]; then
excluderesponse="исключая"
function bgswitch {
	echo "Найдено $linescount строк с $pattern<br> 
	к сожалению ресурсы сервера ограничены 
	и этот запрос не может быть обработан.<br>
	Пожалуйста, измените критерий поиска<br>
	к примеру более длинное или<br>
	более специфическое слово."
	exit 3
}
# Отправлено в фоновый режим.<br>
#	Подождите 20-30 минут<br>
#	и проверьте <a class=\"outlink\" href="./result/${table}">здесь</a><br>
#	или в истории поиска." 

function emptypattern {
   echo "Что искать?"
}

function OKresponse {
echo "$textsqnty в $language - "
#echo "$language - "
}

function Erresponse {
     echo "нет в $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./result/${tempfilewords}">Слова</a> и \");"  
}

function quoteresponse {
	php -r "print(\"<a class="outlink" href="./result/${table}">Цитаты</a><br>\n\");"
	
}
function minlengtherror {
echo "Слишком коротко. Мин $minlength символа"
}

elif [[ "$@" == *"-oge"* ]]; then
excluderesponse="excluding"
function bgswitch {
	echo "Found $linescount lines with $pattern<br> 
	Unfortunately server resources are limited <br>
	Please, change the search criteria<br>
	Use longer or more specific word.<br>"
	exit 3
}
#function bgswitch {
#	echo "$linescount $pattern lines found.<br> 
#	Switched to background mode.<br>
#	Wait for 20-30 minutes <br>
#	and check the result in the search history." 
#}

function emptypattern {
   echo "Empty pattern"
}


function OKresponse {
echo "$textsqnty in $language - "
#echo "$language - "
}

function Erresponse {
     echo "not in $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./result/${tempfilewords}">Words</a> and \");"
}

function quoteresponse {
php -r "print(\"<a class="outlink" href="./result/${table}">Quotes</a><br>\n\");"

}

function minlengtherror {
echo Too short. Min is $minlength
}



else #eng
excluderesponse="excluding"
function bgswitch {
	echo "Found $linescount lines with $pattern<br> 
	Unfortunately server resources are limited <br>
	Please, change the search criteria<br>
	Use longer or more specific word.<br>"
	exit 3
}

function emptypattern {
   echo "Empty pattern"
}


function OKresponse {
echo "`echo "$pattern" | sed 's/[[:lower:]]/\U&/'`${addtotitleifexclude} $textsqnty in $fortitle $language - "
#echo "$language - "
}

function Erresponse {

     echo "${pattern} not in $fortitle $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./result/${tempfilewords}">Words</a> and \");"
}

function quoteresponse {
php -r "print(\"<a class="outlink" href="./result/${table}">Quotes</a><br>\n\");"

}

function minlengtherror {
echo Too short. Min is $minlength
}

fi

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

pattern="$@"

if [[ "$@" == *"-h"* ]]; then
    echo "
    without arguments - starts with prompt in pali<br>
    also search words can be used as arguments e.g.<br>
    <br>
    $> ./scriptname.sh moggall<br>
    <br>
    -def - find definitions in Pali <br>
    -vin - to search in vinaya texts only <br>
    -abhi - to search in abhidhamma texts only <br>
    -en - to search in english <br>
    -ru - to search in Russian <br>
    -th - to search in thai <br>
    -pli - to search in pali (default option) <br>
    -nbg - no background <br>
	-kn - include Khuddaka Nikaya selected books <br>
	-oru - output messages in Russian<br>"
    exit 0
fi

if [[ "$@" == *"-la"* ]]; then
linesafter=`echo "$@" | awk -F'-la ' '{print $2 }' | awk '{print $1}'` 
fi
#echo la=$linesafter
pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs `
userpattern="$pattern"
patternForHighlight="`echo $pattern | sed -E 's/^[A-Za-z]{2,4}[0-9]{2,3}\.\*//g'| sed -E 's/^[A-Za-z]{2,4}[0-9]{2,3}.[0-9]{1,3}\.\*//g' | sed 's/.\*/|/g' |  sed 's@^@(@g' | sed 's/$/)/g'`"
if [[ "$pattern" == "" ]] ||  [[ "$pattern" == "-ru" ]] || [[ "$pattern" == "-en" ]] || [[ "$pattern" == "-th" ]]  || [[ "$pattern" == "-oru" ]]  || [[ "$pattern" == "-nbg" ]] || [[ "$pattern" == "-ogr" ]] || [[ "$pattern" == "-oge" ]] || [[ "$pattern" == "-vin" ]] || [[ "$pattern" == "-all" ]] || [[ "$pattern" == "" ]] || [[ "$pattern" == "-kn" ]] || [[ "$pattern" == "-pli" ]] || [[ "$pattern" == "-def" ]] 
then   
#emptypattern
   exit 3
fi
    

if   [ "${#pattern}" -lt "$minlength" ]
then
minlengtherror
exit 1 
fi

grepgenparam=E

#if you want to use this script for other languages, add blocks that are needed with your language which must be available on suttacentra.net
lookup=$suttapath/sc-data/sc_bilara_data

function clearsed {
sed 's/<p>/\n/g; s/<[^>]*>//g'  | sed  's/": "/ /g' | sed  's/"//1' | sed 's/",$//g' 
}


vin=vinaya
abhi=abhidhamma
sutta=mutta
fortitle=Suttanta
fileprefix=_suttanta
if [[ "$@" == *"-vin"* ]]; then
    vin=dummy
    sutta=sutta
	fortitle=Vinaya
    #echo search in vinaya
    fileprefix=_vinaya
fi
if [[ "$@" == *"-abhi"* ]]; then
    abhi=dummy
    sutta=sutta
	fortitle=Abhidhamma
    fileprefix=_abhidhamma
    #echo search in abhidhamma
fi
 

if [[ "$@" == *"-kn"* ]]; then
function grepbasefile {
nice -19 egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} 
}
fileprefix=${fileprefix}-kn
fortitle="${fortitle} +KN"
#| nice -19 egrep -v "snp|thag|thig|dhp|iti|ud"
elif [[ "$@" == *"-def"* ]]
then
fileprefix=${fileprefix}-definition
fortitle="Definition ${fortitle}"
#echo $pattern | sed 's/.\*/|/g' |  sed 's@^@(@g' | sed 's/$/)/g' | sed 's/[aoā]$//g'
defpattern="`echo $pattern | sed -E 's/([aoā]|aṁ)$//g'`"
pattern="$defpattern" 

patternForHighlight="`echo $pattern | sed -E 's/^[A-Za-z]{2,4}[0-9]{2,3}\.\*//g'| sed -E 's/^[A-Za-z]{2,4}[0-9]{2,3}.[0-9]{1,3}\.\*//g' | sed 's/.\*/|/g' |  sed 's@^@(@g' | sed 's/$/)/g'`"
function grepbasefile {
nice -19 egrep -A1 -Eir "Seyyathāpi.*${defpattern}|${defpattern}[^\s]{0,3}sutta|(dn3[34]|mn4[34]).*(Dv|Tis|Tay|Tī|Cattā|Cata|Pañc|cha|Satta|Aṭṭh|Nav|das).{0,20}${defpattern}|\bKas.{0,60}${defpattern}.{0,9}\?|Katth.*${defpattern}.*daṭṭhabb|\bKata.{0,20}${defpattern}.{0,9}\?|Kiñ.*${defpattern}.{0,9} vadeth|${defpattern}.*adhivacan|vucca.{2,5} ${defpattern}{0,7}|${defpattern}.{0,15}, ${defpattern}.*vucca|${defpattern}.{0,9} vacan" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} 
}

function grepbasefileExtended {
nice -19 egrep -A1 -Eir "(an3.34|an3.111|an3.112|an6.39|an10.174|dn15|sn12.60|sn14.12).*${defpattern}|(mn135|mn136|mn137|mn138|mn139|mn140|mn141|mn142|sn12.2:|sn45.8|sn47.40|sn48.9:|sn48.10|sn48.36|sn48.37|sn48.38|sn51.20).*${defpattern}" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} 
}

#\bKatha.*${defpattern}|\bIdaṁ .*${defpattern}{0,6}\b

elif [[ "$@" == *"-all"* ]]; then
function grepbasefile {
nice -19 egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site}
}
fileprefix=${fileprefix}-all
fortitle="${fortitle} +All"
else 
function grepbasefile {
nice -19 egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv,thag,thig,snp,dhp,iti} 
}

fi

if [[ "$@" == *"-th"* ]]; then
    fnlang=_th
    pali_or_lang=sc-data/html_text/th/pli 
    language=Thai
	printlang=ไทย
    directlink=
    type=html   
    metaphorkeys="как если бы|подоб|представь|обозначение"
    nonmetaphorkeys="подобного|подоба"
elif [[ "$@" == *"-ru"* ]]; then
    fnlang=_ru
    pali_or_lang=sc-data/html_text/ru/pli 
    language=Russian
	printlang=Русский
    directlink=
    type=html   
    metaphorkeys="как если бы|подобно|представь|обозначение|пример"
    nonmetaphorkeys="подобного"
    definitionkeys="что такое.*${pattern}.{0,4}\\?|${pattern}.*говорят|${pattern}.*обозначение|${pattern}.{0,4}, ${pattern}.*говорят"
elif [[ "$@" == *"-pli"* ]]; then
    fnlang=_pali
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan|ūpama|opama|opamma"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath|ekarūp|tathārūpa|āmarūpa|\brūpa|evarūpa|\banopam|\battūpa|\bnillopa|opamaññ"
    definitionkeys="Kata.*${pattern}.{0,4}\\?|${pattern}.*vucati|${pattern}.*adhivacan|${pattern}.{0,4}, ${pattern}.*vucca"
   #modify pattern as legacy uses different letters
elif [[ "$@" == *"-en"* ]]; then
    fnlang=_en
	printlang=English
    pali_or_lang=sc-data/sc_bilara_data/translation/en/
    language=English
    type=json
    metaphorkeys="It’s like a |suppose|is a term for|similar to |simile"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath" 
    definitionkeys="what is.*${pattern}.{0,4}\\?|speak of this.*${pattern}|${pattern}.*term|${pattern}.{0,4}, ${pattern}.*говорят"
else
    fnlang=_pali
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan|ūpama|opama|opamma"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath|ekarūp|tathārūpa|āmarūpa|\brūpa|evarūpa|\banopam|\battūpa|\bnillopa|opamaññ"
fi

if [[ "$@" == *"-exc"* ]]
then
excludepattern="`echo $@ | sed 's/.*-exc //g'`"
addtotitleifexclude=" exc. ${excludepattern,,}"
addtoresponseexclude=" $excluderesponse $excludepattern"
function grepexclude {
egrep -viE "$excludepattern"
}
#echo arg="$@"
excfn="` echo -exc-${excludepattern} | sed 's/ /-/g' | sed 's@\\\@@g' `"

else
function grepexclude {
pvlimit 
}
fi
#echo exc=$excfn

function diact2normal {
sed "s/ā/aa/g" |
sed "s/ī/ii/g" |
sed "s/ū/uu/g" |
sed "s/ḍ/d./g" |
sed "s/ṁ/m./g" |
sed "s/ṅ/n./g" |
sed "s/ṇ/n./g" |
sed "s/ṭ/t./g" |
sed "s/ñ/n~/g"
}

function cyr2lat {
sed "s/а/a/g" |
sed "s/б/b/g" |
sed "s/в/v/g" |
sed "s/г/g/g" |
sed "s/д/d/g" |
sed "s/е/e/g" |
sed "s/ё/yo/g" |
sed "s/ж/zh/g" |
sed "s/з/z/g" |
sed "s/и/i/g" |
sed "s/й/i/g" |
sed "s/к/k/g" |
sed "s/л/l/g" |
sed "s/м/m/g" |
sed "s/н/n/g" |
sed "s/о/o/g" |
sed "s/п/p/g" |
sed "s/р/r/g" |
sed "s/с/s/g" |
sed "s/т/t/g" |
sed "s/у/u/g" |
sed "s/ф/f/g" |
sed "s/х/h/g" |
sed "s/ц/ts/g" |
sed "s/ч/ch/g" |
sed "s/ш/sh/g" |
sed "s/щ/sh/g" |
sed "s/ъ//g" |
sed "s/ы/y/g" |
sed "s/ь//g" |
sed "s/э/e/g" |
sed "s/ю/yu/g" |
sed "s/я/ya/g" 
}

#link and filename

fn=`echo $pattern | sed 's/\*//g' | sed 's/[|-]/-/g' | sed 's/ /-/g' | sed 's/\\\//g' | sed 's@?@-question@g'|  awk '{print tolower($0)}'`
fn=${fn}${excfn}${fileprefix}${fnlang}
modifiedfn=`echo $fn | diact2normal | cyr2lat`
#echo fn=$fn modifiedfn=$modifiedfn
extention=txt
basefile=${fn}_fn.$extention

#filelist
#words=${fn}_words.$extention
#links=${fn}_links.$extention
#links_and_words=${fn}_links_words.$extention
#quotes=${fn}_quotes.$extention
#brief=${fn}_brief.$extention
#metaphors=${fn}_metaphors.$extention
table=${modifiedfn}
tempfile=${modifiedfn}.tmp
tempfilewhistory=${modifiedfn}_hist.tmp
tempfilewords=${modifiedfn}_words
tempdeffile=${modifiedfn}.def.tmp
deffile=${modifiedfn}_definitions


if [[ -s ${table} ]] ; then 
function md5checkwrite {
var="$(cat)"
functionname=`echo $var | awk '{print $1}'`
functionfile=~/.shortcuts/${functionname}.sh 
content=`echo "$var" | awk 'NR!=1'`
#echo $functionfile $functionname
md5_stdin=$(echo "$content" | md5sum | cut -d" " -f 1)
md5_file=$(md5sum ${functionfile} | cut -d" " -f1)
[[ "$md5_stdin" != "$md5_file" ]] && echo "$content"  > $functionfile
}

filesize=$(stat -c%s "${table}")

if (( $filesize >= $filesizenooverwrite )) && [[ "`tail -n1 ${table}`" == "</html>" ]] 
then
	#echo Already 
OKresponse

	if [[ "$language" == "Pali" ]] 
	then 
	wordsresponse
	fi
	quoteresponse
	
	exit 0
#else 
#	echo Already 
fi 

fi

function genwordsfile {
cat $tempfilewords | pvlimit | sedexpr | awk '{print tolower($0)}' | tr -s ' '  '\n' | sort | uniq -c | awk '{print $2, $1}' > $tempfile

uniqwordtotal=`cat $tempfile | pvlimit | sort | uniq | wc -l `
#| sed 's/(//g' | sed 's/)//g'
#cat $tempfile
#echo cat

#cat $templatefolder/Header.html $templatefolder/WordTableHeader.html | sed 's/$title/TitletoReplace/g' > $tempfilewords 
cat $templatefolder/Header.html $templatefolder/WordTableHeader.html | sed 's/$title/TitletoReplace/g' > $tempfilewords 

nice -19 cat $tempfile | pvlimit | while IFS= read -r line ; do
uniqword=`echo $line | awk '{print $1}'`
uniqwordcount=`echo $line | awk '{print $2}'`
linkscount=`nice -19 grep -i "\b$uniqword\b" $basefile | sort | awk '{print $1}' | awk -F'/' '{print $NF}' | sort | uniq | wc -l`

if(( $linkscount == 0 ))
then
continue 
fi 
linkswwords=`grep -i "\b$uniqword\b" $basefile | sort -V | awk '{print $1}' | awk -F'/' '{print $NF}' | sort -V | uniq | awk -F'_' '{print "<a target=_blank href=https://find.dhamma.gift/sc/?q="$1"&lang=pli>"$1"</a>"}'| sort -V | uniq | xargs`

#echo $linkswwords
#cat ${links_and_words}  | tr ' ' '\n' |  nice -19 egrep -i$grepgenparam "$pattern"  | sed -e 's/<[^>]*>//g' | sed 's/[".;:?,]/ /g' | sed -e 's/“/ /g' -e 's/‘/ /g'| sed 's/.*= //g' | sed 's@/legacy-suttacentral-data-master/text/pi/su@@g' | sed 's/.*>//g'| sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//' | tr '[:upper:]' '[:lower:]'  | sort | uniq > ${words}


#cat $file | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”"]/ /g'| grep -io$grepgenparam "[^ ]*$pattern[^ ]*" | sort | uniq >> ${links_and_words}

echo "<tr>
<td class=\"longword\">`echo $uniqword | highlightpattern`</td>
<td>$linkscount</td>   
<td>$uniqwordcount</td>   
<td>$linkswwords</td>
</tr>" >>$tempfilewords

echo "$uniqword: $linkswwords `(( $linkscount >= 6 )) && echo \"($linkscount)\"`<br>" >> $tempfilewhistory
done
}

if [[ "$type" == json ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${brief}
${metaphors}
${top}"`

grepvar=

function linklist {
#echo -e "Content-Type: text/html\n\n"
#echo $@

cat $templatefolder/Header.html $templatefolder/ResultTableHeader.html | sed 's/$title/TitletoReplace/g' | tohtml 

textlist=`nice -19  cat $basefile | pvlimit | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -V | uniq`

for filenameblock in `nice -19 cat $basefile | pvlimit | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -V | uniq` ; do 

    roottext=`nice -19 find $lookup/root -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    translation=`nice -19 find $lookup/translation/en/ -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*" |head -n1`
    
    variant=`nice -19 find $lookup/variant -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    
    np=`echo $filenameblock | sed 's@\.@_@g'`
    tr=`nice -19 find $searchdir -name "*${np}-*"`

     thrulink=`echo $tr | sed 's@.*theravada.ru@https://www.theravada.ru@g'`
#if [[ "$thrulink" == "" ]]; then
#tr=`nice -19 find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
#thrulink="https://suttacentral.net/$filenameblock"
#fi 

if [[ $filenameblock == *"dn"* ]]
then 
dnnumber=`echo $filenameblock | sed 's/dn//g'`
thrulink=`curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep "ДН $dnnumber" | sed 's#href="#href="https://tipitaka.theravada.su#' |awk -F'"' '{print $2}'`
  fi 

if [[ "$language" == "Pali" ]]; then
        file=$roottext
elif [[ "$language" == "English" ]]; then
        file=$translation
fi 
   
  #if [[ $filenameblock == *"-"* ]]
if echo $filenameblock | egrep "(sn|an)[0-9]{0,2}.[0-9]{0,3}-[0-9]{0,3}" >/dev/null
then 
suttanumber=`nice -19 egrep -Ei $filenameblock $basefile | awk '{print $2}' | awk -F':' '{print $1}' | sort | uniq `
else 
suttanumber=$filenameblock
fi 
    
if [[ "$roottext" == *"/dhp/"* ]] ||  [[ "$roottext" == *"/iti/"* ]] 
        then 
        roottitle=`nice -19 grep ':0\.4' $roottext | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

elif ls $roottext | egrep -q "sn[0-9]{0,2}.[0-9]*_"
then
roottitle=`nice -19 grep "${suttanumber}," $sntoccsv | awk -F',' '{print $8" "$4}' | sort -V | uniq`

elif ls $roottext | egrep -q "(sn|an)[0-9]{0,3}.[0-9]*-[0-9]*_"
then

samyuttaname=`grep -m1 \`echo $suttanumber | awk -F'.' '{print $1}'\` $sntoccsv | awk -F',' '{print $4}'`
      roottitle="`nice -19 egrep -i "$pattern" $roottext | clearsed | awk '{print $1}' | awk -F':' '{print $1}' | sort -V | uniq |  xargs ` $samyuttaname"
else 
roottitle=`nice -19 grep ':0\.' $roottext | clearsed | awk '{print substr($0, index($0, $2))}' | xargs | egrep -oE "[^ ]*sutta[^ ]*"`
fi 
#" "substr($2, 1, length($2)-4)

if [[ "$translation" == *"/dn/"* ]] || [[ "$translation" == *"/mn/"* ]] || [[ "$translation" == *"/ud/"* ]] 
        then 
        trntitle=`nice -19 grep ':0\.2' $translation | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `
elif [[ "$translation" == *"/dhp/"* ]] ||  [[ "$translation" == *"/iti/"* ]] 
        then 
        trntitle=`nice -19 grep ':0\.4' $translation | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `
        else
        trntitle=`nice -19 grep ':0\.3' $translation | clearsed | awk '{print substr($0, index($0, $2))}' | sort -V | uniq | xargs `
        fi 

translatorsname=`echo $translation | awk -F'/en/' '{print $2}' | awk -F'/' '{print $1}'`

 


if [[ "$fortitle" == *"Suttanta"* ]]
then
linkthai=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/th/siam_rath"}' `
link=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0""}' `
fi

#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}'`
linkgeneral=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli"}' `
#linkgeneral=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `
linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
#linken=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q='$translatorsname'}' `
#linken=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=eng"}' `
linkpli=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli"}' `
#linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile
#Russian text 
#link ru 
#translatorsname=`echo $tr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `


word=`getwords | grepexclude | removeindex | clearsed | sedexpr | awk '{print tolower($0)}' | highlightpattern | sort | uniq | xargs` 
indexlist=`nice -19 egrep -i "${suttanumber}:" $basefile | awk '{print $2}' | sort -V | uniq`

#indexlist=$(for i in $indexlist
#do
#nice -19 egrep -A${linesafter} -iE "${i}(:|[^0-9]|$)" $roottext | grep -v "^--$" | awk '{print $1}' | clearsed | sedexpr | sort -V | uniq
#done)

#metaphorindexlist=`nice -19 cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`nice -19 cat $file | pvlimit | clearsed | nice -19 egrep -iE "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 


echo "<tr>
<td><a class=\"freebutton\" target=\"_blank\" href="$linkgeneral">$filenameblock</a></td>
<td><strong>`echo $roottitle | highlightpattern` </strong>`echo ${trntitle}  | highlightpattern ` </td>
<td><div class=\"wordwrap\">${word}<div></td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><a target=\"_blank\" href="$linkpli">Pāḷi</a> 
`[[ $thrulink != "" ]] && echo "<a target=\"_blank\" href="$thrulink">Rus</a>"` 
`[[ $thrulink == "" ]] && [[ $link != "" ]] && echo "<a target=\"_blank\" href="$link">Rus</a>"` 
`[[ $linkthai != "" ]] && echo "<a target=\"_blank\" href="$linkthai">ไทย</a>"` <a target=\"_blank\" href="$linken">Eng</a> 
</td>" | tohtml 

#quote part
echo "<td>" | tohtml 

for i in $indexlist
do
#echo "<strong>$i</strong>"
		for f in $roottext $translation #$variant
        do     
        #echo rt=$roottext
		quote=`nice -19 egrep -A${linesafter} -iE "${i}(:|[^0-9]|$)" $f | grep -v "^--$" | removeindex | clearsed | awk '{print substr($0, index($0, $2))}'  | highlightpattern `
      if [[ "$quote" != "" ]]
then 
[[ "$f" == *"root"* ]] && echo "$quote<br class=\"btwntrn\">" || echo "<p class=\"text-muted font-weight-light\">$quote</p>"
fi
done

echo '<br class="styled">'
done | tohtml 
echo "</td>
<!-- <td><a target=\"_blank\" href=\"https://voice.suttacentral.net/scv/index.html?#/sutta?search=${filenameblock}\">mp3</a></td> -->
</tr>" | tohtml

done
matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`

#Sibbin 999 matches in 444 texts of Pali Suttas
}
#e g for Russian language
elif [[ "$type" == html ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${tempfile}
${table}"`

#${texts}

grepvar=l

function linklist {
#echo -e "Content-Type: text/html\n\n"
#echo $@

#Russian text 
#link ru 
#translatorsname=`echo $tr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

cat $templatefolder/Header.html $templatefolder/ResultTableHeader.html | sed 's/$title/TitletoReplace/g' | tohtml 


uniquelist=`cat $basefile | pvlimit | awk '{print $1}' | awk -F'/' '{print $NF}' | sort -V | uniq`
#| grep "html:"
textlist=$uniquelist

#edit me edn
    for i in $uniquelist
do

    filenameblock=`echo $i |  sed 's/.html//g' | sort -V | uniq `
file=`grep -m1 $filenameblock $basefile`
   # count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l` 
tr=$file

    #roottext=`find $lookup/root -name "*${filenameblock}_*"`
   # translation=`find $lookup/translation/en/ -name "*${filenameblock}_*"`
    #tr=`find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*"`
   # variant=`find $lookup/variant -name "*${filenameblock}_*"`
    
    suttanumber="$filenameblock"
	linkgeneral=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `

linklang=$linkgeneral

roottext=`nice -19 find $lookup/root -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
 
        if [[ "$language" == "Pali" ]]; then
        file=$roottext
        

    elif [[ "$language" == "Russian" ]]; then
        file=$tr
        remtitle=`echo $filenameblock | sed 's/[A-Za-z]//g'`
suttatitle=`grep 'h1' $file | clearsed | xargs | sed 's@'$remtitle'@@g'`
		
	
	   np=`echo $filenameblock | sed 's@\.@_@g'`
    tr=`find $searchdir -name "*${np}-*"`

     thrulink=`echo $tr | sed 's@.*theravada.ru@https://www.theravada.ru@g'`

linklang=$thrulink	
fi

roottitle=`nice -19 grep ':0\.' $roottext | clearsed | awk '{print substr($0, index($0, $2))}' | xargs | egrep -oE "[^ ]*sutta[^ ]*"`

if ls $roottext | egrep -q "sn[0-9]{0,2}.[0-9]*_"
then
roottitle=`nice -19 grep "${suttanumber}," $sntoccsv | awk -F',' '{print $8" "$4}' | sort -V | uniq`
fi
  
 if [[ $filenameblock == *"dn"* ]]
then 
dnnumber=`echo $filenameblock | sed 's/dn//g'`
linklang=`curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep "ДН $dnnumber" | sed 's#href="#href="https://tipitaka.theravada.su#' |awk -F'"' '{print $2}'`
  fi    
        
#translatorsname=`echo $translation | awk -F'/ru/' '{print $2}' | awk -F'/' '{print $1}'`
#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
#linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
linkpli=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli"}' `
linken=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=eng"}' `

linkthai=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/th/siam_rath"}' `

count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile

word=`getwords | grepexclude | xargs | clearsed | sedexpr | highlightpattern`
indexlist=`nice -19 egrep -i $filenameblock $basefile | awk '{print $2}'`

#metaphorindexlist=`cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 

#quote=`nice -19 egrep -ih "${pattern}" $file | clearsed | highlightpattern `
echo "<tr>
<td><a target=\"_blank\" href="$linkgeneral">$suttanumber</a></td>
<td><strong>`echo $roottitle | highlightpattern`</strong>`echo "${suttatitle}" | highlightpattern ` </td>
<td>$word</td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><a target=\"_blank\" href="$linkpli">Pāḷi</a>&nbsp;<a target=\"_blank\" href="$linklang">Рус</a>`[[ $thrulink != "" ]] && [[ "$thrulink" != "$linklang" ]] && echo "&nbsp;<a target=\"_blank\" href="$thrulink">Вар. 2</a>"` `[[ $linkthai != "" ]] && echo "<a target=\"_blank\" href="$linkthai">ไทย</a>"`&nbsp;<a target=\"_blank\" href="$linken">"Eng"</a>
</td>
<td>" | tohtml
nice -19 egrep -A${linesafter} -ih "${pattern}" $file | grep -v "^--$" | clearsed | highlightpattern  | while IFS= read -r line ; do
echo "$line"
echo '<br class="styled">'
done | tohtml


echo "</td>
<!-- <td><a target=\"_blank\" href=\"https://voice.suttacentral.net/scv/index.html?#/sutta?search=${filenameblock}\">mp3</a></td> -->
</tr>" | tohtml

done

matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`
}

fi

function getbasefile {
  
if [[ "$pattern" != *"["* ]] &&  [[ "$pattern" != *"]"* ]];  then
pattern=`echo $pattern | sed 's/е/[ёе]/g'`
fi

grepbasefile | grep -v "^--$" | grepexclude | clearsed | sort -V > $basefile

texts=`awk -F'json|html' '{print $1}' $basefile | sort | uniq | wc -l`
if [[ "$@" == *"-def"* ]] && (( $texts <= 6 ))
then 
grepbasefileExtended | grep -v "^--$" | grepexclude | clearsed | sort -V >> $basefile
fi

linescount=`wc -l $basefile | awk '{print $1}'`
if [ ! -s $basefile ]
then

pattern="`echo $pattern | sed 's/\[ёе\]/е/g'`"
	Erresponse
     rm $basefile
     exit 1
elif [ $linescount -ge $maxmatchesbg ] && [[ "$@" != *"-nbg"* ]];  then  
bgswitch
exit 3
	echo "$@" | sed 's/-oru //g' | sed 's/-oge //g' | sed 's/-ogr //g'   | sed 's/-nbg //g' >> ../input/input.txt
	exit 3
fi

}

rm $basefile > /dev/null 2>&1
getbasefile $@ 
#cleanup in case the same search was launched before
rm ${table} table.html $tempfile $tempfilewords $tempfilewhistory > /dev/null 2>&1

#add links to each file
linklist

genwordsfile

textsqnty=`echo $textlist | wc -w`

pattern="`echo $pattern | sed 's/\[ёе\]/е/g'`"
pattern=$userpattern
title="`echo "$pattern" | sed 's/[[:lower:]]/\U&/'`${addtotitleifexclude} $textsqnty texts and $matchqnty matches in $fortitle $language"
titlewords="`echo "$pattern" | sed 's/[[:lower:]]/\U&/'`${addtotitleifexclude} $uniqwordtotal related words in $textsqnty texts and $matchqnty matches in $fortitle $language"

sed -i 's/TitletoReplace/'"$title"'/g' table.html 
sed -i 's/TitletoReplace/'"$title"'/g' ${table}
sed -i 's/TitletoReplace/'"$titlewords"'/g' ${tempfilewords}

#file=`echo ${table} | awk '{print $NF}' | sed 's/.html//g'`
#mv $file.html 
#file=`echo ${tempfilewords} | awk '{print $NF}' | sed 's/.html//g'`
#mv $file.html ${file}_${textsqnty}-${matchqnty}-${uniqwordtotal}.html

#echo "${fortitle^} $language"

OKresponse


#php -r 'header("Location: ./result/table.html");'


#finalize words file 
oldname=$tempfilewords
tempfilewords=${tempfilewords}_${textsqnty}-${matchqnty}-${uniqwordtotal}.html
#sed -i "s/$oldname/$tempfilewords/g" $table
echo "</tbody>
</table>
<a href='/' id='back'>Main page</a>&nbsp;
<a href='/sc'>Read</a>&nbsp;
<a href='/diff'>SuttaDiff</a>&nbsp;
<a href='/history.php'>History</a>&nbsp;
<a href=\"/result/${tempfilewords}\">Words</a>
" | tohtml
cat $templatefolder/Footer.html | tohtml
mv ./$oldname ./$tempfilewords

#finalize quotes file 
oldname=$table
table=${table}_${textsqnty}-${matchqnty}.html
#sed -i "s/$oldname/$table/g" $tempfilewords
echo "</tbody>
</table>
<a href='/' id='back'>Main page</a>&nbsp;
<a href='/sc'>Read</a>&nbsp;
<a href='/diff'>SuttaDiff</a>&nbsp;
<a href='/history.php'>History</a>&nbsp;
<a href=\"/result/${table}\">Quotes</a>
" >> $tempfilewords
cat $templatefolder/WordsFooter.html >> $tempfilewords
mv ./$oldname ./$table

linenumbers=`cat -n $history | grep daterow | egrep "$pattern" | grep "${fortitle^}" | grep "$language" | awk '{print $1}' | tac`

#grep "$textsqnty" | grep "$matchqnty"

for i in $linenumbers
do 
sed -i "${i}d" $history 
done 

if [[ $excludepattern != "" ]]
then
pattern="$pattern exc. ${excludepattern,,}"
fi 

echo -n "<!-- begin $userpattern --> 
<tr><td><a class=\"outlink\" href=\"./result/${table}\">${userpattern}</a></td><th>$textsqnty</th><th>$matchqnty</th><th><a class=\"outlink\" href=\"./result/${tempfilewords}\">$uniqwordtotal</a></th><td>${fortitle^}</td><td>$language</td><td class=\"daterow\">`date +%d-%m-%Y`</td><td>`ls -lh ${table} | awk '{print  $5}'`</td><td>" >> $history

if [[ "$type" == json ]]; then
echo -n "<br>`cat $tempfilewhistory | grep href | highlightpattern | xargs`" >> $history
elif  [[ "$language" == Thai ]] && [[ "$fortitle" == *"Suttanta"* ]]
then
echo -n "`cat $basefile | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' | sed 's/.html//g' | awk -F'_' '{print \"<a target=_blank href=https://suttacentral.net/"$1"/th/siam_rath>"$1"</a>\"}' | sort -u | sort -V | xargs`" >> $history
else
echo -n "`cat $basefile | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' | sed 's/.html//g' | awk -F'_' '{print \"<a target=_blank href=https://suttacentral.net/"$1">"$1"</a>\"}' | sort -u | sort -V | xargs`" >> $history
fi

echo "</td></tr>
" >> $history

#rm $basefile $tempfile $tempfilewhistory > /dev/null 2>&1

#echo thlnk=$linkthai fnb=$filenameblock
echo "<script>window.location.href=\"./result/${table}\";</script>"

exit 0

if [[ "$language" != "Pali" ]]; then
#echo "<script>location.assign('_self');</script>"
#echo "<script>window.open('./result/${table}', '_self');</script>"

elif  [[ "$language" == "Pali" ]]
then 
wordsresponse
quoteresponse
fi




echo ""\$forredirect = \"./result/${table}\";"




file=`echo ${table} | awk '{print $NF}' | sed 's/.html//g'`
diact2normal
newfilename=${newfilename}_t${textsqnty}-m${matchqnty}.html
mv $file.html ${newfilename}
file=`echo ${tempfilewords} | awk '{print $NF}' | sed 's/.html//g'`
diact2normal
newfilename=${newfilename}_t${textsqnty}-m${matchqnty}-w${uniqwordtotal}.html
mv $file.html ${newfilename}

#orig suttatitle block
    if [[ "$language" == "Pali" ]]; then
        file=$roottext
        suttatitle=`nice -19 grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs | egrep -oE "[^ ]*sutta[^ ]*"`

    elif [[ "$language" == "English" ]]; then
        file=$translation
        if [[ "$file" == *"/dn/"* ]] || [[ "$file" == *"/mn/"* ]] 
        then 
        suttatitle=`nice -19 grep ':0\.2' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `
elif [[ "$file" == *"/an/"* ]] 
        then 
        suttatitle=`nice -19 grep ':0\.4' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs ` 
     
    elif [[ "$file" == *"/dhp/"* ]] 
        then 
        suttatitle=`nice -19 grep ':0\.4' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs ` 
        else
        suttatitle=`nice -19 grep ':0\.3' $file | clearsed | awk '{print substr($0, index($0, $2))}' | sort -V | uniq | xargs `
        fi 

    fi 
    
    
    
    
    function highlightpattern {
if [[ "$pattern" == *"|"* ]]
then
echo $pattern | sed "s/|/ /g"
else 
sed "s@$pattern@<b>&</b>@gI"
fi
}

echo $pattern | awk -F'|' '{for(i=1;i<=NF;i++) {print "sed \"s@"$i"@<b>&</b>@gI\" \|"}}'
awk: cmd. line:1: warning: escape sequence `\|' treated as plain `|'
sed "s@apapp@<b>&</b>@gI" |
sed "s@djfj@<b>&</b>@gI" |
sed "s@pppfffp@<b>&</b>@gI" 