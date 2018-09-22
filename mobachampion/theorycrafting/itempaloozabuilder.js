buildItems = {};

var totalItems = 88;
var totalGems = 15;
var totalShapes = 72;

var Shapers = {
  "Amarynth" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0}, 
  "Ashabel" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0}, 
  "Basko" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Cerulean" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Desecrator" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},
  "Dibs" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Faris" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 380, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},     
  "Fenmore" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Flin" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},
  "Freia" : {health: 540, healthPerLevel: 80, healthRegen: 9, healthRegenPerLevel: 0.85, basicAttack: 61, basicAttackPerLevel: 2.7, attackSpeed: 1.4, attackSpeedPerLevel: 2.5, attackRange: 130, moveSpeed: 400, armor: 19, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1.25, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1}, 
  "Kahgen" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},  
  "Kel" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},  
  "Kensu" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Kindra" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 390, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.3, isMelee: 1},  
  "King of Masks" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},  
  "Marah" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 130, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Mikella" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Mina" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Moya" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 130, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Nissa" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0},
  "Petrus" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Raina" : {health: 530, healthPerLevel: 78, healthRegen: 8, healthRegenPerLevel: 0.55, basicAttack: 61, basicAttackPerLevel: 2.85, attackSpeed: 1.5, attackSpeedPerLevel: 2.4, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 3.1, resist: 33, resistPerLevel: 1, attackHaste: 0.5, spellHaste: 0.5, attackPower: 0.8, isMelee: 1},
  "Renzo" : {health: 540, healthPerLevel: 83, healthRegen: 8, healthRegenPerLevel: 0.85, basicAttack: 85, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 385, armor: 20, armorPerLevel: 2.8, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.8, isMelee: 1},
  "Salous" : {health: 515, healthPerLevel: 65, healthRegen: 7.5, healthRegenPerLevel: 0.65, basicAttack: 59, basicAttackPerLevel: 2.4, attackSpeed: 1.5, attackSpeedPerLevel: 3.1, attackRange: 130, moveSpeed: 390, armor: 19, armorPerLevel: 3.4, resist: 33, resistPerLevel: 1, attackHaste: 0.6, spellHaste: 0.6, attackPower: 1.0, isMelee: 1},
  "Sakari" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0}, 
  "Tess" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Varion" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0}, 
  "Viridian" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 390, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.3, isMelee: 1},  
  "Vex" : {health: 520, healthPerLevel: 77, healthRegen: 5, healthRegenPerLevel: 0.6, basicAttack: 58, basicAttackPerLevel: 2.2, attackSpeed: 1.4, attackSpeedPerLevel: 2.4, attackRange: 550, moveSpeed: 370, armor: 16, armorPerLevel: 3.0, resist: 33, resistPerLevel: 0, attackHaste: 1.0, spellHaste: 0.15, attackPower: 1.0, isMelee: 0},   
  "Viyana" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},  
  "Voluc" : {health: 540, healthPerLevel: 84, healthRegen: 8, healthRegenPerLevel: 0.5, basicAttack: 63, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 3.0, attackRange: 170, moveSpeed: 395, armor: 21, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 1.0, spellHaste: 0.2, attackPower: 1.0, isMelee: 1},
  "Zalgus" : {health: 450, healthPerLevel: 67, healthRegen: 5, healthRegenPerLevel: 0.45, basicAttack: 54, basicAttackPerLevel: 2.8, attackSpeed: 1.5, attackSpeedPerLevel: 1.6, attackRange: 550, moveSpeed: 380, armor: 15, armorPerLevel: 3.1, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},   
  "Zeri" : {health: 440, healthPerLevel: 65, healthRegen: 5, healthRegenPerLevel: 0.5, basicAttack: 53, basicAttackPerLevel: 2.7, attackSpeed: 1.5, attackSpeedPerLevel: 2.0, attackRange: 550, moveSpeed: 380, armor: 10, armorPerLevel: 2.9, resist: 33, resistPerLevel: 0, attackHaste: 0.2, spellHaste: 0.6, attackPower: 0.2, isMelee: 0},
  "Training Dummy" : {health: 0, healthPerLevel: 0, healthRegen: 0, healthRegenPerLevel: 0, basicAttack: 0, basicAttackPerLevel: 0, attackSpeed: 1.0, attackSpeedPerLevel: 0, attackRange: 10, moveSpeed: 0, armor: 0, armorPerLevel: 0, resist: 0, resistPerLevel: 0, attackHaste: 1, spellHaste: 1, attackPower: 1, isMelee: 0, hidden: true},
  "FarisMelee" : {health: 530, healthPerLevel: 78, healthRegen: 7.5, healthRegenPerLevel: 0.6, basicAttack: 59, basicAttackPerLevel: 2.6, attackSpeed: 1.5, attackSpeedPerLevel: 2.6, attackRange: 130, moveSpeed: 390, armor: 19.5, armorPerLevel: 3.3, resist: 33, resistPerLevel: 1, attackHaste: 0.3, spellHaste: 0.6, attackPower: 0.3, isMelee: 1, hidden: true},  
};

//I'm hardcoding passives here to allow smarter display and passive stacking that pure text parsing wouldn't reasonably allow
var Passives = {
	"Consume" : {"textDisplay" : function(I, II, III) {
		var consumeText = "";
		var toText = ["two", "three", "four", "five", "six"];
		if (I > 0) {
			var quantityText = "";
			var chancesText = "is a 33% chance";
			if (I > 1) {
				quantityText = " (x" + I + ") ";
				chancesText = "are " + toText[I-2] + " 33% chances";
			}		
			consumeText += "<b>Stackable Passive - Consume I" + quantityText + ":</b><BR>When a nearby enemy dies there " + chancesText + " that you will be healed for 3 Health. The amount healed is doubled for melee shapers.";
		}
		if (II > 0) {
			if (I > 0) {
				consumeText += "<br/><br/>";
			}
			var quantityText = "";
			var chancesText = "is a 66% chance";
			if (II > 1) {
				quantityText = " (x" + II + ") ";
				chancesText = "are " + toText[II-2] + " 66% chances";
			}			
			consumeText += "<b>Stackable Passive - Consume II" + quantityText + ":</b><BR>When a nearby enemy dies there " + chancesText + " that you will be healed for 7 Health. The amount healed is doubled for melee shapers.";
		}
		if (III > 0) {
			if (I + II > 0) {
				consumeText += "<br/><br/>";
			}
			var quantityText = "";
			if (III > 1) {
				quantityText = " (x" + III + ") ";
			}
			var heal = 12*III;
			consumeText += "<b>Stackable Passive - Consume III" + quantityText + ":</b><BR>When a nearby enemy dies you will be healed for " + heal + " Health. The amount healed is doubled for melee shapers.";
		}
		return consumeText;
	}},
	"Toughness" : {"textDisplay" : function(I, II, III) {
		if (III > 0) {
			return "<b>Unique Passive - Toughness III:</b><BR>Reduces the damage taken from basic attacks by 15%.";
		} else if (II > 0) {
			return "<b>Unique Passive - Toughness II:</b><BR>Reduces the damage taken from basic attacks by 8%.";
		} else {
			var reduction = 3;
			quantityText = "";
			if (I > 1) {
				quantityText = " (x" + I + ") ";
				reduction += 1.5*(I-1);
			}
			return "<b>Stackable Passive - Toughness I" + quantityText + ":</b><BR>Reduces the damage taken from basic attacks by " + reduction + ". The reduction is tripled against shapers";
		}
	}},
	"Void" : {"textDisplay" : function(I, II, III) {
		var reduction = 10;
		quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
			reduction += 5*(I-1);
		}		
		return "<b>Stackable Passive - Void" + quantityText + ":</b><BR>Reduces any magical damage taken by " + reduction + ". The reduction is only half as effective against damage over time effects.";}},
	"Life Leech" : {"textDisplay" : function(I, II, III) {
		var heal = 5*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Life Leech" + quantityText + ":</b><BR>Dealing damage causes you to restore " + heal + " Health. The amount healed is doubled against shapers. This effect has a 0.5 second cooldown.";
	}},
	"Transfusion" : {"textDisplay" : function(I, II, III) {
		var heal = 30*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Transfusion" + quantityText + ":</b><BR>You transfuse the allied shaper with the lowest health percentage within 800 range, healing them for " + heal + " Health. This effect has a 15 second cooldown.";
	}},
	"Blaze" : {"textDisplay" : function(I, II, III) {
		var damage = 30*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Blaze" + quantityText + ":</b><BR>Your basic attacks set the target ablaze, causing them to take " + damage + " magical damage over 3 seconds, stacking up to 3 times.";
	}},
	"Vanguard" : {"textDisplay" : function(I, II, III) {
		var damage = 0.1*I*buildStats.armor;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Vanguard" + quantityText + ":</b><BR>Your abilities will deal an additional <b class='armor_scaling'>" + toRoundedString(damage,0) + "</b> damage. This bonus is only 33% as effective for Damage Over Time abilities.";
	}},
	"Inner Peace" : {"textDisplay" : function(I, II, III) {
		var powerReduction = 10*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Inner Peace" + quantityText + ":</b><BR>Dealing damage calms the target, reducing their Power by " + powerReduction + " for 3 seconds.";
	}},
	"Shield Wall" : {"textDisplay" : function(I, II, III) {
		var bonus = 35*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Shield Wall" + quantityText + ":</b><BR>When you drop below 50% Health, you gain " + bonus + " Armor and " + bonus + " Magic Resistance for 4 seconds. This effect has a 30 second cooldown.";
	}},
	"Fervor" : {"textDisplay" : function(I, II, III) {
		var heal = 40*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Fervor" + quantityText + ":</b><BR>Taking damage from an enemy shaper will cause you to regenerate " + heal + " Health over 10 seconds.";
	}},
	"Will Thief" : {"advDisplay" : function(I, II, III) {
			buildStats.advWillThief = true;
			var stacks = document.getElementById("WillThiefCounter").value;
			var extraResist = stacks*3*I;
			document.getElementById("NumWillThiefStacks").innerHTML = "Stacks: " + stacks + ", Extra Magic Resist: " + extraResist;
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("WillThiefCounter").value;
			buildStats.resist += stacks*3*I;		
		},
		"textDisplay" : function(I, II, III) {
			var theft = 3*I;
			var quantityText = "";
			if (I > 1) {
				quantityText = " (x" + I + ") ";
			}
			return "<b>Stackable Passive - Will Thief" + quantityText + ":</b><BR>Dealing damage causes you to steal the target's Magic Resistance, reducing it by " + theft + " and increasing yours by the same amount for 4 seconds. This effect stacks up to 5 times.";
	}},
	"Tenacity" : {"textDisplay" : function(I, II, III) {
		var reduction = 100*(1 - Math.pow(0.65,I));
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Tenacity" + quantityText + ":</b><BR>Reduces the duration of all disabling effects except for suppression by " + toRoundedString(reduction, 0) + "%.";
	}},
	"Soul Collector" : {"advDisplay" : function(I, II, III) {
			buildStats.advMight = true;
			var stacks = document.getElementById("MightCounter").value;
			var extraPower = stacks*0.5;
			var extraHealth = stacks*4;
			document.getElementById("NumMightStacks").innerHTML = "Stacks: " + stacks + ", Extra Power: " + extraPower + ", Extra Health: " + extraHealth;			
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("MightCounter").value;
			buildStats.power += stacks*0.5;
			buildStats.health += stacks*4;		
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Soul Collector:</b><BR>Killing a minion, creature, or worker permanently grants 4 bonus Health and 0.5 bonus Power. The bonuses stack up to 30 times.";
	}},
	"Surge" : {"textDisplay" : function(I, II, III) {
		var bonus = 0.1*I*buildStats.power;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Surge:</b><BR>Using an ability grants you <b class='power_scaling'>" + bonus + "</b> Power for 4 seconds. This effect has a 2 second cooldown.";
	}},
	"Frost" : {"textDisplay" : function(I, II, III) {
		if (II > 0) {
			return "<b>Unique Passive - Frost II:</b><BR>Dealing damage will slow the target for 1 second based on the type of attack used.<BR><BR>Ranged basic attacks: 25%<BR>Melee basic attacks: 40%<BR>Single Target Abilities: 35%<BR>AoE and DoT Abilities: 15%";
		} else {
			return "<b>Unique Passive - Frost I:</b><BR>Dealing damage will slow the target for 1 second based on the type of attack used.<BR><BR>Ranged basic attacks: 12.5%<BR>Melee basic attacks: 20%<BR>Single Target Abilities: 17.5%<BR>AoE and DoT Abilities: 7.5%";
		}
	}},
	"Precision" : {"textDisplay" : function(I, II, III) {
		var bonus = 25*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Precision" + quantityText + ":</b><BR>Your basic attacks deal an additional " + bonus + " bonus physical damage.";
	}},
	"Brilliance" : {"textDisplay" : function(I, II, III) {
		var spellReduction = 10*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}
		return "<b>Stackable Passive - Brilliance" + quantityText + ":</b><BR>Your spellbook spells have " + spellReduction + "% cooldown reduction.";
	}},
	"Shock" : {"textDisplay" : function(I, II, III) {
		var damage = (20 + 0.5*buildStats.power)*I;
		var quantityText = "";
		if (I > 1) {
			quantityText = " (x" + I + ") ";
		}		
		return "<b>Stackable Passive - Shock" + quantityText + ":</b><BR>Whenever you deal damage to an enemy, you also zap them for an additional <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> magical damage. This effect has a 10 second cooldown.";
	}},
	"Endless Bounty" : {"advDisplay" : function(I, II, III) {
			buildStats.advProsperity = true;
			var stacks = document.getElementById("ProsperityCounter").value;
			var extraHealth = stacks*20;
			var extraArmor = stacks*2.5;
			var extraResist = stacks*1.5;
			document.getElementById("NumProsperityStacks").innerHTML = "Stacks/Minutes: " + stacks + ", Extra Health: " + extraHealth + ", Extra Armor: " + extraArmor + ", Extra Magic Resist: " + extraResist;				
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("ProsperityCounter").value;
			buildStats.health += stacks*20;
			buildStats.armor += stacks*2.5;
			buildStats.resist += stacks*1.5;
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Endless Bounty:</b><BR>Every 60 seconds, you gain 20 Health, 2.5 Armor, and 1.5 Magic Resistance. These bonuses stack up to 10 times.";
	}},
	"Cornered Beast" : {"advDisplay" : function(I, II, III) {
			buildStats.advDefiance = true;
			remainingHealthDisplay();
		},
		"flatIncrease" : function(I, II, III) {
			var remainingHealth = document.getElementById("RemainingHealthSlider").value;
			if (remainingHealth < 25) {
				buildStats.bonusCdr += 50; //TODO: Check if it's implemented this way or just halves cooldowns
			}
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Cornered Beast:</b><BR>When you drop below 25% Health all of your non-ultimate abilities have their cooldowns reset and as long as you remain below 25% Health you gain 50% cooldown reduction.";
	}},
	"Juggernaut" : {"percentIncrease" : function(I, II, III) {
		buildStats.power += 0.015*buildStats.health;
	}},
	"Symbiosis" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Symbiosis:</b><BR>Nearby allied shapers gain 10 Health Regen and Symbiosis. When allies under the influence of Symbiosis deal damage your cooldowns are reduced by 0.25 seconds. Whenever you deal damage, allies under the influence of Symbiosis gain 20 Power for 2 seconds.<BR><BR>The cooldown reduction effect can only be triggered once every 0.5 seconds.";
	}},
	"Devotion Aura" : {"textDisplay" : function(I, II, III) {
		var heal = 45 + 0.2*buildStats.power;
		return "<b>Unique Passive - Devotion Aura:</b><BR>You and nearby allied shapers gain 20 Armor and 15 Magic Resistance. Additionally, you will heal the allied shaper with the lowest health percentage within the aura for <b class='power_scaling'>" + toRoundedString(heal,0) + "</b>. This healing effect has a 15 second cooldown.";
	}},
	"Plague Host" : {"textDisplay" : function(I, II, III) {
		var damage = 100 + 0.4*buildStats.power;
		return "<b>Unique Passive - Plague Host:</b><BR>The closest allied shaper within 800 units gains 10 Health Regen and becomes a Plague Carrier, infecting enemies whenever they deal damage. The infection reduces the victim's movement speed by 30% and deals <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> magical damage over 2 seconds.";
	}},
	"Blazing Aura" : {"textDisplay" : function(I, II, III) {
		var damage = 20 + 0.01*buildStats.health;
		return "<b>Unique Passive - Blazing Aura:</b><BR>You are wreathed in flame, dealing <b class='health_scaling'>" + toRoundedString(damage,0) + "</b> magical damage per second to nearby enemies.";
	}},
	"Hellfire" : {"textDisplay" : function(I, II, III) {
		var damage = 75 + 0.3*buildStats.power;
		return "<b>Unique Passive - Hellfire:</b><BR>Your basic attacks ignite the target, dealing 30 magical damage over 3 seconds and stacking up to 3 times. Every third attack against a target affected by Hellfire will cause the target to erupt with flame, dealing <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> magical damage to each enemy within 500 units.";
	}},
	"Ashborn" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Ashborn:</b><BR>When you drop below 30% Health, you surge with lifeforce, recovering (30% max HP) Health over 5 seconds. This effect has a 120 second cooldown.";
	}},
	"Vital Blessing" : {"percentIncrease" : function(I, II, III) {
			buildStats.regen *= 1.3;
			buildStats.drain *= 1.3;
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Vital Blessing:</b><BR>Increases the effectiveness of lifedrain, regen, and healing effects on you by 30%.";
	}},
	"Wellspring" : {"advDisplay" : function(I, II, III) {
			buildStats.advVibrance = true;
			remainingHealthDisplay();
		},
		"percentIncrease" : function(I, II, III) {
			var missingHealth = 100 - document.getElementById("RemainingHealthSlider").value;
			buildStats.healthRegen *= (missingHealth + 100)/100;
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Wellspring:</b><BR>For every 1% Health you are missing your Health Regen is increased by 1%.";
	}},
	"Lockdown" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Lockdown:</b><BR>Taking physical damage from enemy shapers builds a stack of Lockdown for 4 seconds. At 5 stacks Lockdown will activate, reducing any nearby enemies' movespeed by 30% and attack speed by 40% for 3 seconds.";
	}},
	"Ablative Armor" : {"advDisplay" : function(I, II, III) {
			buildStats.advPreservation = true;
			var stacks = document.getElementById("PreservationCounter").value;
			var extraPower = stacks*6;
			document.getElementById("NumPreservationStacks").innerHTML = "Stacks: " + stacks + ", Extra Power: " + extraPower;
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("PreservationCounter").value;
			buildStats.power += stacks*6;		
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Ablative Armor:</b><BR>You gain five stacks of Ablation, increasing your Power by 6 per stack for a total of 30 bonus Power. Enemy Shaper basic attacks remove one stack of Ablation but are reduced in damage by 15% in the process. Ablation stacks are refreshed upon exiting combat.";
	}},
	"Subdue" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Subdue:</b><BR>Dealing damage will reduce the target's Power by 10 and attack speed by 30% for 3 seconds.";
	}},
	"Power Lock" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Power Lock:</b><BR>Dealing damage reduces the target's Power by 10 and all damage they deal by 10% for 3 seconds.";
	}},
	"Life Link" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Life Link:</b><BR>Redirects 10% of the damage nearby allied shapers would take to you instead. This effect deactivates when you are below 25% Health.";
	}},
	"Avatar" : {"advDisplay" : function(I, II, III) {
			buildStats.advHope = true;
		},
		"percentIncrease" : function(I, II, III) {
			if (document.getElementById("HopeCheck").checked) {
				buildStats.armor *= 1.5;
				buildStats.resist *= 1.5;
			}
		},
		"textDisplay" : function(I, II, III) {
			var extraArmor = 0.5*buildStats.armor;
			var extraResist = 0.5*buildStats.resist;
			return "<b>Unique Passive - Avatar:</b><BR>When you drop below 50% Health, you gain <b class='armor_scaling'>" + toRoundedString(extraArmor,0) + "</b> Armor, <b class='resist_scaling'>" + toRoundedString(extraResist,0) + "</b> Magic Resistance, and 20% Damage Reduction for 3 seconds. Damaging an enemy extends this effect by 1 seconds, to a maximum of 6 seconds. This effect has a 30 second cooldown.";
	}},
	"Arcane Aegis" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Arcane Aegis:</b><BR>Every 4 seconds you will gain a shield that absorbs up to 25 magical damage. This effect will continue to stack until the shield reaches a value of 375.";
	}},
	"Mage Slayer" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Mage Slayer:</b><BR>10% of the raw magical damage that would be dealt to you is stored instead. The stored damage is released as bonus magic damage on your next basic attack.";
	}},
	"Contempt" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Contempt:</b><BR>Your basic attacks deal an additional 45 bonus magical damage.";
	}},
	"Despair Aura" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Despair Aura:</b><BR>Nearby enemies have their Magic Resist reduced by 15.";
	}},
	"Last Stand" : {"advDisplay" : function(I, II, III) {
			buildStats.advValor = true;
			remainingHealthDisplay();
		},
		"flatIncrease" : function(I, II, III) {
			var missingHealth = 100 - document.getElementById("RemainingHealthSlider").value;
			buildStats.power += 0.5*(missingHealth);
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Last Stand:</b><BR>Grants bonus Power based on your missing health, up to a maximum of 50 Power. Additionally, when you would drop below 30% Health, you will first gain a shield that absorbs 350 damage for 5 seconds. This effect has a 60 second cooldown.";
	}},
	"Swift Recovery" : {"advDisplay" : function(I, II, III) {
			buildStats.advStability = true;
		},
		"flatIncrease" : function(I, II, III) {
			if (document.getElementById("StabilityCheck").checked) {
				buildStats.moveSpeedIncrease += 0.4;
			}
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Swift Recovery:</b><BR>You gain 40% bonus movement speed for 1 second whenever a disabling effect expires from you.";
	}},
	"Unshakable" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Unshakable:</b><BR>Every 30 seconds you will gain a shield that will prevent the first disabling effect used against you.";
	}},
	"Soul Master" : {"advDisplay" : function(I, II, III) {
			buildStats.advStrife = true;
			var stacks = document.getElementById("StrifeCounter").value;
			var extraPower = 50*(1 - Math.pow(0.99,stacks));
			var extraHealth = 400*(1 - Math.pow(0.99,stacks));
			document.getElementById("NumStrifeStacks").innerHTML = "Stacks: " + stacks + ", Extra Power: " + toRoundedString(extraPower,1) + ", Extra Health: " + toRoundedString(extraHealth,0);
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("StrifeCounter").value;
			buildStats.power += 50*(1 - Math.pow(0.99,stacks));
			buildStats.health += 400*(1 - Math.pow(0.99,stacks));
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Soul Master:</b><BR>Whenever you kill a minion, creature, or worker, you gain permanent bonus Health and Power. The bonuses start at 4 Health and 0.5 Power per stack and decreases by 1% for each additional stack. Any previous bonuses from the Soul Collector passive of Might are carried forward and included.";
	}},
	"Spirit Burn" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Spirit Burn:</b><BR>Dealing damage with abilities will deal 6% of the targets maximum Health over 3 seconds as magical damage. Damage against non-shapers cannot exceed 320 total damage.";
	}},
	"Enlightenment" : {"percentIncrease" : function(I, II, III) {
		buildStats.power *= 1.15;
	}},
	"Power Overwhelming" : {"advDisplay" : function(I, II, III) {
			buildStats.advJustice = true;
		},
		"flatIncrease" : function(I, II, III) {
			if (document.getElementById("JusticeCheck").checked) {
				buildStats.moveSpeedIncrease += 0.1;
			}
		},
		"percentIncrease" : function(I, II, III) {
			if (document.getElementById("JusticeCheck").checked) {
				buildStats.power *= 1.1;
				buildStats.haste *= 1.2;
				buildStats.mastery *= 1.2;
			}
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Power Overwhelming:</b><BR>Using an ability grants you 10% increased Power and Movespeed and 20% increased Haste and Mastery for 3 seconds. This effect has a 2.5 second cooldown.";
	}},
	"Sundering Strikes" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Sundering Strikes:</b><BR>Dealing damage reduces the target's Armor or Magic Resist by 5% for 4 seconds, depending on if the damage dealt was physical or magical. This effect stacks up to 4 times for a maximum reduction of 20%.";
	}},
	"Furious Assault" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Furious Assault:</b><BR>Your basic attacks and abilities passively penetrate 60% of your target's bonus defenses.";
	}},
	"Guard Break" : {"flatIncrease" : function(I, II, III) {
		buildStats.defensePen += 25;
	}},
	"Relentless" : {"advDisplay" : function(I, II, III) {
			buildStats.advPursuit = true;
		},
		"flatIncrease" : function(I, II, III) {
			if (document.getElementById("PursuitCheck").checked) {
				buildStats.moveSpeed += 60;
			}
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Relentless:</b><BR>Dealing damage to an enemy will reduce their movement speed by 60 and increase your movement speed by 60 for 2 seconds.";
	}},
	"Violence Aura" : {"flatIncrease" : function(I, II, III) {
			buildStats.power += 15;
			buildStats.mastery += 10;
		},
		"textDisplay" : function(I, II, III) {
			return "<b>Unique Passive - Violence Aura:</b><BR>You and all nearby allied shapers are granted 15 Power and 10 Mastery.";
	}},
	"Mortal Strike" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Mortal Strike:</b><BR>Dealing damage to an enemy will Mortal Strike them, reducing the effects of Heals, Regen, and Lifedrain by 50% for 3 seconds.";
	}},
	"Obliterate" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Obliterate:</b><BR>Your critical strike damage is increased by 50%.";
	}},
	"Prodigy" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Prodigy:</b><BR>Your abilities will overload for an additional 5% damage.";
	}},
	"Spirit Walk" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Spirit Walk:</b><BR>You move through units without colliding.";
	}},
	"Commanding Presence" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Commanding Presence:</b><BR>Allied shapers within 1200 range move 15% faster while moving towards you.";
	}},
	"Unstoppable" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Unstoppable:</b><BR>The effects of movement speed slows are reduced by 35%.";
	}},
	"Zealous Charge" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Zealous charge:</b><BR>Melee Shapers: Issuing an attack command outside of melee basic attack range will cause you to dash to the target.<BR>Ranged Shapers: Issuing an attack command from inside of melee basic attack range will cause you to disengage from the target, dashing away from them.  This effect has a 20 second cooldown.";
	}},
	"Aftermath" : {"textDisplay" : function(I, II, III) {
		var damage = 50 + 1.2*buildStats.power;
		return "<b>Unique Passive - Aftermath:</b><BR>After using an ability, your next basic attack within 6 seconds will deal <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> additional physical damage. This effect has a 3 second cooldown.";
	}},	
	"Giant Killer" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Giant Killer:</b><BR>Your basic attacks deal an additional 10 (+2% of the target's maximum Health)(+8% of the target's Health) as physical damage.  Bonus damage against non-shapers cannot exceed 225 damage hit.";
	}},
	"Exploit Weakness" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Exploit Weakness:</b><BR>Your basic attacks deal an additional 10 bonus physical damage and causes all damage you deal to the target to be increased by 3% for 3 seconds.  The damage amplification applies only to your damage and stacks up to 5 times for a total of 15% increased damage.";
	}},
	"Windstrike Aura" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Windstrike Aura:</b><BR>You and all nearby allied shapers have a 25% chance when attacking of triggering an additional basic attack that deals 50% damage.";
	}},
	"Zephyr Aura" : {"advDisplay" : function(I, II, III) {
			buildStats.advGrace = true;
		},
		"flatIncrease" : function(I, II, III) {
			if (document.getElementById("GraceCheck").checked) {
				buildStats.moveSpeedIncrease += 0.6;
			}
		},
		"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Zephyr Aura:</b><BR>You and nearby allied shapers gain 40% increased movement speed for 2 seconds upon scoring a kill or an assist on an enemy shaper.";
	}},
	"Fast Forward" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Fast Forward:</b><BR>Dealing damage with basic attacks reduces the cooldown of all of your abilities by 0.5 seconds. The cooldown reduction is only half as effective when dealing damage against a non shaper.";
	}},	
	"Collateral Damage" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Collateral Damage:</b><BR>Dealing damage with basic attacks fires shrapnel at up to 3 enemies near the target, each dealing 40% of the initial damage dealt to the primary target. Fate applies on-hit and other item effects but will not propagate effects that apply only to the primary target.";
	}},
	"Eagle Eye" : {"percentIncrease" : function(I, II, III) {
		buildStats.attackRange *= 1.2;
	}},
	"Puncture" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Puncture:</b><BR>Your basic attacks will deal an additional 5% of their damage as true damage.";
	}},
	"Netherbind" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Netherbind:</b><BR>Basic attacks against enemy shapers will root them for 1 second. This effect has a 10 second cooldown. Basic attacks reduce the cooldown by 1 second.";
	}},
	"Stormcall" : {"textDisplay" : function(I, II, III) {
		var damage = 20 + 0.5*buildStats.power;
		return "<b>Unique Passive - Stormcall:</b><BR>Whenever you damage an enemy with a single-target abilities, they are also struck by lightning that deals magical damage equal to <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> plus 6% of the target's current Health. This effect has a 6 second cooldown.";
	}},	
	"Chain Lightning" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Chain Lightning:</b><BR>Dealing damage causes a chain lightning, dealing 100(+10% of the damage dealt) as magical damage to up to 4 nearby enemies and causes them to take 10% increased magical damage for 3 seconds. This effect has a 6 second cooldown.";
	}},
	"Static Discharge" : {"textDisplay" : function(I, II, III) {
		var damage = 15 + 0.1*buildStats.power;
		return "<b>Unique Passive - Static Discharge:</b><BR>Your basic attacks become charged, dealing <b class='power_scaling'>" + toRoundedString(damage,0) + "</b> bonus magical damage before arcing to random enemy within 450 units of your primary target, dealing magical damage to them equal to 50% of the damage your attack dealt to the primary target.";
	}},
	"Blood Fever" : {"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Blood Fever:</b><BR>Your abilities have an additional 15% Lifedrain.";
	}},
	"Desperate Thirst" : {"advDisplay" : function(I, II, III) {
			buildStats.advAmbition = true;
			remainingHealthDisplay();
		},
		"flatIncrease" : function(I, II, III) {
			var missingHealth = 100 - document.getElementById("RemainingHealthSlider").value;
			buildStats.haste += 0.3*missingHealth;
			buildStats.drain += 0.1*missingHealth;
		},
		"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Desperate Thirst:</b><BR>Grants bonus Haste and Lifedrain based on your missing health, up to a maximum of 30 Haste and 10% Lifedrain.";
	}},
	"Rising Hunger" : {"advDisplay" : function(I, II, III) {
			buildStats.advVoracity = true;
			var stacks = document.getElementById("VoracityCounter").value;
			var extraPower = stacks*6;
			var extraDrain = stacks;
			document.getElementById("NumVoracityStacks").innerHTML = "Stacks: " + stacks + ", Extra Power: " + extraPower + ", Extra Lifedrain: " + extraDrain;
		},
		"flatIncrease" : function(I, II, III) {
			var stacks = document.getElementById("VoracityCounter").value;
			buildStats.power += stacks*6;
			buildStats.drain += stacks*1;
		},
		"textDisplay" : function(I, II, III) {
		return "<b>Unique Passive - Rising Hunger:</b><BR>Dealing damage with basic attacks grant 6 Power and 1% Lifedrain. This effect stacks up to 5 times for a maximum bonus of 30 Power and 5% Lifedrain. Stacks last 4 seconds.";
	}},	
	"Undying Storm" : {"textDisplay" : function(I, II, III) {
		var heal = 75 + 0.7*buildStats.power;
		return "<b>Unique Passive - Undying Storm:</b><BR>Whenever you score a kill or assist on an enemy shaper, you are instantly healed for <b class='power_scaling'>" + toRoundedString(heal,0) + "</b> Health.";
	}}
};

//External function so we can display the appropriate info under the health slider
function remainingHealthDisplay() {
	buildStats.advHealth = true;
	var remainingHealth = document.getElementById("RemainingHealthSlider").value;
	var healthText = "Remaining Health: " + remainingHealth + "%";
	if (buildStats.advDefiance) {
		if (remainingHealth < 25) {
			healthText += ", Extra CDR: 50%";
		} else {
			healthText += ", Extra CDR: 0%";
		}
		
	}
	if (buildStats.advVibrance) {
		healthText += ", Extra Health Regen: " + (100 - remainingHealth) + "%";
	}
	if (buildStats.advValor) {
		healthText += ", Extra Power: " + (0.5*(100 - remainingHealth));
	}
	if (buildStats.advAmbition) {
		healthText += ", Extra Haste: " + toRoundedString(0.3*(100 - remainingHealth), 1) + ", Extra Lifedrain: " + toRoundedString(0.1*(100 - remainingHealth), 1) + "%";
	}
	document.getElementById("RemainingHealthDisplay").innerHTML = healthText;	
}

var ItemPassives = {
	"Life" : {"Consume" : 1},
	"Resilience" : {"Toughness" : 1},
	"Will" : {"Void" : 1},
	"Hunger" : {"Life Leech" : 1},
	"Vigor" : {"Consume" : 2},
	"Purity" : {"Transfusion" : 1},
	"Pride" : {"Blaze" : 1},
	"Form" : {"Vanguard" : 1},
	"Integrity" : {"Toughness" : 2},
	"Discipline" : {"Inner Peace" : 1},
	"Resolve" : {"Shield Wall" : 1},
	"Conviction" : {"Fervor" : 1},
	"Balance" : {"Will Thief" : 1},
	"Freedom" : {"Tenacity" : 1},
	"Might" : {"Soul Collector" : 1},
	"Command" : {"Surge" : 1},
	"Control" : {"Frost" : 1},
	"Abolition" : {"Precision" : 1},
	"Inspiration" : {"Brilliance" : 1},
	"Energy" : {"Shock" : 1},
	"Prosperity" : {"Consume" : 3, "Endless Bounty" : 1},
	"Defiance" : {"Consume" : 3, "Cornered Beast" : 1},
	"Rampancy" : {"Consume" : 3, "Juggernaut" : 1},
	"Harmony" : {"Symbiosis" : 1},
	"Devotion" : {"Devotion Aura" : 1},
	"Pestilence" : {"Plague Host" : 1},
	"Glory" : {"Blazing Aura" : 1},
	"Vengeance" : {"Hellfire" : 1},
	"Rebirth" : {"Ashborn" : 1},
	"Creation" : {"Vital Blessing" : 1},
	"Vibrance" : {"Wellspring" : 1},
	"Adamance" : {"Lockdown" : 1, "Vanguard" : 1},
	"Preservation" : {"Ablative Armor" : 1, "Vanguard" : 1},
	"Order" : {"Toughness" : 3},
	"Equilibrium" : {"Subdue" : 1},
	"Subjugation" : {"Power Lock" : 1},
	"Empathy" : {"Life Link" : 1},
	"Hope" : {"Avatar" : 1},
	"Faith" : {"Fervor" : 1, "Arcane Aegis" : 1},
	"Retribution" : {"Fervor" : 1, "Mage Slayer" : 1},
	"Betrayal" : {"Contempt" : 1, "Will Thief" : 1},
	"Oppression" : {"Despair Aura" : 1, "Will Thief" : 1},
	"Valor" : {"Last Stand" : 1, "Will Thief" : 1},
	"Stability" : {"Swift Recovery" : 1, "Tenacity" : 1},
	"Momentum" : {"Unshakable" : 1, "Tenacity" : 1},
	"Strife" : {"Soul Master" : 1},
	"Decay" : {"Spirit Burn" : 1, "Soul Collector" : 1},
	"Wisdom" : {"Enlightenment" : 1},
	"Justice" : {"Power Overwhelming" : 1},
	"Judgement" : {"Sundering Strikes" : 1},
	"Rage" : {"Furious Assault" : 1},
	"Destruction" : {"Guard Break" : 1},
	"Inevitability" : {"Frost" : 2},
	"Pursuit" : {"Relentless" : 1},
	"Hostility" : {"Violence Aura" : 1},
	"Pain" : {"Mortal Strike" : 1},
	"Dominance" : {"Obliterate" : 1},
	"Divinity" : {"Prodigy" : 1},
	"Fluidity" : {"Spirit Walk" : 1},
	"Influence" : {"Commanding Presence" : 1, "Unstoppable": 1},
	"Impulse" : {"Zealous Charge" : 1},
	"Conquest" : {"Aftermath" : 1, "Precision" : 1},
	"Ruin" : {"Giant Killer" : 1},
	"Finesse" : {"Exploit Weakness" : 1},
	"Corruption" : {"Mortal Strike" : 1, "Brilliance" : 1},
	"Furor" : {"Windstrike Aura" : 1, "Brilliance" : 1},
	"Grace" : {"Zephyr Aura" : 1, "Brilliance" : 1},
	"Zeal" : {"Fast Forward" : 1, "Brilliance" : 1},
	"Fate" : {"Collateral Damage" : 1},
	"Insight" : {"Eagle Eye" : 1, "Puncture" : 1},
	"Duress" : {"Netherbind" : 1},
	"Potency" : {"Stormcall" : 1},
	"Chaos" : {"Chain Lightning" : 1},
	"Resonance" : {"Static Discharge" : 1},
	"Passion" : {"Blood Fever" : 1},
	"Ambition" : {"Desperate Thirst" : 1},
	"Voracity" : {"Rising Hunger" : 1},
	"Assimilation" : {"Undying Storm" : 1}
};

var Items = {};

var Shapes = {};

var Gems = {};

var defaultLoadout = {haste: 4, health: 108, power: 9, armor: 4, passives: {}};

var customLoadout = {passives: {}};

var Loadouts = {};

var PassiveDescriptions = {};

var buildStats = {};

var loadoutCode = 0;

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
			if (savedShaper == key) {
				option.selected=true;
			}
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
	AddItemPTooltips(".mobatip"+firstEmptySlot); 
	buildItems[firstEmptySlot] = it;	
	doCalculations();
  } else {
    alert("Your build is already full.");
  }
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
  
	//TODO: Add more advanced options passives
	// var strifeCount = document.getElementById("StrifeCounter").value;
	// var strifePower = 50*(1 - Math.pow(0.99,strifeCount));
	// var strifeHealth = 400*(1 - Math.pow(0.99,strifeCount));
	// document.getElementById("NumStrifeStacks").innerHTML = "Strife Stacks: " + strifeCount + ", Extra Power: " + toRoundedString(strifePower,1) + ", Extra Health: " + toRoundedString(strifeHealth,0) + "";
  
  
	var smartPassives = {};
	buildStats.vim = 0;
	buildStats.power = 0;
	buildStats.haste = 0;
	buildStats.mastery = 0;
	buildStats.drain = 0;
	buildStats.defensePen = 0;
	buildStats.basicAttack = Shapers[chosenShaper].basicAttack + level*Shapers[chosenShaper].basicAttackPerLevel;
	buildStats.health = Shapers[chosenShaper].health + level*Shapers[chosenShaper].healthPerLevel;
	buildStats.healthRegen = Shapers[chosenShaper].healthRegen + level*Shapers[chosenShaper].healthRegenPerLevel;  
	buildStats.armor = Shapers[chosenShaper].armor + level*Shapers[chosenShaper].armorPerLevel;
	buildStats.resist = Shapers[chosenShaper].resist + level*Shapers[chosenShaper].resistPerLevel;
	buildStats.attackRange = Shapers[chosenShaper].attackRange;
	buildStats.moveSpeed = Shapers[chosenShaper].moveSpeed;
	buildStats.moveSpeedIncrease = 1;
	buildStats.attackSpeed = Shapers[chosenShaper].attackSpeed;
	buildStats.levelASBonus = Shapers[chosenShaper].attackSpeedPerLevel * level;
	
	buildStats.percentPower = 0;
	buildStats.percentHaste = 0;
	buildStats.percentHealth = 0;
	buildStats.percentArmor = 0;
	buildStats.percentResist = 0;
	buildStats.bonusExp = 0;
	buildStats.bonusVim = 0;
	buildStats.bonusCdr = 0;

	//For keeping track of which advanced options need to display
	buildStats.advHealth = false;
	buildStats.advDefiance = false;
	buildStats.advVibrance = false;
	buildStats.advValor = false;
	buildStats.advAmbition = false;
	buildStats.advProsperity = false;
	buildStats.advPreservation = false;
	buildStats.advWillThief = false;
	buildStats.advMight = false;
	buildStats.advStrife = false;
	buildStats.advVoracity = false;
	buildStats.advHope = false;
	buildStats.advStability = false;
	buildStats.advJustice = false;
	buildStats.advPursuit = false;
	buildStats.advGrace = false;
  
	//Add stats from equipped items
	for (var it in buildItems) {
		var item = Items[buildItems[it]]; //Best variable names NA
		if (item.vim != undefined) {
			buildStats.vim += item.vim;
		}    
		if (item.power != undefined) {
			buildStats.power += item.power;
		}
		if (item.haste != undefined) {
			buildStats.haste += item.haste;
		}
		if (item.mastery != undefined) {
			buildStats.mastery += item.mastery;
		}
		if (item.defensePen!= undefined) {
			buildStats.defensePen+= item.defensePen;
		}    
		if (item.health != undefined) {
			buildStats.health += item.health;
		}
		if (item.healthRegen != undefined) {
			buildStats.healthRegen += item.healthRegen;
		}    
		if (item.armor != undefined) {
			buildStats.armor += item.armor;
		}    
		if (item.resist != undefined) {
			buildStats.resist += item.resist;
		}
		if (item.drain != undefined) {
			buildStats.drain += item.drain;
		}
		if (item.moveSpeed != undefined) {
			buildStats.moveSpeedIncrease += (item.moveSpeed)/100;
		} 
		for (var effect in item.effects) {
			if (smartPassives[effect] == undefined) {
				smartPassives[effect] = [0,0,0];	
			} 	
			smartPassives[effect][item.effects[effect] - 1]++;
		} 
	}

	//Add stats from loadout
    if (chosenLoadout.power != undefined) {
      buildStats.power += chosenLoadout.power;
    }
    if (chosenLoadout.haste != undefined) {
      buildStats.haste += chosenLoadout.haste;
    }
    if (chosenLoadout.mastery != undefined) {
      buildStats.mastery += chosenLoadout.mastery;
    }
    if (chosenLoadout.defensePen!= undefined) {
      buildStats.defensePen+= chosenLoadout.defensePen;
    }    
    if (chosenLoadout.health != undefined) {
      buildStats.health += chosenLoadout.health;
    }
    if (chosenLoadout.healthRegen != undefined) {
      buildStats.healthRegen += chosenLoadout.healthRegen;
    }    
    if (chosenLoadout.armor != undefined) {
      buildStats.armor += chosenLoadout.armor;
    }    
    if (chosenLoadout.resist != undefined) {
      buildStats.resist += chosenLoadout.resist;
    }
    if (chosenLoadout.drain != undefined) {
      buildStats.drain += chosenLoadout.drain;
    }
    if (chosenLoadout.moveSpeed != undefined) {
      buildStats.moveSpeedIncrease += (chosenLoadout.moveSpeed)/100;
    }
    
    if (chosenLoadout.percentPower != undefined) {
      buildStats.percentPower += chosenLoadout.percentPower;
    }
    if (chosenLoadout.percentHaste != undefined) {
      buildStats.percentHaste += chosenLoadout.percentHaste;
    }	
    if (chosenLoadout.percentHealth != undefined) {
      buildStats.percentHealth += chosenLoadout.percentHealth;
    }
    if (chosenLoadout.percentArmor != undefined) {
      buildStats.percentArmor += chosenLoadout.percentArmor;
    }    
    if (chosenLoadout.percentResist != undefined) {
      buildStats.percentResist += chosenLoadout.percentResist;
    }
    if (chosenLoadout.vimPer5 != undefined) {
      buildStats.bonusVim += chosenLoadout.vimPer5;
    }
    if (chosenLoadout.exp != undefined) {
      buildStats.bonusExp += chosenLoadout.exp;
    }    
    if (chosenLoadout.cdr != undefined) {
      buildStats.bonusCdr += chosenLoadout.cdr;
    } 
  
	document.getElementById("TotalCost").innerHTML =  "Total Cost: " + buildStats.vim + " vim";
  	
	//Check which item advanced options to display
	for (var p in smartPassives) {
		var sp = smartPassives[p];
		if (Passives[p]["advDisplay"] != undefined) {
			Passives[p]["advDisplay"](sp[0],sp[1],sp[2]);
		}
	}
	
	if (buildStats.advHealth) {
		document.getElementById("RemainingHealth").style.display = "block";
	} else {
		document.getElementById("RemainingHealth").style.display = "none";
	}
	if (buildStats.advProsperity) {
		document.getElementById("ProsperityStacks").style.display = "block";
	} else {
		document.getElementById("ProsperityStacks").style.display = "none";
	}
	if (buildStats.advPreservation) {
		document.getElementById("PreservationStacks").style.display = "block";
	} else {
		document.getElementById("PreservationStacks").style.display = "none";
	}
	if (buildStats.advWillThief) {
		document.getElementById("WillThiefStacks").style.display = "block";
	} else {
		document.getElementById("WillThiefStacks").style.display = "none";
	}
	if (buildStats.advMight) {
		document.getElementById("MightStacks").style.display = "block";
	} else {
		document.getElementById("MightStacks").style.display = "none";
	}
	if (buildStats.advStrife) {
		document.getElementById("StrifeStacks").style.display = "block";
	} else {
		document.getElementById("StrifeStacks").style.display = "none";
	}
	if (buildStats.advVoracity) {
		document.getElementById("VoracityStacks").style.display = "block";
	} else {
		document.getElementById("VoracityStacks").style.display = "none";
	}
	if (buildStats.advHope) {
		document.getElementById("HopeActive").style.display = "block";
	} else {
		document.getElementById("HopeActive").style.display = "none";
	}
	if (buildStats.advStability) {
		document.getElementById("StabilityActive").style.display = "block";
	} else {
		document.getElementById("StabilityActive").style.display = "none";
	}
	if (buildStats.advJustice) {
		document.getElementById("JusticeActive").style.display = "block";
	} else {
		document.getElementById("JusticeActive").style.display = "none";
	}
	if (buildStats.advPursuit) {
		document.getElementById("PursuitActive").style.display = "block";
	} else {
		document.getElementById("PursuitActive").style.display = "none";
	}
	if (buildStats.advGrace) {
		document.getElementById("GraceActive").style.display = "block";
	} else {
		document.getElementById("GraceActive").style.display = "none";
	}
	
	//Flat stat increases from passives first
	for (var p in smartPassives) {
		var sp = smartPassives[p];
		if (Passives[p]["flatIncrease"] != undefined) {
			Passives[p]["flatIncrease"](sp[0],sp[1],sp[2]);
		}
	}
		
	if (chosenLoadout.passives["Outrider"] != undefined) {
		document.getElementById("OutriderActive").style.display = "block";
		if (document.getElementById("outriderCheck").checked == true) {
			buildStats.moveSpeedIncrease += 0.1;
		}
	} else {
		document.getElementById("OutriderActive").style.display = "none";
	}
	if (chosenLoadout.passives["Reaper"] != undefined) {
		document.getElementById("ReaperActive").style.display = "block";
		if (document.getElementById("reaperCheck").checked == true) {
			buildStats.power += 30;
		}
	} else {
		document.getElementById("ReaperActive").style.display = "none";
	}
	if (chosenLoadout.passives["Scavenger"] != undefined) {
		document.getElementById("ScavengerActive").style.display = "block";
		if (document.getElementById("scavengerCheck").checked == true) {
			buildStats.moveSpeedIncrease += 0.1;
		}
	} else {
		document.getElementById("ScavengerActive").style.display = "none";
	}
	if (chosenLoadout.passives["Adventurer"] != undefined) {
		document.getElementById("AdventurerActive").style.display = "block";
		if (document.getElementById("adventurerCheck").checked == true) {
			buildStats.moveSpeedIncrease += 0.08;
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
		buildStats.power += secs*(7 + level)/10;	
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
		buildStats.armor += enems*(3 + level*4/19);	
		buildStats.resist += enems*(3 + level*4/19);
	} else {
		document.getElementById("BrawlerEnemies").style.display = "none";
	}	
		
	//Percent increases from loadout stats
	buildStats.power *= (buildStats.percentPower + 100)/100;
	buildStats.haste *= (buildStats.percentHaste + 100)/100;
	buildStats.health *= (buildStats.percentHealth + 100)/100;
	buildStats.armor *= (buildStats.percentArmor + 100)/100;
	buildStats.resist *= (buildStats.percentResist + 100)/100;		
		
	//Percent increases from passives
	for (var p in smartPassives) {
		var sp = smartPassives[p];
		if (Passives[p]["percentIncrease"] != undefined) {
			Passives[p]["percentIncrease"](sp[0],sp[1],sp[2]);
		}
	}	
		
	if (chosenLoadout.passives["Hoplite"] != undefined) {
		buildStats.power += 0.12*buildStats.armor;
	}

	//Calculate and display final stats
	buildStats.basicAttack += buildStats.power * Shapers[chosenShaper].attackPower;
	buildStats.moveSpeed += 0.5*buildStats.haste;
	buildStats.moveSpeed *= buildStats.moveSpeedIncrease;
	buildStats.hasteASBonus = buildStats.haste*Shapers[chosenShaper].attackHaste;
	buildStats.attacksPerSecond = (1 + 0.01*(buildStats.hasteASBonus + buildStats.levelASBonus))/buildStats.attackSpeed;
	buildStats.cdr = 100 - (100 - buildStats.bonusCdr)*100/(100 + buildStats.haste*Shapers[chosenShaper].spellHaste);

	//TODO: Display these results in a nicer way
	results = "";  
	//Compound stats
	results += "<b>Power:</b> " + toRoundedString(buildStats.power, 1) + "<br/>";
	results += "<b>Haste:</b> " + toRoundedString(buildStats.haste, 1) + "<br/>";
	results += "<b>Mastery:</b> " + toRoundedString(buildStats.mastery, 1) + "<br/><br/>";  

	//Attack stats
	results += "<b>Basic Attack:</b> " + toRoundedString(buildStats.basicAttack, 1) + "<br/>";
	results += "<b>Attacks per Second:</b> " + toRoundedString(buildStats.attacksPerSecond, 2) + "<br/>";
	results += "<b>Critical Chance:</b> " + toRoundedString(buildStats.mastery, 1) + "%<br/>";
	// buildStats.dps = buildStats.basicAttack*buildStats.attacksPerSecond;
	// buildStats.dps *= (1 + buildStats.mastery/100);
	results += "<b>Attack Range:</b> " + toRoundedString(buildStats.attackRange, 0) + "<br/><br/>";

	//Defense stats
	results += "<b>Health:</b> " + toRoundedString(buildStats.health, 0) + "<br/>";
	results += "<b>Health Regen per 5:</b> " + toRoundedString(buildStats.healthRegen, 2) + "<br/>";
	results += "<b>Armor:</b> " + toRoundedString(buildStats.armor, 1) + "<br/>";
	results += "<b>Magic Resist:</b> " + toRoundedString(buildStats.resist, 1) + "<br/>";
	results += "<b>Physical Damage Reduction:</b> " + toRoundedString(100 - 10000/(100+buildStats.armor),0) + "%<br/>";
	results += "<b>Magical Damage Reduction:</b> " + toRoundedString(100 - 10000/(100+buildStats.resist),0) + "%<br/><br/>";  

	//Other stats
	results += "<b>Cooldown Reduction:</b> " + toRoundedString(buildStats.cdr, 1) + "%<br/>";
	results += "<b>Move Speed:</b> " + toRoundedString(buildStats.moveSpeed, 0) + "<br/>"  
	results += "<b>Defense Penetration:</b> " + toRoundedString(buildStats.defensePen, 0) + "<br/>";
	results += "<b>Spell Overload:</b> " + toRoundedString(buildStats.mastery/2, 1) + "%<br/>";
	results += "<b>Life Drain:</b> " + toRoundedString(buildStats.drain, 1) + "%<br/><br/>"; 
	
	//Vim and XP
	results += "<b>Bonus Experience:</b> " + toRoundedString(buildStats.bonusExp, 1) + "%<br/>";
	results += "<b>Vim Generation Per 5:</b> " + toRoundedString(buildStats.bonusVim, 1) + "<br/><br/>";	

	document.getElementById("StatsResults").innerHTML = results;

	//List the passive effects
	passivesText = "";
	
	for (var p in smartPassives) {
		var sp = smartPassives[p];
		if (Passives[p]["textDisplay"] != undefined) {
			if (passivesText == "") {
				passivesText = Passives[p]["textDisplay"](sp[0],sp[1],sp[2]);
			} else {
				passivesText += "<br/><br/>" + Passives[p]["textDisplay"](sp[0],sp[1],sp[2]);
			}
		}
	}	
	
	document.getElementById("PassivesResults").innerHTML = passivesText;
  
	// //Display results vs target shaper
	// targetHP = document.getElementById("TargetHPInput").value;
	// targetArmor = document.getElementById("TargetArmorInput").value;
	// targetResist = document.getElementById("TargetResistInput").value;

	// armorAfterPen = targetArmor*(100 - percentDefensePen)/100 - defensePen;
	// if (armorAfterPen < 0) {
		// armorAfterPen = 0;
	// }
	// resistAfterPen = targetResist*(100 - percentDefensePen)/100 - defensePen;
	// if (resistAfterPen < 0) {
		// resistAfterPen = 0;
	// }	
	// physicalAttackDamage = basicAttack*100/(100 + armorAfterPen);
	// totalBasicAttack = physicalAttackDamage;

	// targetResults = "";
	
	// //Target Stats
	// targetResults += "<b>Target Armor After Penetration:</b> " + toRoundedString(armorAfterPen,1) + "<br/>";
	// targetResults += "<b>Target Magic Resist After Penetration:</b> " + toRoundedString(resistAfterPen,1) + "<br/><br/>";	
	
	// //Per Attack
	// targetResults += "<b>Basic Attack Damage:</b> " + toRoundedString(physicalAttackDamage,1) + "<br/>";
	// // switch(passives["Giant Killer"])
		// // {
		// // case 1:
			// // fourPercentHealth = 0.04*targetHP;
			// // mitigatedGiantKiller = fourPercentHealth*100/(100 + armorAfterPen);
			// // totalBasicAttack += mitigatedGiantKiller;
			// // targetResults += "<b>Giant Killer Damage:</b> " + toRoundedString(mitigatedGiantKiller,1) + "<br/>";
			// // break;
		// // }		
	// targetResults +="<b>Total Damage per Basic Attack (No Crit):</b> " + toRoundedString(totalBasicAttack,1) + "<br/>";
	// totalBasicAttackCrit = totalBasicAttack += mastery*basicAttack/(100 + armorAfterPen);
	// targetResults +="<b>Total Expected Damage per Basic Attack:</b> " + toRoundedString(totalBasicAttackCrit,1) + "<br/><br/>";
	
	// //Per Unit Time
	// dpsMitigated = totalBasicAttackCrit*attacksPerSecond;

	// // switch(passives["Puncture"])
		// // {
		// // case 1:
			// // punctureDamage = 40 + 0.4*power;
			// // targetResults += "<b>Puncture Damage Per 3 Seconds:</b> " + toRoundedString(punctureDamage,1) + "<br/>";
			// // dpsMitigated += punctureDamage/3;
			// // break;
		// // }	
	// targetResults += "<b>DPS vs Target:</b> " + toRoundedString(dpsMitigated,1) + "<br/>";
	// document.getElementById("MitigatedResults").innerHTML = targetResults;
  
}

//Rounds num to dp decimal places and removes trailing zeros
function toRoundedString(num, dp) {
	return (Math.round(num*Math.pow(10,dp))/Math.pow(10,dp)).toString();
}

function populateItemInfo() {
	var data;
	var dataLoaded = false;
	var jsonURL = 'http://moba-champion.com/data/itempalooza.json';
	var pathname = window.location.href;
	if (pathname.indexOf("www.") !== -1) {
		jsonURL = 'http://www.moba-champion.com/data/itempalooza.json'; // cross-origin-domain-policy OP
	}
	
	var itemsLoaded = 0;
	
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
					itm.itemId = this.itemid;
					
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
					match = /\+(\d+)%\sMovement/i.exec(summary);
					if (match != null) {
						itm.moveSpeed = parseFloat(match[1]);
					}

					itm.effects = ItemPassives[this.name];			
					
					for (var i = 0; i < 6; i++) {
						if (savedItemArray[i] == this.itemid) {
							addItemToSlot(i, this.name, this.cost, this.summary, this.passive1, this.passive2, this.img);
						}
					}	
					itemsLoaded++;
					if (itemsLoaded == totalItems) {
						doCalculations();
					}
				}
			});
		}	  
	});
}

//For loading saved builds
function addItemToSlot(slot, name, price, summary, passive1, passive2, img) {
    var docElt = document.getElementById("buildItem"+(slot));
	docElt.src = img;
	buildItems[slot] = name;
	docElt.title = GetSavedItemTitle(name, price, summary, passive1, passive2, img);
	$(".mobatip"+slot).tooltipster();
}

function GetSavedItemTitle(name, price, summary, passive1, passive2, img)
{	
	var htmlString;
	htmlString = '<div class="standard_tooltip">';
	htmlString += '<div class="standard_tooltip_img"><img src="' + img + '"></div>';
	htmlString += '<div class="standard_tooltip_item_header">';

	if (img.indexOf('Legendary') !== -1)
	{
		htmlString += '<p class="legendary_text">' + name + '</p>';
	}
	else if (img.indexOf('Advanced') !== -1)
	{
		htmlString += '<p class="advanced_text">' + name + '</p>';
	}				
	else if (img.indexOf('Basic') !== -1)
	{
		htmlString += '<p class="basic_text">' + name + '</p>';
	}
	else
	{
		htmlString += '<p class="consumable_text">' + name + '</p>';
	}
	
	htmlString += '<p>Cost: <font color="gold">' + price + '</font></p></div>';
	
	htmlString += '<div class="standard_tooltip_item_content">';
	htmlString += '<p>' + summary + '</p>';
	if (passive1 && passive1 != "")
	{
		htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive1 + '</p>';
	}
	if (passive2 && passive2 != "")
	{
		htmlString += '<p class="standard_tooltip_item_content_indent">Passive: ' + passive2 + '</p>';
	}
	htmlString += '</div>';
	htmlString += '<div class="standard_tooltip_item_type">Item</div>';				
	htmlString += '</div>';
	return htmlString;
}

var shapesLoaded = 0;
var gemsLoaded = 0;

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
					shapesLoaded++;
					if (gemsLoaded == totalGems && shapesLoaded == totalShapes) {
						getSavedLoadout();
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
				gemsLoaded++;
				if (gemsLoaded == totalGems && shapesLoaded == totalShapes) {
					getSavedLoadout();
				}
			});
		}
	});
}

function getSavedLoadout() {
	if (savedLoadout != "") {
		document.getElementById("shareLink").value = "http://www.moba-champion.com/loadouts/index.php?l=" + savedLoadout;
		loadLoadout();
	}
}

function loadLoadout() {

	shareUrl = document.getElementById("shareLink").value;
	shareId = /http:\/\/www\.moba-champion\.com\/loadouts\/(\d+)$/.exec(shareUrl);
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
		loadoutCode = shareId[1];
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

function updateShareUrl() {
	var link = "http://www.moba-champion.com/theorycrafting/itembuilder.php";
	link += "?s=" + encodeURI(document.getElementById("shaperMenu").value);
	link += "&i=";
	for (var i = 0; i < 6; i++) {
		if (buildItems[i] != undefined) {
			link += Items[buildItems[i]].itemId;
		} else {
			link += "00";
		}
	}
	if (document.getElementById("customRadioButton").checked == true && loadoutCode > 0) {
		link += "&l=" + loadoutCode;
	}
	document.getElementById("buildShareLink").value = link;
}