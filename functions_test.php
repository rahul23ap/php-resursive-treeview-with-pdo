<?php

function callfab($no){
	$first = 0;
	$second = 1;
	echo $first ."<br/>";
	echo $second ."<br/>";
	
for($n=2;$n<$no;$n++){
	$third = $first + $second;
	echo $third ."<br/>";
	$first = $second;
	$second = $third;
		
}
}
callfab(10);

function isPrimeNumber($prime){
	
	for($i=2;$i<$prime;$i++)	{
		
		if($prime % $i==0){
			return 0;
		};
		
	}
	return 1;
	
	
}

$a = isPrimeNumber(9);
if($a==0){
	echo "it is not prime number";
}else{
	echo "it is prime number";
}

function IsPrime($n)
{
 for($x=2; $x<$n; $x++)
   {
      if($n %$x ==0)
	      {
		   return 0;
		  }
    }
  return 1;
   }
$a = IsPrime(9);
if ($a==0)
echo 'This is not a Prime Number.....'."\n";
else
echo 'This is a Prime Number..'."\n";