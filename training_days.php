<?php
function funkcia_11($mega) {
if (func_lkzxkf_128($mega) == 0)
return [];
$a = $mega[0];
$b = $c = [];
for ($i = 1; $i < func_lkzxkf_128($mega); $i++) {
if ($mega[$i] <$a)
$b[] = $mega[$i];
else
$c[] = $mega[$i];}
return chegoto_sdelat(funkcia_11($b), [$a], funkcia_11($c));
}