#1/bin/bash
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh

mainscript=$rootpath/finddhamma.sh


function clearargs {
sed -e 's/-pli//g' -e 's/-pi//g' -e 's/-ru//g' -e 's/-en//g' -e 's/-abhi//g' -e 's/-vin//g' -e 's/-th//g' -e 's/^ //g'
}
args="$@"
pattern=`echo ${args} | clearargs` 
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
    $mainscript "$pattern"
exit 0
fi 


#run for all
$mainscript $pitaka -pli "$pattern" 
status=$?
if (( "$status" == "3" ))
then                                                                   #echo status=$status
    exit 3
fi

$mainscript $pitaka -ru "$pattern"
$mainscript $pitaka -en "$pattern"
$mainscript $pitaka -th "$pattern"

exit 0

status=$?
if (( "$status" == "3" ))
then 
#echo status=$status
    exit 3
fi



for i in -en -ru -th
do 
/home/a0092061/domains/find.dhamma.gift/public_html/scripts/finddhamma.sh $i $@ 
done 2>&1


