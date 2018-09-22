//Vim variables here for easy editing when things change
var JungleMonsterInfo = {
"Small Fish" : {baseVim: 6, vimPerLvl: 0.1},
"Big Fish" : {baseVim: 45, vimPerLvl: 0.8},
"Scary Fish (Buff)" : {baseVim: 75, vimPerLvl: 1.4},
"Small Mushroom" : {baseVim: 4, vimPerLvl: 0.1},
"Big Mushroom" : {baseVim: 38, vimPerLvl: 0.6},
"Cute Mushroom (Buff)" : {baseVim: 75, vimPerLvl: 1.4},
"Small Ugger" : {baseVim: 19, vimPerLvl: 0.4},
"Big Ugger" : {baseVim: 58, vimPerLvl: 1},
"Ugly Ugger (Buff)" : {baseVim: 75, vimPerLvl: 1.4},
"Small Boar" : {baseVim: 52, vimPerLvl: 0.75},
"Big Boar" : {baseVim: 110, vimPerLvl: 1.5}
}

var JungleCampInfo = {
"Small Fish Camp" : {numInCamp: 3, baseVim: JungleMonsterInfo["Small Fish"].baseVim*2 + JungleMonsterInfo["Big Fish"].baseVim, vimPerLvl: JungleMonsterInfo["Small Fish"].vimPerLvl*2 + JungleMonsterInfo["Big Fish"].vimPerLvl},
"Small Mushroom Camp" : {numInCamp: 4, baseVim: JungleMonsterInfo["Small Mushroom"].baseVim*3 + JungleMonsterInfo["Big Mushroom"].baseVim, vimPerLvl: JungleMonsterInfo["Small Mushroom"].vimPerLvl*3 + JungleMonsterInfo["Big Mushroom"].vimPerLvl},
"Small Ugger Camp" : {numInCamp: 2, baseVim: JungleMonsterInfo["Small Ugger"].baseVim + JungleMonsterInfo["Big Ugger"].baseVim, vimPerLvl: JungleMonsterInfo["Small Ugger"].vimPerLvl + JungleMonsterInfo["Big Ugger"].vimPerLvl},
"Power Camp" : {numInCamp: 3, baseVim: JungleMonsterInfo["Small Fish"].baseVim*2 + JungleMonsterInfo["Scary Fish (Buff)"].baseVim, vimPerLvl: JungleMonsterInfo["Small Fish"].vimPerLvl*2 + JungleMonsterInfo["Scary Fish (Buff)"].vimPerLvl},
"Haste Camp" : {numInCamp: 3, baseVim: JungleMonsterInfo["Small Mushroom"].baseVim*2 + JungleMonsterInfo["Cute Mushroom (Buff)"].baseVim, vimPerLvl: JungleMonsterInfo["Small Mushroom"].vimPerLvl*2 + JungleMonsterInfo["Cute Mushroom (Buff)"].vimPerLvl},
"Armor Camp" : {numInCamp: 2, baseVim: JungleMonsterInfo["Small Ugger"].baseVim + JungleMonsterInfo["Ugly Ugger (Buff)"].baseVim, vimPerLvl: JungleMonsterInfo["Small Ugger"].vimPerLvl + JungleMonsterInfo["Ugly Ugger (Buff)"].vimPerLvl},
"Money Pigs" : {numInCamp: 2, baseVim: JungleMonsterInfo["Small Boar"].baseVim + JungleMonsterInfo["Big Boar"].baseVim, vimPerLvl: JungleMonsterInfo["Small Boar"].vimPerLvl + JungleMonsterInfo["Big Boar"].vimPerLvl}
}

var numInCamp = {"Fish Camp" : 3, "Mushroom Camp" : 4, "Ugger Camp" : 2, "Armor Buff" : 2, "Haste Buff" : 3, "Power Buff" : 3, "Money Pigs" : 2};
var baseCampVim = {"Fish Camp" : 57, "Mushroom Camp" : 50, "Ugger Camp" : 77, "Armor Buff" : 94, "Haste Buff" : 83, "Power Buff" : 87, "Money Pigs" : 162};
var campPerLvl = {"Fish Camp" : 1.0, "Mushroom Camp" : 0.9, "Ugger Camp" : 1.4, "Armor Buff" : 1.8, "Haste Buff" : 1.6, "Power Buff" : 1.6, "Money Pigs" : 2.25};

var monsterSelectText = "<select id='MonsterSelect'>";
for (c in JungleMonsterInfo) {
	monsterSelectText += "<option value='" + c + "'>" + c + "</option>";
}
monsterSelectText += "</select>";

var campSelectText = "<select id='CampSelect'>";
for (c in JungleCampInfo) {
	campSelectText += "<option value='" + c + "'>" + c + "</option>";
}
campSelectText += "</select>";

var jungleLevels = [];
var jungleSelectText = "<select id='JungleLevelSelect'>";
jungleLevels["Level 1 (up to 6:00)"] = 0;
jungleSelectText += "<option value='Level 1 (up to 6:00)'>Level 1 (up to 6:00)</option>";
for (var i=2; i<30; i++) {
	var timeFrame = (i+4) + ":00 - " + (i+5) + ":00";
	var selectOption = "Level " + i + " (" + timeFrame + ")";
	jungleLevels[selectOption] = i-1;
	jungleSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
jungleLevels["Level 30 (34:00+)"] = 29;
jungleSelectText += "<option value='Level 30 (34:00+)'>Level 30 (34:00+)</option></select>";

var meleeBase = 9.5;
var meleePerLvl = 0.1;
var rangedBase = 6.5;
var rangedPerLvl = 0.1;
var striderBase = 14;
var striderPerLvl = 0.2;
var lastHitProportion = 2.5;

var minionLevels = {};
var minionSelectText = "<select id='MinionLevelSelect'>";
for (var i=2; i<30; i++) {
	var spawnTime1 = (i-1) + ":30";
	var spawnTime2 = i + ":00";
	var selectOption = "Level " + i + " (" + spawnTime1 + "/" + spawnTime2 + " Spawn)";
	minionLevels[selectOption] = i-2;
	minionSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
minionLevels["Level 30 (29:30+ Spawn)"] = 28;
minionSelectText += "<option value='30 (29:30+ Spawn)'>30 (29:30+ Spawn)</option></select>";

var striderLevels = {}
var striderSelectText = "<select id='StriderLevelSelect'>";
for (var i=1; i<31; i++) {
	var selectOption = "Level " + i;
	striderLevels[selectOption] = i-1;
	striderSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
striderSelectText += "</select>";

var paraVim = {"First Form" : 150, "Second Form" : 325, "Third Form" : 500};
var paraPerLvl = {"First Form" : 11.67, "Second Form" : 11.67};

var paraSelectText = "<select id='ParasiteLevelSelect'>";
var paraLevels = {};
for (var i=2; i<17; i++) {
	var timeFrame = "";
	if (i%2 == 0) {
		var timeFrame = (i+8)/2 + ":00 - " + (i+8)/2 + ":30";
	} else {
		var timeFrame = (i+7)/2 + ":30 - " + (i+9)/2 + ":00";
	}
	var selectOption = "Stage 1, Level " + i + " (" + timeFrame + ")";
	paraLevels[selectOption] = i-2;
	paraSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
for (var i=2; i<17; i++) {
	var timeFrame = "";
	if (i%2 == 0) {
		var timeFrame = (i+22)/2 + ":30 - " + (i+24)/2 + ":00";
	} else {
		var timeFrame = (i+23)/2 + ":00 - " + (i+23)/2 + ":30";
	}
	var selectOption = "Stage 2, Level " + i + " (" + timeFrame + ")";
	paraLevels[selectOption] = i+13;
	paraSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
paraLevels["Stage 3 (20:00+)"] = 30;
paraSelectText += "<option value='Stage 3 (20:00+)'>Stage 3 (20:00+)</option></select>";

var workerBaseVim = 6;
var workerPerLvl = 0.1;

var workerLevels = [];
var workerSelectText = "<select id='WorkerLevelSelect'>";
workerLevels["Level 1 (up to 2:30)"] = 0;
workerSelectText += "<option value='Level 1 (up to 2:30)'>Level 1 (up to 2:30)</option>";
for (var i=2; i<30; i++) {
	var timeFrame = i + ":30 - " + (i+1) + ":30";
	var selectOption = "Level " + i + " (" + timeFrame + ")";
	workerLevels[selectOption] = i-1;
	workerSelectText += "<option value='" + selectOption + "'>" + selectOption + "</option>";
}
workerLevels["Level 30 (29:30+)"] = 29;
workerSelectText += "<option value='Level 30 (29:30+)'>Level 30 (29:30+)</option></select>";

var predatorKillBonus = 0.35;
var predatorAssistBonus = 0.8;
var predatorWorkerBonus = 1;
var tactRangedBonus = 15;
var tactMeleeBonus = 30;
var tactMinionBonus = 0.5;
var hunterBonusVim = 30;
var hunterBonusChance = 0.25;

var wellCapBase = 50;

var killVimStreak = {"-8" : 22, "-7" : 32, "-6" : 46, "-5" : 65, "-4" : 93, "-3" : 132, "-2" : 189, "-1" : 270, "0" : 300, "1" : 350, "2" : 400, "3" : 450, "4" : 500};
var firstBloodBonus = 100;

var streakTooltip = "While on a kill streak, a death will reset the streak to zero. While on a death streak, a kill will reset the streak to zero and an assist will reverse the death streak by one death.";

var minionTooltip = "<b>USAGE NOTE:</b> Click to toggle the minions between being out of vim range (black border), in vim range (orange border) and last hit (blue border). You can use both the border color and mouseover text to see the current status of each minion.";

var enemyWellTooltip = "<b>USAGE NOTE:</b> If you are unsure how much the spirit well would have generated for the enemy team, try adding a new calculation and use one or more Spirit Well Income sources to come up with the value.";

var striderLevelTooltip = "Striders are level 1 when they first spawn. Every other time you have a strider wave, the strider level increases by 1.";

//Stores all the information required to differentiate the different income types
var IncomeSourceTypes = {
	"Assist" : 
	{
		"tooltip" : "If players assist on a kill, an additional 70% of the kill vim is split between all those who assist.<br/>Predators gain 85% more vim for assists.",
		"options" : "Total Allied Shapers Involved: <select id='NumShapersSelect'><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select><br/><table><tr><td>Victim Kill/Death Streak:&nbsp;</td><td><input type='range' min='-8' max='4' value='0' id='KillStreakSlider' onChange='changeStreakSlider();'>&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' title='" + streakTooltip + "'></i></td></tr><tr><td></td><td id='KillStreakText'>No Streak</td></tr></table>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveAssist(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateAssist(calcNum, sourceNum);}
	},
	"Binding Destroyed" : 
	{
		"tooltip" : "Destroying a binding awards 150 vim to each member of your team.",
		"options" : "",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveBinding(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateBinding(calcNum, sourceNum);}
	},
	"Gladiator Chain" : 
	{
		"tooltip" : "When Gladiators kill lane minions, they gain stacking bonus vim.<br/>The bonus increases by 2 for every consecutive minion killed within 10 seconds up to a maximum of 30 additional vim per minion.<br/><br/><b>USAGE NOTE:</b> This will only calculate the bonus vim for Gladiator stacks. Use 'Minion Wave' to get the vim from last hits.",
		"options" : "Consecutive Minions: <input type='number' id='ConsecutiveMinions' value='0'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveGlad(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateGlad(calcNum, sourceNum);}
	},
	"Individual Jungle Monsters" :
	{
		"tooltip" : "Killing jungle creatures grants vim to the person that gets the last hit.<br/>Hunters also have a 25% chance to gain 30 bonus vim when killing a jungle creature.<br/>Small camps first spawn at 1:50 and take 3 minutes to respawn. Buff camps first spawn at 2:00 and Money Pigs first spawn at 4:00. Both take 5 minutes to respawn. The respawn timer for camps will only begin once the whole camp has been cleared.",
		"options" : "Monster Level: " + jungleSelectText + "<br/>Monster: " + monsterSelectText + "<br/>Quantity Killed: <input type='number' value='1' min='1' id='MonsterQuantity'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveMonsters(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateMonsters(calcNum, sourceNum);}		
	},		
	"Jungle Camps" :
	{
		"tooltip" : "Killing jungle creatures grants vim to the person that gets the last hit.<br/>Hunters also have a 25% chance to gain 30 bonus vim when killing a jungle creature.<br/>Small camps first spawn at 1:50 and take 3 minutes to respawn. Buff camps first spawn at 2:00 and Money Pigs first spawn at 4:00. Both take 5 minutes to respawn. The respawn timer for camps will only begin once the whole camp has been cleared.",
		"options" : "Camp Level: " + jungleSelectText + "<br/>Camp: " + campSelectText + "<br/>Quantity Cleared: <input type='number' value='1' min='1' id='CampQuantity'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveJungleCamps(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateJungleCamps(calcNum, sourceNum);}		
	},	
	"Kill" : 
	{
		"tooltip" : "Killing an enemy shaper grants vim to the shaper that gets the last hit based on the victim\'s kill/death streak at the time.<br/>Predators gain 35% more vim for kills.<br/>Getting First Blood (the first kill of the game) will grant an additional 100 vim.",
		"options" : "<input type='checkbox' id='FirstBlood' onChange='toggleFirstBlood();'>&nbsp;First Blood?<br/><br/><table><tr><td>Victim Kill/Death Streak:&nbsp;</td><td><input type='range' min='-8' max='4' value='0' id='KillStreakSlider' onChange='changeStreakSlider();'>&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' title='" + streakTooltip + "'></i></td></tr><tr><td></td><td id='KillStreakText'>No Streak</td></tr></table>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveKill(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateKill(calcNum, sourceNum);}
	},
	"Minion Wave" : 
	{
		"tooltip" : "Being near dying enemy minions will grant a base amount of vim.<br/>Tacticians get 150% of the base amount for being near dying minions, while last hitting a minion will instead give you 250% of the base value (regardless of role).<br/>Waves spawn every 30 seconds starting at 1:30.<br/><br/><b>USAGE NOTE:</b> If you are a Gladiator, add a Gladiator Chain source to include the extra vim for chaining last hits.",
		"options" : "Minion Level: "+ minionSelectText + "<br/><table><tr><td>MELEE</td><td>RANGED</td></tr><tr><td><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/melee_minion.png' id='MeleeMinionImg1' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/melee_minion.png' id='MeleeMinionImg2' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/melee_minion.png' id='MeleeMinionImg3' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'></td><td><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/ranged_minion.png' id='RangedMinionImg1' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/ranged_minion.png' id='RangedMinionImg2' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'><img class='minion_wave_img' src='http://www.moba-champion.com/theorycrafting/ranged_minion.png' id='RangedMinionImg3' onClick='clickMinionImg(this);' style='border-color: #d06808' title='Minion in Vim Range'>&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' title='" + minionTooltip + "'></i></td></tr></table>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveMinions(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateMinions(calcNum, sourceNum);}
	},
	"Parasite" : 
	{
		"tooltip" : "Parasite awards vim to your whole team.<br/>Parasite first spawns at 5:00 and takes 6 minutes to respawn. It evolves to its second and third forms at 12:30 and 20:00, respectively.",
		"options" : "Stage/Level: " + paraSelectText,
		"saveFunction" : function(calcNum, getInput, sourceNum){saveParasite(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateParasite(calcNum, sourceNum);}
	},
	"Passive Income" : 
	{
		"tooltip" : "All shapers gain 40 vim per minute passively starting from 1:30.<br/>This is in addition to spirit well income.",
		"options" : "Start Time: <input type='text' id='StartTimeSelect' value='0:00'><br/>End Time: <input type='text' id='EndTimeSelect' value='0:00'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){savePassive(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populatePassive(calcNum, sourceNum);}
	},	
	"Spirit Well Capture" : 
	{
		"tooltip" : "Capturing a spirit well gives every member of your team 50 vim plus half the vim the well generated for each member of the enemy team while they controlled it.<br/>Capturing a well also kills every enemy worker at that well.<br/><br/><b>USAGE NOTE:</b> Add a Workers Killed source to take into account the workers that die when you capture the well.",
		"options" : "Total Income Per Enemy Shaper Since Last Capture:<br/><input type='number' step='1' value='0' min='0' id='EnemyWellIncome'>&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' title='" + enemyWellTooltip + "'></i>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveWellCap(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateWellCap(calcNum, sourceNum);}
	},
	"Spirit Well Income" : 
	{
		"tooltip" : "Shapers each gain 1 vim per minute per worker.<br/>Each spirit well owned by your team generates 1 worker every 15 seconds up to a maximum of 18 workers per well.<br/>Workers first start spawning at 1:45.<br/><br/><b>USAGE NOTE:</b> Add multiple of this income source to take into account some of your workers being killed while the well is still under your control.",
		"options" : "Workers Alive at Start Time: <input type='number' value='0' min='0' max='18' id='WorkersAlive'><br/>Start Time: <input type='text' id='StartTimeSelect' step='1' value='0:00'><br/>End Time: <input type='text' id='EndTimeSelect' step='1' value='0:00'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveWellPassive(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateWellPassive(calcNum, sourceNum);}
	},
	"Strider Minion" :
	{
		"tooltip" : "Striders first spawn at 4:00 and begin by appearing every 4th wave. For each enemy binding destroyed in the lane, the number of waves between striders will decrease by one.<br/><br/><b>USAGE NOTE:</b> If you are a Gladiator, add a Gladiator Chain source to include the extra vim for chaining last hits.",
		"options" : "Strider Level: " + striderSelectText + "&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' title='" + striderLevelTooltip + "'></i><br/><input type='checkbox' id='LastHit'>&nbsp;Last Hit?",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveStrider(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateStrider(calcNum, sourceNum);}		
	},		
	"Tactician Harass" : 
	{
		"tooltip" : "Tacticians gain bonus vim when they damage an enemy shaper (15 vim for ranged attacks or abilities and 30 vim for melee attacks).<br/>This effect has a 5 second cooldown.<br/><br/><b>USAGE NOTE:</b> If you have a shaper that will sometimes get the 15 vim bonus and sometimes get the 30 vim bonus, create two separate Tactician Harass sources.",
		"options" : "<input type='checkbox' id='TacticianMelee'>&nbsp;Melee Attacks?<br/>Number of procs: <input type='number' value='0' id='TacticianProcs'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveTact(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateTact(calcNum, sourceNum);}
	},
	"Workers Killed" : 
	{
		"tooltip" : "Killing an enemy worker awards vim to all nearby allied shapers. The vim bounty for workers increases over time.<br/>The vim earned is doubled for Predators.<br/><br/><b>USAGE NOTE:</b> Include workers that die as a result of capturing a spirit well (if you are in range to get vim from them).",
		"options" : "Worker Level: " + workerSelectText + "<br/>Number of workers killed: <input type='number' value='1' min='0' max='18' id='WorkerKills'>",
		"saveFunction" : function(calcNum, getInput, sourceNum){saveWorkers(calcNum, getInput, sourceNum);},
		"populateInfoFunction" : function(calcNum, sourceNum){populateWorkers(calcNum, sourceNum);}
	}
};

var calculationCounter = 0; //Index each calculation by a number

var Calculations = {}; //Will contain Calculation objects

/* Sample Calculation Object (Calculations will contain some number of these)
Calculation = {
	"role" : "Gladiator",
	"sourceCounter" : 0, //Index each source by a number
	"incomeSources" : {}, //see below for a sample Source object
	"totalRoleVim" : 100,
	"totalVim" : 500
};
*/

/* Sample Income Source Object
Source = {
	"type" : "Kill",
	"firstBlood" : false,
	"killStreak" : 3,
	"roleVim" : 0,
	"totalVim" : 400
};
*/

function changeStreakSlider() {
	var sliderVal = parseInt(document.getElementById("KillStreakSlider").value);
	var sliderText = "";
	if (sliderVal > 0) {
		sliderText = "Kill Streak of " + sliderVal;
	} else if (sliderVal < 0) {
		sliderText = "Death Streak of " + (-sliderVal);
	} else {
		sliderText = "No Streak";
	}
	document.getElementById("KillStreakText").innerHTML = sliderText;
}

function clickMinionImg(minion) {
	var title = minion.title;
	if (title == "Minion Not in Vim Range") {
		minion.title = "Minion in Vim Range"
	} else if (title == "Minion in Vim Range") {
		minion.title = "Minion Last Hit";
	} else {
		minion.title = "Minion Not in Vim Range";
	}
	updateMinionColour(minion);
}

function updateMinionColour(minion) {
	var titleToColour = {"Minion Not in Vim Range" : "black", "Minion in Vim Range" : "#d06808", "Minion Last Hit" : "blue"};
	minion.style.borderColor = titleToColour[minion.title];
}

function toggleFirstBlood() {
	if (document.getElementById("FirstBlood").checked) {
		document.getElementById("KillStreakSlider").disabled = true;
		document.getElementById("KillStreakSlider").value = "0";
		document.getElementById("KillStreakText").innerHTML = "No Streak";
	} else {
		document.getElementById("KillStreakSlider").disabled = false;
	}
}

function addSource(i) {
	document.getElementById("PopupTitle").innerHTML = "Add New Source";
	var content = "";
	content += "Income Type: ";
	content += "<select id='IncomeTypeSelect' onChange='sourceTypeChanged(" + i + ")'>";
	for (source in IncomeSourceTypes) {
		content += "<option value='" + source + "'>" + source + "</option>";
	}
	content += "</select>";
	content += "&nbsp;&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' id='VimHelpIcon' title='TOOLTIPSTER HELP INFO HERE'></i>";
	content += "<div id='sourceOptions'></div>";
	document.getElementById("PopupContent").innerHTML = content;
	sourceTypeChanged(i);
	showPopup();
}

function editSource(calcNum, sourceNum) {
	var source = Calculations[calcNum].incomeSources[sourceNum];
	var sourceType = IncomeSourceTypes[source.type];

	document.getElementById("PopupTitle").innerHTML = "Edit Source";
	var content = "";
	content += "Income Type: " + source.type;
	content += "&nbsp;<i class='icon-question-sign dynamic_vim_help_icon' id='VimHelpIcon' title='TOOLTIPSTER HELP INFO HERE'></i>";
	content += "<div class='popup_options' id='sourceOptions'></div>";
	document.getElementById("PopupContent").innerHTML = content;
	document.getElementById("VimHelpIcon").title = sourceType.tooltip;	
	document.getElementById("sourceOptions").innerHTML = sourceType.options;
	$('.dynamic_vim_help_icon').tooltipster({
		maxWidth: 400
	});
	sourceType.populateInfoFunction(calcNum, sourceNum);
	$('#SaveButton').unbind('click').click(function() {sourceType.saveFunction(calcNum, true, sourceNum);hidePopup();});
	showPopup();
}

function sourceTypeChanged(i) {
	selectedType = IncomeSourceTypes[document.getElementById("IncomeTypeSelect").value];
	$('.dynamic_vim_help_icon').tooltipster('destroy');
	document.getElementById("VimHelpIcon").title = selectedType.tooltip;
	document.getElementById("sourceOptions").innerHTML = selectedType.options;
	$('.dynamic_vim_help_icon').tooltipster({
		maxWidth: 400
	});
	$('#SaveButton').unbind('click').click(function() {selectedType.saveFunction(i, true, -1);hidePopup();});
}

function addNewCalculation() {
	document.getElementById("PopupTitle").innerHTML = "Pick Your Role";
	var content = "";
	content += "<table cellpadding='5' style='text-align:center;'><tr>";
	content += "<td><b>GLADIATOR</b></td>";
	content += "<td><b>TACTICIAN</b></td>";
	content += "<td><b>HUNTER</b></td>";
	content += "<td><b>PREDATOR</b></td>";
	content += "</tr><tr>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/gladiator.png' class='popup_img' title='Gladiator' onClick='clickRole(\"Gladiator\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/tactician.png' class='popup_img' title='Tactician' onClick='clickRole(\"Tactician\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/hunter.png' class='popup_img' title='Hunter' onClick='clickRole(\"Hunter\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/predator.png' class='popup_img' title='Predator' onClick='clickRole(\"Predator\");'></td>";
	content += "</tr><tr>";
	content += "<td><input type='radio' name='radioRole' value='Gladiator' id='radioGladiator' checked></td>";
	content += "<td><input type='radio' name='radioRole' value='Tactician' id='radioTactician'></td>";
	content += "<td><input type='radio' name='radioRole' value='Hunter' id='radioHunter'></td>";
	content += "<td><input type='radio' name='radioRole' value='Predator' id='radioPredator'></td>";
	content += "</tr></table>";
	document.getElementById("PopupContent").innerHTML = content;
	AddRoleTooltips('.popup_img');
	$('#SaveButton').unbind('click').click(function() {saveNewCalculation(true, 0);hidePopup();});
	showPopup();
}

function cloneCalculation(calcNum) {
	var newNum = calculationCounter;
	saveNewCalculation(false, calcNum);
	
	var oldCalc = Calculations[calcNum];
	var newCalc = Calculations[newNum];
	newCalc.totalRoleVim = oldCalc.totalRoleVim;
	newCalc.totalVim = oldCalc.totalVim;
	newCalc.sourceCounter = oldCalc.sourceCounter;
	
	for (sourceNum in oldCalc.incomeSources) {
		var source = oldCalc.incomeSources[sourceNum];
		newCalc.incomeSources[sourceNum] = source;
		addRow(newNum, sourceNum, source.type, source.details, source.roleVim, source.totalVim);
		IncomeSourceTypes[source.type].saveFunction(newNum, false, sourceNum);
	}
}

function clickRole(role) {
	document.getElementById("radio" + role).checked = true;
}

function editCalculation(calcNum) {
	var calc = Calculations[calcNum];
	document.getElementById("PopupTitle").innerHTML = "Change Role";
	var content = "";
	content += "<table cellpadding='5' style='text-align:center;'><tr>";
	content += "<td><b>GLADIATOR</b></td>";
	content += "<td><b>TACTICIAN</b></td>";
	content += "<td><b>HUNTER</b></td>";
	content += "<td><b>PREDATOR</b></td>";
	content += "</tr><tr>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/gladiator.png' class='popup_img' title='Gladiator' onClick='clickRole(\"Gladiator\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/tactician.png' class='popup_img' title='Tactician' onClick='clickRole(\"Tactician\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/hunter.png' class='popup_img' title='Hunter' onClick='clickRole(\"Hunter\");'></td>";
	content += "<td><img src='http://www.moba-champion.com/images/roles/predator.png' class='popup_img' title='Predator' onClick='clickRole(\"Predator\");'></td>";
	content += "</tr><tr>";
	content += "<td><input type='radio' name='radioRole' value='Gladiator' id='radioGladiator' checked></td>";
	content += "<td><input type='radio' name='radioRole' value='Tactician' id='radioTactician'></td>";
	content += "<td><input type='radio' name='radioRole' value='Hunter' id='radioHunter'></td>";
	content += "<td><input type='radio' name='radioRole' value='Predator' id='radioPredator'></td>";
	content += "</tr></table>";
	document.getElementById("PopupContent").innerHTML = content;
	AddRoleTooltips('.popup_img');
	document.getElementById("radio" + calc.role).checked = true;
	$('#SaveButton').unbind('click').click(function() {saveEditedCalculation(calcNum);hidePopup();});
	showPopup();
}

function deleteCalculation(calcNum) {
	var r = window.confirm("Are you sure?");
	if (r==true) {
		var calcPost = document.getElementById("CalculationPost[" + calcNum + "]");
		calcPost.parentNode.removeChild(calcPost);
		delete Calculations[calcNum];
	}
}

function showPopup() {
	$('#popupID').fadeIn();
	  
	var popuptopmargin = ($('#popupID').height() + 10) / 2;
	var popupleftmargin = ($('#popupID').width() + 10) / 2;
	$('#popupID').css({
	'margin-top' : -popuptopmargin,
	'margin-left' : -popupleftmargin
	});
}

function hidePopup() {
	$('#popupID').fadeOut();
}

function saveNewCalculation(getInput, calcNum) {

	var role;
	if (getInput) {
		role = $("input[type='radio'][name='radioRole']:checked").val();
	} else {
		role = Calculations[calcNum].role;
	}
	
	Calculations[calculationCounter] = {
		"role" : role,
		"sourceCounter" : 0,
		"incomeSources" : {},
		"totalRoleVim" : 0,
		"totalVim" : 0
	};

	content = "";
	content += "<div class='news_post' id='CalculationPost[" + calculationCounter + "]'>";
	content += "<div class='news_header''><div class='news_header_text'><div class='news_title' id='CalculationTitle[" + calculationCounter + "]'>Role: " + role + " | <a href='#' style='color:black' onClick='editCalculation(" + calculationCounter + ");return false;'>edit</a>&nbsp;<a href='#' style='color:black' onClick='deleteCalculation(" + calculationCounter + ");return false;'>delete</a>&nbsp;<a href='#' style='color:black' onClick='cloneCalculation(" + calculationCounter + ");return false;'>copy</a></div></div></div>";
	content += "<div class='news_content'>";

	content += "<div class='article_news'>";
			
	content += "<table id='CalculationTable[" + calculationCounter + "]' cellpadding='5'>";
			
	content += "<col style='width: 25%'>";
	content += "<col style='width: 40%'>";
	content += "<col style='width: 10%'>";
	content += "<col style='width: 10%'>";
	content += "<col style='width: 15%'>";
			
	content += "<tr>";
		content += "<th style='text-align:left'>Income Source</th>";
		content += "<th style='text-align:left'>Details</th>";
		content += "<th style='text-align:left'>Role Vim</th>";
		content += "<th style='text-align:left'>Total Vim</th>";
		content += "<th></th>";
	content += "</tr>";
	content += "<tr style='border-top:1px solid black'>";
		content += "<th style='text-align:left'>Total Vim Earned</th>";
		content += "<td></td>";
		content += "<td id='totalRoleVim[" + calculationCounter + "]'>0</td>";
		content += "<td id='totalVim[" + calculationCounter + "]'>0</td>";
		content += "<td></td>";		
		content += "</tr>";
			
	content += "</table>";
			
	content += "<a href='#' onClick='addSource(" + calculationCounter + ");return false;'>add new income source</a>";
			
	content += "</div>";

	content += "</div>";
	content += "</div>";
	
	document.getElementById("CalculationsContainer").innerHTML += content;
	
	calculationCounter++;

}

function saveEditedCalculation(calcNum) {
	var calc = Calculations[calcNum];
	var role = $("input[type='radio'][name='radioRole']:checked").val();
	calc.role = role;
	
	document.getElementById("CalculationTitle[" + calcNum + "]").innerHTML = "Role: " + role + " | <a href='#' style='color:black' onClick='editCalculation(" + calcNum + ");return false;'>edit</a>&nbsp;<a href='#' style='color:black' onClick='deleteCalculation(" + calcNum + ");return false;'>delete</a>&nbsp;<a href='#' style='color:black' onClick='cloneCalculation(" + calcNum + ");return false;'>copy</a>";
	for (sourceNum in calc.incomeSources) {
		IncomeSourceTypes[calc.incomeSources[sourceNum].type].saveFunction(calcNum, false, sourceNum);
	}
}

function saveAssist(calcNum, getInput, sourceNum){
	var numShapersInvolved;
	var streakVal;
	if (getInput == true) {
		var numShapersInvolved = document.getElementById("NumShapersSelect").value;
		var streakVal = document.getElementById("KillStreakSlider").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		numShapersInvolved = oldSource.numShapersInvolved;
		streakVal = oldSource.streakVal;
	}
	var splitBetween = (parseInt(numShapersInvolved) - 1);
	
	var totalAssistVim = 0.7*killVimStreak[streakVal];
	var totalVim = totalAssistVim/splitBetween;
	var roleVim = 0;
	
	if (Calculations[calcNum].role == "Predator") {
		roleVim = predatorAssistBonus*totalVim;
		totalVim += roleVim;
	}
	
	var details = "Split Between " + splitBetween;
	var sliderVal = parseInt(streakVal);
	if (sliderVal > 0) {
		details += ", Victim Kill Streak of " + sliderVal;
	} else if (sliderVal < 0) {
		details += ", Victim Death Streak of " + (-sliderVal);
	}
	var source = {
		"type" : "Assist",
		"numShapersInvolved" : numShapersInvolved,
		"streakVal" : streakVal,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateAssist(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("NumShapersSelect").value = source.numShapersInvolved;
	document.getElementById("KillStreakSlider").value = source.streakVal;
	changeStreakSlider();
}

function saveBinding(calcNum, getInput, sourceNum){
	var source = {
		"type" : "Binding Destroyed",
		"details" : "",
		"roleVim" : 0,
		"totalVim" : 150
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateBinding(calcNum, sourceNum){
}

function saveGlad(calcNum, getInput, sourceNum){
	var consecutiveMinions;
	if (getInput == true) {
		var consecutiveMinions = document.getElementById("ConsecutiveMinions").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		consecutiveMinions = oldSource.consecutiveMinions;
	}
	var numInRow = parseInt(consecutiveMinions);
	var bonusVim = 0;
	
	if (Calculations[calcNum].role == "Gladiator") {
		if (numInRow <= 15) {
			bonusVim = numInRow*(numInRow + 1);
		} else {
			bonusVim = 240 + 15*(numInRow - 15);
		}
	}
	
	var details = numInRow + " Last Hits Chained";
	if (numInRow > 14) {
		details += " (" + (numInRow-14) + " at Max Stacks)";
	}
	
	var source = {
		"type" : "Gladiator Chain",
		"consecutiveMinions" : consecutiveMinions,
		"details" : details,
		"roleVim" : bonusVim,
		"totalVim" : bonusVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateGlad(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("ConsecutiveMinions").value = source.consecutiveMinions;
}

function saveMonsters(calcNum, getInput, sourceNum){
	var monster;
	var monsterLevel;
	var qty;
	if (getInput == true) {
		monsterLevel = document.getElementById("JungleLevelSelect").value;
		monster = document.getElementById("MonsterSelect").value;
		qty = document.getElementById("MonsterQuantity").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		monster = oldSource.monster;
		monsterLevel = oldSource.monsterLevel;
		qty = oldSource.qty;
	}

	var totalVim = 0;
	var roleVim = 0;
	
	var level = jungleLevels[monsterLevel];
	
	totalVim += qty*(JungleMonsterInfo[monster].baseVim + level*JungleMonsterInfo[monster].vimPerLvl);
	
	if (Calculations[calcNum].role == "Hunter") {
		roleVim = hunterBonusVim * hunterBonusChance * qty;
	}
	
	totalVim += roleVim;
	
	var details = monsterLevel + " " + monster + " x" + qty;
	var source = {
		"type" : "Individual Jungle Monsters",
		"monster" : monster,
		"monsterLevel" : monsterLevel,
		"qty" : qty,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateMonsters(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("MonsterSelect").value = source.monster;
	document.getElementById("JungleLevelSelect").value = source.monsterLevel;
	document.getElementById("MonsterQuantity").value = source.qty;
}

function saveJungleCamps(calcNum, getInput, sourceNum){
	var camp;
	var campLevel;
	var qty;
	if (getInput == true) {
		campLevel = document.getElementById("JungleLevelSelect").value;
		camp = document.getElementById("CampSelect").value;
		qty = document.getElementById("CampQuantity").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		camp = oldSource.camp;
		campLevel = oldSource.campLevel;
		qty = oldSource.qty;
	}

	var totalVim = 0;
	var roleVim = 0;
	
	var level = jungleLevels[campLevel];
	
	totalVim += qty*(JungleCampInfo[camp].baseVim + level*JungleCampInfo[camp].vimPerLvl);
	
	if (Calculations[calcNum].role == "Hunter") {
		roleVim = hunterBonusVim * hunterBonusChance * qty * JungleCampInfo[camp].numInCamp;
	}
	
	totalVim += roleVim;
	
	var details = campLevel + " " + camp + " x" + qty;
	var source = {
		"type" : "Jungle Camps",
		"camp" : camp,
		"campLevel" : campLevel,
		"qty" : qty,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateJungleCamps(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("CampSelect").value = source.camp;
	document.getElementById("JungleLevelSelect").value = source.campLevel;
	document.getElementById("CampQuantity").value = source.qty;
}

function saveKill(calcNum, getInput, sourceNum){
	var isFirstBlood;
	var streakVal;
	if (getInput == true) {
		var isFirstBlood = document.getElementById("FirstBlood").checked;
		var streakVal = document.getElementById("KillStreakSlider").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		isFirstBlood = oldSource.isFirstBlood;
		streakVal = oldSource.streakVal;
	}	
	
	var sliderVal = parseInt(streakVal);
	if (isFirstBlood) {
		sliderVal = 0;
	}
	var roleVim = 0;
	var totalVim = killVimStreak[streakVal];
	var details = "";
	
	if (Calculations[calcNum].role == "Predator") {
		roleVim = predatorKillBonus*totalVim;
		totalVim += roleVim;
	}
	
	if (isFirstBlood) {
		totalVim += firstBloodBonus;
		details += "First Blood";
	}

	if (sliderVal > 0) {
		details += "Victim Kill Streak of " + sliderVal;
	} else if (sliderVal < 0) {
		details += "Victim Death Streak of " + (-sliderVal);
	}
	
	var source = {
		"type" : "Kill",
		"isFirstBlood" : isFirstBlood,
		"streakVal" : streakVal,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};	
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateKill(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("FirstBlood").checked = source.isFirstBlood;
	document.getElementById("KillStreakSlider").value = source.streakVal;
	changeStreakSlider();	
	toggleFirstBlood();
}

function saveMinions(calcNum, getInput, sourceNum){
	var minionLevel;
	var meleeMinion1;
	var meleeMinion2;
	var meleeMinion3;
	var rangedMinion1;
	var rangedMinion2;
	var rangedMinion3;
	if (getInput == true) {
		minionLevel = document.getElementById("MinionLevelSelect").value;
		meleeMinion1 = document.getElementById("MeleeMinionImg1").title;
		meleeMinion2 = document.getElementById("MeleeMinionImg2").title;
		meleeMinion3 = document.getElementById("MeleeMinionImg3").title;
		rangedMinion1 = document.getElementById("RangedMinionImg1").title;
		rangedMinion2 = document.getElementById("RangedMinionImg2").title;
		rangedMinion3 = document.getElementById("RangedMinionImg3").title;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		minionLevel = oldSource.minionLevel;
		meleeMinion1 = oldSource.meleeMinion1;
		meleeMinion2 = oldSource.meleeMinion2;
		meleeMinion3 = oldSource.meleeMinion3;
		rangedMinion1 = oldSource.rangedMinion1;
		rangedMinion2 = oldSource.rangedMinion2;
		rangedMinion3 = oldSource.rangedMinion3;
	}
	
	var roleVim = 0;
	var totalVim = 0;
	var CS = 0;
	var level = minionLevels[minionLevel];
	var isTactician = (Calculations[calcNum].role == "Tactician");
	if (meleeMinion1 == "Minion in Vim Range") {
		totalVim += meleeBase + level*meleePerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(meleeBase + level*meleePerLvl);
		}
	} else if (meleeMinion1 == "Minion Last Hit") {
		totalVim += lastHitProportion*(meleeBase + level*meleePerLvl);
		CS++;
	}
	if (meleeMinion2 == "Minion in Vim Range") {
		totalVim += meleeBase + level*meleePerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(meleeBase + level*meleePerLvl);
		}
	} else if (meleeMinion2 == "Minion Last Hit") {
		totalVim += lastHitProportion*(meleeBase + level*meleePerLvl);
		CS++;
	}
	if (meleeMinion3 == "Minion in Vim Range") {
		totalVim += meleeBase + level*meleePerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(meleeBase + level*meleePerLvl);
		}
	} else if (meleeMinion3 == "Minion Last Hit") {
		totalVim += lastHitProportion*(meleeBase + level*meleePerLvl);
		CS++;
	}	
	if (rangedMinion1 == "Minion in Vim Range") {
		totalVim += rangedBase + level*rangedPerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(rangedBase + level*rangedPerLvl);
		}
	} else if (rangedMinion1 == "Minion Last Hit") {
		totalVim += lastHitProportion*(rangedBase + level*rangedPerLvl);
		CS++;
	}
	if (rangedMinion2 == "Minion in Vim Range") {
		totalVim += rangedBase + level*rangedPerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(rangedBase + level*rangedPerLvl);
		}
	} else if (rangedMinion2 == "Minion Last Hit") {
		totalVim += lastHitProportion*(rangedBase + level*rangedPerLvl);
		CS++;
	}
	if (rangedMinion3 == "Minion in Vim Range") {
		totalVim += rangedBase + level*rangedPerLvl;
		if (isTactician) {
			roleVim += tactMinionBonus*(rangedBase + level*rangedPerLvl);
		}
	} else if (rangedMinion3 == "Minion Last Hit") {
		totalVim += lastHitProportion*(rangedBase + level*rangedPerLvl);
		CS++;
	}
	
	totalVim += roleVim;

	var details = minionLevel + ", " + CS + " CS";
	var source = {
		"type" : "Minion Wave",
		"minionLevel" : minionLevel,
		"meleeMinion1" : meleeMinion1,
		"meleeMinion2" : meleeMinion2,
		"meleeMinion3" : meleeMinion3,
		"rangedMinion1" : rangedMinion1,
		"rangedMinion2" : rangedMinion2,
		"rangedMinion3" : rangedMinion3,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};	
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populateMinions(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("MinionLevelSelect").value = source.minionLevel;
	document.getElementById("MeleeMinionImg1").title = source.meleeMinion1;
	updateMinionColour(document.getElementById("MeleeMinionImg1"));
	document.getElementById("MeleeMinionImg2").title = source.meleeMinion2;
	updateMinionColour(document.getElementById("MeleeMinionImg2"));
	document.getElementById("MeleeMinionImg3").title = source.meleeMinion3;
	updateMinionColour(document.getElementById("MeleeMinionImg3"));
	document.getElementById("RangedMinionImg1").title = source.rangedMinion1;
	updateMinionColour(document.getElementById("RangedMinionImg1"));
	document.getElementById("RangedMinionImg2").title = source.rangedMinion2;
	updateMinionColour(document.getElementById("RangedMinionImg2"));
	document.getElementById("RangedMinionImg3").title = source.rangedMinion3;
	updateMinionColour(document.getElementById("RangedMinionImg3"));		
}

function saveParasite(calcNum, getInput, sourceNum){
	var paraLevel;
	if (getInput == true) {
		paraLevel = document.getElementById("ParasiteLevelSelect").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		paraLevel = oldSource.paraLevel;
	}
	
	var level = paraLevels[paraLevel];
	var totalVim = 0;
	if (level < 15) {
		totalVim = paraVim["First Form"] + level*paraPerLvl["First Form"];
	} else if (level < 30) {
		totalVim = paraVim["Second Form"] + (level - 15)*paraPerLvl["Second Form"];
	} else {
		totalVim = paraVim["Third Form"];
	}
	var roleVim = 0;
	
	if (Calculations[calcNum].role == "Hunter") {
		roleVim = hunterBonusVim * hunterBonusChance;
		totalVim += roleVim;
	}
	
	var details = paraLevel;
	var source = {
		"type" : "Parasite",
		"paraLevel" : paraLevel,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}
}

function populateParasite(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("ParasiteLevelSelect").value = source.paraLevel;
}

function savePassive(calcNum, getInput, sourceNum){
	var startVal;
	var endVal;
	if (getInput == true) {
		startVal = document.getElementById("StartTimeSelect").value;
		endVal = document.getElementById("EndTimeSelect").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		startVal = oldSource.startVal;
		endVal = oldSource.endVal;
	}
	
	var startSeconds = getSecondsFromTime(startVal);
	var endSeconds = getSecondsFromTime(endVal);
	
	startSeconds = Math.max(startSeconds, 90);
	endSeconds = Math.max(startSeconds, endSeconds);
	
	var seconds = endSeconds - startSeconds;
	var income = seconds*40/60;
	var details = startVal + " - " + endVal;
	
	var source = {
		"type" : "Passive Income",
		"startVal" : startVal,
		"endVal" : endVal,
		"details" : details,
		"roleVim" : 0,
		"totalVim" : income
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populatePassive(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("StartTimeSelect").value = source.startVal;
	document.getElementById("EndTimeSelect").value = source.endVal;
}

function saveWellCap(calcNum, getInput, sourceNum){
	var wellEarned;
	if (getInput == true) {
		wellEarned = document.getElementById("EnemyWellIncome").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		wellEarned = oldSourcewellEarnedworkers;
	}
	var totalVim = 0.5*parseInt(wellEarned) + wellCapBase;
	var details = "Enemy Shapers had Earned " + wellEarned + " Vim";
	
	var source = {
		"type" : "Spirit Well Capture",
		"wellEarned" : wellEarned,
		"details" : details,
		"roleVim" : 0,
		"totalVim" : totalVim
	};	
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populateWellCap(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("EnemyWellIncome").value = source.wellEarned;
}

function saveWellPassive(calcNum, getInput, sourceNum){
	var startVal;
	var endVal;
	var workersAlive;
	if (getInput == true) {
		startVal = document.getElementById("StartTimeSelect").value;
		endVal = document.getElementById("EndTimeSelect").value;
		workersAlive = document.getElementById("WorkersAlive").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		startVal = oldSource.startVal;
		endVal = oldSource.endVal;
		workersAlive = oldSource.workersAlive;
	}
	
	var startQuarterMins = getSecondsFromTime(startVal)/15;
	var endQuarterMins = getSecondsFromTime(endVal)/15;
	
	endQuarterMins = Math.max(startQuarterMins, endQuarterMins);
	var workers = parseInt(workersAlive);
	
	var income = 0;
	var time = Math.ceil(startQuarterMins);
	
	if (time > endQuarterMins) {
		income = (endQuarterMins - startQuarterMins) * workers * 0.25;
	} else {
		income += (time - startQuarterMins) * workers * 0.25;
		var timeStop = Math.floor(endQuarterMins);
		while (time < timeStop) {
			income += workers * 0.25;
			if (workers < 18 && time > 5) {
				workers++;
			}
			time++;
		}
		income += (endQuarterMins - time) * workers * 0.25;
	}
	
	var details = startVal + " - " + endVal + ", " + workersAlive + " workers alive initially";
	
	var source = {
		"type" : "Spirit Well Income",
		"startVal" : startVal,
		"endVal" : endVal,
		"workersAlive" : workersAlive,
		"details" : details,
		"roleVim" : 0,
		"totalVim" : income
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}		
}

function populateWellPassive(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("StartTimeSelect").value = source.startVal;
	document.getElementById("EndTimeSelect").value = source.endVal;
	document.getElementById("WorkersAlive").value = source.workersAlive;
}

function saveStrider(calcNum, getInput, sourceNum){
	var striderLevel;
	var lastHit;
	if (getInput == true) {
		striderLevel = document.getElementById("StriderLevelSelect").value;
		lastHit = document.getElementById("LastHit").checked;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		striderLevel = oldSource.striderLevel;
		lastHit = oldSource.lastHit;
	}	
	
	details = striderLevel;
	var level = striderLevels[striderLevel];
	var totalVim = striderBase + level*striderPerLvl;
	var roleVim = 0;
	
	if (lastHit) {
		totalVim *= lastHitProportion;
		details += ", Last Hit";
	} else {
		details += ", No Last Hit";
		if (Calculations[calcNum].role == "Tactician") {
			roleVim = totalVim*tactMinionBonus;
			totalVim += roleVim;
		}
	}

	var source = {
		"type" : "Strider Minion",
		"striderLevel" : striderLevel,
		"lastHit" : lastHit,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populateStrider(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("StriderLevelSelect").value = source.striderLevel;
	document.getElementById("LastHit").checked = source.lastHit;
}

function saveTact(calcNum, getInput, sourceNum){
	var procs;
	var isMelee;
	if (getInput == true) {
		procs = document.getElementById("TacticianProcs").value;
		isMelee = document.getElementById("TacticianMelee").checked;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		procs = oldSource.procs;
		isMelee = oldSource.isMelee;
	}

	var numProcs = parseInt(procs);
	var bonusVim = 0;
	if (Calculations[calcNum].role == "Tactician") {
		if (isMelee) {
			bonusVim = tactMeleeBonus*procs;
		} else {
			bonusVim = tactRangedBonus*procs;
		}
	}
	
	var details = "";
	if (isMelee) {
		details += "Melee Attacks, "
	}
	details += numProcs + " Procs";

	var source = {
		"type" : "Tactician Harass",
		"isMelee" : isMelee,
		"procs" : procs,
		"details" : details,
		"roleVim" : bonusVim,
		"totalVim" : bonusVim
	};
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populateTact(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("TacticianProcs").value = source.procs;
	document.getElementById("TacticianMelee").checked = source.isMelee;
}

function saveWorkers(calcNum, getInput, sourceNum){
	var workers;
	var workerLevel;
	if (getInput == true) {
		workers = document.getElementById("WorkerKills").value;
		workerLevel = document.getElementById("WorkerLevelSelect").value;
	} else {
		var oldSource = Calculations[calcNum].incomeSources[sourceNum];
		workers = oldSource.workers;
		workerLevel = oldSource.workerLevel;
	}
	var level = workerLevels[workerLevel];
	
	var roleVim = 0;
	var totalVim = (workerBaseVim + level*workerPerLvl)*parseInt(workers);
	var details = workerLevel + ", " + workers + " Workers Killed";
	
	if (Calculations[calcNum].role == "Predator") {
		roleVim = predatorWorkerBonus*totalVim;
		totalVim += roleVim;
	}
	
	var source = {
		"type" : "Workers Killed",
		"workers" : workers,
		"workerLevel" : workerLevel,
		"details" : details,
		"roleVim" : roleVim,
		"totalVim" : totalVim
	};	
	if (sourceNum == -1) {
		saveSource(calcNum, source);	
	} else {
		saveUpdatedSource(calcNum, sourceNum, source);
	}	
}

function populateWorkers(calcNum, sourceNum){
	var source = Calculations[calcNum].incomeSources[sourceNum];
	document.getElementById("WorkerKills").value = source.workers;
	document.getElementById("WorkerLevelSelect").value = source.workerLevel;	
}

function saveSource(calcNum, source) {
	var calc = Calculations[calcNum];
	var counter = calc.sourceCounter++;
	
	if (isNaN(source.roleVim) || isNaN(source.totalVim)) {
			source.roleVim = 0;
			source.totalVim = 0;
			source.details = "INVALID INFORMATION GIVEN";
	}
	
	calc.incomeSources[counter] = source;
	addRow(calcNum, counter, source.type, source.details, source.roleVim, source.totalVim);
	updateCalculation(calcNum, source.roleVim, source.totalVim);	
}

function saveUpdatedSource(calcNum, sourceNum, newSource) {
	var calc = Calculations[calcNum];
	var oldSource = calc.incomeSources[sourceNum];
	updateCalculation(calcNum, (-1*oldSource.roleVim), (-1*oldSource.totalVim));
	
	if (isNaN(newSource.roleVim) || isNaN(newSource.totalVim)) {
			newSource.roleVim = 0;
			newSource.totalVim = 0;
			newSource.details = "INVALID INFORMATION GIVEN";
	}
	
	updateCalculation(calcNum, newSource.roleVim, newSource.totalVim);
	calc.incomeSources[sourceNum] = newSource;
	
	updateRow(calcNum, sourceNum, newSource.details, newSource.roleVim, newSource.totalVim);
}

function addRow(calcNum, sourceNum, type, details, roleVim, totalVim) {

	var table = document.getElementById("CalculationTable[" + calcNum + "]");
	numRows = table.rows.length;
	var row = table.insertRow(numRows-1);
	row.id = "row[" + calcNum + "," + sourceNum + "]";
	var cell1 = row.insertCell(0);
	var cell2 = row.insertCell(1);
	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	var cell5 = row.insertCell(4);
	cell1.innerHTML=type;
	cell2.innerHTML=details;
	cell3.innerHTML=Math.round(roleVim);
	cell4.innerHTML=Math.round(totalVim);
	cell5.innerHTML="<a href=\"#\" onClick=\"editSource(" + calcNum + ", " + sourceNum + ");return false;\">edit</a>&nbsp;<a href=\"#\" onClick=\"deleteRow(" + calcNum + ", " + sourceNum + ", this);return false;\">delete</a>";
}

function updateRow(calcNum, sourceNum, details, roleVim, totalVim) {
	var row = document.getElementById("row[" + calcNum + "," + sourceNum + "]");
	row.cells[1].innerHTML = details;
	row.cells[2].innerHTML = Math.round(roleVim);
	row.cells[3].innerHTML = Math.round(totalVim);
}

function deleteRow(calcNum, sourceNum, r) {
	var i=r.parentNode.parentNode.rowIndex;
	document.getElementById("CalculationTable[" + calcNum + "]").deleteRow(i);
	var source = Calculations[calcNum].incomeSources[sourceNum];
	updateCalculation(calcNum, (-1*source.roleVim), (-1*source.totalVim));
	delete Calculations[calcNum].incomeSources[sourceNum];
}

function updateCalculation(i, roleVim, vim) {
	var calc = Calculations[i];
	calc.totalRoleVim += roleVim;
	calc.totalVim += vim;
	document.getElementById("totalRoleVim[" + i + "]").innerHTML = Math.round(calc.totalRoleVim);
	document.getElementById("totalVim[" + i + "]").innerHTML = Math.round(calc.totalVim);	
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

//TODO: Add additional format checks
function getSecondsFromTime(time) {
	var timeSplit = time.split(":");
	var secs = parseInt(timeSplit[1]);
	var mins = parseInt(timeSplit[0]);
	var totalSeconds = 60*mins + secs;
	return totalSeconds;
}