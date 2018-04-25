<?php
$track=array(
"ACE"=>"Running Aces Harness Park MN",
"ADX"=>"Alberta Downs, ALTA",
"BAN"=>"Bangor Raceway, ME",
"BAR"=>"Barrie Raceway, ONT",
"BBX"=>"Blue Bonnets, QUE",
"BGD"=>"Players’ Bluegrass Downs, KY",
"BLV"=>"Quinte Raceway, ONT",
"BML"=>"Balmoral Park, IL",
"BRX"=>"Buffalo Raceway, NY",
"BTV"=>"Batavia Downs, NY",
"CAL"=>"Cal-Expo Raceway, CA",
"CHR"=>"Charlottetown, PEI",
"CHS"=>"Harrah's Chester Casino Racetrack",
"CON"=>"Cannaught Park",    
"CLN"=>"Clinton Raceway, ONT",
"CLT"=>"Clinton Raceway, ONT",
"CNL"=>"Colonial Downs, VA",
"CUM"=>"Cumberland, ME",
"DDX"=>"Dover Downs, DE",
"DEL"=>"Delaware County Fair, OH",
"DLA"=>"Delaware Afternoon Races",
"DRE"=>"Dresden Raceway",
"DUQ"=>"Du Quion State Fair",
"EMI"=>"Elmira Raceway",
"EPR"=>"Exhibition Park, NB",
"FAR"=>"Farmington, ME",
"FHL"=>"Freehold Raceway, NJ",
"FLM"=>"Flamboro Downs, ONT",
"FOX"=>"Foxboro Park, MA",
"FPX"=>"Fairmount Park, IL",
"FRD"=>"Fraser Downs, BC",
"FRR"=>"Fredericton Raceway, NB",
"FRY"=>"Fryeburg Fair, ME",
"GEO"=>"Georgian Downs, ON",
"GOD"=>"Historic Track-Goshen, NY",
"GRN"=>"Grand Prairie, ALTA",
"GSP"=>"Garden State Park, NJ",
"GRV"=>"Grand River",
"HAR"=>"Harrington Raceway, DE",
"HAW"=>"Hawthorne Park, IL",
"HAY"=>"Hippodrome d'Almyer",
"HMX"=>"Hippodrome de Montreal, QUE",
"HNV"=>"Hanover Raceway, ONT",
"HOP"=>"Hoosier Park, Anderson, IN",
"HPX"=>"Hazel Park Harness, MI",
"IND"=>"Indiana State Fair, IN",
"INY"=>"Indianapolis Downs, IN",
"INV"=>"Inverness Raceway",
"JAC"=>"Jackson Raceway, MI",
"KDX"=>"Kawartha Downs",
"LAX"=>"Los Alamitos, CA",
"LEB"=>"Lebanon, KY",
"LET"=>"Lethbridge, ALTA",
"LEX"=>"The Red Mile, KY",
"LON"=>"Western Fair Raceway, ONT",
"LVD"=>"Lakeview Downs, NFL",
"MXX"=>"The Meadowlands, NJ",
"MEA"=>"The Meadows, PA",
"MOH"=>"Mohawk Racetrack, ONT",
"MRC"=>"Muskegon Racecourse, MI",
"MAY"=>"Maywood Park",
"MRX"=>"Monticello Raceway",
"NFL"=>"Northfield Park, OH",
"NOR"=>"Northville Downs, MI",
"NPX"=>"Northlands Park, ALTA",
"NTS"=>"Northside Downs, NS",
"OAK"=>"Oakridge Racecourse, VA",
"ODX"=>"Ocean Downs, MD",
"OXF"=>"Oxford Fair, ME",
"PCD"=>"Pocono Downs, PA",
"PPK"=>"Pompano Park, FL",
"PRC"=>"Plainridge Racecourse, MA",
"PRE"=>"Presque Isle, ME",
"PRM"=>"Prairie Meadows, IA",
"QBY"=>"Queensbury Downs, SASK",
"QUE"=>"Sulky Quebec, QUE",
"RCH"=>"Rochester Fair, NH",
"RCR"=>"Rosecroft Raceway, MD",
"RID"=>"Rideau Carleton, ONT",
"ROK"=>"Rockingham Park, NH",
"RPX"=>"Raceway Park, OH",
"SAN"=>"Sandown Park Raceway, BC",
"SAR"=>"Hiawatha Horse Park, ONT",
"SCA"=>"Scarborough Downs, ME",
"SCD"=>"Scioto Downs, OH",
"SGH"=>"Saginaw Harness Raceway",
"SKO"=>"Skowhegan, ME",
"SPC"=>"Sports Creek Raceway, MI",
"SPK"=>"Sportsman’s Park, IL",
"SPR"=>"Springfield, IL",
"STG"=>"Saratoga Harness, NY",
"STP"=>"Stampede Park, ALTA",
"SUD"=>"Sudbury Downs, ONT",
"SUM"=>"Summerside Raceway, PEI",
"SYC"=>"The Syracuse Mile, NY",
"SYD"=>"Tartan Downs",
"TOP"=>"Topsham, ME",
"TRR"=>"Thunder Ridge, KY",
"TGD"=>"Tioga Downs",
"TRU"=>"Truro Raceway, NS",
"TRV"=>"Hippodrome de Trois Rivieres",
"UNI"=>"Union, ME",
"VDX"=>"Vernon Downs, NY",
"WDB"=>"Woodbine, ONT",
"WIN"=>"Windsor Fair Races",
"WOD"=>"Woodstock Raceway",
"WRX"=>"Windsor Raceway",
"YRX"=>"Yonkers Raceway, NY"
);
?>

<?php
foreach($track as $x=>$x_value) {
	if($x == $_SESSION['racetrack']){
		$trackloc = $x_value;
		break;
	}
}
?>