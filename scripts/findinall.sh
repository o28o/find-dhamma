#1/bin/bash
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh


function clearargs {
sed -e 's/-pli //g' -e 's/-pi //g' -e 's/-ru //g' -e 's/-en //g' -e 's/-abhi //g' -e 's/-vin //g' -e 's/-th //g' -e 's/^ //g' -e 's/-kn //g' | sed 's/-oru //g' | sed 's/-ogr //g' | sed 's/-oge //g'| sed 's/-nbg //g'
}



args="$@"
pattern=`echo ${args} | clearargs` 


if [[ "$@" == *"-nbg"* ]];  then 
nbg="-nbg"
else 
nbg=
fi

mainscript="nice -19 $rootpath/finddhamma.sh -ogr $nbg"

#check if not empty
if [[ "$pattern" != "" ]]
then
    echo -e "${pattern^} in "
elif [[ "$args" == "" ]]
then
    echo Empty pattern
    exit 1
fi 

#check suttanta vinatya or abhidhamma
if [[ "$@" =~ "-vin" ]]
then
    echo "Vinaya<br>"
    pitaka="-vin"
elif [[ "$@" =~ "-abhi" ]]
then
    echo "Abhidhamma<br>"
    pitaka="-abhi"
elif [[ "$@" =~ "" ]]
then
    echo "Suttanta<br>"

fi 

#check single language
if [[ "$@" =~ "-en" ]] || [[ "$@" =~ "-ru" ]] || [[ "$@" =~ "-pli" ]] || [[ "$@" =~ "-th" ]]
then
    #echo "single language mode<br>"
$mainscript $pitaka "$pattern"
exit 0
fi 

echo $mainscript $pitaka "$pattern" 
#run for all
$mainscript $pitaka "$pattern" 
status=$?
if (( "$status" == "3" ))
then                                                                   #echo status=$status
    exit 3
fi

$mainscript $pitaka -ru "$pattern"
$mainscript $pitaka -en "$pattern"
$mainscript $pitaka -th "$pattern"
 
exit 0
