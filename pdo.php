<?php
  declare(strict_types = 1);        // deklaracja użycia trybu kontrolii typu zmiennych
  include('includes/magic_quotes.php');    // usuwa tak zwane "magic quotes" jeżeli korzystamy z wersji php < PHP 6 (takie dziwne zastosowanie które escapuje '' przy zapytaniach sql ale w praktyce śmieci bazę)

  define('Link',[      // w PHP 7 można za pomocą Define() zadeklarować stałą tablicową (wcześniej tylko const)
    'host'     => 'localhost',
    'username' => 'wipaka_rajczogli',
    'password' => 'kauczuk1',
    'database' => 'pdo_test',
    'charset'  => 'utf-8'
  ]);

  try {      // Blok w którym wyjątki bedą przechwytywane (musi mieć swój blok CATCH)
    $grill = new PDO(                    // klasa PDO służy do komunikacji z bazą danych w bezpieczniejszy sposób, przy tworzeniu podobnie jak proceduralnie podaje się dane do bazy
    "mysql:host=".Link['host'].";
    dbname=".Link['database'].";
    charset = ".Link['charset'],
    Link['username'],
    Link['password']
  );
	  echo 'Połączenie nawiązane!';    // jeśli błąd nie wystąpi pokazuje się ten komunikat

    $grill->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    // setAttribute pozwala zmienić niektóre parametry połączenia, tutaj błędy mają być wyświetlane jako wyjątki

    $query = ($grill->query("SELECT * FROM klienci") == false) ? 'pusto' : $grill->query("SELECT * FROM klienci"); // taki tam mały test z ? (warunek ? efekt dla prawdy : efekt dla fałszu (dla fałszu musi być !)) , metoda query tworzy obiekt ze zbiorem wyników podanego polecenia
    echo "<ul>";
    foreach ($query as $row) {      // foreach można przy wynikach stosować wymiennie z while
      echo "<li>".$row['id']." : ".$row['title'];
    }
    while ($row = $query->fetch()) {      // while działa tak jak zawsze przy cięciu tylko korzysta się z metody fetch() (tnie pojedyńczy wiersz, fetchAll(), od razu dzieli wszystkie wiersze)
      echo "<li>".$row['id']." : ".$row['title'];
    }
    $query->closeCursor();   // metoda zamyka zbiór wyników z bazy w tym konkretnym poleceniu, wymagane aby wykonać kolejne polecenie na tej samej zmiennej
    unset($query); // funkcja unset() usuwa podany obiekt (w przypadku PDO i starszych wersji MySQL zdrowa prakyka to usuwanie obiektu po pobraniu wyników)
    echo "</ul>";

    /*
    if($_SERVER['REQUEST_METHOD'] == 'POST'){      // w ten sposób można sprawdzić typ requestu
      $query2 = ($grill->exec("INSERT INTO `klienci` (`title`)	VALUES ('jakiś shit')") > 0) ? 'dodano rekordzik' :"O kurwa mać"; // do wykonywania poleceń nie zwracających wyniku (np INSERT / UPDATE) używa się metody exec która zwraca ilość wierszy które zostały zmienione
      echo $query2;
    }
    */

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $query2 = $grill->prepare( "INSERT INTO `klienci` (`id`,`title`) VALUES ( NULL, :title )" );    // metoda prepare() pozwala wysłąć do bazy danych szkielet zapytania który będzie wykorzystywany później (w szkielecie można w miejsce wartości dodać placeholdery ?, lub :nazwa)
      for ($i=0; $i < 4; $i++) {
        $query2->bindValue(':title','ŁO JAPIERDOLE', PDO::PARAM_STR);      // przed wykonaniem polecenia można placeholdery zastąpić włąściwymi wartościami użytwając bindValue(nazwa placeholdera, wartość, oczekiwany typ zmiennej (PDO::PARAM_typ))

        $wynik = ($query2->execute() > 0) ? 'dodano jakieś rekordziki zajebiśćie szybko w chuj' : 'no nie dodano ;-;';    // metoda execute() wykonuje spreparowane polecenie (działa podobnie jak np exec czy query)
      }      // oczywista zaleta takiej konstrukcji - szkielet tworzony jest raz a wartości wysyłane są kilkuktronie - szybkość x 1000

      echo $wynik;
      $query2->closeCursor();
      unset($query2);
    }



} catch (PDOexception $e) {    // Blok który wykonuje się po przechwyceniu błędu ($e)
    echo "No nie pykło \n";
    echo "Błąd: ".$e->getmessage();      // złapany bład jest obiektem getmessage wypisuje treść
  }


 ?>
 <!DOCTYPE html>
 <form class="" action="" method="post">
   <button type="submit" name="button">Dodaj rekordzik testowy</button>
 </form>
