var totalNumMinions = 99; //16 waves, 3 striders
var averageVimPerMinion = 844/totalNumMinions;
var averageVimPerWorker = 6.5;

var passiveVim = 561; //Passive + 2 Spirit Wells (no worker harass)

$( document ).ready(function() {
    calculateEarnings();
});

function calculateEarnings() {

	var proportionTimeOutOfLane = document.getElementById("TimeOutsideLane").value/48;
	var timeOutsideSeconds = (Math.round(8*60*proportionTimeOutOfLane) % 60);
	if (timeOutsideSeconds < 10) {
		timeOutsideSeconds = "0" + timeOutsideSeconds;
	}
	var timeOutsideMins = Math.floor(8*proportionTimeOutOfLane);
	document.getElementById("TimeOutsideDiv").innerHTML = timeOutsideMins + ":" + timeOutsideSeconds + " Spent Out of Lane"
	var proportionLastHits = document.getElementById("LastHits").value;
	document.getElementById("PercentLastHits").innerHTML = Math.round(proportionLastHits*100) + "% of Minions Last Hit"
	var averageGladChain = parseInt(document.getElementById("GladChain").value);
	var averageSecondsBetweenHarass = Math.max(5,parseInt(document.getElementById("HarassTime").value)); //When in lane
	var averageKills = parseInt(document.getElementById("NumKills").value);
	var averageAssists = parseInt(document.getElementById("NumAssists").value);
	var averageWorkersKilled = parseInt(document.getElementById("NumWorkers").value);

	var numMinionsInLane = totalNumMinions*(1 - proportionTimeOutOfLane);
	var numMinionsLastHit = numMinionsInLane*proportionLastHits;
	var numMinionsNearby = numMinionsInLane - numMinionsLastHit;
	var vimForGladChain;
	if (averageGladChain <= 15) {
		vimForGladChain = averageGladChain*(averageGladChain + 1);
	} else {
		vimForGladChain = 240 + 30*(averageGladChain - 15);
	}	
	var averageGladBonus = vimForGladChain/averageGladChain;
	var lastHitsVim = 2.5*numMinionsLastHit*averageVimPerMinion;
	var passiveMinionsVim = averageVimPerMinion*numMinionsNearby;
	var passiveMinionsVimNoLastHits = averageVimPerMinion*numMinionsInLane; //Useful to display how much you get if not last hitting
	var secondsInLane = 8*60*(1 - proportionTimeOutOfLane);
	var vimFromWorkers = averageWorkersKilled*averageVimPerWorker;
	var vimFromKills = averageKills*300; //Ignores Kill/Death streaks
	var vimFromAssists = averageAssists*300*0.5; //Approx assumes equal 2 and 3 man kills
	
	var baseEarnings = lastHitsVim + passiveMinionsVim + vimFromWorkers + vimFromKills + vimFromAssists + passiveVim;
	var baseEarningsNoLastHits = passiveMinionsVimNoLastHits + vimFromWorkers + vimFromKills + vimFromAssists + passiveVim;
	
	var gladBonus = numMinionsLastHit*averageGladBonus;
	var tactHarassBonus = 15*secondsInLane/averageSecondsBetweenHarass;
	var tactMinionBonus = 0.5*passiveMinionsVim;
	var tactMinionBonusNoLastHits = 0.5*passiveMinionsVimNoLastHits; 
	var predWorkerBonus = vimFromWorkers;
	var predKillAssistBonus = 0.35*vimFromKills + 0.8*vimFromAssists;
	
	var totalGladVim = baseEarnings + gladBonus;
	var totalTactVim = baseEarnings + tactHarassBonus + tactMinionBonus;
	var totalTactVimNoLastHits = baseEarningsNoLastHits + tactHarassBonus + tactMinionBonusNoLastHits;
	var totalPredVim = baseEarnings + predWorkerBonus + predKillAssistBonus;
	var totalPredVimNoLastHits = baseEarningsNoLastHits + predWorkerBonus + predKillAssistBonus;
	
	results = "";
	results += "Base Vim Earned: " + Math.round(baseEarnings) + "<br/>";
	results += "CS: " + Math.round(numMinionsLastHit) + "<br/>";
	results += "Gladiator Chain Bonus: " +  Math.round(gladBonus) + "<br/>";
	results += "Tactician Harass Bonus: " + Math.round(tactHarassBonus) + "<br/>";
	results += "Tactician Minion Bonus: " + Math.round(tactMinionBonus) + " (" + Math.round(tactMinionBonusNoLastHits) + " if you don't take the last hits)<br/>";
	results += "Predator Kill/Assist Bonus: " + Math.round(predKillAssistBonus) + "<br/>";
	results += "Predator Worker Bonus: " + Math.round(predWorkerBonus) + "<br/>";
	results += "</br>";
	results += "Total Gladiator Vim: " + Math.round(totalGladVim) + "<br/>";
	results += "Total Tactician Vim: " + Math.round(totalTactVim) + " (" + Math.round(totalTactVimNoLastHits) + " if you don't take the last hits)<br/>";
	results += "Total Predator Vim: " + Math.round(totalPredVim) + " (" + Math.round(totalPredVimNoLastHits) + " if you don't take the last hits)";

	document.getElementById("ResultsDiv").innerHTML = results;

}

function toggleVisibility(identifier) {
	postElt = document.getElementById(identifier + "Post");
	headerElt = document.getElementById(identifier + "Header");
	contentElt = document.getElementById(identifier + "Content");
	if (contentElt.style.display == "block") {
		contentElt.style.display = "none";
		postElt.className="news_post_collapsed";
		headerElt.className="news_header_collapsed";
	} else {
		contentElt.style.display = "block";
		postElt.className="news_post";
		headerElt.className="news_header_uncollapsed";
	}
}