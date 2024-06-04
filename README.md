# KvalitetaZraka
Project for web-programmnig
Dokumentacija za projekt "Kvaliteta Zraka"
1. Popis svih dostupnih resursa s opisom i popisom parametara
Na početnoj stranici projekta nalazi se popis svih dostupnih resursa:
1.	Index (Početna stranica)
o	Opis: Prikazuje osnovne informacije i uvod u aplikaciju.
o	Parametri: Nema specifičnih parametara.
2.	API
o	Opis: Omogućuje pristup podacima o kvaliteti zraka.
o	Parametri:
	location (string): Lokacija za koju se traže podaci.
	date (string): Datum za koji se traže podaci (format YYYY-MM-DD).
	pollutant (string): Vrsta zagađivača (opcionalno).
2. Opis arhitekture aplikacije
Aplikacija je strukturirana u nekoliko ključnih modula:
•	index.php: Glavna ulazna točka aplikacije koja usmjerava zahtjeve na odgovarajuće kontrolere.
•	system/: Direktorij koji sadrži sve ključne komponente aplikacije.
o	AppCore.class.php: Osnovna klasa aplikacije koja upravlja inicijalizacijom i osnovnim postavkama.
o	config.inc.php: Konfiguracijske postavke aplikacije.
o	core.functions.php: Zajedničke funkcije koje se koriste širom aplikacije.
o	options.inc.php: Dodatne konfiguracijske opcije.
o	control/: Direktorij koji sadrži kontrolere za različite stranice.
	AbstractPage.class.php: Apstraktna klasa za stranice.
	ApiPage.class.php: Kontroler za API stranice.
	IndexPage.class.php: Kontroler za početnu stranicu.
o	model/: Direktorij koji sadrži klase za rad s bazom podataka.
	MySQLiDatabase.class.php: Klasa za interakciju s MySQL bazom podataka.
o	util/: Direktorij koji sadrži pomoćne klase.
	RequestHandler.class.php: Klasa za rukovanje HTTP zahtjevima.
o	view/: Direktorij koji sadrži predloške za prikaz stranica.
	Api.tpl.php: Predložak za API odgovore.
	Index.tpl.php: Predložak za početnu stranicu.
3. Upute za postavljanje i korištenje API-ja
Postavljanje aplikacije:
1.	Preuzimanje i raspakiravanje:
o	Preuzmite ZIP datoteku projekta i raspakirajte je.
2.	Konfiguracija:
o	Uredite datoteku system/config.inc.php s odgovarajućim postavkama baze podataka.
3.	Pokretanje:
o	Postavite datoteke na vaš web poslužitelj (npr. Apache, Nginx).
o	Provjerite jesu li sve potrebne PHP ekstenzije instalirane i omogućene (npr. MySQLi).
Korištenje API-ja:
•	Endpoint: /api
•	Metoda: GET
•	Primjer zahtjeva:
GET /api?location=Zagreb&date=2023-06-01&pollutant=PM10
•	Primjer odgovora:
{
  "location": "Zagreb",
  "date": "2023-06-01",
  "pollutants": {
    "PM10": "45 µg/m³",
    "NO2": "30 µg/m³"
  }
}
4. Izvještaji o testiranju
Testiranje je provedeno kroz sljedeće korake:
1.	Jedinično testiranje:
o	Testirani su pojedinačni moduli i funkcije kako bi se osigurala njihova ispravnost.
o	Korišteni su lažni podaci za testiranje svih funkcionalnosti API-ja.
2.	Integracijsko testiranje:
o	Provjereno je kako različiti moduli međusobno komuniciraju.
o	Testirano je nekoliko slučajeva korištenja za različite kombinacije parametara API-ja.
3.	Sustavno testiranje:
o	Cjelokupna aplikacija je testirana u okruženju koje simulira produkciju.
o	Provjereno je učitavanje početne stranice i ispravan rad svih funkcionalnosti API-ja.
4.	Regresijsko testiranje:
o	Testirano je nakon svake promjene koda kako bi se osiguralo da nove promjene ne uvode greške.

