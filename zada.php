<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zad7</title>
</head>
<style>
    .ramka{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding-top: 10px;
    }
    .ramka1{
        border: 1px green solid;
        width: 700px;
        padding: 20px;
        margin-top: 75px;
        background-color: #00cc00;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        border-radius: 20px;
    }
    .text{
        height: 34px;
        width: 200px;
        border-radius: 20px;
    }
    select{
        height: 40px;
        width: 207px;
        margin-left: 30px;
        border-radius: 20px;
        border: #4b4b4b solid 2px;
    }
    .przycisk{
        height: 40px;
        width: 200px;
        margin-left: 30px;
        border-radius: 20px;
        cursor: pointer;
    }
    .rameczka{
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    h1{
        margin-top: 10px;
    }
    .form1{
        background-color: #3cff3c;
        margin-left: -20px;
        margin-right: -20px;
        margin-bottom: 20px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    .form2{
        background-color: #41fc41;
        margin-left: -20px;
        margin-right: -20px;
        margin-bottom: -20px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
</style>
<body class="ramka">
<div class="ramka1">
    <h1>Oblicz wiek i dni robocze</h1>
    <form action="" method="post" class="form1">
        <h3>Oblicz wiek i czas lokalny</h3>
        <div class="rameczka">
            <input type="text" id="text" name="text" placeholder="Data urodzenia (d-m-Y)" required class="text">
            <select id="strefa" name="strefa" required>
                <option value="" disabled selected>Wybierz strefę czasową...</option>
                <option value="europa">Europa/Warszawa</option>
                <option value="afryka">Afryka/Abidjan</option>
                <option value="azja">Azja/Tokio</option>
                <option value="amerykaN">Ameryka Północna/Nowy Jork</option>
                <option value="amerykaS">Ameryka Połódniowa/Sao Paulo</option>
            </select>
            <input type="submit" name="przycisk" value="Oblicz wiek i czas" class="przycisk">
        </div>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["przycisk"])){

            $data = $_POST['text'];
            $liczby = array();
            preg_match_all('/\d+/', $data, $liczby);
            if(count($liczby[0]) == 3) {
                $rokurodzenia = end($liczby[0]);
                $dejta = new DateTime();
                $rok = $dejta->format('Y');
                $lat = $rok - $rokurodzenia;
                echo "Wiek: " . $lat . "<br>";
            }
            else{
                echo "Niepoprawna data urodzenia!!!";
            }
            $opcja = $_POST["strefa"];
            if($opcja=='europa'){
                $time = new DateTime("now", new DateTimeZone("Europe/Warsaw"));
                echo "Czas lokalny: ".$time->format('H:i:s')."<br>";
            }

            elseif ($opcja=='afryka'){
                $time = new DateTime("now", new DateTimeZone("Africa/Abidjan"));
                echo "Czas lokalny: ".$time->format('H:i:s')."<br>";
            }
            elseif ($opcja=='azja'){
                $time = new DateTime("now", new DateTimeZone("Asia/Tokyo"));
                echo "Czas lokalny: ".$time->format('H:i:s')."<br>";
            }
            elseif ($opcja=='amerykaN'){
                $time = new DateTime("now", new DateTimeZone("America/New_York"));
                echo "Czas lokalny: ".$time->format('H:i:s')."<br>";
            }
            elseif ($opcja=='amerykaS'){
                $time = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
                echo "Czas lokalny: ".$time->format('H:i:s')."<br>";
            }

        }
        ?>

    </form>
    <form action="" method="post" class="form2">
        <h3>Oblicz dni robocze</h3>
        <div class="rameczka">
            <input type="text" id="text2" name="text2" placeholder="Data początkowa (d-m-Y)" required class="text">
            <input style="margin-left: 30px" type="text" id="text3" name="text3" placeholder="Data końcowa (d-m-Y)" required class="text">
            <input type="submit" name="przycisk2" value="Oblicz dni robocze" class="przycisk">
        </div>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["przycisk2"])){
            $poczatek = $_POST['text2'];
            $koniec = $_POST['text3'];
            $tab1=array();
            $tab2=array();
            preg_match_all('/\d+/', $poczatek, $tab1);
            preg_match_all('/\d+/', $koniec, $tab2);

            $blad1 = DateTime::getLastErrors();
            $blas2 = DateTime::getLastErrors();

            if(count($tab1[0]) == 3 && count($tab2[0]) == 3) {

                $data1 = DateTime::createFromFormat('d-m-Y', $poczatek);
                $data2 = DateTime::createFromFormat('d-m-Y', $koniec);
                if($data1 && $data2) {
                    $suma = 0;
                    while ($data1 <= $data2) {
                        if ($data1->format('N') >= 1 && $data1->format('N') <= 5) {
                            $suma++;
                        }
                        $data1->modify('+1 day');
                    }
                }
                echo "Dni roboczych: ".$suma."<br>";
            }else{
                echo "Niepoprawny format daty!!!";
            }

        }
        ?>
    </form>
</div>
</body>
</html>