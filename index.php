<?php
class KillingGame
{
	private $people;
	private $count;
	private  $holder;

	function __construct($people)
	{
		$this->people = range(1,$people);	
		$this->count= count($people);
		$this->holder=0;//the first person with the knife
	}
	
	private function killEmAll($p)	{
		if(count($p)==1){//base case
			return $p[0];
		}else{
				
			if($p[$this->holder]==max($p)){//If at the end of circle, kill the first person and pass to the second(new first)
				$killed= array_splice($p,0,1);
				echo "<h5>Knife passed to person ". max($p) .". Person ".max($p) . " Has killed person " . $killed[0]. "</h5> Remeaining: ". count($p). json_encode($p)." </br>" ;
				$this->holder=0;
			}else{				
				$killed= array_splice($p, $this->holder+1,1);
				echo "<h5>Knife passed to person ".  $p[$this->holder] .". Person ".$p[$this->holder] ." Has killed person " . $killed[0]. "</h5>"."Remeaining: ". count($p). json_encode($p);
				$this->holder=$this->holder>=(count($p)-1)?0:$this->holder+1;
			}
			return $this->killEmAll($p);
		}
	}

	public  function kill()
	{
		return $this->killEmAll($this->people);
	}
}

$killingGame= new KillingGame(100);
$lastManStanding=$killingGame->kill();
echo "<strong>Last Man Standing is $lastManStanding";