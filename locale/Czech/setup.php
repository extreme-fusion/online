<?php defined('EF5_SYSTEM') || exit;

return array(
	'Charset' => 'UTF-8',
	'xml_lang' => 'cs',
	'eXtreme-Fusion :version - Setup' => 'eXtreme-Fusion :version - Instalace',
	'Step 1: Locale' => 'Krok 1: Jazyk',
	'Step 2: Checking server configuration' => 'Krok 2: Kontrola konfigurace serveru',
	'Step 3: File and Folder Permissions Test' => 'Krok 3: Kontrola přístupových práv k souborům a adresářům',
	'Step 4: Database settings' => 'Krok 4: Nastavení databáze',
	'Step 5: Admin account' => 'Krok 5: Učet administrátora',
	'Step 6: System settings' => 'Krok 6: Nastavení systému',
	'Step 7: Final settings' => 'Krok 7: Dokončení nastavení',
	'Finish' => 'Dokončit',
	// Permissions
	'Perm: admin login' => 'Přihlášení do admin panelu.',
	'Perm: admin bbcodes' => 'Správa štítků BBCodes.',
	'Perm: admin blacklist' => 'Přístup na černé listiny.',
	'Perm: admin comments' => 'Přístup ke správě komentářů.',
	'Perm: admin logs' => 'Přístup do záznamů stránky.',
	'Perm: admin urls' => 'Přístup do generátoru odkazů.',
	'Perm: admin news_cats' => 'Přístup do kategorie novinek.',
	'Perm: admin news' => 'Přidávání novinek z pozice administrátora.',
	'Perm: admin panels' => 'Přístup do správy panelů.',
	'Perm: admin permissions' => 'Možnost přidávat nové pravomoci.',
	'Perm: admin phpinfo' => 'Informace o PHP na serveru..',
	'Perm: admin groups' => 'Přidávání nových skupin uživatelů.',
	'Perm: admin security' => 'Bezpečnostní nastavení',
	'Perm: admin settings' => 'Nastavení hlavního systému.',
	'Perm: admin settings_banners' => 'Správa bannerů.',
	'Perm: admin settings_cache' => 'Nastavení mezipaměti.',
	'Perm: admin settings_time' => 'Nastavení datumu a času.',
	'Perm: admin settings_registration' => 'Přístup do nastavení registrace.',
	'Perm: admin settings_misc' => 'Přístup do nastavení sekce ostatní',
	'Perm: admin settings_users' => 'Přístup do nastavení uživatelů.',
	'Perm: admin settings_ipp' => 'Počet položek na stránku.',
	'Perm: admin settings_logs' => 'Přístup do nastavení záznamů.',
	'Perm: admin settings_synchro' => 'Přístup do nastavení synchronizace.',
	'Perm: admin navigations' => 'Navigace stránky',
	'Perm: admin smileys' => 'Přistup ke smajlíkům',
	'Perm: admin submissions' => 'Přístup ke schvalování obsahu od uživatelů',
	'Perm: admin upgrade' => 'Možnost aktualizovat systém stránky.',
	'Perm: admin user_fields' => 'Možnost přidání nových polí uživatelů.',
	'Perm: admin user_fields_cats' => 'Možnost přidat nové kategorie uživatelských polí.',
	'Perm: admin users' => 'Možnost spravovat uživatelské účty.',
	'Perm: user login' => 'Přihlášení na stránky.',
	'Perm: comment' => 'Vložení komentáře',
	'Perm: comment edit' => 'Úprava svého komentáře ve stanovené lhůtě po jeho přidání.',
	'Perm: comment edit all' => 'Úprava komentářů od jiných uživatelů.',
	'Perm: comment delete' => 'Odstranění komentáře do určité doby od jeho přidání.',
	'Perm: comment delete all' => 'Odstranění komentáře ostatních uživatelů.',
	'Group: admin' => 'Administrátoři mají na starost chod webové stránky.',
	'Group: user' => 'Navštěvník stránek, který se zaregistruje a přihlásí se ke svému účtu.',
	'Group: guest' => 'Návštěvník stránek, který se nepřihlásí.',
	//Step 1
	'Please select the required locale (language):' => 'Prosím, vyberte požadovaný jazyk stránky:',
	'Download more locales from <a href="http://www.extreme-fusion.org/">extreme-fusion.org</a>' => 'Jiné jazykové verze jsou dostupné na adrese <a href="http://www.extreme-fusion.org/">extreme-fusion.org</a>',
	'I accept aGPL v3 License' => 'Souhlasím s licenčními podmínkami aGPL v3',
	//Step 2
	'Unwriteable' => 'Nezapisovatelný',
	'The folders and files listed below must be set writeable (chmod 777).' => 'Poniższym katalogom i plikom należy ustawić zapisywalność (chmod 777).',
	'Refresh' => 'Aktualizovat',
	'PHP Version Error' => 'Váš server nesplňuje systémové požadavky: PHP interpreter je starší než verze :php_required.<br />
							Co můžete udělat:
							<ul>
							<li>Použijte Panel Správy serveru  a vyberte "Výběr tlumočníka PHP" pro pozdější použití - poznámka: ne každý poskytovatel hostingu poskytuje takové nástroje</li>
							<li>Nainstalujte novější verzi PHP ze soubory, jenž jsou k dispozici na webových stránkách výrobce - pro pokročilé</li>
							<li>Obraťte se na technickou podporu vašeho serveru, aby Vám pomohli</li>
							</ul>',
	'Extension error' => 'Nenalezeno požadované rozšíření :extension_error. Měly by být načteny z vhodné konfigurace serveru',
	'Files has not been changed.' => 'Soubory nebyly změněny.',
	'Not found' => 'Nenalezeno',
	// Step 3 - Access criteria
	'Please enter your MySQL database access settings.' => 'Zadejte nastavení pro databázi MySQL.',
	'Database Hostname:' => 'Adresa hostitele:',
	'Database Username:' => 'Uživatelské jméno k databázi:',
	'Database Password:' => 'Heslo do databáze:',
	'Database Name:' => 'Název databáze:',
	'Database Port:' => 'Port databáze:',
	'Table Prefix:' => 'předpona tabulek:',
	'Cookie Prefix:' => 'předpona cookie:',
	'Cache Prefix:' => 'předpona cache:',
	'URL:' => 'Adresa stránky:',
	// Step 4 - Database Setup
	'Advanced' => 'Rozšíření',
	'Database connection established.' => 'Připojení k databázi bylo úspěšné.',
	'Config file successfully written.' => 'Konfigurace souboru byla úspěšně uložena.',
	'Database tables created.' => 'Tabulky databáze byly vytvořeny.',
	'Error:' => 'Chyba:',
	'Unable to create database tables.' => 'Nelze vytvořit tabulky v databázi.',
	'Unable to write config file.' => 'Nelze zapsat konfigurační soubor',
	'Please ensure config.php is writable.' => 'Ujistěte se, že soubor config.php je zapisovatelný.',
	'Could not write or delete MySQL tables.' => 'Nebylo možné uložit nebo odstranit MySQL tabulky.',
	'Please make sure your MySQL user has read, write and delete permission for the selected database.' => 'Zkontrolujte, zda MySQL uživatel databáze má právo na číst, zapisovat a mazat data v databázi.',
	'Table prefix error.' => 'Chyba v předponě tabulky.',
	'Unable to connect with MySQL database.' => 'Nelze se připojit k databázi MySQL.',
	'Please ensure your MySQL username and password are correct.' => 'Zkontrolujte nastavení, uživatelské jméno a heslo pro databázi MySQL.',
	'There are empty fields left!' => 'Pole jsou prázdné!',
	'Please make sure you have filled out all the MySQL connection fields.' => 'Sprawdź, czy wszystkie pola są wypełnione.',
	'Tables prefix (Advanced settings) is already in use or prefix has not been written, and tables prefix exist in the database with the same name as that system is trying to create. Please enter a different prefix for tables.' => 'Předpona tabulek (Pokročilé nastavení)  se již používá nebo předpona nebyla zapsána popřípadě tabulky již existují se stejným názvem v databázi a systém se snaží se je snaží vytvořit. Prosím, zadejte jinou předponu pro tabulky.',
	'NOTE! If after installation you experience problems with links and URLs (error 404), you must reinstall the system without checking the box below, or change the $_route in config.php.' => 'POZOR! Pokud po ukončení instalace máte problémy s odkazy a adresami URL (chyby 404), znovu přeinstalujte systém s níže nezašknutým polem nebo změňte nastavení $_route v souboru config.php.',
	'The names of the files listed below please change with the instructions.' => 'Názvy souborů jsou uvedeny níže, změňte postupujte podle pokynů.',
	'modRewrite warning' => 'Instalační program nemohl zjistit, zda váš server podporuje modRewrite.<br />
	Zaškrtněte toto políčko, pokud jste si jisti, že výše uvedený modul je k dispozici. <br />
	Zodpovídá za vytváření odkazů přátelských na vyhledávání.', 	
	'FURL warning' => 'Instalátor rozpoznal, że užíváte jiné server než Apache.<br />
	Abyste mohli používat odkazy přátelské pro vyhledávače, server musí podporovat cestu PATH_INFO.<br />
	Po dokončení instalace systém zkusí zjistit, jest-li je cesta dostupná, ale existuje zde riziko záměny.<br />
	Aby se tomu zabránilo, zaškrtněte políčko níže, pokud jste si jisti, že váš server podporuje PATH_INFO.',
	// Step 5 - Super Admin login
	'Super Admin login details' => 'Vytvořte hlavního administrátora stránky',
	'Username:' => 'Název uživatele:',
	'Login Password:' => 'Heslo pro přihlášení:',
	'Repeat Login password:' => 'Potvrdit heslo pro přihlášení:',
	'Email address:' => 'Adresa e-mailu:',
	// Step 6 - User details validation
	'Your login does not appear to be valid.' => 'Uživatelské jméno je nesprávné.',
	'Your two login passwords do not match.' => 'Uživatelská hesla se neshodují.',
	'Your email address does not appear to be valid.' => 'Byla zadána neplatná adresa e-mailu',
	'Setup complete' => '<div class="valid">Instalace dokončena. Děkujeme, že jste se rozhodli používat eXtreme-Fusion 5 - Ninja Edition!</div>',
	'Administrator account has not been created.' => 'Administrátorský účet nebyl vytvořen.',
	//Welcome Message
	'Welcome to your site' => 'Vítejte na své nové stránce.',
	'Welcome to eXtreme-Fusion CMS. Thank for using our CMS, Please turn off the maintenance mode in security, onces you have finished configuring your site.' => 'Děkujeme, že jste se rozhodli používat redakční systém eXtreme-Fusion. Doporučujeme zapnout mód udržby v administraci pro donastavování webu.',
	// Stage 6 - News Categories
	'Bugs' => 'Chyby',
	'Downloads' => 'Ke stažení',
	'eXtreme-Fusion' => 'eXtreme-Fusion',
	'Games' => 'Hry',
	'Graphics' => 'Grafika',
	'Hardware' => 'Hardware',
	'Journal' => 'Cestování',
	'Members' => 'Uživatelé',
	'Mods' => 'Modifikace',
	'Movies' => 'Filmy',
	'Network' => 'Sítě',
	'News' => 'Novinky',
	'Security' => 'Bezpečnost',
	'Software' => 'Software',
	'Themes' => 'Šablony',
	'Windows' => 'Windows',
	// Stage 6 - Panels
	'Navigation' => 'Navigace',
	'Online Users' => 'Online uživatelé',
	'Welcome Message' => 'Uvítací zpráva',
	'User Panel' => 'Panel uživatele',
	// Step 6 - Navigation Links
	'Home' => 'Domů',
	'News Cats' => 'Kategorie novinek',
	'Contact' => 'Kontakt',
	'Search' => 'Vyhledávání',
	'Rules' => 'Pravidla',
	'Tags' => 'Klíčové slova',
	'Team' => 'Redakce',
	'Pages' => 'Vlastní stránky',
	// Stage 6 - User Field Categories
	'Contact Information' => 'Kontaktní informace',
	'Information' => 'Informace',
	'Miscellaneous' => 'Různé',
	'First name' => 'První jméno',
	'Date of birth' => 'Datum narození',
	'Website' => 'Webová stránka',
	'Living place' => 'Bydliště',
	'Signature' => 'Podpis',
	// Example news
	'Example news title' => 'Vítejte na webu běžícím na redakčním systému eXtreme-Fusion 5',
	'Example news content' => '<p style="text-align: center;">
	To, co zde vidíte, je web vytvořen pomocí bezplatného redakčního systému (CMS) <a href="http://extreme-fusion.org/">eXtreme-Fusion 5</a>.</p>
	<p>
	Pokud jste správcem této stránky, přihlaste se pomocí formuláře na pravé straněwebu.<br />
	Pak jděte do administračního panelu a konfigurujte a přidávat obsah nebo vytvářejte nové uživatelské účty.</p>
	<p>
	Rozvoj Vaší stránky je možno vykonat přes sekci Moduly, pro příklad modul Bodování, který ohodnocuje body aktivnost na webu.</p>
	<p style="text-align: center;">
	Pokud nejste správcem této stránky, ale chcete mít své vlastní webové stránky, přejděte na naší <a href="http://extreme-fusion.org/">Podporu</a>, kde stáhnete system EF5 či získáte pomoc od komunity.<br />
	&nbsp;</p>',
	'Example news url' => 'vítejte_na_strance_bezici_na_extreme-fusion_5',
	'Example news description' => 'To, co zde vidíte, je web vytvořen pomocí bezplatného redakčního systému eXtreme-Fusion 5.',
	// Some additional informations
	'The installation was interrupted. The system can be unstable.' => 'Instalace byla přerušena. Systém může být nestabilní.',
	'Start the installation again.' => 'Spusťte instalaci znovu',
	'Stop the installation or start from the begining.' => 'Ukončit instalaci nebo začít novou instalaci.',
	'Stop installation' => 'Ukončit instalaci.',
);
