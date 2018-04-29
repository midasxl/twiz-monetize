<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Twiz sheet</title>
        <link rel="stylesheet" media="screen" href="../assets/css/ui-theme/jquery-ui.min.css" /><!-- jquery theme -->
        <link rel="stylesheet" media="screen" href="../assets/css/dataTables.jqueryui.css" /><!-- datatables css integration file -->
        <link rel="stylesheet" media="screen" href="../assets/css/twiztooltip.css" /><!-- rulesets for tooltip on datatable columns -->
        <link rel="stylesheet" media="screen" href="../assets/css/summary.css" /><!-- rulesets for summary sheet -->
          </head>
<body>
<?php
$source = '../sample/latest.xml';
$xmldata = simplexml_load_file($source);
// format date for header
$headerdate			= $xmldata->racedata[0]->race_date[0];
$headerdate1		= date_create($headerdate);
$headerdate2		= date_format($headerdate1,"M d, Y");
// get full track name from array; pass in abbreviation
include("switch.php"); // return $trackloc variable with full track name as value
/*echo '<div id="card-header"><img src="../assets/img/logo-twiz.png" /><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$trackloc.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
'.$headerdate2.'</h1><a class="head-anchor equi" href="http://www.trackmaster.com/cgi-bin/axprodlist.cgi?tpp" target="_blank">Buy TRACKMASTER Printed PDF</a></div>';*/
//echo 'Filter: Pace=ITM Races= Within2F,All tracks,Todays surf';
echo '<div>
<a href="https://www.thoroughwiz.com/account.php"><img src="../assets/img/logo-twiz.png" /></a>
<h2>'.$trackloc.'</h2><br>
<a style="color:BLACK;" href="" id="printMe">Print This Card</a> ';

if (isset($_POST['maxRaces'])){
    echo '<select style="position:absolute;right:5px;bottom:5px;">';
    foreach ($_POST as $key => $value) {
        echo "<option>$key&nbsp;&nbsp;$value</option>";
    }
    echo '</select>';
}
echo '</div>';

$anchorNum = 0;
// count number of <racedata> nodes in the entire document to get number of races for the jump anchors
$xmlDoc = new DOMDocument();
$xmlDoc->load($source);
$raceNum = $xmlDoc->getElementsByTagName("racedata");
$numOfraces = $raceNum->length;
    $numOfraces	= $raceNum->length;
$i = 0; // generic counter
// loop time
foreach($xmldata->children() as $racedata) { // gets all <racedata> children of the root element <data>
    // get and format date for each race header
    $formatme1 			    = $racedata->race_date;
    $formatme2			    = $horsedata->$ppdata->racedate[0];
    $days2              = (strtotime($formatme1) - strtotime($formatme2)) / (60 * 60 * 24);
    $date1				      = date_create($formatme1);
    $race_date 			    = date_format($date1,"m-d-y");
    $race_date_header 	= date_format($date1,"mdy");
    $equilinkracedate2 	= date_format($date1,"m/d/y");
    $anchorNum 			    = $anchorNum + 1;
    $tsurf              = $racedata->surface;
    if ($tsurf<> "T" AND $tsurf<>  "I" AND $tsurf<> "C" AND $tsurf<> "O" ){
        $tsurf="D";
    } ELSE {
        $tsurf="T";
    }
    $todaysclass        = $racedata->todays_cls;
    $aclr               = $racedata->race_text;
    if (preg_match('/MAIDENS/',$aclr))
        echo '<font color="red">';
    if (preg_match('/turf/',$aclr) OR preg_match('/TURF/',$aclr) OR preg_match('/Turf/',$aclr))
        echo '<font color="GREEN">';
    if (preg_match('/MAIDENS/',$aclr) AND preg_match('/turf/',$aclr))
        echo '<font color="ORANGE">';
    // Create race header
$raceinfotext=$racedata->race_text;
if (strpos($raceinfotext, 'SIMULCAST') !== false){
    goto sc;
}
    echo '<div>
	<br>
    <a	name="'.$anchorNum.'" class="head-anchor" href="http://www.equibase.com/static/entry/'.$racedata->track.$race_date_header.'USA-EQB.html#RACE'.$racedata->race.'" target="_blank">Race '.$racedata->race.', Class of	'.$racedata->todays_cls.' @	'.$racedata->track.' on	'.$race_date.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Going	'.$racedata->dist_disp.' over the '.$tsurf.'</a>
	<br>
 <br>'.substr($racedata->race_text,0,50).'<br>Post Time: '.$racedata->post_time.'
   
	</div>
 
	<div>

	<p>
	<a  class="r-data" href= "http://www.equibase.com/static/chart/summary/'.$racedata->track.$race_date_header.'USA'.$racedata->race.'-EQB.html " target="_blank">Results </a> | 
	<a  class="r-data" href= "http://www.equibase.com/premium/eqbPDFChartPlus.cfm?RACE='.$racedata->race.'&BorP=P&TID='.$racedata->track.'&CTRY=USA&DT='.$equilinkracedate2.'&DAY=D&STYLE=EQB" target="_blank">Charts</a> | 
<a href="https://ko-fi.com/M4M6BWTB"target="_blank">Buy Us a Coffee</a>
	</p>';
    if (preg_match('/MAIDENS/',$aclr))
        echo '</font>';
    if (preg_match('/turf/',$aclr) OR preg_match('/TURF/',$aclr) OR preg_match('/Turf/',$aclr))
        echo '</font>';
    if (preg_match('/MAIDENS/',$aclr) AND preg_match('/turf/',$aclr))
        echo '</font>';
      		echo '<p>Jump	to race:&nbsp;&nbsp;';
	for ($x = 1; $x <=	$numOfraces; $x++) {
		echo "<a href='#".$x."'>".$x."</a>&nbsp;&nbsp;";
    }
	echo '</p></div>';
    	//	create table and thead tag and contents
	echo '

        <table class="display table'.$i.'">
    <thead><tr>
        <th>Prg#</th>
        <th>Twiz</th>
        <th>Styl</th>

       
       
        
        <th>Horses Name | Comment [Misty_Speed-Fig] **left= oldest to right= most recent, <b>(Things to look for)</b>.</th>
 <th>MLOdds</th>
    </tr></thead>
    <tbody>';

    $jockperc           =0;
    $trainerperc        =0;
    $horseperc          =0;
    $raceperc           =0;
    $workperc           =0;
    $classratingavg     =0;
    $speedfigureavg     =0;
    $pacefigure2avg     =0;
    $pacefigure2avg4    =0;
    $pacefigureavg3     =0;
    $pacefigureavg      =0;
    $qdisp              =0;
    $hdisp              =0;
    $sdisp              =0;
    $fdisp              =0;
    $abytavg            =0;
$fclass=$racedata->todays_cls;
    $lookfor="";
    foreach($racedata->horsedata as $horsedata) { // gets <horsedata> node
        $lines          =0;
        $jockwins       =0;
$jockshows       =0;
        $jockplaces     =0;
        $jockstarts     =0;
        $trainerstarts  =0;
 $trainershows  =0;
        $trainerwins    =0;
        $trainerplaces  =0;
$trainerroi =0;
        $horsestarts    =0;
        $horsewins      =0;
        $horseplaces    =0;
        $horseearnings  =0;
        $horseshows     =0;
        $apv            =0;
        $horseperc      =0;
        $jockperc       =0;
 $jockroi       =0;
        $raceprc        =0;
        $trainerperc    =0;
$maybe=0;
     
        foreach($horsedata->jockey->stats_data->children() as $jockeydata) {
            $jockstarts=$jockstarts+$jockeydata->starts;
            $jockwins=$jockwins+$jockeydata->wins;
            $jockplaces=$jockplaces+$jockeydata->places;
$jockshows=$jockshows+$jockeydata->shows;
 $jockroi=$jockroi+$jockeydata->roi;
        }
        foreach($horsedata->jockey->stats_data->children() as $stat) {
            if((string) $stat['type'] == 'LAST30'){
               $jockstarts=$jockstarts+$stat->starts;
               $jockplaces=$jockplaces+$stat->places;
$jockshows=$jockshows+$stat->shows;
               $jockwins=$jockwins+$stat->wins;
	       $jockroi=$jockroi+$stat->roi;
            }
        }
        foreach ($horsedata->trainer->stats_data->children() as $trainerdata) {
            $trainerstarts=$trainerstarts+$trainerdata->starts;
            $trainerwins=$trainerwins+$trainerdata->wins;
$trainershows=$trainershows+$trainerdata->shows;
            $trainerplaces=$trainerplaces+$trainerdata->places;
$trainerroi=$trainerroi+$trainerdata->roi;
        }
        foreach($horsedata->trainer->stats_data->children() as $stat) {
            if((string) $stat['type'] == 'LAST30'){
               $trainerstarts=$trainerstarts+$stat->starts;
               $trainerplaces=$trainerplaces+$stat->places;
$trainershows=$trainershows+$stat->shows;
               $trainerwins=$trainerwins+$stat->wins;
	       $trainerroi=$trainerroi+$stat->roi;
            }
        }
        foreach ($horsedata->stats_data->children() as $newhorsedata) {
            $horsestarts=$horsestarts+$newhorsedata->starts;
            $horsewins=$horsewins+$newhorsedata->wins;
            $horseplaces=$horseplaces+$newhorsedata->places;
            $horseshows=$horseshows+$newhorsedata->shows;
$horseroi=$horseroi+$newhorsedata->roi;
            $horseearnings=$horseearnings+$newhorsedata->earnings;
        }
        foreach($horsedata->stats_data->stat as $stat) {
            if((string) $stat['type'] == 'THIS_YEAR'){
               $tystarts=$tystarts+$stat->starts;
               $tyshows=$tyshows+$stat->shows;
               $tywins=$tywins+$stat->wins;
$tyroi=$tyroi+$stat->roi;
               $tyearnings=$tyearnings+$stat->earnings;
            }
        }
        foreach($horsedata->stats_data->stat as $stat) {
            if((string) $stat['type'] == 'LAST_YEAR'){
             $lystarts=$lystarts+$stat->starts;
               $lyshows=$lyshows+$stat->shows;
               $lywins=$lywins+$stat->wins;
$lyroi=$lyroi+$stat->roi;
               $lyearnings=$lyearnings+$stat->earnings;
               }
        }
        $tstarts=$tystarts;
        $tshows=$tyshows;
        $tearnings=$tyearnings;
        $twins=$tywins;
$troi=$troi;
        if ($tystarts <6){
            $tstarts=$tystarts+$lystarts;
$troi=$tyroi+$lyroi;
            $tshows=$tyshows+$lyshows;
            $tearnings=$tyearnings+$lyearnings;
            $twins=$tywins+$lywins;
        }
        $tc1=$twins-$tshows;
        $tc2=$twins;
        if($tc1 <=0){
            $tc1=1;
        }
        if($tc2 <= 0){
            $tc2=1;
        }
        if($tc1 <= 0){
            $apv=$tearnings/$tc2;
        }else{
            $apv=$tearnings/$tc1;
        }
        $apv=$apv/10000;
        if($trainerstarts <=0){
            $trainerstarts=1;
        }
        if($jockstarts <=0){
            $jockstarts=1;
        }
        if($horsestarts <=0){
            $horsestarts=1;
        }
$jockroi=($jockroi/2)/10;
$trainerroi=($trainerroi/2)/10;
$troi=($troi/2)/10;
        $jockperc			= (((($jockwins+$jockplaces+$jockshows)/3)/$jockstarts)*100);
        $trainerperc		= (((($trainerwins+$trainerplaces+$trainershows)/3)/$trainerstarts)*100);
        $horseperc			= (((($horsewins+$horseplaces)/2)/$horsestarts)*100);
        $connections		= ($jockperc+$trainerperc)/2;
        // get and calculate dollar amount instead of odds
        $mornodds 		    = (explode("/",$horsedata->morn_odds,2));
        if($mornodds[1] <=0){
            $dollarvalue 	= $mornodds[0] ;
        }else{
            $dollarvalue 	= $mornodds[0] / $mornodds[1];
        }
        //http://www.equibase.com/premium/eqbPDFChartPlus.cfm?RACE=11&BorP=P&TID=AQU&CTRY=USA&DT=04/06/2013&DAY=D&STYLE=EQB
        $weighttoday=$horsedata->weight;
        // get and format last race data for equibase link
                
             $myvalue2 = $horsedata->jockey->jock_disp;
$arr2 = explode(' ',trim($myvalue2));
        
        $strj = substr( $horsedata->jockey->jock_disp, 0, strpos($horsedata->jockey->jock_disp, ' ', 5) );
        $strt = substr( $horsedata->trainer->tran_disp, 0, strpos($horsedata->trainer->tran_disp, ' ', 5) );
        if ($strj==""){
            $strj =$horsedata->jockey->jock_disp;
        }
        if ($strt==""){
            $strt =$horsedata->trainer->tran_disp;
        }
        $meds=$horsedata->med;
        $blinks=$horsedata->equip;
        $tsire=$horsedata->sire->tmmark;
        if($tsire<>"" AND $surface=="T"){
            $lookfor=$lookfor."<b> Turf sire </b>";
        }
        $aelg=$horsedata->ae_flag;
        if($aelg<>""){
            $lookfor=$lookfor."<b> AE listed </b>";
        }
        $workperc=50+$horsedata->workoutdata->worktext[0];
        $raceperc=50+$horsedata->workoutdata->worktext[0];
        $rank1=$horsedata->workoutdata->rank_group[0];
        if($rank1 <=0){
            $rank1=1;
        }
        $workperc=(100-( ($horsedata->workoutdata->ranking[0]/$rank1)*100))+($horsedata->workoutdata->rank_group[0]/10);
        if($horsedata->workoutdata->ranking[0] == $horsedata->workoutdata->rank_group[0]){
            $workperc=50+$horsedata->workoutdata->worktext[0];
        }
        if($horsedata->workoutdata->rank_group[0] == 1){
            $workperc=50+$horsedata->workoutdata->worktext[0];
        }
        $wkdays=$horsedata->workoutdata->days_back[0];
        $cw="";
        if($wkdays=="" or $wkdays<=0){
            $wkdays=0;
        }

$wkfurlongs=$horsedata->workoutdata->worktext[0];
$wkrank=$horsedata->workoutdata->ranking[0];
$wkgroup=$horsedata->workoutdata->rank_group[0];
$wktext=$horsedata->workoutdata->worktext[0];
if($wkgroup==""){
$wktext="N/A";
$wkrank=0;
$wkgroup=0;
$wkfurlongs=0;
}
if (((int)$wktext[0]==5 and $wkdays<17) OR ($workperc>=80 and $wkdays<10)){
	$lookfor=$lookfor."<b> Sharp Work </b>";
}

if ($blinks<>"" ){
$lookfor=$lookfor."<b> Blinker change </b>";
}
        
if ( $meds<>"N"){
$lookfor=$lookfor."<b> 1st or 2nd Lasix </b>";
}
        $todaysclass = $racedata->todays_cls;
        $todaysdist=($racedata->distance);
        // the following can be set like this: $first = $second = $third = $fourth = 0;
        $classrating_flag=0;
        $speedfigure_flag=0;
        $posttime_flag=0;
        $pacefigure_flag=0;
        $pacefigure2_flag=0;
        $total_a=0;
        $total_b=0;
        $total_c=0;
        $total_d=0;
        $total_e=0;
        $abyt3=0;
        $lines2=0;
        $quarter=0;
        $half=0;
        $stretch=0;
        $finish1=0;
        $q=0;
        $h=0;
        $s=0;
        $f=0;
        $qlb=0;
        $hlb=0;
        $slb=0;
        $flb=0;
        $fs=0;
$combinedc=0;
$checklast=999;
$firstrow=0;
$finally=0;
$n1=0;
$n2=0;
$n3=0;
$n4=0;

 $add20=0;
 $countadd=0;

     

        
 foreach($horsedata->ppdata as $ppdata) { // gets <ppdata> node

        $checkep=(int)$ppdata->pacefigure;
$checklp=(int)$ppdata->pacefigur2;


 $checkclass2=(int)$ppdata->classratin;
   $checkspeed=(int)$ppdata->speedfigur;
 
     if( $checkspeed == 0 ){
	goto e;
}
     $comment=$ppdata->shortcomme;
 

   $raceperc=$ppdata->speedfigur;
            $raceperc=(int)($raceperc);
        $formatme2			= $ppdata->racedate;
        $date2				= date_create($formatme2);
        $equilinkracedate 	= date_format($date2,"m/d/y");
 $days = (strtotime($formatme1) - strtotime($formatme2)) / (60 * 60 * 24);
		if ($firstrow==0){
            $equilink = "<a href='http://www.equibase.com/premium/eqbPDFChartPlus.cfm?RACE=".$ppdata->racenumber."&BorP=P&TID=".$ppdata->trackcode."&CTRY=".$ppdata->country."&DT=".$equilinkracedate."&DAY=D&STYLE=EQB' target='_blank'>".$equilinkracedate."</a>";
        $scr="";
        if($ppdata->positionfi <=0 or $ppdata->positionfi >=50 or $ppdata->positionfi ="" ){
            $scr="S";
        }
$days2=round($days);
       
$race2=$raceperc;

$firstrow=999;
		}
$formatme3			= $ppdata->racedate;
$daystoday = (strtotime($formatme1) - strtotime($formatme3)) / (60 * 60 * 24);
     $dayslr=$daystoday;

     $daycnt=$daystoday;
 if($daystoday>=1000){
            $daystoday=$wkdays;
     $daycnt=0;
     $dayslr=0;
        }
            $speedr=$ppdata->speedfigur;
			if ($checklast==999){
			 $speedfirst=$ppdata->speedfigur;
			 $classfirst=$ppdata->classratin;
			 $checklast=0;
			}
             
                   if($countadd==1 and (int)$classfirst <  (int)$fclass){
 $lookfor=$lookfor."<b> Up in class </b>";
 }
                     if($countadd==1 and (int)$classfirst >  (int)$fclass){  /// up down and trbl not working and add last 3 speeds up
 $lookfor=$lookfor."<b> Down in class </b>";
 }
            $speedr=(int)$speedr;
            $foreign=$ppdata->foreignspe;
            if (($ppdata->foreignspe) > ($foreign=$ppdata->speedfigur)){
                $speedr=$foreign -20;
            }
            $finishcheck=$ppdata->positionfi;
            $distof=($ppdata->distance);
            $surface=$ppdata->courseid;
            if ($surface<> "T" AND $surface<> "I" AND $surface<>"C" AND $surface<>"O"){
                $surface="D";
            } ELSE {
                $surface="T";
            }
            if($ppdata->pulledofft <> 0){
                $surface="D";
            }
     
      $countadd=$countadd+1;
     
           
                
     
     $myvalue1 = $ppdata->jockdisp;
$arr1 = explode(' ',trim($myvalue1));

     if($countadd==1 and  ($arr1[0] <> $arr2[0])){
 $lookfor=$lookfor."<b> Jockey Change</b>";
      
       
 }
         if($countadd==1 and ($ppdata->horseclaim <> 0)){
 $lookfor=$lookfor."<b> Trainer Change</b>";
 }
                 if($countadd==1 and $ppdata->distance <>"" and ($ppdata->distance < $todaysdist-150 or $ppdata->distance > $todaysdist+150) ){
 $lookfor=$lookfor."<b> Distance change </b>";
 }
   

           

                    if ($tsurf <> $surface and $countadd==1 ){  //Is surface the horse ran on the same as today
                       $lookfor=$lookfor."<b> Surface change </b>";
                    }
 $qlb=($ppdata->lenback1)/100;
            $hlb=($ppdata->lenback2)/100;
            $slb=($ppdata->lenbackstr)/100;
            $flb=($ppdata->lenbackfin)/100;
            $qlb=intval($qlb);
            $hlb=intval($hlb);
            $slb=intval($slb);
            $flb=intval($flb);
            $fs=$ppdata->fieldsize;
			// quarter
$quarter = ($qlb+$ppdata->position1)/2;
// half
$half = ($hlb+$ppdata->position2)/2;
// stretch
$stretch =($slb+$ppdata->positionst)/2;
// finish
$finish1 = ($flb+$ppdata->positionfi)/2;
$fs=$ppdata->fieldsize;
if($fs<=0){
	goto c;
}

if ($quarter <=0){
$quarter=0;
}
if ($half <=0){
$half=0;
}
if ($stretch <=0){
$stretch=0;
}
if ($finish1 <=0){
$finish1=0;
}
$c1=$a-(($quarter/$fs)*100);
$c2=$a-(($half/$fs)*100);
$c3=$a-(($stretch/$fs)*100);
$c4=$a-(($finish1/$fs)*100);
if($finish<=3){
$n1=$n1+$c1;
$n2=$n2+$c2;
$n3=$n3+$c3;
$n4=$n4+$c4;
}
$numbers = array_unique(array($c1,$c2));
// rsort : sorts an array in reverse order (highest to lowest).
 rsort($numbers);
 //echo 'Highest is -'.$numbers[0].', Second highest is -'.$numbers[1];
$numbers1 = array_unique(array($c3,$c4));
// rsort : sorts an array in reverse order (highest to lowest).
 rsort($numbers1);
 //echo 'Highest is -'.$numbers[0].', Second highest is -'.$numbers[1];
$finish=$ppdata->positionfi;
if($ppdata->leadertim2 <=0 or $ppdata->leadertime<=0){
    goto nofigs;
}
            $addtospeed      = ((((int)$ppdata->leadertim2-(int)$ppdata->leadertime)+(int)$ppdata->horsetime2)-67);
   
     nofigs:
           // $classratingvalue 		= $ppdata->classratin; //ADDED
          // $ppdata->winnersspe
                      $classratingvalue 		=   (int)$ppdata->speedfigur + (((int)$ppdata->complinele)/100)+(((int)$ppdata->lenbackfin)/100);
    
   $posttimeoddsvalue=  $ppdata->posttimeod;
    
         
             $pacefigurevalue 		= $ppdata->pacefigure; //ADDED
            $pacefigure2value 		= $ppdata->pacefigur2; //ADDED
            $foreign                = $ppdata->foreignspe;
            $turffigurevalue 		= $ppdata->turffigure; //ADDED
                $speedfigurevalue 		=((((( (((100+(43.20 - ($ppdata->leadertim2))*10)-$half))-( (((100+(43.20 - ($ppdata->leadertim2))*10)-$half))-(int)$classratingvalue)))-$posttimeoddsvalue-$dollarvalue))+(((int)$ppdata->speedfigur)/10));
     //(int)$ppdata->speedfigur
            //$speedfigurevalue 		=((((int)$ppdata->speedfigur-((int)$ppdata->speedfigur-(int)$classratingvalue)))-$posttimeoddsvalue-$dollarvalue)+10;
            //added this line
            $foreign = $foreign -20;
            if($comment <>"null" ){
                $comment=$comment;
            }ELSE{
                $comment=$horsedata->ppdata->shortcomme;
            }
     
   $bld="";

   $bld4="";

 
$mistySspeed=round($speedfigurevalue,1);
   if ($mistySspeed >= $fclass){
	   $bld='<B>';
	   $bld4='</b>';
   }
//$checkclass2.$bld2.'-'.$bld3.$checkspeed
 $lookfor=' [ '.$bld.$mistySspeed.$bld4.' ] '.$comment.' | '.$lookfor;
if($countadd==1){
    $mistySspeed1=$mistySspeed;
}
$bld="";
   $bld2="";
 $bld3="";
   $bld4=""; 
            $a = $classratingvalue ;
            $classrating_flag++;
            $b = $pacefigurevalue;
            $pacefigure_flag++;
            $c = $pacefigure2value;
            $pacefigure2_flag++;
            $d = $speedfigurevalue;
            $speedfigure_flag++;
            $e = $posttimeoddsvalue;
            $posttime_flag++;
            $total_a += $a; // class rating
            $total_b += $b; // pace1
            $total_c += $c; // pace2
            $total_d += $d; // speed figure
            $total_e += $e;
            $lines=$lines+1;// we processed a race so count it
 b: //for whatever reason we skipped processing a time the horse ran


     
 if($countadd==1){
 $odds1=intval($ppdata->posttimeod);
 }
 if($countadd==2){
 $odds2=intval($ppdata->posttimeod);
 }
 if($countadd==3){
 $odds3=intval($ppdata->posttimeod);
 }
 if ($odds1==0){
	 $odds1=100;
 }
  if ($odds2==0){
	 $odds2=100;
 }
  if ($odds3==0){
	 $odds3=100;
 }
c:
  $combinedc=$combinedc+$numbers[0];
$combinedc=$combinedc+$numbers1[0];
e:
        } // end $horsedata as $ppdata loop
$rsty="";
$rstc=round(max($pacefigureavg+$n1,$pacefigure2avg+$n2,$pacefigureavg3+$n3,$pacefigure2avg4+$n4));
$n1=round($pacefigureavg+$n1);
$n2=round($pacefigure2avg+$n2);
$n3=round($pacefigureavg3+$n3);
$n4=round($pacefigure2avg4+$n4);
if($rstc==$n1){
$rsty="E/P";
}
if($rstc==$n2){
$rsty="E__";
}
if($rstc==$n3){
$rsty="_P_";
}
if($rstc==$n4){
$rsty="__S";
}
if ($speedfigure_flag<=0){
$classrating_flag=1;
$speedfigure_flag=1;
$pacefigure_flag=1;
$pacefigure2_flag=1;
$speedfigure_flag=1;
}
$combinedc=($combinedc/10)*($speedfigure_flag/10);
        $classratingavg 	= ($total_a / $classrating_flag);
	
        $combinedc			=($combinedc/$speedfigure_flag);
        $pacefigureavg	 	= ($total_b / $pacefigure_flag);
        $pacefigure2avg 	= ($total_c / $pacefigure2_flag);
        $speedfigureavg 	= ($total_d / $speedfigure_flag);

        $abytavg            = $abyt3/$speedfigure_flag;
		$pacefigureavg3     = (($pacefigureavg*2)+$pacefigure2avg)/3;
        $pacefigure2avg4    = (($pacefigure2avg*2)+$pacefigureavg)/3;
		d:
        $averagepace        = ($pacefigureavg+$pacefigure2avg)/2 ;

        $jockperc           = ($jockperc/2)+100;
        $trainerperc        = ($trainerperc/2)+100;
        $horseperc          = ($horseperc/2)+100;

if($rsty==""){
$rsty="N/A";
}
$combinedc2=$combinedc;

$angle=0;
$add20= 0;
 $yes="";
 if($odds1 < $odds2 AND $odds2 < $odds3 ){
	 $add20= 1;  //not sure how much value to give this
	 $lookfor=$lookfor."<b> odds lower last 3 </b>";
 }
 	  if ($days2>28 and $days2<=90)  {  
$lookfor=$lookfor." <b>Short Rest</b> ";
 }
  if ($days2>90)  {  
$lookfor=$lookfor." <b>Long Rest</b> ";
 }
$days22=$days2/5;
if ($wkdays <= $days22 ){
  $days22=$wkdays;
}
if($workperc<=1 or $workperc==50){
$workperc=$race2;
}
$combinedc3=$combinedc2;
        $daycnt=$days2;
if($days2 >=$wkdays){
    $daycnt=$wkdays;
}
 
 if ($lookfor<>""){
     $lookfor='<b> ( </B>'.$lookfor.'<b> ) </b>';
 }
$dollarvalue1=$dollarvalue;
 
//ACTUAL MATH OF FIGURE

$somefig1=$add20;

//All Races unless the horse was in the very back of the filed at the finish.

$somefig1=round($speedfigureavg,1);

//(100-$dollarvalue)



//Somefig1 is the TWIZ Rank.

echo '<tr><td>'.$horsedata->program.'</td><td>'.number_format($somefig1, 1, '.', '').'</td><td>'.$rsty.'</td><td>'.$horsedata->horse_name.' '.$lookfor.' </td><td>'.money_format("$%i", $dollarvalue1).'</td></tr>';
$yes="";
        $lookfor="";
		
		
		

	} // end $racedata as $horsedata loop
	echo '</tbody>

   </table>';
	$i++; // increment our counter
sc:
} // end $xmldata as $racedata loop
?>
<script src="../assets/js/jquery-1.11.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.jqueryui.js"></script>
<script src="../assets/js/natural.js"></script>
<script>
$(document).ready(function(){
		  $('table.display').dataTable({
				"retrieve": true,
				"paging": false,
				//"ordering": false,
				"info": false,
				"bFilter": false,
				"order": [[ 1, "des" ]],
				columnDefs: [
					{ type: 'natural', targets: 0 },
					{ type: 'natural', targets: 2 },
				]
			});
});
</script>
<script>
$(document).ready(function(){
  	$(".hideRows").click(function(e){
      e.preventDefault();
  		var target = $(this).prop('id');
  		target = '.' + target;
  		$(target).find('input[type="checkbox"]').each(function(){
  		   if ($(this).prop('checked')!=true) {
  			 $(this).parent().parent().hide();
  		   };
  		});
  	});
  	$(".restoreRows").click(function(e){e.preventDefault();
  		var target = $(this).prop('id');
  		target = '.' + target;
  		$(target).find('input[type="checkbox"]').each(function () {
  		   if ($(this).prop('checked')!=true) {
  			 $(this).parent().parent().show();
  		   };
  		});
  	});
    $('#printMe').click(function() {
    	window.print();
    	return false;
    });
    $('#showlegend').click(function(e){
    	e.preventDefault();
    	$('#legend').slideToggle('slow');
    });
    // IIFE to calculate standard deviation on all twiz figures per race
    /* first get a count on the number of races, this will tell us how many tables there are.
      then create a loop with the number of races as the count maximum
    */
    (function (){
      // get number of Races from a php variable that already holds this information
      var raceTally='<?php echo $numOfraces; ?>';
      // start loop based on that number starting at 0
      for(var i = 0; i < raceTally; i++) {
          var TableData;
          TableData = storeTblValues(i);
          //convert array of strings to an array of integers
          var arrayOfNumbers = TableData.map(Number);
          //alert(arrayOfNumbers);
          var stdDev;
          stdDev = standardDeviation(arrayOfNumbers);//send array to standardDeviation function
          //alert("Standard Deviation: " + stdDev);
          var classNum = $('#classNum' + i).html();
          //alert("Class Number: " + classNum);
//
           var totalStdDev = parseFloat(classNum) - parseFloat(stdDev*10);
          //alert("Total SD: " + totalStdDev);
          fixedStdDev = totalStdDev.toFixed(2);
          //alert("Total SD fixed 2: " + fixedStdDev);
          roundedStdDev = Math.round(fixedStdDev);
          //alert("Rounded SD: " + roundedStdDev);
          $("#stdDevTotal" + i).text(roundedStdDev);//output sd to div on page
      }
    })();
    function storeTblValues(i){
        var TableData = new Array();
        $('#DataTables_Table_' + i + ' tr').each(function(row, tr){
            TableData[row]=$(tr).find('td:eq(17)').text();
        });
        TableData.shift();  // first row will be empty - so remove
        TableData.pop(); // last element will be 0 - so remove
        return TableData;
    }
    // standard deviation logic for legacy purposes
    /*$(function(){
      var stdDev = standardDeviation([1, 2, 3, 4, 5, 6, 7, 8, 9, 25]);
      $("#stdDev").text(avg);
    });*/
    function standardDeviation(values){
        // get the average of the data set
        var avg = average(values); // call average function
        // calculate difference between each array value and the average value
        // map function will iterate over array items and return a new array of these values
        var squareDiffs = values.map(function(value){
          var diff = value - avg;
          // square the differences of each value in this step as well
          var sqrDiff = diff * diff;
          return sqrDiff;
        });
        // get the average of the squared differences
        var avgSquareDiff = average(squareDiffs); // call average function
        // calculate the square root of the average squared differences
        // final result is the standard deviation for the data set
        var stdDev = Math.sqrt(avgSquareDiff);
        return stdDev;
    }
    function average(data){
      // reduce iterates over every array value and produces a single result
      // produces a sum of all the item in the array
      var sum = data.reduce(function(sum, value){
        return sum + value;
      }, 0);
      // divide the sum by the number of items in the array to get average
      var avg = sum / data.length;
      return avg;
    }
});
</script>
</body>
</html>
