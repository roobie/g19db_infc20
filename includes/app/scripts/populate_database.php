<?php
	
	require 'database_props.php';
	
	try {
		
		$db = new PDO($pdo_connection_string, $user, $password);

		//=========================================================================
		// TABLE DROPS && DEFS
		//=========================================================================

		$db->query("DELETE FROM student WHERE idstudent < 1000000");
		//--- BEGIN:	INSERTS ---

		$db->query("INSERT INTO student VALUES (null, '8810260000', 'Björn', 'Roberg', 'Ällingavägen 9B LGH 1409', '+46073-508-87-41', 'bjorn.roberg@gmail.com', 'domestic')");
		

		$db->query("INSERT INTO student VALUES (null, '8802040000' , 'Erik', 'Samuelsson', 'Järnåkravägen 27A', '+46070-834-45-66', 'erik.g.samuelsson@gmail.com', 'domestic')");
		

		$db->query("INSERT INTO student VALUES (null, '8807300000', 'Pontus', 'Åkerblom', 'Magistratsvägen 55Y', '+46070-528-61-78', 'pontusakerblom@gmail.com', 'domestic')");
		

		$db->query("INSERT INTO student VALUES (null, null, 'John', 'Doe', 'Utbytesvägen 3', '+46070-831-64-58', 'j.doe@gmail.com', 'foreign')");
		
		$db->query("INSERT INTO student VALUES (null, '7603105627', 'Playa', 'Widegrip', 'Footage Rd 65', '+46070-071-29-40', 'Laboriously@Regenerates.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8411274416', 'Attachment', 'Progression', 'Mightiest Rd 24', '+46073-824-05-97', 'Barnett@Judge\'s.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9002122171', 'Fate', 'Funnel', 'Grove Rd 61', '+46075-021-82-42', 'Passively@Roberta.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7609161994', 'Antelope', 'Relive', 'Epigenetic Rd 44', '+46073-361-40-24', 'Comenico@Cinch.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8305184406', 'Unselfish', 'Exposure', 'Chilblains Rd 38', '+46073-044-70-59', 'Heinkel@Inclusion.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8801012261', 'Abstraction', 'Apologized', 'Ungracious Rd 7', '+46077-752-11-67', 'Annoying@Haunting.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7908029694', 'Sonogram', 'Authoritarianism', 'Clobbered Rd 23', '+46070-307-41-85', 'Inspections@Narration.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Tripod', 'Shapes', 'Secants Rd 67', '+46073-225-83-55', 'Brad@Amortization.no', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '8911212817', 'Bemoans', 'Yori', 'Panties Rd 40', '+46071-353-50-79', 'Inspection@Eaters.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7711281437', 'Snack', 'Ripened', 'Westwood Rd 22', '+46079-417-29-92', 'Lex@Schooldays.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7603026566', 'Nothin', 'Liens', 'Feathertop\'s Rd 35', '+46076-178-07-83', 'Actuality@Occident.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9109262778', 'Tandem', 'Flips', 'Creatively Rd 19', '+46075-086-28-25', 'Siva@Layoffs.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9208071208', 'Allan', 'Designer', 'Obstruct Rd 61', '+46076-875-67-72', 'Contretemps@Pigment.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8004226118', 'Purified', 'Boys', 'Promising Rd 87', '+46078-927-64-89', 'Blasphemies@Irrelevant.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7505236798', 'Kids', 'Gale', 'Culture\'s Rd 66', '+46077-380-65-68', 'Caller@Sap.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8712063567', 'Budge', 'Addict', 'Fran Rd 5', '+46071-821-20-83', 'Volcanos@Pointless.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7710128119', 'Paredon', 'I\'m', 'Talkin Rd 93', '+46077-333-35-68', 'Meanes@Cjs.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8902241287', 'Archaeological', 'Superhighways', 'Mistrust Rd 84', '+46073-325-06-24', 'Vilas@Brevet.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8109207495', 'Merchandising', 'Austrian', 'Hiss Rd 75', '+46073-441-52-17', 'Crucifixion@Squibb.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8910248917', 'Macro', 'Kitti', 'Homogeneity Rd 4', '+46070-634-30-15', 'Celebrities@Screenland.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7609256878', 'Asleeep', 'Abbreviation', 'Matrimony Rd 90', '+46074-022-80-12', 'Expand@Welter.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7708195253', 'Ruiz', 'Jeers', 'Fat Rd 15', '+46075-396-07-20', 'Neglects@Slumbered.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8703155417', 'Departed', 'Shotwell', 'Repugnant Rd 37', '+46071-962-52-72', 'Powder@Matriarch.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7705062972', 'Folks', 'Sylvania', 'Brumidi\'s Rd 89', '+46071-218-46-36', 'Kathy@Conclusion.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7508226472', 'Glycerinated', 'Overlay', 'Dineen Rd 95', '+46072-354-77-68', 'Automotive@Circonscription.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Purgation', 'Enigmatic', 'Vinegar Rd 85', '+46076-136-71-26', 'Unworn@Rubber.se', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '8302112656', 'Grigory', 'Determine', 'Use Rd 8', '+46079-741-56-70', 'Tug@Degeneration.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7603148667', 'Delegated', 'Rend', 'Truest Rd 100', '+46078-093-12-59', 'Fashions@Obsessive.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7907127943', 'Decreases', 'Salesmen', 'Intrepid Rd 49', '+46070-731-98-93', 'Incompetent@Devotees.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8303206445', 'Manny', 'Dispelled', 'Brightened Rd 84', '+46077-619-15-74', 'Vortex@Florida\'s.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7903223180', 'Axis', 'Pompons', 'Deepened Rd 61', '+46071-896-16-26', 'Cotton\'s@Higherandlower.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8308187137', 'Cleared', 'Excitability', 'Lonely Rd 73', '+46079-931-21-42', 'Flagrantly@Without.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9111201291', 'Dramatist', 'Chicanery', 'Secondandthird Rd 49', '+46077-112-77-98', 'Tourist@Fill.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7512073258', 'Mechanisms', 'Streamliner', 'Lass Rd 100', '+46076-405-27-58', 'Stinkpotters@Receptionist.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8306213392', 'Supervisors', 'Snazzy', 'Unaware Rd 39', '+46077-747-76-08', 'Rectangle@Holier.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9211173147', 'Uninominal', 'Rejects', 'Talents Rd 31', '+46074-479-94-21', 'Farewell@Climactic.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7712188917', 'Swaggering', 'Thermogravimetric', 'Pagoda Rd 100', '+46071-601-55-31', 'Oversight@Tab.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9103058256', 'Sparing', 'Uncles', 'Beardsley\'s Rd 83', '+46077-578-53-71', 'Affliction@Pesce.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7703106795', 'Orin', 'Poses', 'Llewellyn Rd 51', '+46072-271-48-91', 'Fabulous@Enquirer.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8208269369', 'My', 'Tangos', 'Traditions Rd 100', '+46071-212-45-92', 'Scratches@Preferring.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9206174949', 'Overpayment', 'Ridiculed', 'Dick\'s Rd 62', '+46073-567-15-71', 'Exceeds@Ijal.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7705196149', 'Droves', 'Condescension', 'Maser Rd 16', '+46073-562-92-72', 'Ryerson@Legally.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8907251096', 'Fabrics', 'Arab', 'Unsuccessful Rd 28', '+46074-365-72-16', 'Gentlemanly@Diminution.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8206134335', 'Unloads', 'Commuter', 'Stateless Rd 34', '+46074-543-12-32', 'Ecuador@Lodley.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9102256888', 'Monologue', 'Analytrol', 'Nugent Rd 27', '+46078-043-59-61', 'Oriented@Luxemburg.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9111261597', 'Thor', 'Gloucester', 'Swivel Rd 9', '+46077-746-92-33', 'Dusting@Unrehearsed.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8801143260', 'Clamshell', 'Grin', 'Okla Rd 4', '+46074-864-85-49', 'Monaural@Mezzo.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8507075313', 'Makeup', 'Everest', 'Lapel Rd 7', '+46071-429-47-13', 'Gossiped@Contradictorily.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8301223492', 'Frankfurter\'s', 'Hawthorne', 'Cries Rd 33', '+46070-386-81-06', 'Sucker@Diversities.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Sulkily', 'Casks', 'Cheek Rd 52', '+46075-589-56-20', 'Cutest@Goggle.se', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '9104178072', 'Scrivener', 'Sociable', 'Churchgoing Rd 6', '+46075-198-16-67', 'Untimely@Ramsperger.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7903057819', 'Intentioned', 'Incepting', 'Hendry Rd 74', '+46079-278-52-69', 'Bexar@Spectra.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Canoes', 'Animal', 'Prosecutor Rd 22', '+46077-539-75-75', 'Chennault\'s@Chavis.net', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, null, 'Softening', 'Thar', 'Balcony Rd 23', '+46075-378-21-38', 'Straightening@Logged.com', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '7505287833', 'Discoid', 'Reciprocate', 'Thumping Rd 85', '+46073-571-55-57', 'Slightly@Helmut.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7710154298', 'Barnsful', 'Indonesian', 'Gaze Rd 21', '+46073-114-51-14', 'Enmity@Arthritis.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Varviso', 'Grimesby', 'Faculties Rd 66', '+46076-328-07-20', 'Vive@Unaccompanied.net', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '8506112230', 'Ullman', 'Ferdinand', 'Wrestlings Rd 53', '+46070-970-90-56', 'Duyvil@Gob.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Fayette', 'Tode', 'Schubert Rd 99', '+46070-695-03-77', 'Disbelieving@Penned.net', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '7912273392', 'Adventuring', 'Stanislas', 'Eloi Rd 89', '+46073-145-79-70', 'Exuberance@Punishment.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Armor', 'Dehydrated', 'Postponement Rd 28', '+46072-715-61-76', 'Yehudi@Sovietskaya.se', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '9001136192', 'Beautifying', 'Venice', 'Stretcher Rd 54', '+46073-710-72-81', 'Butyrate@Jaggers.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7608288117', 'Presided', 'Newsstand', 'Spatially Rd 34', '+46074-022-17-80', 'Beef\'s@Listens.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7909111246', 'Governments', 'Elevation', 'Thy Rd 26', '+46075-576-16-49', 'Affectionately@Copiously.net', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9207062031', 'Honolulu', 'Begins', 'Wins Rd 25', '+46075-858-59-86', 'Ethics@Features.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8508108032', 'Ambassadors', 'Nolens', 'Shifters Rd 74', '+46076-966-48-77', 'Flocculation@Down.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9007094807', 'Egyptians', 'Erect', 'Decisions Rd 56', '+46071-927-55-57', 'Claimants@Peanut.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, null, 'Adonis', 'Turnouts', 'Shrub Rd 87', '+46074-333-86-73', 'Nonpoisonous@Mcenroe\'s.dk', 'foreign')");
		$db->query("INSERT INTO student VALUES (null, '8702213018', 'Talismanic', 'Tomas', 'Carried Rd 98', '+46075-597-76-47', 'Assignments@Hoopla.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7811261792', 'Petting', 'Tollhouse', 'Moderation Rd 28', '+46074-221-39-30', 'Lurched@Stub.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9112207018', 'Tepees', 'Abuse', 'Scoured Rd 78', '+46079-931-82-23', 'Closeup@Superstitious.no', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9211154092', 'Frilly', 'Fingering', 'Rooming Rd 17', '+46072-401-47-80', 'Gash@Saami\'s.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7903282177', 'Outbreak', 'Psyche', 'Maligned Rd 45', '+46078-188-03-19', 'Container@Cellist.com', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '7503194793', 'Dictionaries', 'Monastery', 'Rumford Rd 77', '+46077-350-55-10', 'Kingdoms@Skate.se', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '9005169629', 'Sulky\'s', 'Payoff', 'Determinable Rd 86', '+46073-033-19-70', 'Stidger@Conclusively.dk', 'domestic')");
		$db->query("INSERT INTO student VALUES (null, '8506092447', 'Claim', 'Conditional', 'Gore Rd 84', '+46071-750-10-97', 'Heartfelt@Forebearing.no', 'domestic')");

		//--- END:	INSERTS ---

		//=========================================================================

		$db = null;

		} catch (PDOException $e) {
			die( $e->getMessage() );
		}

	// Redirects to the referring page.
	if (header("Location: ".$_SERVER["HTTP_REFERER"]) == 'localhost') {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
?>
