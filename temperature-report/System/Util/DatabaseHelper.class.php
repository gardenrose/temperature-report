<?php

class DatabaseHelper
{
	// dodavanje gradova, kreira se sql upit za bazu, i proslijede se odabrane ili unesene vrijednosti, 
	// spremljene su u nizu entry, i onda se vade po indeksima, prvi je id, pa ime grada i zadnja temperatura
	// i posalje se upit na bazu
    public static function insertData($data)
    {
        foreach ($data as $entry) {
            $sql = "INSERT INTO `city_temperature` (`cityId`, `cityName`, `lastTemperature`) VALUES (" . $entry[0] . "," .  $entry[1] . "," .  $entry[2] . ")";
            try {
                AppCore::getDB()->sendQuery($sql);
            } catch (Throwable) {
                //ignore
            }
        }
    }
	// dohvaća sve temp, i to parametre id grada, ime grada i zadnju temp za taj grad
	// kreiramo upit koji trazi te podatke u bazi, SELECT ... 
	// spremimo ga u string i saljemo u metodu sendQuery, od rezultata odvajamo svaki redak 
	// u niz data, jer metoda SELECT upit vraca niz. Taj niz je output ove metode.
    public static function getAllTemperatures()
    {
        $sql = "SELECT `cityId`, `cityName`, `lastTemperature` FROM `city_temperature`";
        $result = AppCore::getDB()->sendQuery($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
// pomocu INSERT query-a dodajemo grad, proslijedimo id, ime, zadnju temp i neke default vrijednosti, za id -1, za city varijablu city, za lastTemperature NULL
// posalje se upit na bazu za dodavanje grada i metoda uvijek vrati true
    public static function addCity($city)
    {
        $sql = "INSERT INTO `city_temperature` (`cityId`, `cityName`, `lastTemperature`) VALUES (-1,\"" . $city . "\", NULL )";
        AppCore::getDB()->sendQuery($sql);
        return true;
    }
	
	// brise red u bazi gdje je ime grada jednako proslijeđenom parametru, tj gradu kojeg oznacimo
	// salje DELETE upit na bazu

    public static function removeCity($city)
    {
        $sql = "DELETE FROM `city_temperature` WHERE cityName = \"" . $city . "\"";
        AppCore::getDB()->sendQuery($sql);
        return true;
    }

// vraca sve gradove iz baze,iz tablice city_temperature i to samo imena gradova, i sprema ih u niz
    public static function getCities()
    {
        $sql = "SELECT cityName FROM `city_temperature`";
        $result = AppCore::getDB()->sendQuery($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

// ažurira vrijednosti u tablici city_temprature unesenim podacima, citydata je niz s podacima o gradu
// i svaki taj podatak se salje u upitu, i postojeci podaci u bazi se zamjene ovima iz proslijedjenog niza
// svaki na svom indeksu, npr cityId prvim podatkom u nizu, cityName drugim , i lastTemperature trecim
    public static function updateTemperatureAndId($cityData)
    {
        $sql = "UPDATE `city_temperature` SET `cityId`=" . $cityData[0] . ",`lastTemperature`=" . $cityData[2] . " WHERE `cityName`=\"" . $cityData[1] . "\"";
        AppCore::getDB()->sendQuery($sql);
        return true;
    }

// dohvaća city, SELECT upitom koji provjerava ime grada, proslijedimo ime i iz baze se 
// prikaze rezultat grada cije ime je isto proslijedjenom. Podaci o gradu se spremaju u niz data
    public static function getCity($city)
    {
    $sql = "SELECT cityName, lastTemperature FROM `city_temperature` WHERE cityName = \"". $city ."\" ";
    $result = AppCore::getDB()->sendQuery($sql);
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

}
