buildItems = {};

var Shapers = {
  "Amarynth" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0}, 
  "Ashabel" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0}, 
  "Cerulean" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Desecrator" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},
  "Dibs" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Faris" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 380, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},     
  "Fenmore" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Freia" : {health: 540, healthPerLevel: 80, healthRegen: 9, healthRegenPerLevel: 0.85, basicAttack: 61, basicAttackPerLevel: 2.7, attackSpeed: 1.4, attackSpeedPerLevel: 2.5, attackRange: 130, moveSpeed: 400, armor: 19, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1.25, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1}, 
  "Kel" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},  
  "Kindra" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 390, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.3, isMelee: 1},  
  "King of Masks (Geoffrey)" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},  
  "Marah" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 130, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Mikella" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Mina" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Moya" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 130, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Nissa" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0},
  "Petrus" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Raina" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},
  "Renzo" : {health: 540, healthPerLevel: 83, healthRegen: 8, healthRegenPerLevel: 0.85, basicAttack: 85, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130,
  moveSpeed: 385, armor: 20, armorPerLevel: 2.8, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.8, isMelee: 1},
  "Salous" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Varion" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Vex" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0},   
  "Viyana" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},  
  "Voluc" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 170, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Zalgus" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},   
  "Zeri" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Training Dummy" : {health: 0, healthPerLevel: 0, healthRegen: 0, healthRegenPerLevel: 0, basicAttack: 0, basicAttackPerLevel: 0, attackSpeed: 1.0, attackSpeedPerLevel: 0, attackRange: 10, moveSpeed: 0, armor: 0, armorPerLevel: 0, resist: 0, resistPerLevel: 0, attackHaste: 1, spellHaste: 1, attackPower: 1, isMelee: 0, hidden: true},
  "FarisMelee" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 390, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.3, isMelee: 1, hidden: true},  
};

var Items = {};

var Shapes = {};

var Gems = {};

var defaultLoadout = {haste: 4, health: 108, power: 9, armor: 4, passives: {}};

var customLoadout = {passives: {}};

var PassiveDescriptions = {};

var Loadouts = {};

$(document).ready(function(){ 
	populateItemInfo(); 
	// populateShaperInfo(); TODO: Pull down shaper stats once MC does the JSON for it.
	populateShapeInfo();
	populateGemInfo();
	
	select = document.getElementById("shaperMenu");
    for (var key in Shapers) {
		if (Shapers[key].hidden != true) {
			var option=document.createElement("option");
			option.text=key;
			option.value=key;
			select.add(option, null);
		}
	}
	doCalculations();
});

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

function addDblClicks(matchName) {
$(matchName).each(function() 
	{
		var item = $(this).attr('title');
		if (item && item != "")
		{
			$(this).dblclick(function() {
				addItem(item);
			});
		}
	});
}

function addItem(it) {
firstEmptySlot = -1;
  for (i = 5; i>=0; i--) {
    if (buildItems[i] == undefined) {
	  firstEmptySlot = i;
	}
  }
  if (firstEmptySlot != -1) {
    docElt = document.getElementById("buildItem"+(firstEmptySlot));
	docElt.src = Items[it].img;
	docElt.title = it;
	AddItemTooltips(".mobatip"+firstEmptySlot); 
	buildItems[firstEmptySlot] = it;
  } else {
    alert("Your build is already full.");
  }
  doCalculations();
}

function removeItem(it) {
  if (buildItems[it] != undefined) { //Don't want anything to happen if already blank
		docElt = document.getElementById("buildItem"+(it));
		docElt.src = "http://www.moba-champion.com/theorycrafting/Blank.png";
		delete buildItems[it];
		$(".mobatip"+it).tooltipster('destroy');
		docElt.title = "";
		doCalculations();
	}
}

function doCalculations() {

	chosenShaper = document.getElementById("shaperMenu").value;
	if (chosenShaper == "Faris") {
		document.getElementById("FarisForm").style.display = "block";
		if (document.getElementById("farisMeleeRadioButton").checked == true) {
			chosenShaper = "FarisMelee";
		}
	} else {
		document.getElementById("FarisForm").style.display = "none";
	}
	
	var level = document.getElementById("levelSelect").selectedIndex;
	
	var chosenLoadout = defaultLoadout;
	
	if (document.getElementById("customRadioButton").checked == true) {
		chosenLoadout = customLoadout;
	}
  
	document.getElementById("loadoutStats").innerHTML= "";
	if (chosenLoadout.power != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.power,1) + " Power<br/>";
	}
	if (chosenLoadout.percentPower != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.percentPower,1) + "% Power<br/>";
	}
	if (chosenLoadout.haste != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.haste,1) + " Haste<br/>";
	}
	if (chosenLoadout.percentHaste != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.percentHaste,1) + "% Haste<br/>";
	}
	if (chosenLoadout.armor != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.armor,1) + " Armor<br/>";
	}
	if (chosenLoadout.percentArmor != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.percentArmor,1) + "% Armor<br/>";
	}
	if (chosenLoadout.resist != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.resist,1) + " Magic Resist<br/>";
	}
	if (chosenLoadout.percentResist != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.percentResist,1) + "% Magic Resist<br/>";
	}
	if (chosenLoadout.mastery != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.mastery,1) + " Mastery<br/>";
	}
	if (chosenLoadout.defensePen != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.defensePen,1) + " Defense Penetration<br/>";
	}
	if (chosenLoadout.drain != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.drain,1) + "% Lifedrain<br/>";
	}	
	if (chosenLoadout.health != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.health,1) + " Health<br/>";
	}
	if (chosenLoadout.percentHealth != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.percentHealth,1) + "% Health<br/>";
	}
	if (chosenLoadout.healthRegen != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.healthRegen,1) + " Health Regeneration<br/>";
	}
	if (chosenLoadout.moveSpeed != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.moveSpeed,1) + "% Movement Speed<br/>";
	}		
	if (chosenLoadout.cdr != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.cdr,1) + "% Cooldown Reduction<br/>";
	}	
	if (chosenLoadout.vimPer5 != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.vimPer5,1) + " Vim Generation Per 5<br/>";
	}	
	if (chosenLoadout.exp != undefined) {
		document.getElementById("loadoutStats").innerHTML+= "+" + toRoundedString(chosenLoadout.exp,1) + "% Experience<br/>";
	}

	document.getElementById("loadoutStats").innerHTML+=	"<br/>";
	
	for (var loadoutPassive in chosenLoadout.passives) {
		document.getElementById("loadoutStats").innerHTML+= PassiveDescriptions[loadoutPassive] + "<br/>";
	} 	
  
	var strifeCount = document.getElementById("StrifeCounter").value;
	var strifePower = 50*(1 - Math.pow(0.99,strifeCount));
	var strifeHealth = 400*(1 - Math.pow(0.99,strifeCount));
	document.getElementById("NumStrifeStacks").innerHTML = "Strife Stacks: " + strifeCount + ", Extra Power: " + toRoundedString(strifePower,1) + ", Extra Health: " + toRoundedString(strifeHealth,0) + "";
  
  
	var passives = {}
	var vim = 0;
	var power = 0;
	var haste = 0;
	var mastery = 0;
	var drain = 0;
	var defensePen = 0;
	var percentDefensePen = 0;
	var basicAttack = Shapers[chosenShaper].basicAttack + level*Shapers[chosenShaper].basicAttackPerLevel;
	var health = Shapers[chosenShaper].health + level*Shapers[chosenShaper].healthPerLevel;
	var healthRegen = Shapers[chosenShaper].healthRegen + level*Shapers[chosenShaper].healthRegenPerLevel;  
	var armor= Shapers[chosenShaper].armor + level*Shapers[chosenShaper].armorPerLevel;
	var resist = Shapers[chosenShaper].resist + level*Shapers[chosenShaper].resistPerLevel;
	var attackRange = Shapers[chosenShaper].attackRange;
	var moveSpeed = Shapers[chosenShaper].moveSpeed;
	var moveSpeedIncrease = 1;
	var attackSpeed = Shapers[chosenShaper].attackSpeed;
	var levelASBonus = Shapers[chosenShaper].attackSpeedPerLevel * level;
	
	var percentPower = 0;
	var percentHaste = 0;
	var percentHealth = 0;
	var percentArmor = 0;
	var percentResist = 0;
	var bonusExp = 0;
	var bonusVim = 0;
	var bonusCdr = 0;	
  
	//Add stats from equipped items
	for (var it in buildItems) {
		var item = Items[buildItems[it]]; //Best variable names NA
		if (item.vim != undefined) {
			vim += item.vim;
		}    
		if (item.power != undefined) {
			power += item.power;
		}
		if (item.haste != undefined) {
			haste += item.haste;
		}
		if (item.mastery != undefined) {
			mastery += item.mastery;
		}
		if (item.defensePen!= undefined) {
			defensePen+= item.defensePen;
		}    
		if (item.health != undefined) {
			health += item.health;
		}
		if (item.healthRegen != undefined) {
			healthRegen += item.healthRegen;
		}    
		if (item.armor != undefined) {
			armor += item.armor;
		}    
		if (item.resist != undefined) {
			resist += item.resist;
		}
		if (item.drain != undefined) {
			drain += item.drain;
		}
		if (item.moveSpeed != undefined) {
			moveSpeedIncrease += (item.moveSpeed)/100;
		} 
		for (var effect in item.effects) {
			if (passives[effect] != undefined) {
				if (passives[effect] < item.effects[effect]) {
					passives[effect] = item.effects[effect];
				}
			} else {
				passives[effect] = item.effects[effect];
			} 
		} 
	}

	//Add stats from loadout
    if (chosenLoadout.power != undefined) {
      power += chosenLoadout.power;
    }
    if (chosenLoadout.haste != undefined) {
      haste += chosenLoadout.haste;
    }
    if (chosenLoadout.mastery != undefined) {
      mastery += chosenLoadout.mastery;
    }
    if (chosenLoadout.defensePen!= undefined) {
      defensePen+= chosenLoadout.defensePen;
    }    
    if (chosenLoadout.health != undefined) {
      health += chosenLoadout.health;
    }
    if (chosenLoadout.healthRegen != undefined) {
      healthRegen += chosenLoadout.healthRegen;
    }    
    if (chosenLoadout.armor != undefined) {
      armor += chosenLoadout.armor;
    }    
    if (chosenLoadout.resist != undefined) {
      resist += chosenLoadout.resist;
    }
    if (chosenLoadout.drain != undefined) {
      drain += chosenLoadout.drain;
    }
    if (chosenLoadout.moveSpeed != undefined) {
      moveSpeedIncrease += (chosenLoadout.moveSpeed)/100;
    }
    
    if (chosenLoadout.percentPower != undefined) {
      percentPower += chosenLoadout.percentPower;
    }
    if (chosenLoadout.percentHaste != undefined) {
      percentHaste += chosenLoadout.percentHaste;
    }	
    if (chosenLoadout.percentHealth != undefined) {
      percentHealth += chosenLoadout.percentHealth;
    }
    if (chosenLoadout.percentArmor != undefined) {
      percentArmor += chosenLoadout.percentArmor;
    }    
    if (chosenLoadout.percentResist != undefined) {
      percentResist += chosenLoadout.percentResist;
    }
    if (chosenLoadout.vimPer5 != undefined) {
      bonusVim += chosenLoadout.vimPer5;
    }
    if (chosenLoadout.exp != undefined) {
      bonusExp += chosenLoadout.exp;
    }    
    if (chosenLoadout.cdr != undefined) {
      bonusCdr += chosenLoadout.cdr;
    } 
  
	document.getElementById("TotalCost").innerHTML =  "Total Cost: " + vim + " vim";
  
	//TODO: Add more advanced options passives after itempalooza
  
	switch(passives["Guard Crack"])
		{
		case 1:
		  defensePen += 15;
		  delete passives["Guard Crack"]; //Flat stat passives we use here needn't be displayed
		  break;
		} 
	switch(passives["Guard Break"])
		{
		case 1:
			defensePen += 25;
			delete passives["Guard Break"];
			break;
		}  
	switch(passives["Guard Crush"])
		{
		case 1:
			percentDefensePen += 40;
			delete passives["Guard Crush"];
			break;
		}
	switch(passives["Defensive Aura"])
		{
		case 1:
			armor += 8;
			resist += 10;
			break;
		case 2:
			armor += 12;
			resist += 17;  
			break;
		case 3:
			armor += 16;
			resist += 24;      
			break;
		}
	switch(passives["Violence Aura"])
		{
		case 1:
			power += 15;
			mastery += 10;
			break;
		}		
	switch(passives["Soul Collector"])
		{
		case 1:
			power += strifePower;
			health += strifeHealth;
			document.getElementById("StrifeStacks").style.display = "block";
			break;
		default:
			document.getElementById("StrifeStacks").style.display = "none";
		}
		
	if (chosenLoadout.passives["Outrider"] != undefined) {
		document.getElementById("OutriderActive").style.display = "block";
		if (document.getElementById("outriderCheck").checked == true) {
			moveSpeedIncrease += 0.1;
		}
	} else {
		document.getElementById("OutriderActive").style.display = "none";
	}
	if (chosenLoadout.passives["Reaper"] != undefined) {
		document.getElementById("ReaperActive").style.display = "block";
		if (document.getElementById("reaperCheck").checked == true) {
			power += 30;
		}
	} else {
		document.getElementById("ReaperActive").style.display = "none";
	}
	if (chosenLoadout.passives["Scavenger"] != undefined) {
		document.getElementById("ScavengerActive").style.display = "block";
		if (document.getElementById("scavengerCheck").checked == true) {
			moveSpeedIncrease += 0.1;
		}
	} else {
		document.getElementById("ScavengerActive").style.display = "none";
	}
	if (chosenLoadout.passives["Adventurer"] != undefined) {
		document.getElementById("AdventurerActive").style.display = "block";
		if (document.getElementById("adventurerCheck").checked == true) {
			moveSpeedIncrease += 0.08;
		}
	} else {
		document.getElementById("AdventurerActive").style.display = "none";
	}
	if (chosenLoadout.passives["Ravager"] != undefined) {
		document.getElementById("RavagerSeconds").style.display = "block";
		var secs = parseFloat(document.getElementById("numSecondsCombat").value);
		if (secs >10) {
			secs = 10;
		} else if (secs < 0){
			secs = 0;
		}
		power += secs*(7 + level)/10;	
	} else {
		document.getElementById("RavagerSeconds").style.display = "none";
	}
	if (chosenLoadout.passives["Brawler"] != undefined) {
		document.getElementById("BrawlerEnemies").style.display = "block";
		var enems = parseInt(document.getElementById("numNearbyEnemies").value);
		if (enems > 5) {
			enems = 5;
		} else if (enems < 0){
			enems = 0;
		}
		armor += enems*(3 + level*4/19);	
		resist += enems*(3 + level*4/19);
	} else {
		document.getElementById("BrawlerEnemies").style.display = "none";
	}	
		
	//Percent Increases from Loadout Stats
	power *= (percentPower + 100)/100;
	haste *= (percentHaste + 100)/100;
	health *= (percentHealth + 100)/100;
	armor *= (percentArmor + 100)/100;
	resist *= (percentResist + 100)/100;		

	switch(passives["Vitality Blessing"])
		{
		case 1:
			drain *= 1.3;
			healthRegen *= 1.3;
			break;
		}   
	switch(passives["Stoneskin Aura"])
		{
		case 1:
			armor *= 1.08;
		break;
		}		
	switch(passives["Eagle Eye"])
		{
		case 1:
			attackRange *= 1.2;
			delete passives["Eagle Eye"];
			break;
		}

	switch(passives["Juggernaut"])
		{
		case 1:
			power += 0.015*health;
			break;
		}
		
	if (chosenLoadout.passives["Hoplite"] != undefined) {
		power += 0.12*armor;
	}

	//Calculate and display final stats
	basicAttack += power * Shapers[chosenShaper].attackPower;
	moveSpeed += 0.38*haste;
	moveSpeed *= moveSpeedIncrease;
	var hasteASBonus = haste*Shapers[chosenShaper].attackHaste;
	var attacksPerSecond = (1 + 0.01*(hasteASBonus + levelASBonus))/attackSpeed;
	var cdr = 100 - (100 - bonusCdr)*100/(100 + haste*Shapers[chosenShaper].spellHaste);

	//TODO: Display these results in a nicer way
	results = "";  
	//Compound stats
	results += "<b>Power:</b> " + toRoundedString(power, 1) + "<br/>";
	results += "<b>Haste:</b> " + toRoundedString(haste, 1) + "<br/>";
	results += "<b>Mastery:</b> " + toRoundedString(mastery, 1) + "<br/><br/>";  

	//Attack stats
	results += "<b>Basic Attack:</b> " + toRoundedString(basicAttack, 1) + "<br/>";
	results += "<b>Attacks per Second:</b> " + toRoundedString(attacksPerSecond, 2) + "<br/>";
	results += "<b>Critical Chance:</b> " + toRoundedString(mastery, 1) + "%<br/>";
	var dps = basicAttack*attacksPerSecond;
	dps *= (1 + mastery/100);
	results += "<b>Basic DPS:</b> " + toRoundedString(dps, 1) + "<br/>";
	results += "<b>Attack Range:</b> " + toRoundedString(attackRange, 0) + "<br/><br/>";

	//Defense stats
	results += "<b>Health:</b> " + toRoundedString(health, 0) + "<br/>";
	results += "<b>Health Regen per 5:</b> " + toRoundedString(healthRegen, 2) + "<br/>";
	results += "<b>Armor:</b> " + toRoundedString(armor, 1) + "<br/>";
	results += "<b>Magic Resist:</b> " + toRoundedString(resist, 1) + "<br/>";
	results += "<b>Physical Damage Reduction:</b> " + toRoundedString(100 - 10000/(100+armor),0) + "%<br/>";
	results += "<b>Magical Damage Reduction:</b> " + toRoundedString(100 - 10000/(100+resist),0) + "%<br/><br/>";  

	//Other stats
	results += "<b>Cooldown Reduction:</b> " + toRoundedString(cdr, 1) + "%<br/>";
	results += "<b>Move Speed:</b> " + toRoundedString(moveSpeed, 0) + "<br/>"  
	results += "<b>Flat Defense Penetration:</b> " + toRoundedString(defensePen, 0) + "<br/>";
	results += "<b>Percent Defense Penetration:</b> " + toRoundedString(percentDefensePen, 0) + "%<br/>";
	results += "<b>Spell Overload:</b> " + toRoundedString(mastery/2, 1) + "%<br/>";
	results += "<b>Life Drain:</b> " + toRoundedString(drain, 1) + "%<br/><br/>"; 
	
	//Vim and XP
	results += "<b>Bonus Experience:</b> " + toRoundedString(bonusExp, 1) + "%<br/>";
	results += "<b>Vim Generation Per 5:</b> " + toRoundedString(bonusVim, 1) + "<br/><br/>";	

	document.getElementById("StatsResults").innerHTML = results;

	//List the passive effects
	//TODO: Probably want to hardcode all this so we can use stats to determine the values in passives. Or maybe add enough special cases that it does pseudo natural language processing.
	passivesText = "";
  
	for (var p in passives) {
		if (passivesText == "") {
			passivesText = PassiveDescriptions[p][passives[p]];
		} else {
			passivesText += "<br/><br/>" + PassiveDescriptions[p][passives[p]];
		}
	}
	document.getElementById("PassivesResults").innerHTML = passivesText;
  
	//Display results vs target shaper
	targetHP = document.getElementById("TargetHPInput").value;
	targetArmor = document.getElementById("TargetArmorInput").value;
	targetResist = document.getElementById("TargetResistInput").value;

	armorAfterPen = targetArmor*(100 - percentDefensePen)/100 - defensePen;
	if (armorAfterPen < 0) {
		armorAfterPen = 0;
	}
	resistAfterPen = targetResist*(100 - percentDefensePen)/100 - defensePen;
	if (resistAfterPen < 0) {
		resistAfterPen = 0;
	}	
	physicalAttackDamage = basicAttack*100/(100 + armorAfterPen);
	totalBasicAttack = physicalAttackDamage;

	targetResults = "";
	
	//Target Stats
	targetResults += "<b>Target Armor After Penetration:</b> " + toRoundedString(armorAfterPen,1) + "<br/>";
	targetResults += "<b>Target Magic Resist After Penetration:</b> " + toRoundedString(resistAfterPen,1) + "<br/><br/>";	
	
	//Per Attack
	targetResults += "<b>Basic Attack Damage:</b> " + toRoundedString(physicalAttackDamage,1) + "<br/>";
	switch(passives["Giant Killer"])
		{
		case 1:
			fourPercentHealth = 0.04*targetHP;
			mitigatedGiantKiller = fourPercentHealth*100/(100 + armorAfterPen);
			totalBasicAttack += mitigatedGiantKiller;
			targetResults += "<b>Giant Killer Damage:</b> " + toRoundedString(mitigatedGiantKiller,1) + "<br/>";
			break;
		}		
	targetResults +="<b>Total Damage per Basic Attack (No Crit):</b> " + toRoundedString(totalBasicAttack,1) + "<br/>";
	totalBasicAttackCrit = totalBasicAttack += mastery*basicAttack/(100 + armorAfterPen);
	targetResults +="<b>Total Expected Damage per Basic Attack:</b> " + toRoundedString(totalBasicAttackCrit,1) + "<br/><br/>";
	
	//Per Unit Time
	dpsMitigated = totalBasicAttackCrit*attacksPerSecond;

	switch(passives["Puncture"])
		{
		case 1:
			punctureDamage = 40 + 0.4*power;
			targetResults += "<b>Puncture Damage Per 3 Seconds:</b> " + toRoundedString(punctureDamage,1) + "<br/>";
			dpsMitigated += punctureDamage/3;
			break;
		}	
	targetResults += "<b>DPS vs Target:</b> " + toRoundedString(dpsMitigated,1) + "<br/>";
	document.getElementById("MitigatedResults").innerHTML = targetResults;
  
}

//Rounds num to dp decimal places and removes trailing zeros
function toRoundedString(num, dp) {
	return (Math.round(num*Math.pow(10,dp))/Math.pow(10,dp)).toString();
}

function populateItemInfo() {
	var data;
	var dataLoaded = false;
	var jsonURL = 'http://moba-champion.com/data/itemdata.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1) {
		jsonURL = 'http://www.moba-champion.com/data/itemdata.json'; // cross-origin-domain-policy OP
	}
	
	$.getJSON(jsonURL, function(dat) {
		data = dat;
		dataLoaded = true;
	  
		if (dataLoaded == true)	{
			$.each(data, function()	{	
				if (this.type != "1") {
					Items[this.name] = {};
					itm = Items[this.name]; //Apparently IE freaks out if you use the variable name item here so it's called itm now!
					itm.vim = this.cost;
					itm.img = this.img;
					
					summary = this.summary;
					
					//Process summary to work out item stats
					match = /\+(\d+)\sPower/i.exec(summary);
					if (match != null) {
						itm.power = parseFloat(match[1]);
					}
					match = /\+(\d+)\sArmor/i.exec(summary);
					if (match != null) {
						itm.armor = parseFloat(match[1]);
					}
					match = /\+(\d+)\sHaste/i.exec(summary);
					if (match != null) {
						itm.haste = parseFloat(match[1]);
					}
					match = /\+(\d+)\sMagic/i.exec(summary);
					if (match != null) {
						itm.resist = parseFloat(match[1]);
					}
					match = /\+(\d+)\sMastery/i.exec(summary);
					if (match != null) {
						itm.mastery = parseFloat(match[1]);
					}
					match = /\+(\d+)\sHealth(?! Regen)/i.exec(summary);
					if (match != null) {
						itm.health = parseFloat(match[1]);
					}
					match = /\+(\d+)\sHealth\sRegen/i.exec(summary);
					if (match != null) {
						itm.healthRegen = parseFloat(match[1]);
					}
					match = /\+(\d+)%\sLifedrain/i.exec(summary);
					if (match != null) {
						itm.drain = parseFloat(match[1]);
					}	
					match = /\+(\d+)\sDefense/i.exec(summary);
					if (match != null) {
						itm.defensePen = parseFloat(match[1]);
					}
					match = /\+(\d+)%\sMovespeed/i.exec(summary);
					if (match != null) {
						itm.moveSpeed = parseFloat(match[1]);
					}

					passive1 = this.passive1;
					passive2 = this.passive2;

					itm.effects = {}
					
					numeralToValue = {"I":1, "II":2, "III":3};
					
					if (passive1 != "") {
						p1Split = passive1.split(/:\s?<BR>/); //Split at ': <BR>' to grab the passive name
						p1NameSplit = p1Split[0].split(" ");
					
						lastElt = p1NameSplit[p1NameSplit.length - 1];
						p1Val = numeralToValue[lastElt]; //Uses the numeral to work out what level of the passive this is
						if (p1Val == undefined) { //No numeral means treat it as a number 1
							p1Val = 1;
						} else {
							p1NameSplit.splice(-1, 1);
						}
					
						p1Name = p1NameSplit.join(" ");
						itm.effects[p1Name] = p1Val;
						
						if (PassiveDescriptions[p1Name] == undefined) {
							PassiveDescriptions[p1Name] = {};
						}
						name = p1Split[0];
						p1Split.splice(0,1);
						PassiveDescriptions[p1Name][p1Val] = "<b>" + name + "</b>: <BR>" + p1Split.join(": <BR>");
						
						if (passive2 != "") {
							p2Split = passive2.split(/:\s?<BR>/);
							if (p2Split.length > 1) { //Checks if passive 2 is named. If yes, do the same as for passive 1
								p2NameSplit = p2Split[0].split(" ");
						
								lastElt = p2NameSplit[p2NameSplit.length - 1];
								p2Val = numeralToValue[lastElt];
								if (p2Val == undefined) {
									p2Val = 1;
								} else {
									p2NameSplit.splice(-1, 1);
								}
						
								p2Name = p2NameSplit.join(" ");
								itm.effects[p2Name] = p2Val;
								
								if (PassiveDescriptions[p2Name] == undefined) {
									PassiveDescriptions[p2Name] = {};
								}
								name = p2Split[0];
								p2Split.splice(0,1);
								PassiveDescriptions[p2Name][p2Val] = "<b>" + name + "</b>: <BR>" + p2Split.join(": <BR>");
							} else { //If not named, treat it as a continuation of the description for passive 1
								PassiveDescriptions[p1Name][p1Val] += "<br/>" + passive2;
							}
						}						
					}					
					
				}
			});
		}	  
	});
}

function populateShapeInfo() {
	var data;
	var dataLoaded = false;
	var jsonURL = 'http://moba-champion.com/loadouts/shapes.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1) {
		jsonURL = 'http://www.moba-champion.com/loadouts/shapes.json';
	}
	wait = true;
	
	$.getJSON(jsonURL, function(dat) {
		data = dat;
		dataLoaded = true;
		if (dataLoaded == true) {
			$.each(data, function() {
				for (s in this) {
				
					shapeData = this[s];
					Shapes[shapeData.id] = {};
					shape = Shapes[shapeData.id];
					bonus = shapeData.bonus;
					shape.gems = shapeData.gems;
					
					//First check if it's a passive stone
					match = /Unique\sPassive\s-\s(.+):/.exec(bonus)
					if (match != null) {
						shape.passive = match[1];
						PassiveDescriptions[shape.passive] = bonus;
					} else {
					
						//Process bonus to work out stats
						match = /\+((\.|\d)+)\sPower/i.exec(bonus);
						if (match != null) {
							shape.power = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Power/i.exec(bonus);
						if (match != null) {
							shape.percentPower = parseFloat(match[1]);
						}				
						match = /\+((\.|\d)+)\sArmor/i.exec(bonus);
						if (match != null) {
							shape.armor = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Armor/i.exec(bonus);
						if (match != null) {
							shape.percentArmor = parseFloat(match[1]);
						}				
						match = /\+((\.|\d)+)\sHaste/i.exec(bonus);
						if (match != null) {
							shape.haste = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Haste/i.exec(bonus);
						if (match != null) {
							shape.percentHaste = parseFloat(match[1]);
						}				
						match = /\+((\.|\d)+)\sMagic/i.exec(bonus);
						if (match != null) {
							shape.resist = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Magic/i.exec(bonus);
						if (match != null) {
							shape.percentResist = parseFloat(match[1]);
						}				
						match = /\+((\.|\d)+)\sMastery/i.exec(bonus);
						if (match != null) {
							shape.mastery = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sHealth(?!-)/i.exec(bonus);
						if (match != null) {
							shape.health = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Health/i.exec(bonus);
						if (match != null) {
							shape.percentHealth = parseFloat(match[1]);
						}				
						match = /\+((\.|\d)+)\sHealth-Regeneration/i.exec(bonus);
						if (match != null) {
							shape.healthRegen = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Lifedrain/i.exec(bonus);
						if (match != null) {
							shape.drain = parseFloat(match[1]);
						}	
						match = /\+((\.|\d)+)\sDefense/i.exec(bonus);
						if (match != null) {
							shape.defensePen = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Movement/i.exec(bonus);
						if (match != null) {
							shape.moveSpeed = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Experience/i.exec(bonus);
						if (match != null) {
							shape.exp = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sVim/i.exec(bonus);
						if (match != null) {
							shape.vimPer5 = parseFloat(match[1]);
						}
						match = /\+((\.|\d)+)\sPercent-Cooldown-Reduction/i.exec(bonus);
						if (match != null) {
							shape.cdr = parseFloat(match[1]);
						}
					
					}
				}
			});
		}
	});
}

function populateGemInfo() {
	var data;
	var dataLoaded = false;
	var jsonURL = 'http://moba-champion.com/loadouts/gems.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1) {
		jsonURL = 'http://www.moba-champion.com/loadouts/gems.json';
	}
	wait = true;
	
	$.getJSON(jsonURL, function(dat) {
		data = dat;
		dataLoaded = true;
		if (dataLoaded == true) {
			$.each(data, function() {	
				Gems[this.id] = {};
				gem = Gems[this.id];
				bonus = this.bonus;
				gem.color = this.color;
				
				//Process bonus to work out stats
				match = /\+((\.|\d)+)\sPower/i.exec(bonus);
				if (match != null) {
					gem.power = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Power/i.exec(bonus);
				if (match != null) {
					gem.percentPower = parseFloat(match[1]);
				}				
				match = /\+((\.|\d)+)\sArmor/i.exec(bonus);
				if (match != null) {
					gem.armor = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Armor/i.exec(bonus);
				if (match != null) {
					gem.percentArmor = parseFloat(match[1]);
				}				
				match = /\+((\.|\d)+)\sHaste/i.exec(bonus);
				if (match != null) {
					gem.haste = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Haste/i.exec(bonus);
				if (match != null) {
					gem.percentHaste = parseFloat(match[1]);
				}				
				match = /\+((\.|\d)+)\sMagic/i.exec(bonus);
				if (match != null) {
					gem.resist = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Magic/i.exec(bonus);
				if (match != null) {
					gem.percentResist = parseFloat(match[1]);
				}				
				match = /\+((\.|\d)+)\sMastery/i.exec(bonus);
				if (match != null) {
					gem.mastery = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sHealth(?!-)/i.exec(bonus);
				if (match != null) {
					gem.health = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Health/i.exec(bonus);
				if (match != null) {
					gem.percentHealth = parseFloat(match[1]);
				}				
				match = /\+((\.|\d)+)\sHealth-Regeneration/i.exec(bonus);
				if (match != null) {
					gem.healthRegen = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sDefense/i.exec(bonus);
				if (match != null) {
					gem.defensePen = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sVim/i.exec(bonus);
				if (match != null) {
					gem.vimPer5 = parseFloat(match[1]);
				}
				match = /\+((\.|\d)+)\sPercent-Cooldown-Reduction/i.exec(bonus);
				if (match != null) {
					gem.cdr = parseFloat(match[1]);
				}				
				
			});
		}
	});
}

function loadLoadout() {

	shareUrl = document.getElementById("shareLink").value;
	shareId = /http:\/\/www\.moba-champion\.com\/loadouts\/index\.php\?l=(\d+)/.exec(shareUrl);
	if (shareId) {
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				response = xmlhttp.responseText;
				match = /<loadoutString>(.+)<\/loadoutString>/.exec(response);
				if (match) {
					loadoutUpdated(match[1]);
				} else {
					window.alert("Invalid Share Link");
				}
				
			}
		}	  
		xmlhttp.open("GET","./loadouts/loadoutinfo.php?l="+shareId[1],true);
		xmlhttp.send();
	} else {
		window.alert("Invalid Share Link");
	}
}

function loadoutUpdated(str) {
	document.getElementById("customRadioButton").checked = true;
	customLoadout = {passives: {}};
	
	var customShapes = str.slice(0, -1).split("_");
	for (var s in customShapes) {
		shape = customShapes[s];
		shapeInfo = shape.split(",");
		
		shapeId = shapeInfo[2];
		shapeData = Shapes[shapeId];
		
		var active = true;
		var gemSlots = shapeData.gems;
		for (var i = 0; i < parseInt(shapeInfo[4]); i++) {
			gemId = shapeInfo[5+i];
			
			if (gemId != "-1") {
				addGemToCustom(gemId);
				correctColor = gemSlots[i].color;
				if (correctColor != "combo" && correctColor != Gems[gemId].color) {
					active = false;
				}
			} else {
				active = false;
			}
		}
		
		if (active) {
			addShapeToCustom(shapeId);
		}
	}
	doCalculations();
}

function addGemToCustom(gemId) {
	var gem = Gems[gemId];
	
	if (gem.power != undefined) {
		if (customLoadout.power != undefined) {
			customLoadout.power += gem.power;
		} else {
			customLoadout.power = gem.power;
		}
	}
	if (gem.percentPower != undefined) {
		if (customLoadout.percentPower != undefined) {
			customLoadout.percentPower += gem.percentPower;
		} else {
			customLoadout.percentPower = gem.percentPower;
		}
	}
	if (gem.armor != undefined) {
		if (customLoadout.armor != undefined) {
			customLoadout.armor += gem.armor;
		} else {
			customLoadout.armor = gem.armor;
		}
	}	
	if (gem.percentArmor != undefined) {
		if (customLoadout.percentArmor != undefined) {
			customLoadout.percentArmor += gem.percentArmor;
		} else {
			customLoadout.percentArmor = gem.percentArmor;
		}
	}
	if (gem.resist != undefined) {
		if (customLoadout.resist != undefined) {
			customLoadout.resist += gem.resist;
		} else {
			customLoadout.resist = gem.resist;
		}
	}	
	if (gem.percentResist != undefined) {
		if (customLoadout.percentResist != undefined) {
			customLoadout.percentResist += gem.percentResist;
		} else {
			customLoadout.percentResist = gem.percentResist;
		}
	}	
	if (gem.haste != undefined) {
		if (customLoadout.haste != undefined) {
			customLoadout.haste += gem.haste;
		} else {
			customLoadout.haste = gem.haste;
		}
	}	
	if (gem.percentHaste != undefined) {
		if (customLoadout.percentHaste != undefined) {
			customLoadout.percentHaste += gem.percentHaste;
		} else {
			customLoadout.percentHaste = gem.percentHaste;
		}
	}	
	if (gem.health != undefined) {
		if (customLoadout.health != undefined) {
			customLoadout.health += gem.health;
		} else {
			customLoadout.health = gem.health;
		}
	}
	if (gem.percentHealth != undefined) {
		if (customLoadout.percentHealth != undefined) {
			customLoadout.percentHealth += gem.percentHealth;
		} else {
			customLoadout.percentHealth = gem.percentHealth;
		}
	}
	if (gem.healthRegen != undefined) {
		if (customLoadout.healthRegen != undefined) {
			customLoadout.healthRegen += gem.healthRegen;
		} else {
			customLoadout.healthRegen = gem.healthRegen;
		}
	}
	if (gem.mastery != undefined) {
		if (customLoadout.mastery != undefined) {
			customLoadout.mastery += gem.mastery;
		} else {
			customLoadout.mastery = gem.mastery;
		}
	}
	if (gem.defensePen != undefined) {
		if (customLoadout.defensePen != undefined) {
			customLoadout.defensePen += gem.defensePen;
		} else {
			customLoadout.defensePen = gem.defensePen;
		}
	}
	if (gem.cdr != undefined) {
		if (customLoadout.cdr != undefined) {
			customLoadout.cdr += gem.cdr;
		} else {
			customLoadout.cdr = gem.cdr;
		}
	}
	if (gem.vimPer5 != undefined) {
		if (customLoadout.vimPer5 != undefined) {
			customLoadout.vimPer5 += gem.vimPer5;
		} else {
			customLoadout.vimPer5 = gem.vimPer5;
		}
	}	
}

function addShapeToCustom(shapeId) {
	var shape = Shapes[shapeId];
	
	if (shape.power != undefined) {
		if (customLoadout.power != undefined) {
			customLoadout.power += shape.power;
		} else {
			customLoadout.power = shape.power;
		}
	}
	if (shape.percentPower != undefined) {
		if (customLoadout.percentPower != undefined) {
			customLoadout.percentPower += shape.percentPower;
		} else {
			customLoadout.percentPower = shape.percentPower;
		}
	}
	if (shape.armor != undefined) {
		if (customLoadout.armor != undefined) {
			customLoadout.armor += shape.armor;
		} else {
			customLoadout.armor = shape.armor;
		}
	}	
	if (shape.percentArmor != undefined) {
		if (customLoadout.percentArmor != undefined) {
			customLoadout.percentArmor += shape.percentArmor;
		} else {
			customLoadout.percentArmor = shape.percentArmor;
		}
	}
	if (shape.resist != undefined) {
		if (customLoadout.resist != undefined) {
			customLoadout.resist += shape.resist;
		} else {
			customLoadout.resist = shape.resist;
		}
	}	
	if (shape.percentResist != undefined) {
		if (customLoadout.percentResist != undefined) {
			customLoadout.percentResist += shape.percentResist;
		} else {
			customLoadout.percentResist = shape.percentResist;
		}
	}	
	if (shape.haste != undefined) {
		if (customLoadout.haste != undefined) {
			customLoadout.haste += shape.haste;
		} else {
			customLoadout.haste = shape.haste;
		}
	}	
	if (shape.percentHaste != undefined) {
		if (customLoadout.percentHaste != undefined) {
			customLoadout.percentHaste += shape.percentHaste;
		} else {
			customLoadout.percentHaste = shape.percentHaste;
		}
	}	
	if (shape.health != undefined) {
		if (customLoadout.health != undefined) {
			customLoadout.health += shape.health;
		} else {
			customLoadout.health = shape.health;
		}
	}
	if (shape.percentHealth != undefined) {
		if (customLoadout.percentHealth != undefined) {
			customLoadout.percentHealth += shape.percentHealth;
		} else {
			customLoadout.percentHealth = shape.percentHealth;
		}
	}
	if (shape.healthRegen != undefined) {
		if (customLoadout.healthRegen != undefined) {
			customLoadout.healthRegen += shape.healthRegen;
		} else {
			customLoadout.healthRegen = shape.healthRegen;
		}
	}
	if (shape.mastery != undefined) {
		if (customLoadout.mastery != undefined) {
			customLoadout.mastery += shape.mastery;
		} else {
			customLoadout.mastery = shape.mastery;
		}
	}
	if (shape.defensePen != undefined) {
		if (customLoadout.defensePen != undefined) {
			customLoadout.defensePen += shape.defensePen;
		} else {
			customLoadout.defensePen = shape.defensePen;
		}
	}
	if (shape.cdr != undefined) {
		if (customLoadout.cdr != undefined) {
			customLoadout.cdr += shape.cdr;
		} else {
			customLoadout.cdr = shape.cdr;
		}
	}
	if (shape.vimPer5 != undefined) {
		if (customLoadout.vimPer5 != undefined) {
			customLoadout.vimPer5 += shape.vimPer5;
		} else {
			customLoadout.vimPer5 = shape.vimPer5;
		}
	}
	if (shape.moveSpeed != undefined) {
		if (customLoadout.moveSpeed != undefined) {
			customLoadout.moveSpeed += shape.moveSpeed;
		} else {
			customLoadout.moveSpeed = shape.moveSpeed;
		}
	}
	if (shape.drain != undefined) {
		if (customLoadout.drain != undefined) {
			customLoadout.drain += shape.drain;
		} else {
			customLoadout.drain = shape.drain;
		}
	}
	if (shape.exp != undefined) {
		if (customLoadout.exp != undefined) {
			customLoadout.exp += shape.exp;
		} else {
			customLoadout.exp = shape.exp;
		}
	}	
	
	if (shape.passive != undefined) {
		customLoadout.passives[shape.passive] = 1;
	}		
}