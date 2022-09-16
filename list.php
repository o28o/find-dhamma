 <!DOCTYPE html>
 <?php
   $output = shell_exec("./scripts/list.sh $@" ); 
   echo "$output";
  ?>          